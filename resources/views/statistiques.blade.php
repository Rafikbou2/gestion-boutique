<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits les Plus Vendus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            width: 230px;
            background: linear-gradient(180deg, #187de2, #1458a5);
            padding-top: 30px;
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar .nav-link {
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .content {
            margin-left: 230px;
            padding: 40px 30px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
        }

        .card-title i {
            font-size: 1.2rem;
        }

        .card-text {
            font-size: 1rem;
            color: #333;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Barre latérale -->
    <div class="sidebar">
        <h4>Ma Boutique</h4>
        <ul class="nav flex-column px-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Accueil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/gestionproduits') }}">
                    <i class="fas fa-cogs me-2"></i> Produits
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/gestioncommandes') }}">
                    <i class="fas fa-box me-2"></i> Commandes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ventes.realisees') }}">
                    <i class="fas fa-chart-line me-2"></i> Ventes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('produits.plus.vendus') }}">
                    <i class="fas fa-star me-2"></i> Top Produits
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="content">
        <h2 class="mb-4">Top 10 des Produits les Plus Vendus</h2>
        <div class="row">
            @foreach ($produits as $produit)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-box-open me-2 text-primary"></i>
                                {{ is_array($produit) ? $produit['nom'] : $produit->nom }}
                            </h5>
                            <p class="card-text">
                                <strong>Quantité vendue :</strong>
                                {{ is_array($produit) ? $produit['quantite'] : $produit->quantite }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>

