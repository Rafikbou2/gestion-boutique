<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\Vente;
use Illuminate\Support\Facades\DB;


class ProduitController extends Controller
{
    // Afficher la liste des produits
   public function index()
    {
        // Récupérer les produits et les grouper par catégorie
       $produits = Produit::all()->groupBy('categorie'); // ici 'categorie' est le nom de ta colonne
return view('gestionproduits', compact('produits'));


        // Envoyer à la vue
        return view('gestionproduits', compact('produits'));
    }

    // Afficher la page de création
    public function create()
    {
        return view('ajouterproduit');
    }

    // Ajouter un produit
    public function store(Request $request)
    {
        // Validation et ajout du produit avec messages personnalisés
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'quantite' => 'required|numeric',
            'description' => 'required',
            'categorie' => 'required|string|max:255',
        ], [
            'nom.required' => 'Le champ "Nom du produit" est obligatoire.',
            'prix.required' => 'Le champ "Prix" est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre valide.',
            'quantite.required' => 'Le champ "Quantité" est obligatoire.',
            'quantite.numeric' => 'La quantité doit être un nombre valide.',
            'description.required' => 'Le champ "Description" est obligatoire.',
              'categorie.required' => 'Le champ "Catégorie" est obligatoire.',
        'categorie.string' => 'La catégorie doit être une chaîne de caractères.',
        ]);

        // Création du produit
        Produit::create($request->only(['nom', 'prix', 'quantite','categorie', 'description']));

        return redirect()->route('gestionproduits')->with('success', 'Produit ajouté avec succès!');
    }

    // Afficher la page d'édition
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('modifierproduit', compact('produit'));
    }

    // Mettre à jour un produit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'quantite' => 'required|numeric',
            'categorie' => 'required|string|max:255',
            'description' => 'required',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->update($request->all());

        return redirect()->route('gestionproduits')->with('success', 'Produit mis à jour avec succès!');
    }

    public function vendre($id)
{
    $produit = Produit::findOrFail($id);

    // Vérifier le stock
    if ($produit->quantite <= 0) {
        return back()->with('error', 'Le produit est en rupture de stock.');
    }

    // Enregistrer la vente
    Vente::create([
        'produit_id' => $produit->id,
        'quantite'   => 1,
        'montant'    => $produit->prix,
        'date_vente' => now()->toDateString(),
        'statut'     => 'terminée',
    ]);

    // Mise à jour du stock
    $produit->decrement('quantite', 1);

    // Redirection avec message
    return redirect()
        ->route('ventes.realisees')
        ->with('success', 'Vente réalisée avec succès !');
}

public function produitsLesPlusVendus()
{
    $ventes = DB::table('ventes')
        ->select('produit_id', DB::raw('SUM(quantite) as total_quantite'))
        ->groupBy('produit_id')
        ->orderByDesc('total_quantite')
        ->take(5)
        ->get();

    $produits = [];

    foreach ($ventes as $vente) {
        $produit = Produit::find($vente->produit_id);
        if ($produit) {
            $produits[] = [
                'nom' => $produit->nom,
                'quantite' => $vente->total_quantite
            ];
        }
    }

    return view('statistiques', compact('produits'));
}




}
