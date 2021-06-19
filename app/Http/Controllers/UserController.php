<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{

    private $user ;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware(function ($request, $next) {

            $authuser = Auth::user();
            $this->user = User::findOrFail($authuser->id);

            if ($authuser->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }
            return $next($request);
        });
        
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return Inertia::render(
            'Dashboard',
            [
                'data' => $this->user,
                'rewards' => Reward::where('point_min', '<=', $this->user->points)->get(),
                'redeems' => $this->user->redeems()->with('reward')->get(),
            ]
        );
    }

    /**
     * Redeem page
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reward $reward
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function redeem(Request $request, Reward $reward)
    {
        if ($request->has('user') && $request->post('user') == $this->user->id) {

            $this->user->redeems()->create([
                'reward_id' => $reward->id,
                'by_admin' => false,
            ])->save();
        }
        return Inertia::render(
            'Redeem',
            [
                'data' => $reward,
                'user' => $this->user->refresh()
            ]
        );
    }
}