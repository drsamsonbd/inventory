<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class optimumlevel extends Model
{
    protected $fillable = [
       'department_id','item_id','optimum_level','minimum_level'
    ];
}
