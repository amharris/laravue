<?php

namespace App\Observers;

use App\Models\Reward;
use App\Models\RewardRedeem;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RewardRedeemObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the RewardRedeem "created" event.
     *
     * @param  \App\Models\RewardRedeem  $rewardRedeem
     * @return void
     */
    public function created(RewardRedeem $rewardRedeem)
    {
        // Log::info(print_r($rewardRedeem, true));
        $rewardPoint = Reward::findOrFail($rewardRedeem->reward_id)->point_min;

        $user = User::findOrFail($rewardRedeem->user_id);
        $user->points -= (int)$rewardPoint;
        $user->save();
    }

    /**
     * Handle the RewardRedeem "updated" event.
     *
     * @param  \App\Models\RewardRedeem  $rewardRedeem
     * @return void
     */
    public function updated(RewardRedeem $rewardRedeem)
    {
        //
    }

    /**
     * Handle the RewardRedeem "deleted" event.
     *
     * @param  \App\Models\RewardRedeem  $rewardRedeem
     * @return void
     */
    public function deleted(RewardRedeem $rewardRedeem)
    {
        //
    }

    /**
     * Handle the RewardRedeem "restored" event.
     *
     * @param  \App\Models\RewardRedeem  $rewardRedeem
     * @return void
     */
    public function restored(RewardRedeem $rewardRedeem)
    {
        //
    }

    /**
     * Handle the RewardRedeem "force deleted" event.
     *
     * @param  \App\Models\RewardRedeem  $rewardRedeem
     * @return void
     */
    public function forceDeleted(RewardRedeem $rewardRedeem)
    {
        //
    }
}
