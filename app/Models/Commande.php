<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable=[
        'dateCommande',
        'montant',
        'numeroCommande',
        'etat',
        'dateLivraisonCommande',
        'client_id',
    ];
    public  function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);  //,'client_id'// Assurez-vous que 'client_id' est bien le nom de la colonne
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
            ->withPivot('quantite') // Colonne supplémentaire pour la quantité de chaque produit
            ->withTimestamps();    // Enregistre les dates de création/mise à jour
    }
}
