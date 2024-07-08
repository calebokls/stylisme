<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class validationy extends Model
{
    use HasFactory;

    protected $fillable = ['nom','prenom','photo','piece','user_id','validary','image_data'];
     public function UserValidation()
     {
        return $this->hasOne(User::class);
     }
}
