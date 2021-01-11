<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'product_name',
        'product_code',
        'description',
        'root',
        'supplier_id',
        'sku',
        'item_type',
        'average_price',
        'image',
        'product_quantity'
    ];
}
