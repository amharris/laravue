<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reward()
    {
        return $this->hasMany(RewardRedeem::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function bag()
    {
        return $this->hasOne(TransactionBag::class);
    }

    public function latestBag()
    {
        return $this->hasOne(TransactionBag::class)->latestOfMany()->first();
    }

    public function points()
    {
        return $this->belongsToMany(RewardPoint::class, 'transactions', 'user_id', 'point_id')
            ->sum('point');
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'reward_redeems', 'user_id', 'reward_id')
            ->withPivot('by_admin')->withTimestamps();
    }
}
