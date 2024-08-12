<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'harga_total',
        'status',
    ];

    // Definisikan relasi dengan OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
