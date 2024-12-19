<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        "libelleProd",
        "codeProd",
        "description",
        "prixU",
        "image",
        "stock",
        "qte",
        "categorie_id"
    ];
    //    public function commandes() 111
//    public function commandes()
//    {
//        return $this->hasMany(Commande::class);
//    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
            ->withPivot('quantite')
            ->withTimestamps();
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
