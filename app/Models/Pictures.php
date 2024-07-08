<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pictures extends Model
{
    use HasFactory;
    protected $fillable = ['file'];



    public function getUrlForModelyImage()
    {
        return Storage::disk('public')->url($this->file);
    }
}
