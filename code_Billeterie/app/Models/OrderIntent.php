<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIntent extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_intent_id';

    protected $fillable = [
        'order_intent_price',
        'order_intent_type',
        'user_email',
        'user_phone',
        'expiration_date',
    ];
}
