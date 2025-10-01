<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Vente; // Assurez-vous d'importer le modèle Vente
use Illuminate\Http\Request;

class RapportController extends Controller
{
    // Afficher la vue des rapports
    public function index()
    {
        $ventes = Vente::all(); // Vous pouvez personnaliser cette partie si nécessaire
        return view('rapports', compact('ventes'));
    }
    

    // Télécharger le PDF des rapports
    public function downloadPdf()
    {
        $ventes = Vente::all(); // Récupérer les ventes ou autres données nécessaires

        // Charger la vue pour générer le PDF
        $pdf = PDF::loadView('pdf', compact('ventes'));
        
        // Télécharger le fichier PDF
        return $pdf->download('rapport_ventes.pdf');
    }
}

