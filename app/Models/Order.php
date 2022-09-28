<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable  = ['user_id', 'product_id', 'total_quantity', 'payment', 'address', 'phone', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
