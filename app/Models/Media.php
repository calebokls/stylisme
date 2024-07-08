<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Static_;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['files'];

    public static function booted()
    {
       Static::deleting(function(Media $media){
        Storage::disk('public')->delete($media->files);
       });
    }


    public function getUrlForManequinaImage()
    {
        return Storage::disk('public')->url($this->files);
    }
}
