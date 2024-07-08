<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Acteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            return view('admin.acteur.index',[
                "acteurs"=>Acteur::paginate(25)
            ]);
        }else{
            return back()->with('danger','Vous n\'etes pas autorisé a effectué cette action');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $acteur = new Acteur();
        return view('admin.acteur.form',[
            'acteur'=>$acteur
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
