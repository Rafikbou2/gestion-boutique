<?php

namespace App\Http\Controllers;

use App\Models\Commande; // Import du modèle Commande
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    // Afficher la liste des commandes
    public function index()
    {
        $commandes = Commande::all(); // Récupérer toutes les commandes
        return view('gestioncommandes', compact('commandes'));
    }

    // Méthode pour afficher le formulaire de création
    public function create()
    {
        return view('ajoutercommande');
    }

    // Méthode pour enregistrer une commande
    public function store(Request $request)
    {
        // Valider les données entrantes
        $request->validate([
            'client_name' => 'required|string|max:255',
            'produits' => 'required|string',
            'prix_total' => 'required|numeric',
            'statut' => 'required|string',
        ]);

        // Créer une nouvelle commande
        Commande::create([
            'client_name' => $request->client_name,
            'produits' => $request->produits,
            'prix_total' => $request->prix_total,
            'statut' => $request->statut,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('gestioncommandes')->with('success', 'Commande ajoutée avec succès!');
    }

    public function destroy($id)
{
    $commande = Commande::findOrFail($id);
    $commande->delete();
    
    return redirect()->route('gestioncommandes')->with('success', 'Commande supprimée avec succès!');
}

public function edit($id)
{
    $commande = Commande::findOrFail($id);
    return view('modifiercommande', compact('commande'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'client_name' => 'required',
        'produits' => 'required',
        'prix_total' => 'required|numeric',
        'statut' => 'required|in:en attente,en cours,livré',
    ]);

    $commande = Commande::findOrFail($id);
    $commande->update($request->all());

    return redirect()->route('gestioncommandes')->with('success', 'Commande mise à jour avec succès!');
}


}
