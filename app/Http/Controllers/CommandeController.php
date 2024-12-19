<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::with('client', 'produits')->get();
        return response()->json($commandes, 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    // STORE 1
//    public function store(Request $request)
//    {
//        $commande = Commande::create([
//            'client_id' => $request->client_id,
//        ]);
//
//        $produits = $request->produits; // Array de produits avec leurs quantités
//        foreach ($produits as $produit) {
//            $commande->produits()->attach($produit['id'], ['quantite' => $produit['quantite']]);
//        }
//
//        return response()->json(['message' => 'Commande créée avec succès !'], 201);
//    }
    public function store(Request $request)
    {
       // $user = auth()->user(); // Récupérer l'utilisateur authentifié
        // Créer l'utilisateur (si nécessaire)
        $user = User::create([
            'name' => $request->user['nom'],
            'email' => $request->user['email'],
            'password' => bcrypt($request->user['password']),
            'telephone' => $request->user['telephone'],
        ]);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }
        $commande = Commande::create([
            'client_id' => $user->id, // Utiliser l'ID de l'utilisateur connecté
        ]);
        $produits = $request->produits; // Array de produits avec leurs quantités
        foreach ($produits as $produit) {
            $commande->produits()->attach($produit['id'], ['quantite' => $produit['quantite']]);
        }

        return response()->json(['message' => 'Commande créée avec succès !'], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
