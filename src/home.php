<?php if(isset($_SESSION['user'])): ?>
    <!-- Hero Section avec Jumanji -->
    <div class="hero-section position-relative mb-5">
        <img src="img/Rectangle-4.png" class="w-100" alt="Jumanji" style="height: 600px; object-fit: cover;">
        <div class="position-absolute bottom-0 start-0 p-5 text-white" style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
            <h1 class="display-4">JUMANJI</h1>
            <p class="lead">Regardez La Première Saison !</p>
            <p class="w-50">Consectetur Adipiscing Elit Duis Tristique Sollicitudin Nibh Sit Amet Commodo Nulla Facilisi Nullam Vehicula Ipsum A Arcu Cursus Vitae Congue</p>
        </div>
    </div>

    <!-- Films du moment -->
    <h2 class="text-white mb-4">Films du moment</h2>
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card bg-dark">
                <img src="img/card-1.png" class="card-img" alt="Queen's Gambit">
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark">
                <img src="img/card-2.png" class="card-img" alt="Narcos">
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark">
                <img src="img/card-3.png" class="card-img" alt="Into the Badlands">
            </div>
        </div>
    </div>

    <!-- Séries du moment -->
    <h2 class="text-white mb-4">Séries du moment</h2>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card bg-dark">
                <img src="img/card-4.png" class="card-img" alt="JoJo's Bizarre Adventure">
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark">
                <img src="img/card-5.png" class="card-img" alt="Rick and Morty">
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark">
                <img src="img/card-6.png" class="card-img" alt="Peaky Blinders">
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="text-center text-white">
        <h1>Bienvenue sur Bedflix</h1>
        <p>Connectez-vous pour accéder à notre catalogue.</p>
        <a href="index.php?page=login" class="btn btn-danger">Se connecter</a>
    </div>
<?php endif; ?> 