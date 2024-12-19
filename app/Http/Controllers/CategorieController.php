<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Categorie::all();
        return response()->json($categories,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $categorie = Categorie::create($data);
        return response()->json($categorie,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categorie=Categorie::findOrFail($id);
        return response()->json($categorie,201);
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, string $id)
            {
                try {
                    $categorie=Categorie::findOrFail($id);
                    $valid=$request->validate([
                        "nomCat"=>'required',
                        "description"=>'required',
                    ]);
                    $categorie->update($valid);
                    return response()->json($categorie,200);
                }catch (ModelNotFoundException $e){
                    return response()->json(['error'=>"Categorie not found"],404);
                }
            }

    public function destroy(string $id)
    {
        //
    }
}
