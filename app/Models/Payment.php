<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    
    protected $fillable = [
        'user_id',
        'address_id',
        'products',
        'status',
        'delivery_date',
        'delivery_time',
        'shipping_method',
        'idPesanan',
        'bukti_pembayaran',
        'total',
    ];

    protected $casts = [
        'products' => 'array',
        'delivery_date' => 'date',
        'delivery_time' => 'datetime:H:i',
        'total' => 'integer',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
