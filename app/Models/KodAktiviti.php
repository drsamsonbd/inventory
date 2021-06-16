<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodAktiviti extends Model
{
   
    protected $fillable = [
        'aktiviti_code',
        'akitiviti_descriptions',
        'ol_code',          
    ];
}
