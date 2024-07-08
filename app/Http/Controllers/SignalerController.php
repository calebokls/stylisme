<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignalerRequest;
use App\Mail\SignalMail;
use App\Models\Collectiony;
use App\Models\Modely;
use App\Models\SignalCollectiony;
use App\Models\Signalisation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SignalerController extends Controller
{
    public function index()
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            $signalisations = DB::table('signalisations')
            ->select(
                 'signalisations.*',
                 'users.name as signaling_user_name',
                 'users.firstname as signaling_user_prenom',
                 'modelies.name as modely_name',
                 'modely_users.name as modely_user_name',
                 'modely_users.firstname as modely_user_prenom',
                 'modely_users.id as modely_user_id'
                 )
                 ->join('users', 'users.id', '=', 'signalisations.user_id') // Utilisateur qui a fait la signalisation
                 ->join('modelies', 'modelies.id', '=', 'signalisations.modely_id') // Modèle signalé
                 ->join('users as modely_users', 'modely_users.id', '=', 'modelies.user_id') // Utilisateur qui a ajouté le modèle
                 ->orderBy('created_at','DESC')
                 ->paginate(4);
                 //dd($signalisations);
                 return view('signaler.index',[
                        'signalisations'=>$signalisations
                  ]);
        }else{
            return back()->with('danger','Impossible d\'effectuer cette');
        }
    }

    public function create(Modely $modely)
    {
        return view('signaler.form',[
            'modely'=>$modely
        ]);
    }

    public function signalement(Request $request)
    {
        $request->validate([
            'motif' => ['required', 'string','min:3','max:255'],
            'user_id' => ['exists:users,id'],
            'modely_id' => ['exists:modelies,id'],
        ]);
       $signalisation = new Signalisation();
       $signalisation->motif = $request->motif;
       $signalisation->user_id = Auth::user()->id;
       $signalisation->modely_id = $request->modely_id;
       $signalisation->save();
        return to_route('home')->with('success','Votre signalisation a été bien enregistrer');
    }

    public function getMotif(string $id)
    {
        $motif = Signalisation::where('id','=',$id)->get();
        return response()->json(['motifs'=>$motif]);
    }

    public function Avertir(Request $request)
    {
      $user = User::where('id',$request->input('user_id'))->get();
      $users = new User();
      Mail::send(new SignalMail($users));
      return back()->with('success','Avertissment effectué avec succès');
    }

    public function createCollection(Collectiony $collectiony)
    {
        return view('signalerCollection.form',[
            'collectiony'=>$collectiony
        ]);

    }

    public function signalementCollection(Request $request)
    {
      $validate = Validator::make($request->all(),[
        'motif'=>['required','min:3','max:255'],
        'collectiony_id'=>['exists:collectionies,id']
      ]);
      $signalCollection = new SignalCollectiony();
      $signalCollection->user_id = Auth::user()->id;
      $signalCollection->collectiony_id = $request->input('collection_id');
      $signalCollection->motif= $request->input('motif');
      $signalCollection->save();
      return to_route('home')->with('success','Signalement effectué avec succès');
    }

    public function indexCollection()
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            $signalisations = DB::table('signal_collectionies')
                             ->select(
                                     'signal_collectionies.*',
                                     'users.name as signaling_user_name',
                                     'users.firstname as signaling_user_prenom',
                                     'collectionies.name as collectionies_name',
                                     'collectionies_users.name as collectionies_users_name',
                                     'collectionies_users.firstname as collectionies_user_prenom',
                                     'collectionies_users.id as collectionies_users_id'
                                     )
                            ->join('users', 'users.id', '=', 'signal_collectionies.user_id') // Utilisateur qui a fait la signalisation
                            ->join('collectionies', 'collectionies.id', '=', 'signal_collectionies.collectiony_id') // Modèle signalé
                            ->join('users as collectionies_users', 'collectionies_users.id', '=', 'collectionies.user_id') // Utilisateur qui a ajouté le modèle
                            ->orderby('created_at','DESC')
                            ->paginate(16);
               ;
           return view('signaler.indexCollection',[
                 'signalisations'=>$signalisations
           ]);
        }else{
            return back()->with('danger','Impossible d\'effectuer cette action');
        }
    }

    public function getMotifCollection(string $id)
    {
        $signale = SignalCollectiony::where('id',$id)->get();
        return response()->json(['motif'=>$signale]);
    }
}
