<?php

namespace App\Http\Controllers;

use App\Models\Collectiony;
use App\Models\Marques;
use App\Models\Modely;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function MarqueModely(User $user)
    {
       $marques = Marques::where('user_id',$user->id)->take(4)->get();
       return view('indexs.MarqueModely',[
        'marques'=>$marques,
        'user'=>$user
       ]);
    }

    public function searchMarqueModely(Request $request)
    {
        $search = $request->input('search');
       $marques = Marques::where('name','LIKE','%'.$search.'%')->get();
       return view('indexs._MarqueModely',[
        'marques'=>$marques
       ]);
    }

    public function loadMoreMarqueModely(Request $request,User $user)
    {
        $skip = $request->input('skip',4);
        $take = 4;
        $marques = Marques::where('user_id',$user->id)
                           ->skip($skip)
                           ->take($take)
                           ->get()
                           ;
         return response()->json([
            'marques'=>view('indexs._loadMoreMarqueModely',['marques'=>$marques])->render(),
            'hasMore'=>$marques->count()===$take
         ]);
    }

    public function MarqueCollection(User $user)
    {
        $marques = Marques::where('user_id',$user->id)->take(4)->get();
        return view('indexs.MarqueCollection',[
            'marques'=>$marques,
            'user'=>$user
        ]);
    }

    public function searchMarqueCollection(Request $request)
    {
        $search = $request->input('search');
        $marques = Marques::where('name','LIKE','%'.$search.'%')->get();
        return view('indexs._searchMarqueCollection',[
            'marques'=>$marques
        ]);
    }

    public function searchShowMarquesCollection(Marques $marque,User $user,Request $request)
    {
        $search= $request->input('search');
         $collectionies = Collectiony::where('name','LIKE','%'.$search.'%')
                                      ->where('marques_id',$marque->id)
                                      ->where('user_id',$user->id)
                                      ->get()
                                    ;
            return view('indexs._searchShowMarquesCollection',[
                'collectionies'=>$collectionies
            ]);
    }

    public function loadMoreMarqueCollection(Request $request,User $user)
    {
        $skip = $request->input('skip',4);
        $take = 4;
        $marques = Marques::where('user_id',$user->id)
                           ->skip($skip)
                           ->take($take)
                           ->get()
                           ;
         return response()->json([
            'marques'=>view('indexs._loadMoreMarqueModely',['marques'=>$marques])->render(),
            'hasMore'=>$marques->count()===$take
         ]);
    }

    public function showMarquesCollection(Marques $marque)
    {
        $marque->load(['users', 'collectionies' => function ($query) {
            $query->take(4);
        }]);
        return view('indexs.showMarqueCollection',[
            'marque'=>$marque
        ]);
    }

    public function showMarquesModely(Marques $marque)
    {
        $marque->load(['users', 'modelies' => function ($query) {
            $query->take(4);
        }]);
        return view('indexs.showMarquesModely',[
            'marque'=>$marque
        ]);
    }

    public function searchShowMarquesModely(Marques $marque,User $user,Request $request)
    {
        $search = $request->input('search');
       $modelies = Modely::where('name','LIKE','%'.$search.'%')
                          ->where('user_id',$user->id)
                          ->where('marques_id',$marque->id)
                          ->get()
                          ;
        return view('indexs._searchShowMarqueModely',[
            'modelies'=>$modelies
        ]);
    }

    public function loadMorShowMarquesModely(Request $request,Marques $marque)
    {
        $skip = $request->input('skip',4);
        $take = 4;
        $marque->load(['users', 'modelies' => function ($query) use($take,$skip) {
            $query->take($take)->skip($skip);
        }]);
        return response()->json([
            'marque'=>view('indexs._loadMorShowMarquesModely',['marque'=>$marque])->render(),
            'hasMore'=>$marque->count()===$take
        ]);
    }

    public function getCollectionByUser(User $user)
    {
        return view('indexs.CollectionUser',[
            'collectionies'=>Collectiony::where('user_id',$user->id)->take(4)->get(),
            'user'=>$user
        ]);
    }

    public function searchCollectionbyUser(Request $request,User $user)
    {
        $search = $request->input('search');
        $collectionies = Collectiony::where('name','LIKE','%'.$search.'%')
                                      ->where('user_id',$user->id)
                                      ->get()
                                      ;
        return view('indexs._searchcollectionbyuser',[
            'user'=>$user,
            'collectionies'=>$collectionies
        ]);
    }

    public function LoadMoreCollection(Request $request,User $user)
    {
        $skip= $request->input('skip',4);
        $take = 4;
        $collectionies = Collectiony::where('user_id',$user->id)
                                     ->skip($skip)
                                     ->take($take)
                                     ->get()
                                     ;
          return response()->json([
            'collectionies'=>view('indexs._loadMoreCollection',
                               ['collectionies'=>$collectionies])->render(),
            'hasMore'=>$collectionies->count()===$take
          ]);
    }

    public function showModelByUser(User $user,Modely $modely)
    {
        return view('indexs.showModelByUser',[
            'modely'=>$modely,
            'user'=>$user,
            'modeliesUsers'=>Modely::where('user_id',$user->id)->get()
        ]);
    }

    public function showCollectionByUser(User $user,Collectiony $collectiony)
    {
        return view('indexs.showCollectionByUser',[
            'collectiony'=>$collectiony,
            'user'=>$user,
            'collectionies'=>Collectiony::where('user_id',$user->id)->get()
        ]);
    }

    public function loadMorShwoMarquesCollection(Request $request,Marques $marque)
    {
        $skip = $request->input('skip',4);
        $take = 4;
        $marque->load(['users', 'collectionies' => function ($query) use($take,$skip) {
            $query->take($take)->skip($skip);
        }]);
        return response()->json([
            'marque'=>view('indexs._loadMorShowMarquesCollection',['marque'=>$marque])->render(),
            'hasMore'=>$marque->count()===$take
        ]);
    }

    public function MarqueIndexModel()
    {
              $take = 2; // Nombre d'éléments à récupérer
              $marques = Marques::whereIn('id',function($query){
                $query->select(DB::raw('MAX(id)'))
                         ->from('marques')
                         ->groupBy('user_id')
                         ->get();
              })->take($take)->get();
        return view('index.marques.modely',[
            'marques'=>$marques
        ]);
    }

    public function ScrollMarqueIndexModel(Request $request)
    {
        $skip=$request->input('skip',2);
        $take = 2;
        $marques = Marques::whereIn('id',function($query){
            $query->select(DB::raw('MAX(id)'))
                     ->from('marques')
                     ->groupBy('user_id')
                     ->get();
               })->skip($skip)->take($take)->get();
         return view('index.marques._modely',[
               'marques'=>$marques
          ]);
    }

    public function MarqueIndexCollection()
    {
        $take = 2; // Nombre d'éléments à récupérer
              $marques = Marques::whereIn('id',function($query){
                $query->select(DB::raw('MAX(id)'))
                         ->from('marques')
                         ->groupBy('user_id')
                         ->get();
              })->take($take)->get();
        return view('index.marques.collection',[
            'marques'=>$marques
        ]);
    }

    public function ScrollMarqueIndexCollection(Request $request)
    {
        $skip=$request->input('skip',2);
        $take = 2;
        $marques = Marques::whereIn('id',function($query){
            $query->select(DB::raw('MAX(id)'))
                     ->from('marques')
                     ->groupBy('user_id')
                     ->get();
               })->skip($skip)->take($take)->get();
         return view('index.marques._collection',[
               'marques'=>$marques
          ]);
    }

    public function IndexCollection()
    {
        $collectionies = Collectiony::whereIn('id',function($query){
               $query->select(DB::raw('MAX(id)'))
                     ->from('collectionies')
                     ->groupBy('user_id');
        })->take(2)->get();
        return view('index.collection',[
            'collectionies'=>$collectionies
        ]);
    }

    public function scrollCollectionOneIndex(Request $request)
    {
        $skip = $request->input('skip',2);
        $take = 2;
        $collectionies = Collectiony::whereIn('id', function($query) {
            $query->select(DB::raw('MAX(id)'))
                  ->from('collectionies')
                  ->groupBy('user_id');
        })->skip($skip)->take($take)->get();
        return view('index._collection',[
            'collectionies'=>$collectionies
        ])->render();
    }

    public function modelsearch(Request $request)
    {
      $search = $request->input('search');
      $marques = Marques::where('name','LIKE','%'.$search.'%')->get();
      return view('index.marques.search._modely',[
        'marques'=>$marques
      ]);
    }

    public function collectionsearch(Request $request)
    {
         $search = $request->input('search');
         $marques = Marques::where('name','LIKE','%'.$search.'%')->get();
        return view('index.marques.search._modely',[
        'marques'=>$marques
      ]);
    }

    public function collectionsindexsearch(Request $request)
    {
        $search = $request->input('search');
        $collectionies = Collectiony::where('name','LIKE','%'.$search.'%')->get();
       return view('index.marques.search._collectionindexsearch',[
       'collectionies'=>$collectionies
     ]);
    }
}
