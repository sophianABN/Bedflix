<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$user = $_SESSION['user'];
$error = null;
$success = null;

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = Database::getInstance();
        
        // Gestion de l'upload de l'image
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['photo']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);
            
            if (!in_array(strtolower($filetype), $allowed)) {
                throw new Exception('Format de fichier non autorisé. Utilisez JPG, PNG ou GIF.');
            }
            
            // Générer un nom unique pour éviter les conflits
            $newname = uniqid() . '.' . $filetype;
            $upload_dir = __DIR__ . '/../../public/img/profiles/';
            
            // Créer le dossier s'il n'existe pas
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $newname)) {
                throw new Exception('Erreur lors de l\'upload du fichier.');
            }
            
            // Mettre à jour la photo dans la base de données
            $stmt = $db->prepare("
                UPDATE UTILISATEURS 
                SET photo_profil_utilisateur = ? 
                WHERE id_utilisateur = ?
            ");
            $stmt->execute(['img/profiles/' . $newname, $user['id_utilisateur']]);
        }
        
        // Mise à jour des autres informations
        $stmt = $db->prepare("
            UPDATE UTILISATEURS 
            SET nom_utilisateur = ?,
                prenom_utilisateur = ?,
                pseudo_utilisateur = ?
            WHERE id_utilisateur = ?
        ");
        
        $stmt->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['pseudo'],
            $user['id_utilisateur']
        ]);
        
        // Mettre à jour la session
        $stmt = $db->prepare("SELECT * FROM UTILISATEURS WHERE id_utilisateur = ?");
        $stmt->execute([$user['id_utilisateur']]);
        $_SESSION['user'] = $stmt->fetch();
        
        $success = "Profil mis à jour avec succès !";
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h2 class="card-title mb-4">Modifier mon profil</h2>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
                
                <div class="text-center mb-4">
                    <img src="<?= htmlspecialchars($user['photo_profil_utilisateur'] ?? 'img/user-icon.png') ?>" 
                         alt="Photo de profil" 
                         class="rounded-circle"
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo de profil</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                    
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" 
                               value="<?= htmlspecialchars($user['nom_utilisateur']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" 
                               value="<?= htmlspecialchars($user['prenom_utilisateur']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" 
                               value="<?= htmlspecialchars($user['pseudo_utilisateur']) ?>" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
}
.form-control {
    background-color: #333;
    border: 1px solid #444;
    color: white;
}
.form-control:focus {
    background-color: #444;
    border-color: #666;
    color: white;
}
.btn-primary {
    background-color: #e50914;
    border: none;
}
.btn-primary:hover {
    background-color: #b2070f;
}
</style> 