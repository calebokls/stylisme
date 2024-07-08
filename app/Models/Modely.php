<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Modely extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'genre',
        'user_id',
        'marques_id'
    ];

    public function pictures():HasMany
    {
        return $this->hasMany(Pictures::class);
    }

    public function UserModely():HasOne
    {
        return $this->hasOne(User::class);
    }

    public function marques():BelongsTo
    {
        return $this->belongsTo(Marques::class);
    }
    public function tailles():BelongsToMany
    {
        return $this->belongsToMany(Taille::class,'tailles_modelies');
    }

    public function AttacheFiles(?array $files)
    {
        $pictures = [];
        if($files > 0)
        {
            foreach($files as $file)
            {
                if($file->getError())
                {
                    continue;
                }
                $filename = $file->store('modely/'.$this->id,'public');
                $pictures[] = [
                    'file'=>$filename
                ];
            }
        }
        if(count($pictures) > 0)
        {
            $this->pictures()->createMany($pictures);
        }
    }

    public function getPicture():?Pictures
    {
        return $this->pictures[0]?? null;
    }

}
