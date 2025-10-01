<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Vente;
use Carbon\Carbon;

class PanierController extends Controller
{
    public function ajouter($id)
    {
        $produit = Produit::findOrFail($id);
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            if ($panier[$id]['quantite'] < $produit->quantite) {
                $panier[$id]['quantite']++;
            } else {
                return back()->with('error', 'Stock insuffisant pour ce produit.');
            }
        } else {
            $panier[$id] = [
                "nom" => $produit->nom,
                "prix" => $produit->prix,
                "quantite" => 1
            ];
        }

        session()->put('panier', $panier);
        return back()->with('success', 'Produit ajouté au panier.');
    }

    public function supprimer($id)
    {
        $panier = session()->get('panier', []);
        if (isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
        }
        return back()->with('success', 'Produit retiré du panier.');
    }

    public function valider()
{
    $panier = session()->get('panier', []);

    if (empty($panier)) {
        return back()->with('error', 'Le panier est vide.');
    }

    foreach ($panier as $id => $details) {
        $produit = Produit::find($id);

        if (!$produit) {
            return back()->with('error', "Le produit avec l'ID {$id} n'existe pas.");
        }

        if ($produit->quantite < $details['quantite']) {
            return back()->with('error', "Stock insuffisant pour le produit {$produit->nom}.");
        }

        // Décrémenter le stock
        $produit->decrement('quantite', $details['quantite']);

        // Enregistrer la vente
        Vente::create([
            'produit_id' => $produit->id,
            'quantite'   => $details['quantite'],
            'montant'    => $details['prix'] * $details['quantite'],
            'date_vente' => now()->toDateString(), // Format YYYY-MM-DD
            'statut'     => 'terminée'
        ]);
    }

    // Vider le panier après validation
    session()->forget('panier');

    return redirect()
        ->route('ventes.realisees')
        ->with('success', 'Vente(s) validée(s) avec succès !');
}

      
}

