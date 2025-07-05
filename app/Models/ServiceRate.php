<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRate extends Model
{
    protected $fillable = [
        'user_id',
        'payment_id',
        'rate',
        'comment'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
