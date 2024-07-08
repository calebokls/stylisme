<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Marques extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'description',
        'slogan'
    ];

    public function propertie():BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'property_marques');
    }

    public function collectionies():HasMany
    {
        return $this->hasMany(Collectiony::class);
    }

    public function modelies():HasMany
    {
        return $this->hasMany(Modely::class);
    }

    public function users():BelongsTo
    {
       return  $this->belongsTo(User::class);
    }

    public function getImageForMarquesUrl()
    {
        return Storage::disk('public')->url($this->logo);
    }
}
