# Bedflix 🎬

Une application de streaming vidéo inspirée de Netflix, développée avec PHP et MySQL.

## 📋 Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Composer
- Extension PDO PHP pour MySQL

## 🚀 Installation

1. Clonez le repository
```bash
git clone https://github.com/sophianABN/Bedflix.git
cd Bedflix
```

2. Installez les dépendances
```bash
composer install
```

3. Configurez la base de données
- Copiez le fichier `.env.example` en `.env`
```bash
cp .env.example .env
```
- Modifiez les variables dans `.env` avec vos informations de connexion

4. Importez la base de données
```bash
mysql -u votre_utilisateur -p < db/bedflix.sql
```

## 🛠️ Structure du Projet

```
bedflix/
├── config/         # Configuration (BDD, etc.)
├── db/            # Fichiers SQL
├── public/        # Point d'entrée de l'application
├── src/           # Code source
└── vendor/        # Dépendances
```

## 🔑 Variables d'Environnement

Créez un fichier `.env` à la racine du projet avec les variables suivantes :

```env
DB_HOST=localhost
DB_NAME=Bedflix
DB_USER=your_username
DB_PASS=your_password
```

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou un pull request.
