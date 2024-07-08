<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrimaryRequest;
use App\Models\Primary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrimaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            return view('admin.primary.index',[
                'primaries'=>Primary::orderby('created_at','DESC')->paginate(2)
            ]);
        }else{
            return back()->with('danger','Impossible d\'effectuer cette acton');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            $primary = new Primary();
            return view('admin.primary.form',[
                'primary'=>$primary
            ]);
        }else{
            return back()->with('danger','Impossible d\'effectuer cette action');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrimaryRequest $request)
    {
        $primaires = new Primary();
        $primaires->create($request->validated());
        return to_route('admin.primary.index')->with('success','Sous categorie créé avec succès');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Primary $primary)
    {
        if(Auth::user() && Auth::user()->acteur ==="admin")
        {
            return view('admin.primary.form',[
                'primary'=>$primary
            ]);
        }else{
            return back()->with('danger','Impossible d\'effectuer cette action');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrimaryRequest $request, Primary $primary)
    {
        $primary->update($request->validated());
        return to_route('admin.primary.index')->with('success','Sous categorie modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Primary $primary)
    {
        $primary->delete();
        return to_route('admin.primary.index')->with('success','Sous categorie supprimer avec succès');
    }
}
