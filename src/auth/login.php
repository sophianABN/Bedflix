<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $db = Database::getInstance();
        
        $stmt = $db->prepare("
            SELECT * FROM UTILISATEURS 
            WHERE email_utilisateur = ?
        ");
        
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['mot_de_passe_utilisateur'])) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit;
        } else {
            throw new Exception("Email ou mot de passe incorrect");
        }
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Connexion</h2>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Inscription réussie ! Vous pouvez maintenant vous connecter.</div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
    </div>
</div> 