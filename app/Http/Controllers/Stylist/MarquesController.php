<?php

namespace App\Http\Controllers\stylist;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarquesRequest;
use App\Models\Marques;
use App\Models\Property;
use App\Models\validationy;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MarquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('danger','Veuillez vous connecter');
        }
        if(Auth::user() && Auth::user()->acteur === 'styliste' )
        {
            return view('styliste.marques.index',[
                'marques'=> Marques::where('user_id',Auth::user()->id)->paginate(8)
             ]);
        }else{
            return back()->with('danger','vous n\'etes pas autorisé a effectué cette action');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('danger','Veuillez vous connecter');
        }

        if(Auth::user() && Auth::user()->acteur === 'styliste' )
        {
            $validation = validationy::where('user_id',Auth::user()->id)->first();
            if(empty($validation))
            {
               return to_route('validation.validationy.create')->with('danger','Veullez renseigner vos identifiant de validation');
            }elseif($validation->validary == false){
               return to_route('style.marque.index')->with('success','Vos identifiant sont en cours de validation.');
            }else{
               $marque = new Marques();
               return view('styliste.marques.form',[
                   'marque'=>$marque,
                   'primaries'=> Property::pluck('name','id')
               ]);
            }
        }else{
            return back()->with('danger','Vous n\'etes pas autorisé a effectué cette action');
        }
    }
    public function show(Marques $marque)
    {
        return view('styliste.marques.show',[
            'marque'=>$marque
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarquesRequest $request)
    {
        $marquesData = $this->ExtractData(new Marques(),$request);
        $marquesData['user_id'] = Auth::user()->id;
        $marque = new Marques();
        $marque->logo = $marquesData['logo'];
        $marque->name= $marquesData['name'];
        $marque->description= $marquesData['description'];
        $marque->slogan= $marquesData['slogan'];
        $marque->user_id = $marquesData['user_id'];
        $marque->save();
         $marque->propertie()->sync($request->validated('propertie'));
        return to_route('style.marque.index')->with('success','Marque créé avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marques $marque)
    {
        $find = Marques::find($marque)->where('user_id',Auth::user()->id)
                                      ->where('name',$marque->name)
                                      ->first();
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('danger','Veuillez vous connecter');
        }

        if(Auth::user() && Auth::user()->acteur === "styliste" && $find)
        {
                $primaries = Property::pluck('name','id');
                return view('styliste.marques.form',[
                    'marque'=>$marque,
                    'primaries'=>$primaries
                ]);
        }else{
           return back()->with('danger','La marque que vous voulez modifier n\'est pas le votre');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarquesRequest $request, Marques $marque)
    {
        $marquesData = $this->ExtractData(new Marques(),$request);
        $marquesData['user_id'] = Auth::user()->id;
        if(array_key_exists('logo',$marquesData))
        {
          $marque->logo = $marquesData['logo'];
        }
        $marque->name= $marquesData['name'];
        $marque->description= $marquesData['description'];
        $marque->slogan= $marquesData['slogan'];
        $marque->user_id = $marquesData['user_id'];
        $marque->save();
        $marque->propertie()->sync($request->validated('propertie'));
        return to_route('style.marque.index')->with('success','Marque modifier avec succès');
    }

    private function ExtractData(Marques $marque,MarquesRequest $request):array
    {

        $data = $request->validated();
       /**
        * @var HttpUploadedFile $image
        */
        $image = $request->validated('logo');
        if($image === null || $image->getError()){
            return $data;
        }
        if($marque->logo)
        {
            Storage::disk('public')->delete($marque->logo);
        }
        $data['logo'] = $image->store('marques','public');
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(marques $marque)
    {
        $marque->delete();
        return to_route('style.marque.index')->with('success','Marque supprimer avec succès');
    }

    public function SearchStylMarque(Request $request)
    {
        $search = $request->input('search');
        $marques = Marques::where('name','LIKE','%'.$search.'%')
                           ->where('user_id',Auth::user()->id)
                           ->get()
                          ;
        return view('styliste.marques._searchstylmarque',[
            'marques'=>$marques
        ]);

    }
}
