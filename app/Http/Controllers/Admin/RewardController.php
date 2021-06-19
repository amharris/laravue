<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reward;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class RewardController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Reward $reward)
    {
        return Inertia::render(
            'Admin/Reward',
            [
                'data' => $reward->withcount('redeems')->get(),
                'customers' => User::where('is_admin', false)->get(['id', 'name','points']),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'point_min' => ['required'],
        ])->validate();

        $data = $request->all();
        $data['created_at'] = \Carbon\Carbon::now();
        Reward::create($data);

        return redirect()->back()
            ->with('message', 'Reward Added Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reward $reward)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'point_min' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            $reward->update($request->all());
            return redirect()->back()
                ->with('message', 'Reward Successfully Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        try {
            $reward->delete();
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()
            ->with('errors', 'Somethings went wrong: ' . $th->getMessage());
        }
        return redirect()->back()
            ->with('message', 'Reward successfully deleted.');
    }


    public function redeem(Request $request)
    {
        if ($request->has(['reward_id', 'user_id'])) {
            $user = User::findOrFail($request->post('user_id'));
            // $user->rewards()->attach($request->post('reward_id'), ['by_admin' => true]);
            $user->redeems()->firstOrNew([
                'reward_id' => $request->post('reward_id'),
                'by_admin' => true,
            ])->save();
        }
        // Log::info(print_r($request->post(), true));
        return redirect()->back()
            ->with(
                'message',
                'Successfully redeem reward points!'
            );
    }
}
