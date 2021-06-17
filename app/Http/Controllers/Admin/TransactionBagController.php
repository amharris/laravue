<?php

namespace App\Http\Controllers\Admin;

use App\Models\TransactionBag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionBagController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        if ($request->has(['cart', 'item'])) {
            $item = $request->get('item');
            $bag = TransactionBag::findOrFail($request->get('cart'));

            $bag->items()->attach($item['id'], [
                'qty'=> $item['quantity'],
                'total_price' => $item['subtotal']
            ]);

            return $item['id'];
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionBag  $transactionBag
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionBag $transactionBag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionBag  $transactionBag
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionBag $transactionBag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionBag  $transactionBag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionBag $transactionBag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\TransactionBag  $bag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TransactionBag $bag)
    {
        // Log::info(print_r($request->all(), true));

        // return response()->json($bag);
        $item = $request->all();
        $bag->items()->detach($item['id']);

        return response()->json($item['id']);
    }
}
