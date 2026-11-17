<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    /** @use HasFactory<\Database\Factories\OrdersFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(user1::class, 'user_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    /** Products contained in this order through order_products. */
    public function products()
    {
        return $this->belongsToMany(Product1::class, 'order_products', 'order_id', 'product_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function product1s()
    {
        return $this->products();
    }
}
