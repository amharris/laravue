<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionBag extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_payment',
        'created_at',
        'updated_at',
    ];

    public function items()
    {
        return $this->belongsToMany(TransactionItem::class, 'transaction_bag_items', 'bag_id', 'item_id')
            ->withPivot('qty', 'total_price');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
