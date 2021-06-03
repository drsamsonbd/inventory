<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    protected $fillable = [
        'department_id', 'item_id', 'current_level', 'change_type', 'change_detail', 'quantity', 'date',
    ];
}
