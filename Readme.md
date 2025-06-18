# Projet API de Recommandation de Produits selon la Météo

## Description

Ce projet est une application web composée d'une API backend Symfony et d'un frontend React.  
L'application propose des recommandations de produits vestimentaires en fonction de la météo d'une ville choisie et d'une date sélectionnée.

---

## Fonctionnalités

- Récupération de la liste des produits via l'endpoint `/api/products`.
- Recommandation de produits adaptés à la météo (froid, doux, chaud) via l'endpoint `/api/recommendations`.
- Interface utilisateur React avec sélection de la ville et de la date.
- Affichage des produits recommandés sous forme de cartes.

---

## Backend (Symfony)

### Endpoints

- **GET /api/products**  
  Retourne la liste de tous les produits disponibles.

- **POST /api/recommendations**  
  Prend en entrée un JSON avec la ville et la date, interroge l'API météo, puis recommande des produits adaptés.  
  Exemple de payload :
  ```json
  {
    "weather": {
      "city": "Paris"
    },
    "date": "2025-06-18"
  }
  ```
