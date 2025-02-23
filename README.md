Étape 1 : Cloner le dépôt GitHub

Étape 2 : Installer les dépendances (composer install / npm install)

Étape 3 : Créer la base de données (CREATE DATABASE hypo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;)

.env :
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hyp
DB_USERNAME=root
DB_PASSWORD=root

Étape 4 : Lancer les migrations (php artisan migrate)

Pour le projet : 

Se créer un compte
Se connecter
Ajouter un/des clients
Ajouter un/des poneys
Ajouter une/des réservations (besoin de clients et de poneys pour en faire)
Les factures se font automatiquement quand une réservation est faite)

Si le projet ne fonctionne pas : Voir screenshots.pdf
