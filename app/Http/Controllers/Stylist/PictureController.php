<?php

namespace App\Http\Controllers\Stylist;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function destroy(Pictures $picture)
    {
         $picture->delete();
         return back()->with('success','Image supprimé avec succès');
    }
}
