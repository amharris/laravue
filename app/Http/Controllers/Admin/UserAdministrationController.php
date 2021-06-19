<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserAdministrationController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render(
            'Admin/UserAdministration',
            [
                'data' => User::where('is_admin', false)
                    ->select(['id', 'name', 'email', 'points'])
                    ->withcount('rewards')
                    ->paginate(6)
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
            'email' => ['required'],
            'password' => ['required'],
        ])->validate();

        $data = $request->all();
        $data['is_admin'] = false;
        $data['password'] = Hash::make($request->get('password'));
        $data['created_at'] = \Carbon\Carbon::now();
        User::create($data);

        return redirect()->back()
            // ->with('data', User::where('is_admin', false)->get(['id', 'name', 'email']))
            ->with('message', 'User Added Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            User::find($request->input('id'))->update($request->all());
            return redirect()->back()
                ->with('message', 'User Successfully Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->back()
                ->with('errors', 'Somethings went wrong: ' . $e->getMessage());
        }
        return redirect()->back()
            ->with('message', 'User successfully deleted.');
    }

    public function rewards(User $user)
    {
        // $rewards = $user->rewards;
        return response()->json($user->redeems()->with('reward')->get());
    }
}
