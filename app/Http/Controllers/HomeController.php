<?php

namespace App\Http\Controllers;

use App\Models\Collectiony;
use App\Models\Marques;
use App\Models\Modely;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::where('acteur', 'styliste')
                      ->where('logo','!=','')
                      ->take(2)
                      ->get();
       return view('index',[
        "users"=>$users
       ]);
    }

    public function ScrollIndex(Request $request)
    {
        $skip = $request->input('skip',2);
        $take = 2;
        $users = User::where('acteur', 'styliste')
                      ->where('logo','!=','')
                      ->skip($skip)
                      ->take($take)
                      ->get();
         return view('_index',[
            'users'=>$users
         ]);
    }
    public function home(User $user)
    {
        $modelies = Modely::where('user_id',$user->id)->take(2)->get();
        return view('home',[
            'modelies'=>$modelies,
            'user'=>$user
        ]);
    }

    public function searchHome(Request $request,User $user)
    {
       $search = $request->input('homesearch');
       $modelies = Modely::where('name','LIKE','%'.$search.'%')
                           ->where('user_id',$user->id)
                           ->get();
       return view('_home',[
        'modelies'=>$modelies,
        'user'=>$user
       ]);
    }

    public function LoadMorModelies(Request $request,User $user)
    {
       $skip = $request->input('skip',4);
       $take = 4;
       $userId = $user->id;
       $modelies= Modely::where('user_id',$userId)
                         ->skip($skip)
                         ->take($take)
                         ->get();
                 ;
        return response()->json([
            'modelies'=>view('home._loadMod',['modelies'=>$modelies])->render(),
            'hasMore'=>$modelies->count()===$take
        ]);
    }

    public function WomenMenAndMixte(Request $request,User $user)
    {
        $route = $request->route()->getName();
        $womens = '';
        if($route === 'home.womens')
        {
            $womens = Modely::where('genre','femme')
                              ->where('user_id',$user->id)
                            ->get();
            return view('home.women',[
                'womens'=>$womens
            ]);
        }
        if($route === 'home.mens')
        {
            $womens = Modely::where('genre','homme')
                             ->where('user_id',$user->id)
                             ->get();
            return view('home.women',[
                'womens'=>$womens
            ]);
        }
        if($route === 'home.mixt')
        {
            $womens = Modely::where('genre','mixt')
                            ->where('user_id',$user->id)
                            ->get();
            return view('home.women',[
                'womens'=>$womens
            ]);
        }
    }

    public function view(Modely $modely)
    {
        return response()->json(
            [
                'modelies'=>$modely->pictures,
                'name'=>$modely->name,
                'price'=>$modely->price,
                'genre'=>$modely->genre
            ]);
    }

    public function WomenSearch(Request $request)
    {
            $womens = Modely::where('genre','femme')
                              ->where('name','LIKE',"%{$request->input('search')}%")
                              ->get()
                              ;
        return view('home._women',[
            "womens"=>$womens
        ]);
    }

    public function MenSearch(Request $request)
    {
             $mens = Modely::where('genre','homme')
                            ->where('name','LIKE','%'.$request->input('search').'%')
                            ->get()
                            ;
               return view('home._men',[
                            "mens"=>$mens
                      ]);
    }

    public function MixtSearch(Request $request)
    {
             $mixtes = Modely::where('genre','mixte')
                            ->where('name','LIKE',"%{$request->input('search')}%")
                            ->get()
                            ;
               return view('home._mixte',[
                            "mixtes"=>$mixtes
                      ]);
    }

    public function HomeSearch(Request $request)
    {
               $searchTerm = $request->input('homesearch');
               $users = User::where('entreprise', 'LIKE', '%' . $searchTerm . '%')
                            ->where('logo','!=','')
                           ->get();
       return view('home._home',[
          'users'=>$users
       ]);
    }

    public function getAllMarques(User $user)
    {
        $marques=Marques::where('user_id',$user->id);
        return view('home._marques',[
            'marques'=>$marques
        ]);
    }

    public function getAllModelyByUser(User $user)
    {
        $modelies =Modely::where('user_id',$user->id)->get();
        return view('home._modely',['modelies'=>$modelies]);
    }

    public function getAllModelyByWomens()
    {
        $womens = Modely::whereIn('id',function($query){
                                 $query->select(DB::raw('MAX(id)'))
                                      ->from('modelies')
                                      ->where('genre','femme')
                                      ->groupBy('user_id');
                             })->take(2)->get();
            return view("index.women",[
                'womens'=>$womens
            ]);
    }

    public function ScrollWomens(Request $request)
    {
        $skip = $request->input('skip','2');
        $take= 2;
        $womens = Modely::whereIn('id',function($query){
                                 $query->select(DB::raw('MAX(id)'))
                          ->from('modelies')
                          ->where('genre','femme')
                          ->groupBy('user_id');
        })->skip($skip)->take($take)->get();
        return view('index.partials._womens',[
            'womens'=>$womens
        ])->render();
    }

    public function getAllModelyByMens()
    {
        $mens = Modely::whereIn('id',function($query){
                                 $query->select(DB::raw('MAX(id)'))
                                      ->from('modelies')
                                      ->where('genre','homme')
                                      ->groupBy('user_id');
                             })->take(2)->get();
            return view("index.men",[
                'mens'=>$mens
            ]);
    }

    public function ScrollMens(Request $request)
    {
        $skip = $request->input('skip',2);
        $take= $request->input('take',2);
        $mens = Modely::whereIn('id',function($query){
                                 $query->select(DB::raw('MAX(id)'))
                          ->from('modelies')
                          ->where('genre','homme')
                          ->groupBy('user_id');
        })->skip($skip)->take($take)->get();
        return view('index.partials._mens',[
            'mens'=>$mens
        ])->render();
    }

    public function getAllModelyByMixte()
    {
        $mixtes = Modely::whereIn('id',function($query){
                         $query->select(DB::raw('MAX(id)'))
                         ->from('modelies')
                        ->where('genre','mixte')
                        ->groupBy('user_id');
                })->take(2)->get();
           return view("index.mixt",[
                 'mixtes'=>$mixtes
              ]);
    }

    public function ScrollMixte(Request $request)
    {
        $skip = $request->input('skip',2);
        $take= $request->input('take',2);
        $mixtes = Modely::whereIn('id',function($query){
                                 $query->select(DB::raw('MAX(id)'))
                          ->from('modelies')
                          ->where('genre','mixte')
                          ->groupBy('user_id');
        })->skip($skip)->take($take)->get();
        return view('index.partials._mixtes',[
            'mixtes'=>$mixtes
        ])->render();
    }

}


