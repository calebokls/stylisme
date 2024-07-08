<?php

namespace App\Http\Controllers\Stylist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StylistCollectionRequest;
use App\Models\Abonement;
use App\Models\Collectiony;
use App\Models\Marques;
use App\Models\Taille;
use App\Models\User;
use App\Models\validationy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StylisteCollectionnyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('danger','Veuillez vous connecter');
        }elseif(Auth::user() && Auth::user()->acteur === "styliste")
        {
            return view('styliste.collections.index',[
                'collections'=>Collectiony::with('marques')->where('user_id',Auth::user()->id)->paginate(8)
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
        if(Auth::user() && Auth::user()->acteur === "styliste")
        {
            $validation = validationy::where('user_id',Auth::user()->id)
                                      ->first()
                                      ;
            $subscribe = Abonement::where('user_id',Auth::user()->id)->first();
             $DateState=Carbon::now();
             if($subscribe->fin === $DateState)
             {
                $premium = $subscribe->premium = false;
                $abonenement= new Abonement();
                $abonenement->premium =$premium;
                $abonenement->save();
             }
            if(empty($validation))
               {
                   return to_route('validation.validationy.create')->with('danger','Veullez renseigner vos identifiant de validation');
               }elseif($validation->validary == false)
                {
                    return back()->with('success','Vos identifiant sont en cours de validation.Veuillez patienter');
                }else{
                    if(empty($subscribe) || $subscribe && $subscribe->premium == false)
                    {
                        return to_route('index')->with('success','Devenez premium ou renouvelez votre abonement pour effectuer cette action');
                    }else{
                        $collectiony = new Collectiony();
                        $primaries = Marques::where('user_id',Auth::user()->id)->pluck('name','id');
                         return view('styliste.collections.form',[
                                     'collectiony'=>$collectiony,
                                     'primaries'=>$primaries
                           ]);
                    }
                }
        }else{
            return back()->with('danger','Vous n\'etes pas autorisé a effectué cette action');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nbres = $request->input('nombre_de_clics');
        $rules = [];
        $images = [];
        $rules["nom"] = 'required|min:3';
        $rules["marque"] = 'required|exists:marques,id';
        $rules["user_id"] = 'exists:users,id';
        for($j=1;$j<=$nbres;$j++)
        {
            $rules["images{$j}"] = ['array','required'];
            $rules["images{$j}.*"] = ['required','max:2000'];
            $rules["prices{$j}"] = ['required','numeric'];
            $rules["descriptions{$j}"] = ['required','min:3'];
            $rules["tailles{$j}"] = ['array','required'];
            $images[] = [
                "images{$j}"=>$request->file("images{$j}"),
                "prices{$j}"=>$request->input("prices{$j}"),
                "descriptions{$j}"=>$request->input("descriptions{$j}"),
                "tailles{$j}"=>$request->input("tailles{$j}")
            ];
        }
        $validator= Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            //dd($validator);
            // return redirect()->back()->withErrors($validator)->withInput();
            return response()->json(['errors'=>$validator->errors()],422);
        }
         //dd($request->all());


        $collectiony = new Collectiony();
        //  dd($request->file('images1'));
             $collectionImage = [];
             //dd($images);
             foreach ($images as $i => $imageData) {
                $i++;
                $imageFiles = $imageData["images{$i}"];
                $price = $imageData["prices{$i}"] ;
                $description = $imageData["descriptions{$i}"];
                $taille = $imageData["tailles{$i}"];
                if(!empty($imageFiles))
                {
                    $collectionImages= [];
                    $imageIndex = 0;
                    if(is_array($imageFiles))
                    {
                        foreach($imageFiles as $key=>$files)
                        {
                            if(is_array($files))
                            {
                                foreach($files as $k=>$file)
                                {
                                    $path = $file->store("collections/".$k,'public');
                                    $collectionImages[] = [
                                        "image{$imageIndex}"=>$path
                                    ];
                                    $imageIndex++;
                                }
                            }else{

                                $path = $files->store("collections/".$key,'public');
                                $collectionImages[] = [
                                    "image{$imageIndex}"=>$path
                                ];
                                $imageIndex++;
                            }
                        }
                    }else{
                        $path = $imageFiles->store("collections/".$i,'public');
                        $collectionImages[] = [
                            "image{$i}"=>$path
                        ];
                    }
                }
                if(!empty($collectionImages))
                {
                    $collectionImage[]=[
                        "images{$i}"=>$collectionImages,
                        "prices{$i}"=>$price,
                        "descriptions{$i}"=>$description,
                        "tailles{$i}"=>$taille
                    ];
                }

            }
         $collectiony->name=$request->input('nom');
         $collectiony->nbre = $nbres;
         $collectiony->user_id = Auth::user()->id;
         $collectiony->marques_id = (int)$request->input('marque');
           $collectiony->product = serialize($collectionImage);
           $collectiony->save();
           return to_route("style.collectiony.index")->with("success","Collection créé avec succès");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collectiony $collectiony)
    {
        $find = Collectiony::find($collectiony)->where('user_id',Auth::user()->id)
                             ->where('name',$collectiony->name)
                             ->first()
                              ;
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('danger','Veuillez vous connecter');
        }
        if(Auth::user() && Auth::user()->acteur === "styliste" && $find)
        {
            $tailles= Taille::select('id','name')->get();
            $primaries = Marques::where('user_id',Auth::user()->id)->pluck('name','id');
            return view('styliste.collections.EditForm',[
                'collectiony'=>$collectiony,
                'tailles'=>$tailles,
                'primaries'=>$primaries
            ]);
        }else{
            return back()->with('danger','Vous n\'etes pas autorisé a effectué cette action');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collectiony $collectiony)
    {
        $nbres = $request->input('nbre_click');
        $rules = [];
        $produits= [];
        $rules["nom"]= ["required"];
        $errors = [];
        for($i=1;$i<=(int)$nbres;$i++)
        {
            $rules["images{$i}"]= ['max:2000'];
            $rules["prices{$i}"] = ['required','integer'];
            $rules["descriptions{$i}"] = ['required','min:3'];
            $rules["tailles{$i}"] = ['array','required'];
            $produits[] = [
                "images{$i}"=>$request->file("images{$i}"),
                "prices{$i}"=>$request->input("prices{$i}"),
                "descriptions{$i}"=>$request->input("descriptions{$i}"),
                "tailles{$i}"=>$request->input("tailles{$i}")
            ];
        }
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
             $errors =array_merge($errors,$validator->errors()->toArray());
        }
          //dd($request->all());
        $newCollectionImage= [];
        $oldCollectionImages = unserialize($collectiony->product);
        foreach ($produits as $i => $produit) {
            $i++;
            $newImageFiles = $produit["images{$i}"];
            $newPrices = $produit["prices{$i}"];
            $newDescription = $produit["descriptions{$i}"];
            $newTailles = $produit["tailles{$i}"];

            $newCollectionImages = [];
            $oldCollectionIndex = $i - 1;
            //Vérification de la validiter des donnée
            if(array_key_exists($oldCollectionIndex,$oldCollectionImages)
             && empty($oldCollectionImages[$oldCollectionIndex]["images{$i}"])
             && empty($newImageFiles))
            {
                    $validator = Validator::make([
                        "images{$i}"
                    ],["images{$i}"=>'required']);
                 if($validator->fails())
                 {
                    $errors = array_merge($errors,$validator->errors()->toArray());
                 }
            }

            // Vérification de l'existence de la clé dans $oldCollectionImages
            if (!array_key_exists($oldCollectionIndex, $oldCollectionImages) || !array_key_exists("images{$i}", $oldCollectionImages[$oldCollectionIndex])) {
                $oldCollectionImages[$oldCollectionIndex]["images{$i}"] = [];
            }

            $oldImages = $oldCollectionImages[$oldCollectionIndex]["images{$i}"];
            $newImageIndex = count($oldImages);

            if ($newImageFiles !== null) {
                foreach ($newImageFiles as $key => $files) {
                    if (is_array($files)) {
                        foreach ($files as $k => $v) {
                            $path = $v->store("collections/{$k}", 'public');
                            $newCollectionImages[] = ["image{$newImageIndex}" => $path];
                            $newImageIndex++;
                        }
                    } else {
                        $path = $files->store("collections/{$key}", 'public');
                        $newCollectionImages[] = ["image{$newImageIndex}" => $path];
                        $newImageIndex++;
                    }
                }
            }

            // Fusion des anciennes et nouvelles images
            $mergedImage = array_merge($oldImages, $newCollectionImages);

            $newCollectionImage[] = [
                "images{$i}" => $mergedImage,
                "prices{$i}" => $newPrices,
                "descriptions{$i}" => $newDescription,
                "tailles{$i}" => $newTailles
            ];
        }
        if(!empty($errors))
        {
            return response()->json(['errors'=>$errors],422);
        }
        $collectiony->name= $request->input('nom');
        $collectiony->product = serialize($newCollectionImage);
        $collectiony->nbre=$nbres;
        $collectiony->user_id = Auth::user()->id;
        // $collectiony->product = serialize();
        $collectiony->save();
        return to_route('style.collectiony.index')->with('success','Modification effectué avec succès');
    }

    public function show(Collectiony $collectiony)
    {
        $collectionies = Collectiony::where('user_id','=',$collectiony->user_id)->get();
        return view('styliste.collections.show',[
              'collectiony'=>$collectiony,
              'collectionies'=>$collectionies
         ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collectiony $collectiony)
    {
        $collectiony->delete();
        return to_route("style.collectiony.index")->with("success","Suppression effectué avec succès");
    }

    public function customeTaile()
    {
        $primaries = Taille::pluck('name','id');
        return response()->json($primaries);
    }

    public function deleteImage(Request $request, Collectiony $collectiony)
{
    $collectionDeserializer = unserialize($collectiony->product);

    foreach ($collectionDeserializer as $key => $values) {
        if (!isset($values[$request->input('tableau')])) {
            continue;
        }

        $tableaux = $values[$request->input('tableau')];

        foreach ($tableaux as $tableauKey => $tableau) {
            if (!isset($tableau[$request->input('image')])) {
                continue;
            }

            $imagePath = $tableau[$request->input('image')];

            // Supprimer l'image du tableau
            unset($tableau[$request->input('image')]);

            if(empty($tableau))
            {
                unset($tableaux[$tableauKey]);
            }

            // Mettre à jour les clés du tableau
            $tableaux = array_values($tableaux);

            // Mettre à jour le tableau principal
           $collectionDeserializer[$key][$request->input('tableau')] = $tableaux;
        }
    }
    // dd($values);

    // dd($collectionDeserializer);

    // Mettre à jour la base de données
    $collectiony->product = serialize($collectionDeserializer);
    $collectiony->save();

    // Supprimer l'image du stockage
    Storage::disk('public')->delete($imagePath);
    return back()->with('success','Image de la collection supprimer avec succès');
}

public function getNbreAndTailles()
{
    $properties = Taille::pluck('name','id');
    return response()->json([
           'properties'=>$properties
        ]);
}

public function info(Collectiony $collectiony)
{
    return response()->json(["collectiony"=>unserialize($collectiony->product)]);
}
public function destroyInput(Request $request, Collectiony $collectiony)
{
    // Récupérer l'index à supprimer
    $key = (int)$request->route()->parameter('id');

    // Désérialiser le champ 'product'
    $tableau = unserialize($collectiony->product);

    // Supprimer l'élément du tableau
    unset($tableau[$key]);

    // Réindexer les clés du tableau
    $tableau = array_values($tableau);
    // Mettre à jour les sous-clés pour qu'elles commencent à partir de 1
    foreach ($tableau as $index => $item) {
        $newIndex = $index + 1;
        $updatedItem = [];

        foreach ($item as $subKey => $subValue) {
            if (preg_match('/(\D+)(\d+)/', $subKey, $matches)) {
                $updatedItem[$matches[1] . $newIndex] = $subValue;
            } else {
                $updatedItem[$subKey] = $subValue;
            }
        }

        $tableau[$index] = $updatedItem;
    }

    // Sérialiser le tableau mis à jour
    $updatedProduct = serialize($tableau);

    // Mettre à jour le champ 'product' dans la base de données
    $collectiony->product = $updatedProduct;
    $collectiony->save();

    return back()->with('success','Le champs de formulaire a été supprimer avec succès');
 }
 public function SearchStylCollection(Request $request)
 {
    $search = $request->input('search');
    $collections = Collectiony::where('name','LIKE','%'.$search.'%')
                                 ->where('user_id',Auth::user()->id)
                                 ->get()
                                 ;
     return view('styliste.collections._searchcollection',[
        'collections'=>$collections
         ]);
 }
}
