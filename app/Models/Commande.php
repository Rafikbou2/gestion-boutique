<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vente;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'produits',
        'prix_total',
        'statut',
    ];

    // Dans le modèle Commande (Commande.php)


// app/Models/Commande.php

}
