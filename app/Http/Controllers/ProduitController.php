<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits=Produit::all();
        return response()->json($produits,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    //! store 1
//    public function store(Request $request)
//    {
//        $data=$request->all();
//        if ($request->hasFile('image')){
//            $path =$request->file('image')->store('images','public');
//            $data['image']=$path;
//        }
//        $produit = Produit::create($data);
//        return response()->json($produit,201);
//    }
//    public function store(Request $request)
//    {
//        // Validation des données d'entrée
//        $request->validate([
//            "libelleProd"=> 'required|string|max:255',
//            "codeProd" => 'required|string|max:25',
//            'description' => 'nullable|string',
//            'priU' => 'required|numeric',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//            "stock"=>'required|numeric',
//            "qte"=>'required|numeric',
//        ]);
//
//        // Récupérer toutes les données de la requête
//        $data = $request->all();
//        // Stocker l'image dans le dossier 'images' du disque 'public'
//        $path = $request->file('image')->store('images', 'public');
//        // Ajouter le chemin de l'image aux données
//        $data['image'] = $path;
//        // Créer le produit avec les données
//        $produit = Produit::create($data);
//        // Retourner une réponse JSON avec le produit créé
//        return response()->json($produit, 201);
//    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
//            $path = $request->file('image')->getClientOriginalName();
            $data['image'] = $path;
        }

        $produit = Produit::create($data);

        // Ajouter l'URL complète de l'image
        $produit->image = $produit->image ? asset('storage/' . $produit->image) : null;

        return response()->json($produit, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $produit = Produit::findOrFail($id);
        return response()->json($produit,201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $produit=Produit::findOrFail($id);
            $valid=$request->validate([
                "libelleProd"=>'required',
                "codeProd"=>'required',
                "description"=>'required',
                "prixU"=>'required',
                "image"=>'required',
                "stock"=>'required',
                "qte"=>'required',
                "categorie_id" => 'required|exists:categories,id', // Assurez-vous que l'ID de catégorie existe

            ]);
            $produit->update($valid);
            return response()->json($produit,200);
        }catch (ModelNotFoundException $e){
            return response()->json(['error'=>"Produit not found"],404);
        }
    }

//    public function update(Request $request, string $id)
//    {
//        try {
//            // Récupérer le produit
//            $produit = Produit::findOrFail($id);
//
//            // Validation des données fournies
//            $valid = $request->validate([
//                "libelleProd" => 'required|string|max:255',
//                "description" => 'required|string',
//                "prixU" => 'required|numeric',
//                "image" => 'required|string',
//                "stock" => 'required|integer',
//                "qte" => 'required|integer',
//                "categorie_id" => 'required|exists:categories,id', // Assurez-vous que l'ID de catégorie existe
//            ]);
//
//            // Génération du nouveau code produit
//            $codeProd = 'CAT-' . $valid['categorie_id'] . '-' . now()->format('Ymd') . '-' . $produit->id;
//
//            // Mise à jour des données
//            $produit->update(array_merge($valid, ['codeProd' => $codeProd]));
//
//            // Retourner une réponse JSON avec le produit mis à jour
//            return response()->json($produit, 200);
//        } catch (ModelNotFoundException $e) {
//            // Gestion de l'erreur si le produit n'est pas trouvé
//            return response()->json(['error' => "Produit not found"], 404);
//        } catch (\Exception $e) {
//            // Gestion des autres erreurs
//            return response()->json(['error' => $e->getMessage()], 500);
//        }
//    }

    public function destroy(string $id)
    {
    }
}
