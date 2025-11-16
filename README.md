# 🧩 Petit MVC PHP

Ce projet est une **mini architecture MVC (Modèle - Vue - Contrôleur)** développée en **PHP pur**, sans framework.  
Il a pour but de mieux comprendre la structure et le fonctionnement d’un modèle MVC, en séparant la **logique**, les **données** et l’**affichage**.

---

## 📁 Structure du projet

```text

│   .htaccess               # Réécriture d’URL pour un routage propre
│   index.php               # Point d’entrée principal du site
│   README.md
│
├───app
│       Controller.php      # Classe abstraite de base pour les contrôleurs
│       Model.php           # Classe abstraite de base pour les modèles
│
├───controllers
│       MainController.php  # Contrôleur de l'accueil (hérite de Controller)
│
├───public
│       (CSS, JS, images, etc.)
│
└───views
        default.php         # Vue par défaut (layout général)
        |
        ├───Main
        |        index.php  # Vue associée à MainController
        
        
```

---

## ⚙️ Lancer le projet

Depuis la racine du projet, lance le serveur PHP intégré :

```bash
php -S localhost:8000
