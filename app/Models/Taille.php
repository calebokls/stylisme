<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Taille extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function model():BelongsTo
    {
        return $this->belongsTo(Modely::class);
    }
}
