<?php

namespace App\Http\Controllers\Manequin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManequinaRequest;
use App\Models\Manequina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Table;

class ManequinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manequins.index',[
             'manequins'=>Manequina::paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manequin = new Manequina();
        return view('manequins.form',[
            'manequin'=>$manequin
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManequinaRequest $request)
    {
        $manequin  = Manequina::create($request->validated());
        $manequin->AttacheMedia($request->validated('files'));
        return to_route('manequina.manequin.index')->with('success','Photo de manequina ajouté avec succès');
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
    public function edit(Manequina $manequin)
    {
        return view('manequins.form',[
            'manequin'=>$manequin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ManequinaRequest $request, Manequina $manequin)
    {
       $images = DB::table('manequinas')
                     ->select('manequinas.name')
                     ->leftJoin('media','media.manequina_id','=','manequina_id')
                     ->where('manequina_id','=',$manequin->id)
                     ->get()
             ;
          if(count($images) == 0 && $request->file('files')==null)
          {
            return to_route('manequina.manequin.edit',$manequin)->with('danger','Vous devez ajouter au moins une image ou video à '.$manequin->name);
          }
        $manequin->update($request->validated());
        $manequin->AttacheMedia($request->validated('files'));
        return to_route('manequina.manequin.index')->with('success','photo de manequina modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manequina $manequin)
    {
      $manequin->delete();
      return to_route('manequina.manequin.index')->with('success','Photo supprimer avec success');
    }
}
