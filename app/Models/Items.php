<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'item_code',
        'descriptions',
        'sku',
        'pku',
        'dku',
        'avpu',
        'image',
        'category_id',
    ];
}
