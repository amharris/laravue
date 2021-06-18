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
        return $this->belongsToMany(User::class, 'reward_redeems');
    }
}
