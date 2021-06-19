<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardRedeem extends Model
{

    protected $fillable = [
        'user_id',
        'reward_id',
        'by_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}
