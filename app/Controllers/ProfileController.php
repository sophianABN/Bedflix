<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\UserModel;
use Exception;

class ProfileController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function edit() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        return $this->view('profile/edit', ['user' => $_SESSION['user']]);
    }

    public function update() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }

        try {
            $userId = $_SESSION['user']['id_utilisateur'];
            $userData = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'pseudo' => $_POST['pseudo'],
                'id' => $userId
            ];

            // Gestion de l'upload photo
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
                $userData['photo'] = $this->handlePhotoUpload($_FILES['photo']);
            }

            $this->userModel->update($userData);
            $_SESSION['user'] = $this->userModel->findById($userId);
            
            return $this->view('profile/edit', [
                'user' => $_SESSION['user'],
                'success' => 'Profil mis à jour avec succès!'
            ]);

        } catch (Exception $e) {
            return $this->view('profile/edit', [
                'user' => $_SESSION['user'],
                'error' => $e->getMessage()
            ]);
        }
    }

    private function handlePhotoUpload($file) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $file['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (!in_array(strtolower($filetype), $allowed)) {
            throw new Exception('Format de fichier non autorisé');
        }
        
        $newname = uniqid() . '.' . $filetype;
        $upload_dir = __DIR__ . '/../../public/img/profiles/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        if (!move_uploaded_file($file['tmp_name'], $upload_dir . $newname)) {
            throw new Exception('Erreur lors de l\'upload');
        }
        
        return 'img/profiles/' . $newname;
    }
}