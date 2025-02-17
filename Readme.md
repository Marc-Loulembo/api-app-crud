# Projet Fullstack CRUD

## Auteur
Loulembo Marc

## Description
Ce projet est une application de liste de courses divisée en deux parties : le front-end et le back-end. Le back-end est développé en PHP et se trouve dans le répertoire `www` de Wamp64. Le front-end est développé en React.

## Structure du projet
- **Back-end** : PHP
    - `index.php`
    - `model/Item.php`
    - `controller/ItemController.php`
    - `config/database.php`
- **Front-end** : React
    - `index.js`
    - `ItemsContext.js`
    - `pages/Home.js`
    - `pages/CreateItem.js`
    - `pages/ItemsList.js`
    - `pages/UpdateItem.js`

## Installation

### Cloner le dépôt
```bash
git clone https://github.com/Marc-Loulembo/api-app-crud.git
```

### Back-end
1. Copier les fichiers PHP dans le répertoire `www` de Wamp64.
2. Créer une base de données MySQL nommée `listes_courses`.
3. Importer le fichier SQL pour créer la table `items`.

### Front-end
1. Naviguer dans le répertoire du front-end.
2. Installer les dépendances :
```bash
npm install
```
3. Lancer l'application :
```bash
npm start
```

## Utilisation
- Accéder à l'application via `http://localhost`.
- Utiliser le menu pour naviguer entre les fonctionnalités CRUD (Créer, Lire, Mettre à jour, Supprimer).

## API Endpoints
- `GET /api/items` : Récupérer la liste des items.
- `GET /api/items/{id}` : Récupérer un item par son ID.
- `POST /api/items` : Créer un nouvel item.
- `PUT /api/items/{id}` : Mettre à jour un item par son ID.
- `DELETE /api/items/{id}` : Supprimer un item par son ID.

