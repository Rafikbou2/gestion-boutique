<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function produitsLesPlusVendus()
{
    $produits = DB::table('vente_produit')
        ->join('produits', 'produits.id', '=', 'vente_produit.produit_id')
        ->select('produits.nom', DB::raw('SUM(vente_produit.quantite) as total_vendus'))
        ->groupBy('produits.nom')
        ->orderByDesc('total_vendus')
        ->take(10)
        ->get();

    return view('statistiques', compact('produits'));
}
}
