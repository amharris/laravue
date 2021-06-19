<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'point_min'
    ];

    public function redeems()
    {
        return $this->hasMany(RewardRedeem::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, RewardRedeem::class, 'reward_id', 'id', 'id', 'user_id');
    }
}
