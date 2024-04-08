# Registre de Stack Technique - Projet T.P. Symfony / Doctrine / Twig

## Résumé

Ce registre contient les étapes et les informations clés concernant le développement du projet T.P. utilisant Symfony, Doctrine et Twig.

---

## Versions des stack utilisées :

- PHP Version 8.3.0
- Composer Version 2.7.2
- Symfony CLI Version 5.8.14
- Twig Version 3.8.0
- Doctrine Version 3.1.1
- NodeJS Version 20.10.0

---

## Prérequis

- PHP 8 ou version ultérieure
- Composer (instructions: https://getcomposer.org/download/)
- Symfony-CLI (instructions: https://symfony.com/download)
- Node.js pour le TP 4

---

## TP 1: Démarrer un projet avec Symfony

### Étapes:

1. Créer un répertoire symfony_projects/
2. Créer le projet "mon-projet-symfony":

```bash
symfony new mon-projet-syfony --webapp
```

3. Installer symfony/runtime (si clonage d'un dépôt GitHub):

```bash
composer require symfony/runtime
```

4. Démarrer le serveur Symfony:

```bash
cd symfony_projects/mon-projet-symfony/
Symfony server:start -d
```

5. Ouvrir le projet sous VSCode:

```bash
code .
```

6. Arrêter le serveur symfony:

```bash
Symfony server:stop
```

### Création d'un premier contrôleur:

- Créer le contrôleur "homeController":

```bash
symfony console make:controller homeController
```

- Modifier le fichier HomeController.php pour router l'adresse principale vers HomeController et personnaliser la vue.

### Arborescence du site:

- mon-projet-symfony/src/Controller/HomeController.php
- projet-symfony/templates/base.html.twig
- projet-symfony/templates/default/index.html.twig

---

## TP 2: L’ORM Doctrine

### Configuration et création de la BDD:

- Modifier le fichier .env pour configurer MySQL.
- Créer la BDD:

```bash
symfony console doctrine:database:create
```

### Création du schéma de base:

- Créer une nouvelle entité "UserService" avec les propriétés "nom" et "age".
- Faire la migration vers la BDD:

```bash
symfony console make:migration
symfony console doctrine:migrations:migrate
```

---

## TP 3: Routes

- Créer un nouveau contrôleur "Service" sans template.
- Modifier le contrôleur ServiceController pour insérer, rechercher et modifier des utilisateurs dans la table user_service.

---

## TP 4: L’authentification

### Formulaire d’authentification:

- Créer le projet "auth-symfony":

```bash
symfony new auth-syfony --webapp
```

- Paramétrer la base de données et créer la BDD.
- Installer les bundles et créer les contrôleurs.
- Protéger la page "secretPage" et enregistrer un nouvel utilisateur.

---

## TP 5: Le bundle API Plateform

### Créer un projet Symfony avec API Plateform:

- Créer le projet "api_plateform":

```bash
symfony new api_plateform --webapp
```

- Ajouter API Plateform au projet:

```bash
composer require api
```

- Créer les entités "Team" et "Position" avec leurs relations.

---

## TP 6: Appli Symfony / Twig

- Enrichir le schéma de BD pour intégrer de nouvelles données.
- Développer une application Symfony / Twig affichant l'organigramme de la structure.
