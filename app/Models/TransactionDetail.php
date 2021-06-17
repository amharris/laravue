<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'price',
        'qty',
        'total_price',
        'trx_id',
        'created_at',
        'updated_at',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'trx_id');
    }

    public function items()
    {
        return $this->belongsTo(TransactionItem::class, 'item_id');
    }
}
