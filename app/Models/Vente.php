<?php

// app/Models/Vente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = ['produit_id', 'quantite', 'montant', 'date_vente', 'statut'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
// app/Models/Produit.php
public function ventes()
{
    return $this->hasMany(Vente::class);
}


}
