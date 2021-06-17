<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionBagItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'bag_id',
        'qty',
        'total_price',
        'created_at',
        'updated_at',
    ];

    public function item()
    {
        return $this->hasOne(TransactionItem::class, 'item_id');
    }

    public function bag()
    {
        return $this->hasOne(TransactionBag::class, 'bag_id');
    }
}
