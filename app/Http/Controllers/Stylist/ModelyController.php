<?php

namespace App\Http\Controllers\Stylist;

use App\Models\Modely;
use App\Models\Marques;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModelyRequest;
use App\Models\Abonement;
use App\Models\Taille;
use App\Models\validationy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('success','veuillez vous connecter');
        }elseif(Auth::user() && Auth::user()->acteur === 'styliste')
        {
            return view('styliste.modely.indexs',[
                'modelies'=>Modely::with('marques')->where('user_id',Auth::user()->id)->paginate(8)
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
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('danger','Veuillez vous connecter');
        }
        elseif(Auth::user() && Auth::user()->acteur === "styliste"){
            $validation = validationy::where('user_id',Auth::user()->id)
                                      ->first()
                                      ;
            $susbcribe = Abonement::where('user_id',Auth::user()->id)->first();
                if($susbcribe->fin->isPast())
                {
                    $premium = false;
                    $susbcribe->premium = $premium;
                    $susbcribe->save();
                }
            if(empty($validation))
            {
                return to_route('validation.validationy.create')->with('danger','Veullez renseigner vos identifiant de validation');
            }elseif($validation->validary == false)
            {
                return back()->with('success','Vos identifiant sont en cours de validation.Veuillez patienter');
            }else{
                if($susbcribe && $susbcribe->premium == false)
                {
                    return to_route('index')->with('success','Veuillez renouveller votre abonement');
                }elseif(empty($susbcribe) && Modely::where('user_id',Auth::user()->id)->count()<1 )
                {
                    $modely = new Modely();
                    $primaries = Taille::pluck('name','id');
                    $marques = Marques::where('user_id',Auth::user()->id)->pluck('name','id')->toArray();
                    $selectedPrimaries = DB::table('modelies')
                                           ->join('marques', 'marques.id', '=', 'modelies.marques_id')
                                           ->where('modelies.id', '=', $modely->id)
                                           ->pluck('marques.name')
                                           ->toArray();
                    return view('styliste.modely.form',[
                        'modely'=>$modely,
                        'marques'=>$marques,
                        'primaries'=>$primaries,
                        'selectedPrimaries'=>$selectedPrimaries
                    ]);
                }
                elseif(empty($susbcribe) && Modely::where('user_id',Auth::user()->id)->count()>=1){
                    return to_route('index')->with('success','Devenez premium pour beneficier plus de possibilité');
                }
                else{
                    $modely = new Modely();
                    $primaries = Taille::pluck('name','id');
                    $marques = Marques::where('user_id',Auth::user()->id)->pluck('name','id')->toArray();
                    $selectedPrimaries = DB::table('modelies')
                                           ->join('marques', 'marques.id', '=', 'modelies.marques_id')
                                           ->where('modelies.id', '=', $modely->id)
                                           ->pluck('marques.name')
                                           ->toArray();
                    return view('styliste.modely.form',[
                        'modely'=>$modely,
                        'marques'=>$marques,
                        'primaries'=>$primaries,
                        'selectedPrimaries'=>$selectedPrimaries
                    ]);
                }
            }
        }else{
            return back()->with('danger','Vous n\'ètes pas autorisé a effectué cette action');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModelyRequest $request)
    {
        $modelyData= $request->validated();
        $modelyData['user_id'] = Auth::user()->id;
        $modelyData['marques_id'] = $request->input('marque');
        $modely = Modely::create($modelyData);
        $modely->tailles()->sync($request->validated('taille'));
       $modely->AttacheFiles($request->validated('pictures'));
       return to_route('style.modely.index')->with('success','Model créé avec succès');
    }

    public function show(Modely $modely)
    {
        $modeliesUsers = Modely::where('user_id','=',$modely->user_id)->get();
        return view('styliste.modely.show',[
            'modely'=>$modely,
            'modeliesUsers'=>$modeliesUsers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modely $modely)
    {
        $find = Modely::find($modely)->where('user_id',Auth::user()->id)
                        ->where('name',$modely->name)
                        ->first();
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('danger','Veuillez vous connecter');
        }
        if(Auth::user() && Auth::user()->acteur === "styliste" && $find)
        {
               $selectedPrimaries = DB::table('modelies')
                                       ->join('marques', 'marques.id', '=', 'modelies.marques_id')
                                       ->where('modelies.id', '=', $modely->id)
                                       ->pluck('marques.name')
                                       ->toArray();
                 $marques = Marques::where('user_id',Auth::user()->id)->pluck('name','id');
                 $primaries = Taille::pluck('name','id');
                    return view('styliste.modely.form',[
                                   'modely'=>$modely,
                                   'marques'=>$marques,
                                   'primaries'=>$primaries,
                                   'selectedPrimaries'=>$selectedPrimaries
                       ]);
        }else{
            return back()->with('danger','Vous n\'etes pas autorisé a effectué cette action');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModelyRequest  $request, Modely $modely)
    {
        $modelyData= $request->validated();
        $modelyData['user_id'] = Auth::user()->id;
        $modely->update($modelyData);
        $modely->tailles()->sync($request->validated('taille'));
        $modely->AttacheFiles($request->validated('pictures'));
        return to_route('style.modely.index')->with('success','Model modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modely $modely)
    {
        $modely->delete();
        return to_route('style.modely.index')->with('success','Model supprimé avec succès');
    }

    public function SearchStylModely(Request $request)
    {
        $search = $request->input('search');
        $modelies = Modely::where('name','LIKE','%'.$search.'%')
                           ->where('user_id',Auth::user()->id)
                           ->get()
                          ;
        return view('styliste.modely._searchstylmodel',[
            'modelies'=>$modelies
        ]);
    }
}
