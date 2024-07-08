<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.property.index',[
            'properties'=>Property::orderby('created_at','DESC')->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property =  new Property();
        return view('admin.property.form',[
            'property'=>$property
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        $property = Property::create($request->validated());
        return to_route('admin.property.index')->with('success','Ajout  éffectué avec succès');
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
    public function edit(Property $property)
    {
        return view('admin.property.form',[
            'property'=>$property
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->validated());
        return to_route('admin.property.index')->with('success','Modification  éffectué avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return to_route('admin.property.index')->with('success','Suppression  éffectué avec succès');
    }
}
