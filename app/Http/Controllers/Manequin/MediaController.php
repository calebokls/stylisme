<?php

namespace App\Http\Controllers\Manequin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function destroy(Media $media)
    {
        $media->delete();
        return back()->with('success','Media supprimer avec succès');
    }
}
