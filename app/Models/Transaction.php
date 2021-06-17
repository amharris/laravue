<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total_payment',
        'reference_id',
        'point_id',
        'created_at',
        'updated_at',
    ];

    public function point()
    {
        return $this->belongsTo(RewardPoint::class, 'point_id');
    }

    public function detail()
    {
        return $this->hasMany(TransactionDetail::class, 'trx_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
