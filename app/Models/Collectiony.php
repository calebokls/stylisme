<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Collectiony extends Model
{
    use HasFactory;
    protected $fillable = ['product','name','nbres'];
    public function marques():BelongsTo
    {
        return $this->belongsTo(Marques::class);
    }
}
