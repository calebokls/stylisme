<?php

use App\Http\Controllers\Abonement\AbonementController;
use App\Http\Controllers\admin\TailleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Manequin\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignalerController;
use App\Http\Controllers\stylist\MarquesController;
use App\Http\Controllers\Stylist\ModelyController;
use App\Http\Controllers\Stylist\StylisteCollectionnyController;
use App\Http\Controllers\ValidaryController;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$idRegex = '[0-9]+';

Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/home/{user}',[HomeController::class,'home'])
      ->where(['user'=>'[0-9]+'])
      ->name('home');
Route::GET('/searchhome/{user}',[HomeController::class,'searchHome'])
     ->where(['user'=>'[0-9]+'])
     ;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Nos Routes
 */
 Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('category',\App\Http\Controllers\admin\CategoryController::class)->except('show');
    Route::resource('primary',\App\Http\Controllers\admin\PrimaryController::class)->except('show');
    Route::resource('property',\App\Http\Controllers\admin\PropertyController::class)->except('show');
    Route::resource('taille',\App\Http\Controllers\admin\TailleController::class)->except('show');
 });
 Route::resource('chat',\App\Http\Controllers\ChatModeController::class)->except('show');

Route::prefix('style')->name('style.')->group(function(){
    Route::GET('/search-style-collection',[StylisteCollectionnyController::class,'SearchStylCollection']);
    Route::GET('/search-style-modely',[ModelyController::class,'SearchStylModely']);
    Route::GET('/search-style-marque',[MarquesController::class,'SearchStylMarque']);
    Route::resource('marque',\App\Http\Controllers\Stylist\MarquesController::class);
    Route::resource('modely',\App\Http\Controllers\Stylist\ModelyController::class);
    Route::resource('collectiony',\App\Http\Controllers\Stylist\StylisteCollectionnyController::class);
    Route::GET('/taille',[\App\Http\Controllers\Stylist\StylisteCollectionnyController::class,'customeTaile']);
    Route::delete('/picture/{picture}',[\App\Http\Controllers\Stylist\PictureController::class,'destroy'])
    ->where([
           'picture'=>'[0-9]+'
    ]);
    Route::delete('/delete-image-collectiony/{collectiony}',[\App\Http\Controllers\Stylist\StylisteCollectionnyController::class,'deleteImage'])
    ->name('deleteImageCollections')
    ->where([
        'collectiony'=>'[0-9]+'
    ]);
    Route::GET('/collectiony-tailles',[\App\Http\Controllers\Stylist\StylisteCollectionnyController::class,'getNbreAndTailles']);
    Route::GET('/collectiony/nbre/{collectiony}',[\App\Http\Controllers\Stylist\StylisteCollectionnyController::class,'info'])
               ->where(['collectiony'=>'[0-9]+'])
               ->name('nbre');
});

Route::GET('/subscribe',[AbonementController::class,'susbcribe'])->name('modo.subscribe');
Route::GET('/renewSubscribe',[AbonementController::class,'renewSubscribe'])->name('modo.renew');

Route::prefix('manequina')->name('manequina.')->group(function(){
   Route::resource('manequin',\App\Http\Controllers\Manequin\ManequinaController::class)->except('show');
   Route::delete('/media/{media}',[MediaController::class,'destroy'])
   ->where([
    'media'=>'[0-9]+'
   ]);
});

Route::prefix('home')->name('home.')->group(function(){
    Route::GET('/modely-vetement/{user}',[HomeController::class,'getAllModelyByUser'])
         ->where(['user'=>'[0-9]+'])
    ;
    Route::GET('/loadMoreModel/{user}',[HomeController::class,'LoadMorModelies'])
         ->where(['user'=>'[0-9]+'])
         ;
    Route::GET('/loadMoreCollection/{user}',[IndexController::class,'LoadMoreCollection'])
          ->where(['user'=>'[0-9]+'])
          ;
    Route::GET('/loadMoreMarqueModely/{user}',[IndexController::class,'loadMoreMarqueModely'])
          ->where(['user'=>'[0-9]+'])
         ;
    Route::GET('/loadMoreShowMarqueModely/{marque}/{user}',[IndexController::class,'loadMorShowMarquesModely'])
          ->where(['marque'=>'[0-9]+',
                     'user'=>'[0-9]+'
                   ]);
    Route::GET('/loadMoreShowMarqueCollection/{marque}/{user}',[IndexController::class,'loadMorShwoMarquesCollection'])
          ->where(['marque'=>'[0-9]+',
                     'user'=>'[0-9]+'
                ])
         ;
    Route::GET('/loadMoreMarqueCollection/{user}',[IndexController::class,'loadMoreMarqueCollection'])
          ->where(['user'=>'[0-9]+'])
       ;
    Route::GET('/marque-vetement',[HomeController::class,'getAllMarques'])->name('getmarques');
    Route::GET('/womens/{user}',[HomeController::class,'WomenMenAndMixte'])
         ->where(['user'=>'[0-9]+'])
         ->name('womens');
    Route::GET('/womens-search',[HomeController::class,'WomenSearch']);
    Route::GET('/mens/{user}',[HomeController::class,'WomenMenAndMixte'])
          ->where(['user'=>'[0-9]+'])
          ->name('mens');
    Route::GET('/mens-search',[HomeController::class,'MenSearch']);
    Route::GET('/home-search',[HomeController::class,'HomeSearch']);
    Route::GET('/mixt/{user}',[HomeController::class,'WomenMenAndMixte'])
          ->where(['user'=>'[0-9]+'])
          ->name('mixt');
    Route::GET('/mixt-search',[HomeController::class,'MixtSearch']);
    Route::GET('/views/{modely}',[HomeController::class,'view'])
          ->name('view')
          ->where(['modely'=>'[0-9]+']);
    Route::GET('/index-women',[HomeController::class,'getAllModelyByWomens'])->name('index.womens');
    Route::GET('/scrollIndex-women',[HomeController::class,'ScrollWomens']);
    Route::GET('/scrollIndex-men',[HomeController::class,'ScrollMens']);
    Route::GET('/scrollIndex-mixt',[HomeController::class,'ScrollMixte']);
    Route::GET('/scrollIndex-index',[HomeController::class,'ScrollIndex']);
    Route::GET('/index-men',[HomeController::class,'getAllModelyByMens'])->name('index.mens');
    Route::GET('/index-mixt',[HomeController::class,'getAllModelyByMixte'])->name('index.mixte');
});
Route::prefix('validation')->name('validation.')->group(function(){
    Route::resource('/validationy',\App\Http\Controllers\ValidaryController::class);
});
Route::PUT('/valider/validation/{id}',[ValidaryController::class,'Valider'])
->where(['id'=>'[0-9]+'])
->name('user.valider');
Route::GET('/annuler/validation/{id}',[ValidaryController::class,'Annuler'])
        ->where(['id'=>'[0-9]+'])
        ->name('user.annuler');

Route::GET('/signalement/{modely}/signaler',[SignalerController::class,'create'])->where([
    'modely'=>'[0-9]+'
])->name('signalement.signaler');
Route::POST('/signalisation/model',[SignalerController::class,'signalement'])->where([
    ])->name('signalement.utilisateur');

Route::GET('/signalement/{collectiony}/collection',[SignalerController::class,'createCollection'])->where([
    'collectiony'=>'[0-9]+'
])->name('signalement.signler.collection');
Route::POST('/signalement/collection',[SignalerController::class,'signalementCollection'])
->name('signalement.utilisateur.collection');

Route::GET('/indexCollections',[SignalerController::class,'indexCollection'])->name('index.collections.user');

Route::GET('/signaler',[SignalerController::class,'index'])->name('signalement.index');
Route::GET('/motif/signaler/{id}',[SignalerController::class,'getMotif'])->where([
    'id'=>'[0-9]+'
]);
Route::GET('/motif/collection/{id}',[SignalerController::class,'getMotifCollection'])->where([
    'id'=>'[0-9]+'
]);
Route::POST('/avertir',[SignalerController::class,'avertir'])->name('user.avertir');
Route::GET('/deleteInput/{collectiony}/{id}',[StylisteCollectionnyController::class,'destroyInput'])
     ->where([
              'collectiony'=>'[0-9]+',
              'id'=>'[0-9]+'
            ])
     ->name('collection.input.destroy');
//Route by User
Route::prefix('index')->name('index.')->group(function(){
    Route::GET('/marques/modelies/{user}',[IndexController::class,'MarqueModely'])
         ->where(['user'=>'[0-9]+'])
         ->name('marques.modely');
    Route::GET('/marques/collections/{user}',[IndexController::class,'MarqueCollection'])
          ->where(['user'=>'[0-9]+'])
          ->name('marques.collection');
    Route::GET('/showMarqueCollection/{marque}/{user}',[IndexController::class,'showMarquesCollection'])
         ->where(['marque'=>'[0-9]+',
                  'user'=>'[0-9]+'])
         ->name('show.Marque.Collection');
    Route::GET('/showMarqueModely/{marque}/{user}',[IndexController::class,'showMarquesModely'])
         ->where(['marque'=>'[0-9]+',
                  'user'=>'[0-9]+'])
        ->name('show.marque.modely');

    Route::GET('/collectionUser/{user}',[IndexController::class,'getCollectionByUser'])
         ->where(['user'=>'[0-9]'])
         ->name('collection.user');
    Route::GET('/searchcollectionbyuser/{user}',[IndexController::class,'searchCollectionbyUser'])
         ->where(['user'=>'[0-9]']);
    Route::GET('/showModelUser/{user}/model/{modely}',[IndexController::class,'showModelByUser'])
          ->where(['user'=>'[0-9]+',
                    'modely'=>'[0-9]+'
             ])
          ->name('show.modely.user');
    Route::GET('/showCollectionUser/{user}/collection/{collectiony}',[IndexController::class,'showCollectionByUser'])
         ->where(['user'=>'[0-9]+',
                  'collectiony'=>'[0-9]+'
            ])
        ->name('show.collectiony.user');
    Route::GET('/marqueindexmodel',[IndexController::class,'MarqueIndexModel'])->name('marque.index.model');
    Route::GET('/scrollindexmodel',[IndexController::class,'ScrollMarqueIndexModel'])->name('scroll.marque.index.model');
    Route::GET('/marqueindexcollection',[IndexController::class,'MarqueIndexCollection'])->name('marque.index.collection');
    Route::GET('/scrollindexcollection',[IndexController::class,'ScrollMarqueIndexCollection'])->name('scroll.marque.index.collection');
    Route::GET('/index-collection',[IndexController::class,'IndexCollection'])->name('index.collection');
    Route::GET('/scrollIndex-collection',[IndexController::class,'scrollCollectionOneIndex'])->name('index.collection.scroll');
    Route::GET('/index-model-search',[IndexController::class,'modelsearch'])->name('model.search');
    Route::GET('/index-collection-search',[IndexController::class,'collectionsearch'])->name('collection.search');
    Route::GET('/index-collection-index-search',[IndexController::class,'collectionsindexsearch'])->name('collection.search');
    Route::GET('/searchMarqueModely',[IndexController::class,'searchMarqueModely']);
    Route::GET('/searchMarqueCollection',[IndexController::class,'searchMarqueCollection']);
    Route::GET('/searchShowMarqueModely/{marque}/{user}',[IndexController::class,'searchShowMarquesModely'])
         ->where(['marque'=>'[0-9]+',
                   'user'=>'[0-9]+'])
        ;
    Route::GET('/searchShowMarqueCollection/{marque}/{user}',[IndexController::class,'searchShowMarquesCollection'])
        ->where(['marque'=>'[0-9]+',
                  'user'=>'[0-9]+'])
       ;
});

Route::GET('/contact',[ContactController::class,'contact'])->middleware('auth') ->name('user.contact');
Route::POST('/contact',[ContactController::class,'sendContact'])->name('user.send');

require __DIR__.'/auth.php';
