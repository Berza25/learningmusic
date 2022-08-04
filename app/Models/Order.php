<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['gross_amount', 'snap_token', 'user_id', 'payment_status', 'number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
