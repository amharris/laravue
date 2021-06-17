<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                'data' => $reward->latest()->get()
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
            redirect()->back()
            ->with('errors', 'Somethings went wrong.');
        }
        return redirect()->back()
            ->with('message', 'Reward successfully deleted.');
    }
}
