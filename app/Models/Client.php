<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public function commande()
    {
        return $this->hasMany(Commande::class,'client_id'); //Relation inverse
    }
}
