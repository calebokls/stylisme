<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Primary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
             return view('admin.category.index',[
                   'categories'=>Category::orderBy('created_at', 'DESC')->paginate(8)
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
            $category = new Category();
            $primaries = Primary::pluck('nom','id');
            return view('admin.category.form',[
                        'category'=>$category,
                        'primaries'=>$primaries
               ]);
        }else{
            return back()->with('danger','Impossible d\'effectuer cette acton');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        $category->primaries()->sync($request->validated('primaries'));
        return to_route('admin.category.index')->with('success','Categorie créé avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            $primaries = Primary::pluck('nom','id');
            return view('admin.category.form',[
                'category'=>$category,
                'primaries'=>$primaries
            ]);
        }else{
            return back()->with('danger','Impossible d\'effectuer cette acton');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        $category->primaries()->sync($request->validated('primaries'));
        return to_route('admin.category.index')->with('success','Categorie modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(Auth::user() && Auth::user()->acteur === "admin")
        {
            $category->delete();
            return to_route('admin.category.index')->with('success','Categorie supprimée avec succès');
        }else{
            return back()->with('danger','Impossible d\'effectuer cette acton');
        }
    }
}
