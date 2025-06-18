# Installation Guide

Ce guide vous aidera à installer et configurer le projet sur votre machine locale.

## Prérequis

Avant de commencer, assurez-vous d’avoir installé les logiciels suivants :

- [PHP](https://www.php.net/downloads.php) (version 8.1 ou supérieure)
- [Composer](https://getcomposer.org/download/) (pour gérer les dépendances PHP)
- [MySQL](https://dev.mysql.com/downloads/installer/) (ou un autre système de gestion de base de données compatible)
- [Symfony CLI](https://symfony.com/download) (facultatif mais recommandé pour le développement Symfony)

## Installation

### Étape 1 : Cloner le projet

Clonez le dépôt du projet sur votre machine locale avec Git :

```bash
git clone https://github.com/votre-utilisateur/votre-projet.git
cd votre-projet
```

### Étape 2 : Installer les dépendances PHP

Utilisez Composer pour installer les dépendances du projet :

```bash
composer install
```

### Étape 3 : Configurer l’environnement

Copiez le fichier `.env` en `.env.local` :

```bash
cp .env .env.local
```

Modifiez ensuite le fichier `.env.local` pour y configurer vos informations de connexion à la base de données :

```dotenv
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
WEATHERAPI_KEY="votre_clé_api"
```

### Étape 4 : Créer la base de données

Créez la base de données et appliquez les migrations :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### Étape 5 : Charger les fixtures (facultatif)

Si vous disposez de fixtures pour insérer des données de test :

```bash
php bin/console doctrine:fixtures:load
```

### Étape 6 : Lancer le serveur de développement

Avec la CLI Symfony :

```bash
symfony serve
```

Ou avec le serveur de développement intégré de PHP :

```bash
php -S localhost:8000 -t public/
```

### Étape 7 : Accéder à l’application

Ouvrez votre navigateur et accédez à :

```text
http://localhost:8000
```

## Dépendances

Voici un exemple de fichier `composer.json` typique pour un projet Symfony :

```json
{
  "name": "votre-utilisateur/votre-projet",
  "type": "project",
  "require": {
    "php": "^8.1",
    "ext-ctype": "*",
    "ext-iconv": "*",
    "composer/package-versions-deprecated": "^1.11",
    "doctrine/doctrine-bundle": "^2.7",
    "doctrine/doctrine-migrations-bundle": "^3.2",
    "doctrine/orm": "^2.13",
    "symfony/asset": "6.3.*",
    "symfony/console": "6.3.*",
    "symfony/dotenv": "6.3.*",
    "symfony/expression-language": "6.3.*",
    "symfony/flex": "^2",
    "symfony/framework-bundle": "6.3.*",
    "symfony/http-client": "6.3.*",
    "symfony/monolog-bundle": "^3.8",
    "symfony/runtime": "6.3.*",
    "symfony/security-bundle": "6.3.*",
    "symfony/serializer": "6.3.*",
    "symfony/twig-bundle": "6.3.*",
    "symfony/validator": "6.3.*",
    "symfony/webpack-encore-bundle": "^1.16",
    "symfony/yaml": "6.3.*"
  },
  "require-dev": {
    "doctrine/doctrine-fixtures-bundle": "^3.4",
    "symfony/debug-bundle": "6.3.*",
    "symfony/maker-bundle": "^1.47",
    "symfony/stopwatch": "6.3.*",
    "symfony/web-profiler-bundle": "6.3.*"
  }
}
```

N'oubliez pas d’ajuster ce fichier selon les besoins spécifiques de votre projet.
