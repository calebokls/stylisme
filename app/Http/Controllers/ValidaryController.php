<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationyRequest;
use App\Mail\CancelMail;
use App\Mail\SuperAdminMail;
use App\Mail\ValidatedMail;
use App\Models\validationy;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ValidaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            return view('validary.index',[
                'validaries'=>validationy::orderby('created_at','DESC')->paginate(6)
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
        $validationy = new validationy();
        return view('validary.form',[
            'validationy'=>$validationy
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidationyRequest $request)
    {
         $imageData =  $request->input('image_data');
         if($imageData)
         {
            // Décoder l'image base64
            list($type, $data) = explode(';', $imageData);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            // Générer un nom de fichier unique
            $fileName = uniqid() . '.png';
            $filePath = 'validation/complet/'.$fileName;
            // Stocker le fichier dans le dossier 'public'
             Storage::disk('public')->put($filePath, $data);
         }
        $validationy = new validationy();
        $validationyData = $this->ExtractPicture($validationy,$request);
        $validationyData['user_id'] = Auth::user()->id;
        $validationyData['validary'] = false;
        $validationyData['image_data'] = $filePath;
         validationy::create( $validationyData);
         Mail::send(new SuperAdminMail());
        return to_route('index')->with('success',
        'Vos identitifiant sont bien enregistrer vous recevez un mail une fois qu\'il seront validé');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $validationy = validationy::findOrFail($id);
        return view('validary.information',[
            'validationy'=>$validationy
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(validationy $validationy)
    {
        if(!Auth::user())
        {
            return redirect()->intended(route('login'))->with('success','Veuilez vous connecter');
        }
        $validation = validationy::where('user_id',Auth::user()->id)->first();
        $othervalidation  = validationy::where('user_id',$validationy->id)->first();
        if($validation->validary == true)
        {
            return to_route('style.modely.index')->with('danger','Votre compte est deja validé');
        }
        if(empty($validation))
        {
             return back()->with('danger','Vous n\'etes pas autorisé à effectuer cette action');
        }
        if($validation->user_id === $othervalidation->user_id)
        {
            return view('validary.form',[
                'validationy'=>$validationy
            ]);
        }else{
            return back()->with('danger','Impossoible d\'effectuer cette action');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidationyRequest $request, validationy $validationy)
    {
        $imageData =  $request->input('image_data');
        if($imageData)
        {
           // Décoder l'image base64
           list($type, $data) = explode(';', $imageData);
           list(, $data)      = explode(',', $data);
           $data = base64_decode($data);
           // Générer un nom de fichier unique
           $fileName = uniqid() . '.png';
           $filePath = 'validation/complet/'.$fileName;
           // Stocker le fichier dans le dossier 'public'
            Storage::disk('public')->put($filePath, $data);
        }
        $validationyData = $this->ExtractPicture($validationy,$request);
        $validationyData['image_data'] = $filePath;
        $validationyData['user_id'] = Auth::user()->id;
        $validationy->update($validationyData);
        return to_route('home')->with('success','Identification de validation modifier avec succès');
    }

    private function extractPicture(Validationy $validationy, ValidationyRequest $request): array
{
    $data = $request->validated();

    // Récupération des fichiers photo et piece depuis la requête
    $photo = $request->validated('photo');
    $piece = $request->validated('piece');

    // Vérifie si les fichiers photo et piece ont été téléchargés avec succès et s'ils ont des erreurs
    if ($photo == null && $photo->getError() && $piece == null && $piece->getError()) {
        return $data;
    }

    // Supprime les anciens fichiers s'ils existent
    if ($validationy->photo) {
        Storage::disk('public')->delete($validationy->photo);
    }
    if ($validationy->piece) {
        Storage::disk('public')->delete($validationy->piece);
    }

    // Enregistre les nouveaux fichiers
    $data['photo'] = $photo->store('validation/photo', 'public');
    $data['piece'] = $piece->store('validation/piece', 'public');
    return $data;
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(validationy $validationy)
    {
       $validationy->delete();
       return to_route('home')->with('success','Suppression effectué avec succès');
    }

    public function Valider(int $id)
    {
       $validationy = validationy::findOrfail($id);
       $validationy->validary = true;
       $validationy->save();
       Mail::send(new ValidatedMail());
       return back()->with('success','Utilisateur valider');
    }

    public function Annuler(int $id)
    {
       $validationy = validationy::findOrfail($id);
       $validationy->validary = false;
       Mail::send(new CancelMail($validationy));
       $validationy->save();
       return back()->with('success','Utilisateur non valider');
    }
}
