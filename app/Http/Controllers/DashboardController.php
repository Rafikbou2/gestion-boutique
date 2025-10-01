<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use App\Models\Vente; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Produits avec stock faible
        $alertesStock = Produit::where('quantite', '<=', 5)->get();

        // Total des ventes
        $totalVentes = Vente::sum('montant');

        // Nombre total de produits
        $totalProduits = Produit::count();

        // Stock total (somme des quantités)
        $stockTotal = Produit::sum('quantite');

        // Statuts standardisés (en minuscules)
        $nouvellesCommandes = Commande::whereRaw('LOWER(statut) = ?', ['nouvelle'])->count();
        $commandesEnAttente = Commande::whereRaw('LOWER(statut) = ?', ['en attente'])->count();
        $commandesEnCours = Commande::whereRaw('LOWER(statut) = ?', ['en cours'])->count();
        $commandesLivrees = Commande::whereRaw('LOWER(statut) = ?', ['livrée'])->count();

        // Commandes récentes (par exemple les 10 dernières)
        $commandesRecente = Commande::with('client')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Données de ventes pour Chart.js (tu peux remplacer par des données dynamiques)
        $salesData = [
            'labels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai'],
            'datasets' => [
                [
                    'label' => 'Ventes Mensuelles',
                    'data' => [3000, 4000, 2500, 5000, 4500],
                    'borderColor' => 'blue',
                    'backgroundColor' => 'rgba(0, 0, 255, 0.1)',
                ]
            ]
        ];

        return view('dashboard', compact(
            'alertesStock',
            'totalVentes',
            'totalProduits',
            'stockTotal',
            'nouvellesCommandes',
            'commandesEnAttente',
            'commandesEnCours',
            'commandesLivrees',
            'commandesRecente',
            'salesData'
        ));
    }
}
