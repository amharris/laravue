<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardRedeem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reward_id',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function reward()
    {
        return  $this->belongsToMany(Reward::class);
    }
}
