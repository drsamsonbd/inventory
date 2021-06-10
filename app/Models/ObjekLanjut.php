<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekLanjut extends Model
{
    protected $fillable = [
        'ol_code',
        'ol_descriptions',
        'finance_code_id',          
    ];
}
