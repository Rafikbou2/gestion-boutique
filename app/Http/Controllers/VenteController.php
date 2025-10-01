<?php
namespace App\Http\Controllers;

use App\Models\Vente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    // Afficher les ventes avec pagination automatique
    public function index()
    {
        $ventes = Vente::paginate(10); // Pagination automatique de 10 par page
        return view('realisees', compact('ventes'));
    }

    // Afficher les ventes réalisées avec pagination personnalisée
    public function ventesRealisees(Request $request)
{
    // Nombre de ventes par page
    $perPage = 10;
    
    // Récupérer la page actuelle, par défaut 1 si non spécifiée
    $page = $request->get('page', 1);
    
    // Calcul du décalage pour la pagination
    $offset = ($page - 1) * $perPage;

    // Total des ventes
    $total = Vente::count();

    // Récupérer les ventes avec la relation produit
    $ventes = Vente::with('produit')
        ->skip($offset)
        ->take($perPage)
        ->get();

    // Calcul du nombre total de pages
    $totalPages = ceil($total / $perPage);

    // Passer les variables à la vue
    return view('realisees', compact('ventes', 'total', 'page', 'perPage', 'totalPages'));
}

    

    // Calculer le total des ventes
   public function calculerTotalVentes()
{
    // Calculer la somme des montants des ventes
    $totalVentes = Vente::sum('montant');

    // Retourner la vue avec les données
    return view('dashboard', compact('totalVentes'));
}
}
