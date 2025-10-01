<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 70px;
        }
        h1 {
            font-size: 2.5rem;
            color: #343a40;
        }
        .navbar {
            background: linear-gradient(to right, #1e3c72, #2a5298);
        }
        .navbar .nav-link, .navbar .navbar-brand {
            color: white;
        }
        .navbar .nav-link:hover {
            color: #ffc107;
        }
        .card.out-of-stock {
            border-color: red;
        }
        .out-of-stock-text {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ma Boutique</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Tableau de Bord</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/gestionproduits') }}"><i class="fas fa-cogs"></i> Gestion des Produits</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/gestioncommandes') }}"><i class="fas fa-box"></i> Gestion des Commandes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('ventes.realisees') }}"><i class="fas fa-chart-line"></i> Ventes Réalisées</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('rapports') }}"><i class="fas fa-file-alt"></i> Rapports</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenu principal -->
<div class="container mt-4">
    <div class="row">

        <!-- Colonne gauche : Produits -->
        <div class="col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Gestion des Produits</h1>
                <a href="{{ url('/ajouterproduit') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouveau Produit
                </a>
            </div>

            <!-- Boutons catégories -->
            <div class="mb-3">
                <button class="btn btn-outline-primary me-2 filter-btn" data-filter="all">Toutes</button>
              @foreach($produits->keys() as $categorie)

                    <button class="btn btn-outline-primary me-2 filter-btn" data-filter="{{ $categorie }}">
                        {{ $categorie }}
                    </button>
                @endforeach
            </div>

            <!-- Produits -->
            <div class="row" id="produits-list">
                @foreach($produits as $categorie => $liste)
                    @foreach($liste as $produit)
                        <div class="col-md-4 produit-item mb-3" data-categorie="{{ $categorie }}">
                            <div class="card {{ $produit->quantite == 0 ? 'out-of-stock' : '' }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produit->nom }}</h5>
                                    <p><strong>Prix :</strong> {{ $produit->prix }} DA</p>
                                    <p>
                                        <strong>Quantité :</strong>
                                        @if($produit->quantite == 0)
                                            <span class="out-of-stock-text">Épuisé</span>
                                        @else
                                            {{ $produit->quantite }}
                                        @endif
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" {{ $produit->quantite == 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>

        </div>

        <!-- Colonne droite : Panier -->
        <div class="col-md-4">
            @if(session('panier') && count(session('panier')) > 0)
            <div class="card sticky-top" style="top: 80px;">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-shopping-cart"></i> Panier du Client
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Qté</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach(session('panier') as $id => $details)
                                @php $total += $details['prix'] * $details['quantite']; @endphp
                                <tr>
                                    <td>{{ $details['nom'] }}</td>
                                    <td>{{ $details['quantite'] }}</td>
                                    <td>{{ $details['prix'] * $details['quantite'] }} DA</td>
                                    <td>
                                        <form action="{{ route('panier.supprimer', $id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h5>Total : <strong>{{ $total }} DA</strong></h5>
                    <form action="{{ route('panier.valider') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-cash-register"></i> Finaliser
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="text-center mt-4">
    © 2025 Ma Boutique - Tous droits réservés.
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.filter-btn');
    const produits = document.querySelectorAll('.produit-item');

    buttons.forEach(btn => {
        btn.addEventListener('click', function () {
            const filter = this.getAttribute('data-filter');

            produits.forEach(prod => {
                if (filter === 'all' || prod.getAttribute('data-categorie') === filter) {
                    prod.style.display = 'block';
                } else {
                    prod.style.display = 'none';
                }
            });
        });
    });
});
</script>
</body>
</html>



