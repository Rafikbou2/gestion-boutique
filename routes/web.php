<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\RapportController;
use App\Exports\VentesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\PanierController;

Route::get('/', function () {
    return view('welcome'); 
});


// Route vers le tableau de bord
Route::get('/Dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes pour afficher la liste des produits et commandes
Route::get('/gestionproduits', [ProduitController::class, 'index'])->name('gestionproduits');
Route::get('/gestioncommandes', [CommandeController::class, 'index'])->name('gestioncommandes');

// Routes pour les produits : création, modification et gestion via le contrôleur
Route::resource('produits', ProduitController::class);

// Routes pour les commandes
Route::resource('commandes', CommandeController::class);

// Routes pour ajouter, afficher et gérer les produits
Route::get('/ajouterproduit', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');

// Routes pour afficher les ventes réalisées
Route::get('/ventes/realisees', [VenteController::class, 'ventesRealisees'])->name('ventes.realisees');


// Routes pour vendre un produit
Route::post('/produit/vendre/{id}', [ProduitController::class, 'vendre'])->name('vendre.produit');

// Suppression de doublons pour la vente d'un produit
// La route ci-dessus suffit pour vendre un produit

Route::get('/commande/create', [CommandeController::class, 'create'])->name('commande.create');
Route::post('/commande', [CommandeController::class, 'store'])->name('commande.store');
Route::put('/commande/{id}/update', [CommandeController::class, 'update'])->name('commande.update');

Route::get('/ventes/realisees', [VenteController::class, 'ventesRealisees'])->name('realisees');

Route::get('/ventes/realisees', [VenteController::class, 'ventesRealisees'])->name('ventes.realisees');

Route::get('/rapports', [RapportController::class, 'index'])->name('rapports');

Route::get('/rapports', [RapportController::class, 'index'])->name('rapports.index');

// Route pour télécharger le rapport PDF
Route::get('/rapports/telecharger-pdf', [RapportController::class, 'downloadPdf'])->name('rapports.downloadPdf');
Route::get('/rapports', [RapportController::class, 'index'])->name('rapports');


Route::get('/statistiques/produits-les-plus-vendus', [ProduitController::class, 'produitsLesPlusVendus'])->name('produits.plus.vendus');
Route::get('/statistiques', [ProduitController::class, 'produitsLesPlusVendus'])->name('statistiques.produits');


Route::post('/panier/ajouter/{id}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::post('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
Route::post('/panier/valider', [PanierController::class, 'valider'])->name('panier.valider');