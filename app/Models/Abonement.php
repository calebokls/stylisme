<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','debut','fin','premium'];
    protected $casts = [
        'debut' => 'datetime',
        'fin' => 'datetime',
    ];
}
