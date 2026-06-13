# GestEns — Application de gestion des enseignants

Application SPA développée avec **Vue 3 + Vite**, backend **PHP/MySQL**.
Sécurisée par authentification JWT et organisée en 3 modules fonctionnels.

---

## Stack technique

| Couche | Technologie |
|---|---|
| Frontend | Vue 3 (Composition API) + Vite |
| Routing | Vue Router 4 |
| État global | Pinia |
| Graphiques | Chart.js + vue-chartjs |
| Icônes | @tabler/icons-vue |
| Styles | CSS Variables |
| Backend | PHP 8+ (API REST) |
| Base de données | MySQL 8 |
| Auth | JWT (stocké en `localStorage`) |

---

## Installation

```bash
# 1. Cloner le projet
git clone https://github.com/votre-org/gestens.git
cd gestens/frontend

# 2. Installer les dépendances
npm install

# 3. Configurer l'environnement
cp .env.example .env
# Éditer .env : VITE_API_URL=http://localhost:8000/api

# 4. Lancer le dev
npm run dev

# 5. Build production
npm run build
```

---

## Structure du projet

```
gestens/
├── frontend/                    ← Application Vue 3
│   ├── index.html
│   ├── vite.config.js
│   ├── .env.example
│   │
│   ├── public/
│   │   └── favicon.svg
│   │
│   └── src/
│       ├── main.js              ← Point d'entrée (app + pinia + router)
│       ├── App.vue              ← Shell principal (RouterView)
│       │
│       ├── assets/
│       │   └── main.css         ← Variables CSS globales (voir style.md §8)
│       │
│       ├── router/
│       │   └── index.js         ← Routes + guards d'authentification
│       │
│       ├── stores/
│       │   ├── auth.js          ← Pinia : token JWT, user, login/logout
│       │   └── enseignants.js   ← Pinia : liste, CRUD, bilan
│       ├── layouts/
│       │   ├── AppShell.vue     ← Sidebar + TopBar + <RouterView>
│       │   └── AuthLayout.vue   ← Centré, fond page, pour la page login
│       │
│       ├── components/
│       │   ├── common/
│       │   │   ├── AppSidebar.vue    ← Navigation latérale (3 menus)
│       │   │   ├── AppTopBar.vue     ← Barre haut : titre + actions
│       │   │   ├── AppToast.vue      ← Toast succès/erreur (téléporté)
│       │   │   ├── AppModal.vue      ← Modale générique (slot)
│       │   │   └── AppPagination.vue ← Pagination tableau
│       │   │
│       │   ├── enseignant/
│       │   │   ├── EnseignantForm.vue    ← Formulaire ajout (étapes)
│       │   │   ├── EnseignantTable.vue   ← Tableau + édition inline
│       │   │   ├── EnseignantRow.vue     ← Ligne tableau (mode view/edit)
│       │   │   └── DeleteConfirm.vue     ← Modale confirmation suppression
│       │   │
│       │   └── bilan/
│       │       ├── BilanMetrics.vue  ← 3 metric cards (total/max/min)
│       │       ├── BilanChart.vue    ← Histogramme Chart.js
│       │       └── BilanPie.vue      ← Camembert Chart.js (toggle)
│       │
│       └── views/
│           ├── LoginView.vue         ← Page d'authentification
│           ├── AjoutView.vue         ← Menu 1 : formulaire d'ajout
│           ├── ListeView.vue         ← Menu 2 : tableau CRUD
│           └── BilanView.vue         ← Menu 3 : bilan + graphe
│
└── backend/                     ← API REST PHP
    ├── index.php                ← Router principal
    ├── config/
    │   └── database.php         ← PDO connexion MySQL
    ├── middleware/
    │   └── Auth.php             ← Vérification JWT
    ├── controllers/
    │   ├── AuthController.php   ← POST /login
    │   └── EnseignantController.php ← CRUD /enseignants
    ├── models/
    │   └── Enseignant.php       ← Requêtes SQL
