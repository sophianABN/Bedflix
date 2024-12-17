<?php
namespace App\Models;

use Core\Model;
use PDO;

class UserModel extends Model {
    public function findByEmail($email) {
        $stmt = $this->db->prepare("
            SELECT * FROM UTILISATEURS 
            WHERE email_utilisateur = ?
        ");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create($userData) {
        $stmt = $this->db->prepare("
            INSERT INTO UTILISATEURS (
                nom_utilisateur, 
                prenom_utilisateur, 
                email_utilisateur,
                pseudo_utilisateur, 
                mot_de_passe_utilisateur, 
                photo_profil_utilisateur,
                id_role
            ) VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $userData['nom'],
            $userData['prenom'],
            $userData['email'],
            $userData['pseudo'],
            $userData['password'],
            $userData['photo'],
            2 // Role utilisateur par défaut
        ]);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM UTILISATEURS 
            WHERE id_utilisateur = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($userData) {
        $query = "UPDATE UTILISATEURS SET 
            nom_utilisateur = ?,
            prenom_utilisateur = ?,
            pseudo_utilisateur = ?";
        
        $params = [
            $userData['nom'],
            $userData['prenom'],
            $userData['pseudo']
        ];

        if (isset($userData['photo'])) {
            $query .= ", photo_profil_utilisateur = ?";
            $params[] = $userData['photo'];
        }

        $query .= " WHERE id_utilisateur = ?";
        $params[] = $userData['id'];

        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }
} 