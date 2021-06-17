<?php

namespace App\Http\Controllers\Admin;

use App\Models\RewardPoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class RewardPointController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RewardPoint $rewardPoint)
    {
        return Inertia::render(
            'Admin/RewardPoint',
            [
                'data' => $rewardPoint->latest()->get(['id', 'rule_name', 'point', 'rate', 'type'])
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
            'rule_name' => ['required'],
            'point' => ['required'],
            'type' => ['required'],
        ])->validate();

        $data = $request->all();
        if (!$request->get('rate') && $request->get('type') == 'fixed') {
            $data['rate'] = 1;
        }
        $data['created_at'] = \Carbon\Carbon::now();
        RewardPoint::create($data);

        return redirect()->back()
            ->with('message', 'Point Added Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RewardPoint  $rewardPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RewardPoint $rewardPoint)
    {
        Validator::make($request->all(), [
            'rule_name' => ['required'],
            'rate' => ['required'],
            'point' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            RewardPoint::find($request->input('id'))->update($request->except('id'));
            return redirect()->back()
                ->with('message', 'Point Successfully Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RewardPoint  $rewardPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(RewardPoint $rewardPoint)
    {
        try {
            $rewardPoint->delete();
        } catch (\Throwable $th) {
            //throw $th;
            redirect()->back()
            ->with('errors', 'Somethings went wrong.');
        }
        return redirect()->back()
            ->with('message', 'Point successfully deleted.');
    }
}
