<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Manequina extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public function medias():HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function AttacheMedia(?array $medias)
    {
        $files= [];
        if($medias>0)
        {
           foreach($medias as $media)
           {
              if($media->getError())
              {
                continue;
              }
              $fileaname = $media->store('media/'.$this->id,'public');
              $files[] = [
                  'files'=>$fileaname
              ];
           }
        }

        if(count($files)>0)
        {
            $this->medias()->createMany($files);
        }
    }
  public function getMedias()
  {
    return $this->medias[0]?? null;
  }
 }
