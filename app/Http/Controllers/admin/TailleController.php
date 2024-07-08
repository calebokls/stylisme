<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TailleRequest;
use App\Models\Taille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TailleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            return view('admin.taille.index',[
                'tailles'=>Taille::paginate(4)
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
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            $taille = new Taille();
              return view('admin.taille.form',[
                        'taille'=>$taille
               ]);
        }else{
            return back()->with('danger','Vous n\'etes pas autorisé a effectué cette action');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TailleRequest $request)
    {
        $tailles = Taille::create($request->validated());
        return to_route('admin.taille.index')->with('success','Taille créé avec succès');
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
    public function edit(Taille $taille)
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            return view('admin.taille.form',[
                'taille'=>$taille
            ]);
        }else{
            return back()->with('danger','Vous n\'etes pas autorisé a effectué cette action');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TailleRequest $request, Taille $taille)
    {
        $taille->update($request->validated());
        return to_route('admin.taille.index')->with('success','Taille modifier avec succèss');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TailleRequest $taille)
    {
        $taille->delete();
        return to_route('admin.taille.index')->with('success','Taille supprimer avec succès');
    }
}
