#  Weather Recommendation App

Une application complète qui recommande des produits en fonction de la météo d’une ville et d’une date choisie.
![Aperçu de l'application](https://github.com/AmiineHAMMOUTENE/Weather-recommendations-API/blob/main/frontend/public/Screenshot%202025-06-18%20154908.png?raw=true)

---

##  Fonctionnalités

- Saisie de la ville et de la date
- Appel à une API météo
- Recommandation de produits basée sur les conditions météo
- Interface moderne en React (Vite + TailwindCSS)
- Backend robuste en Symfony (API REST)
- Architecture découplée frontend / backend
- Tests unitaires avec PHPUnit

---

##  Technologies utilisées

### Backend (Symfony)

- PHP 8.1+
- Symfony 6.3
- Doctrine ORM
- API REST avec contrôleurs dédiés
- WeatherAPI (clé API)
- Migrations & Fixtures
- **Tests unitaires avec PHPUnit**

### Frontend (React + Vite)

- React 18
- Vite
- TailwindCSS
- Shadcn UI
- Date-fns
- Composants réutilisables : calendrier, cards, formulaire

---

##  Installation

###  Prérequis

- PHP 8.1+
- Composer
- MySQL ou MariaDB
- Node.js 18+ et npm
- Symfony CLI (recommandé)

---

### 1. Cloner le projet

```bash
git clone https://github.com/votre-utilisateur/votre-projet.git
cd votre-projet
```

---

### 2. Installation du backend Symfony

```bash
cd backend
composer install
cp .env .env.local
```

Modifiez `.env.local` pour ajouter vos infos :

```env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
WEATHERAPI_KEY="votre_clé_api"
```

Créez la base et exécutez les migrations :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

Lancez le serveur Symfony :

```bash
symfony serve
```

####  Lancer les tests

```bash
php bin/phpunit
```

---

### 3. Installation du frontend React

```bash
cd frontend
npm install
npm run dev
```

Accédez à : `http://localhost:5173`

>  Le frontend appelle l’API sur `http://localhost:8000`. Pensez à gérer le CORS si nécessaire dans Symfony.


---

##  Auteur

**Amine Hammoutene**  
🔗 [GitHub](https://github.com/AmiineHAMMOUTENE)
