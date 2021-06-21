<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reward;

class UserController extends Controller
{

    public function me(Request $request)
    {
        return $request->user()->only(['name', 'email', 'points']);
    }

    public function rewards(Request $request)
    {
        $user = $request->user();

        $rewards = Reward::where('point_min', '<=', $user->points)->get(['name', 'point_min', 'id']);

        return [
            'points' => $user->points,
            'rewards' => $rewards,
            'redeems' => $user->redeems()->with('reward:id,name')->get()->pluck('reward')
        ];
    }

    public function redeem(Request $request, Reward $reward)
    {
        $status = 'error';
        $rewardEarned = [];
        if ($reward) {
            if ($reward->point_min <= $request->user()->points) {
                $request->user()->redeems()->create([
                    'reward_id' => $reward->id,
                    'by_admin' => false,
                ])->save();
                $status = 'success';
                $rewardEarned = ['name' => $reward->name, 'id' => $reward->id];
            }
        }

        return [
            'status' => $status,
            'reward' => $rewardEarned,
            'points' => $request->user()->refresh()->points
        ];
    }
}
