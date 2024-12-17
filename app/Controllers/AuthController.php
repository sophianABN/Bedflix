<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\UserModel;
use Exception;

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            try {
                $user = $this->userModel->findByEmail($email);
                
                if ($user && password_verify($password, $user['mot_de_passe_utilisateur'])) {
                    $_SESSION['user'] = $user;
                    $this->redirect('/');
                }
                
                throw new Exception("Email ou mot de passe incorrect");
            } catch (Exception $e) {
                return $this->view('auth/login', ['error' => $e->getMessage()]);
            }
        }

        return $this->view('auth/login');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userData = [
                    'nom' => $_POST['nom'] ?? '',
                    'prenom' => $_POST['prenom'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'pseudo' => $_POST['pseudo'] ?? '',
                    'password' => password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT),
                    'photo' => 'img/user-icon.png'
                ];

                if ($this->userModel->create($userData)) {
                    $this->redirect('/login?success=1');
                }
                
                throw new Exception("Erreur lors de l'inscription");
            } catch (Exception $e) {
                return $this->view('auth/register', ['error' => $e->getMessage()]);
            }
        }

        return $this->view('auth/register');
    }

    public function logout() {
        session_destroy();
        $this->redirect('/');
    }
} 