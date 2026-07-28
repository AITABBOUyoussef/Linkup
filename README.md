# ProfessionalConnect

## 1. Présentation du projet
ProfessionalConnect est une plateforme de réseau social professionnel conçue pour aider les utilisateurs à développer leur carrière et leur réseau. Cette application web permet aux professionnels de se connecter entre eux, de partager des actualités de leur secteur et de mettre en valeur leur profil au sein d'un environnement centralisé.

## 2. Problématique
Les professionnels et les chercheurs d'emploi ont souvent du mal à maintenir un réseau actif et à découvrir de nouvelles opportunités dans un espace ciblé. ProfessionalConnect résout ce problème en offrant un espace dédié spécifiquement aux échanges professionnels, facilitant ainsi la mise en relation et la visibilité professionnelle.

## 3. Fonctionnalités principales
*   **Créer et gérer un profil :** S'inscrire, se connecter de manière sécurisée, et mettre à jour ses informations (titre professionnel, entreprise, photo).
*   **Publier et interagir :** Créer des posts (texte et images), aimer, commenter, sauvegarder (save) et republier les contenus du réseau.
*   **Développer son réseau :** Rechercher des utilisateurs, envoyer des invitations de connexion, et gérer les demandes (accepter/refuser/ignorer).
*   **Consulter un fil d'actualité :** Visualiser un flux dynamique affichant les publications et les republications de la communauté par ordre chronologique.

## 4. Technologies utilisées
*   **Laravel 11 (PHP 8.2) :** Développer l'architecture backend (MVC), gérer les routes, et sécuriser l'authentification.
*   **Blade & Tailwind CSS :** Construire l'interface utilisateur de manière modulaire, responsive et moderne.
*   **MySQL :** Stocker, structurer et lier les données relationnelles (utilisateurs, posts, commentaires, connexions).
*   **Eloquent ORM :** Interagir avec la base de données de manière fluide et sécurisée.

## 5. Installation et lancement

**Prérequis :**
*   PHP 8.2+
*   Composer
*   Node.js et npm
*   Serveur local (ex: XAMPP, Laragon) avec MySQL

**Commandes testées (Windows / Linux / macOS) :**

1. Cloner le dépôt :
```bash
git clone [https://github.com/votre-nom/professional-connect.git](https://github.com/votre-nom/professional-connect.git)
cd professional-connect

Installer les dépendances backend :

Bash
composer install
Configurer l'environnement :

Bash
cp .env.example .env
(Configurez vos identifiants de base de données DB_DATABASE, DB_USERNAME, DB_PASSWORD dans ce fichier .env).

Générer la clé de sécurité et migrer la base de données :

Bash
php artisan key:generate
php artisan migrate
Installer et compiler les dépendances frontend :

Bash
npm install
npm run build
Lancer le serveur local :

Bash
php artisan serve
L'application est maintenant accessible sur http://localhost:8000.

6. Captures d'écran
(Note : Ajoutez ici des captures claires, avec des titres, en veillant à flouter toute information personnelle ou sensible).

Fil d'actualité (Feed) :
![Aperçu du fil d'actualité avec options de publication et interactions](./docs/feed_screenshot.png)

Gestion du réseau :
![Page de gestion des invitations et suggestions de contacts](./docs/network_screenshot.png)

7. Contribution personnelle
En tant que développeur Full-Stack sur ce projet, j'ai conçu le diagramme entité-association (ERD) et implémenté l'ensemble de la base de données relationnelle. J'ai développé les contrôleurs avec un code modulaire et structuré en orienté objet, gérant la logique des relations complexes (comme le système de connexion mutuelle entre utilisateurs). J'ai également intégré l'interface frontend interactive avec Blade et Tailwind CSS.

8. Difficultés rencontrées
Problème : Afficher un fil d'actualité (Feed) cohérent qui mélange à la fois les publications originales et les "reposts" provenant de deux tables distinctes, tout en les triant par date exacte.

Recherche : J'ai exploré la possibilité d'utiliser des requêtes SQL brutes (UNION / JOIN), mais cela rendait le code difficile à maintenir et cassait la logique de l'ORM.

Solution : J'ai utilisé les Collections d'Eloquent. J'ai récupéré séparément les posts et les reposts en chargeant leurs relations (with()). J'ai formaté chaque élément avec une propriété commune (feed_type et feed_date), puis j'ai concaténé les deux collections et je les ai triées par cette date unifiée (sortByDesc()).

Apprentissage : J'ai approfondi ma maîtrise des Collections Laravel et j'ai appris à résoudre efficacement le problème du "N+1 queries" pour optimiser les performances de l'application.

9. Améliorations possibles
Sécurité et Validation : Renforcer la validation des formulaires côté client avec des expressions régulières (Regex) en temps réel.

Notifications : Implémenter un système d'alertes en temps réel (via les Events/Websockets Laravel) lors de la réception d'une invitation ou d'un commentaire.

Fonctionnalité de messagerie : Ajouter une messagerie instantanée (Peer-to-Peer) permettant aux professionnels connectés d'échanger directement sur la plateforme.
