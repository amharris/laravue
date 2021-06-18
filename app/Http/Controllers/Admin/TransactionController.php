<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\TransactionBag;
use App\Models\TransactionDetail;
use App\Models\RewardPoint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TransactionController extends AdminController
{
    const TRX_STATUS = 'pending';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render(
            'Admin/Transaction',
            [
                'data' => Transaction::with('user')->with('point')->latest()->get(),
                'customers' => User::where('is_admin', false)->take(10)->get(['id', 'name as text']),

            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cust = $request->post('user_id');
        if (!$cust) {
            return redirect()->route('transactions.index')->with('message', 'Select User first');
        }
        $items = [];
        $bag = TransactionBag::where('user_id', $cust)
            ->where('submitted', false)
            ->latest()
            ->first();

        if (empty($bag)) {
            $user = User::findOrFail($cust);
            $user->bag()->create(['total_payment' => 0]);

            $bag = $user->latestBag();
        } else {
            $bagitems = $bag->items()->get();

            foreach ($bagitems as $key => $item) {
                $items[$key]['id'] = $item->id;
                $items[$key]['name'] = $item->name;
                $items[$key]['price'] = $item->price;
                $items[$key]['quantity'] = $item->pivot->qty;
                $items[$key]['subtotal'] = $item->pivot->total_price;
            }
        }
        // Log::info(print_r(User::findOrFail($cust)->toArray(), true));

        return Inertia::render('Admin/TransactionNew',
        [
            // 'customers' => User::where('is_admin', false)->get(['id', 'name as text']),
            // 'cart' => [
                // ['id'=> null, 'name'=>'-- Add new item --', 'quantity'=>0, 'price'=>0, 'subtotal'=>0] 
            // ],

            'cart' => $bag,
            'items' => $items,
            'customer' => User::findOrFail($cust),
            'rewardpoint' => RewardPoint::latest()->first(),

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        // return response()->json($transaction->get());
        return Inertia::render('Admin/TransactionDetails',[
            'data' => $transaction->with('detail.items')->with('user')->with('point')->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Log::info(print_r($request->post(), true));

        if ($request->has(['customer', 'cart', 'rewardpoint', 'total'])) {
            $trxData = $request->post();

            $detail = [];
            $userId = $trxData['customer']['id'];
            $uuid = Str::uuid()->toString();
            foreach ($trxData['cart'] as $key => $item) {
                $detail[$key]['item_id'] = $item['id'];
                $detail[$key]['qty'] = $item['quantity'];
                $detail[$key]['price'] = $item['price'];
                $detail[$key]['total_price'] = $item['subtotal'];
            }

            $transaction = Transaction::create([
                'user_id' => $userId,
                'status' => self::TRX_STATUS,
                'total_payment' => $trxData['total'],
                'point_id' => $trxData['rewardpoint']['id'],
                'reference_id' => $uuid
            ]);

            $transaction->detail()->createMany($detail);

            $bag = TransactionBag::where('user_id', $userId)
                ->where('submitted', false)
                ->latest()
                ->first();

            $bag->submitted = true;
            $bag->save();
        }

        return redirect()->route('transactions.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
