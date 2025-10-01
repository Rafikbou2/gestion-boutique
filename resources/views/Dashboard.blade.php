<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tableau de Bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            width: 230px;
            background: linear-gradient(180deg, #187de2, #1458a5);
            padding-top: 30px;
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: background-color 0.3s, color 0.3s;
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
            transition: background 0.3s ease, color 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .content {
            margin-left: 230px;
            padding: 40px 30px;
            transition: background-color 0.3s, color 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
            transition: transform 0.2s ease-in-out, background-color 0.3s, color 0.3s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .card-text {
            font-size: 1.4rem;
            font-weight: bold;
        }

        .bg-stat {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
        }

        .bg-success {
            background: linear-gradient(to right, #00c851, #007e33) !important;
            color: white;
        }

        canvas {
            max-height: 300px;
        }

        /* Styles alertes */
        .alert-icon {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        footer {
            margin-top: auto;
            padding: 15px 30px;
            background-color: #f1f1f1;
            color: #555;
            text-align: center;
            border-top: 1px solid #ddd;
            font-size: 0.9rem;
        }

        /* Badges status commandes */
        .badge-pending { background-color: #ffc107; color: #212529; }
        .badge-processing { background-color: #17a2b8; }
        .badge-delivered { background-color: #28a745; }

        /* Responsive table */
        .table-responsive { margin-top: 20px; }

        /* Dark mode omitted for brevity */
        body.dark-mode {
  background-color: #121212;
  color: #e0e0e0;
}

body.dark-mode .sidebar {
  background: linear-gradient(180deg, #0b2240, #0a1a33);
  color: #ddd;
  box-shadow: none;
}

body.dark-mode .sidebar .nav-link {
  color: #bbb;
}

body.dark-mode .sidebar .nav-link:hover,
body.dark-mode .sidebar .nav-link.active {
  background-color: rgba(255, 255, 255, 0.15);
  color: #fff;
}

body.dark-mode .content {
  background-color: #1e1e1e;
  color: #ddd;
}

body.dark-mode .card {
  background-color: #272727;
  color: #ddd;
  box-shadow: none;
}

body.dark-mode .table {
  background-color: #272727;
  color: #ddd;
}

body.dark-mode .table th {
  background-color: #444;
  color: #eee;
}

body.dark-mode .table tr:nth-child(even) {
  background-color: #333;
}

body.dark-mode .table tr:hover {
  background-color: #555;
}

/* Boutons */
body.dark-mode .btn-primary {
  background-color: #004085;
  border-color: #003768;
}
body.dark-mode .btn-primary:hover {
  background-color: #003768;
  border-color: #002f5a;
}

body.dark-mode footer {
  background-color: #1e1e1e;
  color: #aaa;
  border-top: 1px solid #444;
}

    </style>
</head>
<body>
    <!-- Barre latérale -->
    <div class="sidebar">
        <h4>Ma Boutique</h4>
        <ul class="nav flex-column px-3">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard') }}">
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
                <a class="nav-link" href="{{ route('rapports') }}">
                    <i class="fas fa-file-alt me-2"></i> Rapports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('statistiques.produits') }}">
                    <i class="fas fa-chart-pie me-2"></i> Statistiques
                </a>
            </li>

            <!-- Bouton Dark Mode -->
            <li class="nav-item mt-4 px-3">
                <button id="darkModeToggle" class="btn btn-outline-light w-100">
                    <i class="fas fa-moon"></i> Mode sombre
                </button>
            </li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="content">
        <h1 class="mb-4">Tableau de Bord</h1>

        {{-- Alerte stock faible --}}
        @if($alertesStock->isNotEmpty())
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-triangle alert-icon"></i>
                <div>
                    <strong>Alerte stock :</strong>
                    <ul class="mb-0">
                        @foreach($alertesStock as $alerte)
                            <li>Produit <strong>{{ $alerte->nom }}</strong> : stock faible ({{ $alerte->stock }} unités restantes)</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Résumé des stocks --}}
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card bg-stat text-white text-center p-3">
                    <h5 class="card-title">Total Produits</h5>
                    <p class="card-text fs-3">{{ $totalProduits }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-stat text-white text-center p-3">
                    <h5 class="card-title">Stock Total</h5>
                    <p class="card-text fs-3">{{ $stockTotal }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white text-center p-3">
                    <h5 class="card-title">Total Ventes</h5>
                    <p class="card-text fs-3">{{ $totalVentes }} DA</p>
                </div>
            </div>
        </div>

       

        <!-- Graphique -->
        <h4 class="mb-3">Graphique des Ventes</h4>
        <div class="card p-4 mb-5">
            <canvas id="salesChart"></canvas>
        </div>

        <footer>
            &copy; {{ date('Y') }} Ma Boutique. Tous droits réservés.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Dark mode toggle & persistence
        const toggleBtn = document.getElementById('darkModeToggle');
        const body = document.body;

        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            toggleBtn.innerHTML = '<i class="fas fa-sun"></i> Mode clair';
        }

        toggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                toggleBtn.innerHTML = '<i class="fas fa-sun"></i> Mode clair';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                toggleBtn.innerHTML = '<i class="fas fa-moon"></i> Mode sombre';
            }
        });

        // Chart.js data from Blade variable
        const salesData = @json($salesData);
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: salesData,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    title: { display: false }
                },
                scales: {
                    x: {
                        title: { display: true, text: 'Période' }
                    },
                    y: {
                        title: { display: true, text: 'Montant (DA)' },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>


