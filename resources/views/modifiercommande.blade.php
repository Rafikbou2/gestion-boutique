<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Commande</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Ajout des icônes FontAwesome -->
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

        /* Container */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(4, 8, 255, 0.88);
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

        /* Formulaire */
        form {
            margin-top: 30px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-size: 1.1rem;
            color: #343a40;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
            transition: border 0.3s ease, background-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #007bff;
            background-color: #ffffff;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* Bouton */
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            font-size: 1.1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Alertes d'erreur */
        .alert {
            margin-top: 20px;
            font-size: 1rem;
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
    <a class="nav-link active" href="{{ route('rapports') }}">
        <i class="fas fa-file-alt"></i> Rapports
    </a>
</li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Modifier Commande</h1>
        
        <!-- Formulaire pour éditer la commande -->
        <form action="{{ route('commande.update', $commande->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="client_name" class="form-label">Nom du Client</label>
                <input type="text" class="form-control" id="client_name" name="client_name" value="{{ old('client_name', $commande->client_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="produits" class="form-label">Produits</label>
                <input type="text" class="form-control" id="produits" name="produits" value="{{ old('produits', $commande->produits) }}" required>
            </div>

            <div class="mb-3">
                <label for="prix_total" class="form-label">Prix Total (DA)</label>
                <input type="number" class="form-control" id="prix_total" name="prix_total" value="{{ old('prix_total', $commande->prix_total) }}" required>
            </div>

            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-select" id="statut" name="statut" required>
                    <option value="en attente" {{ old('statut', $commande->statut) == 'en attente' ? 'selected' : '' }}>En attente</option>
                    <option value="en cours" {{ old('statut', $commande->statut) == 'en cours' ? 'selected' : '' }}>En cours</option>
                    <option value="livré" {{ old('statut', $commande->statut) == 'livré' ? 'selected' : '' }}>Livré</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('gestioncommandes') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
