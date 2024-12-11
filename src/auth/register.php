<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $pseudo = $_POST['pseudo'] ?? '';
    $password = $_POST['password'] ?? '';
    $photo = 'img/user-icon.png'; // Photo par défaut

    try {
        $db = Database::getInstance();
        
        // Vérifier si l'email existe déjà
        $check = $db->prepare("SELECT id_utilisateur FROM UTILISATEURS WHERE email_utilisateur = ?");
        $check->execute([$email]);
        if ($check->rowCount() > 0) {
            throw new Exception("Cet email est déjà utilisé");
        }

        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur
        $stmt = $db->prepare("
            INSERT INTO UTILISATEURS (nom_utilisateur, prenom_utilisateur, email_utilisateur, 
                                    pseudo_utilisateur, mot_de_passe_utilisateur, 
                                    photo_profil_utilisateur, id_role) 
            VALUES (?, ?, ?, ?, ?, ?, 2)
        ");
        
        $stmt->execute([$nom, $prenom, $email, $pseudo, $hashedPassword, $photo]);
        
        header('Location: index.php?page=login&success=1');
        exit;
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Inscription</h2>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
        </form>
    </div>
</div> 