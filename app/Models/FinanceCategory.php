<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceCategory extends Model
{
    protected $fillable = [
        'finance_code',
        'descriptions',        
    ];
}
