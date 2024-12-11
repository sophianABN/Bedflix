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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/bedflix-logo.png" alt="Bedflix Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=series">Séries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=films">Films</a>
                    </li>
                </ul>

                <?php if(isset($_SESSION['user'])): ?>
                    <form class="search-form me-3">
                        <i class="fas fa-search"></i>
                        <input type="search" class="form-control" placeholder="Titre, genres, ...">
                    </form>
                    
                    <div class="d-flex align-items-center">
                        <a href="#" class="nav-link me-3">
                            <i class="fas fa-bell notification-icon"></i>
                        </a>
                        <div class="dropdown">
                            <img src="<?= htmlspecialchars($_SESSION['user']['photo_profil_utilisateur'] ?? 'img/user-icon.png') ?>" 
                                 alt="Profile" 
                                 class="profile-icon" 
                                 role="button" 
                                 data-bs-toggle="dropdown">
                            <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                <li><a class="dropdown-item text-white" href="index.php?page=profile">Profil</a></li>
                                <li><a class="dropdown-item text-white" href="index.php?page=logout">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="d-flex">
                        <a class="nav-link me-3" href="index.php?page=login">Connexion</a>
                        <a class="nav-link" href="index.php?page=register">Inscription</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container mt-4"> 