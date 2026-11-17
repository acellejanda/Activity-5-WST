<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewsFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(user1::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product1::class, 'product_id');
    }
}
