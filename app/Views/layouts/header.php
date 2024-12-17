<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bedflix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #141414;
            color: white;
        }
        .navbar {
            padding: 0.5rem 1rem;
            background-color: #000 !important;
        }
        .navbar-brand img {
            height: 25px;
            width: auto;
            object-fit: contain;
        }
        .nav-link {
            color: #fff !important;
            font-size: 14px;
        }
        .nav-link:hover {
            color: #e50914 !important;
        }
        .search-form {
            position: relative;
            width: 300px;
        }
        .search-form input {
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.7);
            border-radius: 25px;
            color: #fff;
            padding: 8px 40px 8px 40px;
            width: 100%;
            font-size: 14px;
            caret-color: white;
        }
        .search-form input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .search-form input:focus {
            background-color: rgba(0, 0, 0, 0.8);
            border-color: #fff;
            box-shadow: none;
            outline: none;
            color: white;
        }
        .search-form .fa-search {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
        }
        .profile-icon {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            object-fit: cover;
        }
        .notification-icon {
            font-size: 18px;
            color: #fff;
        }
        .search-form input:-webkit-autofill,
        .search-form input:-webkit-autofill:hover,
        .search-form input:-webkit-autofill:focus {
            -webkit-text-fill-color: white;
            -webkit-box-shadow: 0 0 0px 1000px #000 inset;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/img/bedflix-logo.png" alt="Bedflix" height="40">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu principal -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/films">Films</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/series">Séries</a>
                    </li>
                </ul>

                <!-- Menu utilisateur -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="/<?= htmlspecialchars($_SESSION['user']['photo_profil_utilisateur']) ?>" 
                                     alt="Photo de profil" 
                                     class="rounded-circle me-2"
                                     style="width: 32px; height: 32px; object-fit: cover;">
                                <?= htmlspecialchars($_SESSION['user']['pseudo_utilisateur']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile">Mon Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/logout">Déconnexion</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Inscription</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </header>
    <div class="container mt-4"> 