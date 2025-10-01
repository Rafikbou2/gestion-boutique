<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Ajout des icônes FontAwesome -->
    <style>
        /* Style général */
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
        <h1 class="text-center">Ajouter un Nouveau Produit</h1>

        <!-- Afficher les erreurs de validation globales -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('produits.store') }}" method="POST">
    @csrf
    <div>
        <label for="nom">Nom du produit :</label>
        <input type="text" name="nom" id="nom" required>
    </div>
    <div>
        <label for="prix">Prix :</label>
        <input type="number" name="prix" id="prix" step="0.01" required>
    </div>
    <div>
        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" id="quantite" required>
    </div>
    <div>
        <label for="description">Description :</label>
        <textarea name="description" id="description" required></textarea>
    </div>
    <div class="mb-3">
    <label for="categorie" class="form-label">Catégorie</label>
    <select name="categorie" id="categorie" class="form-control" required>
        <option value="">-- Choisir une catégorie --</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
    </select>
</div>

    <button type="submit">Ajouter le produit</button>
</form>

    </div>

    <!-- Script Bootstrap JS (optionnel, si vous avez besoin de certains composants interactifs comme les modales) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

