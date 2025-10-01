<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Ma Boutique')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        /* Styles communs et layout */
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
        }

        /* -- DARK MODE -- */
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

        /* Bouton toggle dark mode */
        #darkModeToggle {
            width: 100%;
            margin-top: 1rem;
            border-radius: 5px;
            cursor: pointer;
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

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        
            <!-- Bouton Dark Mode -->
            <li class="nav-item mt-4 px-3">
                <button id="darkModeToggle" class="btn btn-outline-light">
                    <i class="fas fa-moon"></i> Mode sombre
                </button>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Scripts Bootstrap & FontAwesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark mode toggle & persistence -->
    <script>
        const toggleBtn = document.getElementById('darkModeToggle');
        const body = document.body;

        // Charger état du localStorage
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
    </script>

    @stack('scripts')
</body>
</html>
