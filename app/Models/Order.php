<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['table_number', 'order_type', 'items', 'total_price', 'status'];
    protected $casts = ['items' => 'array'];
}
