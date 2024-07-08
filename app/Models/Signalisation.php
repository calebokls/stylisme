<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signalisation extends Model
{
    use HasFactory;
    protected $fillable = ['motif'];

    public function signalingUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
