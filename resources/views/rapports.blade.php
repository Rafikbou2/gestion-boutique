<!DOCTYPE html>
<html>
<head>
    <title>Rapport des Ventes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Style général */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            padding-top: 70px; /* Compense la navbar fixe */
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #343a40;
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(21, 6, 233, 0.98);
        }

        /* Table */
        .table {
            margin-top: 20px;
            background-color: white;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table th,
        .table td {
            text-align: center;
            padding: 15px;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }

        .table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #e9ecef;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(to right, #1e3c72, #2a5298); /* Dégradé de couleur */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-brand {
            font-size: 1.75rem;
            font-weight: bold;
            color: white;
        }

        .navbar .nav-link {
            color: white;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: #ffc107; /* Changement de couleur au survol */
        }

        .navbar .nav-item.active .nav-link {
            color: #ffc107; /* Couleur de lien actif */
        }

        .navbar-toggler-icon {
            background-color: #ffc107; /* Icone burger en couleur dorée */
        }

        /* Footer */
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ma Boutique</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Tableau de Bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/gestionproduits') }}"><i class="fas fa-cogs"></i> Gestion des Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/gestioncommandes') }}"><i class="fas fa-box"></i> Gestion des Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ventes.realisees') }}"><i class="fas fa-chart-line"></i> Ventes Réalisées</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Rapports</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Rapport des Ventes</h1>

        <!-- Boutons Export -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('rapports.downloadPdf') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Exporter en PDF
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventes as $vente)
                <tr>
                    <td>{{ $vente->produit->nom }}</td>
                    <td>{{ $vente->quantite }}</td>
                    <td>{{ $vente->produit->prix }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Ma Boutique. Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
