# EduWeb - Plateforme de Cours en Ligne

## Contexte du Projet
EduWeb est une plateforme d’apprentissage en ligne qui vise à révolutionner l’éducation en offrant un système interactif et personnalisé pour les étudiants et les enseignants. Cette application fournit des fonctionnalités adaptées à chaque rôle (Visiteur, Étudiant, Enseignant, Administrateur).

---

## Fonctionnalités

### Partie Front Office

#### Visiteur
- Accès au catalogue des cours avec pagination.
- Recherche de cours par mots-clés.
- Création d’un compte avec choix du rôle (Étudiant ou Enseignant).

#### Étudiant
- Consultation du catalogue des cours.
- Recherche et consultation des détails des cours (description, contenu, enseignant, etc.).
- Inscription aux cours après authentification.
- Accès à une section **"Mes cours"** regroupant les cours rejoints.

#### Enseignant
- Ajout de nouveaux cours avec des informations détaillées :
  - Titre, description, contenu (vidéo ou document), tags, catégorie.
- Gestion des cours :
  - Modification, suppression, consultation des inscriptions.
- Accès à une section **"Statistiques"** :
  - Nombre d’étudiants inscrits, nombre de cours créés, etc.

### Partie Back Office

#### Administrateur
- Validation des comptes enseignants.
- Gestion des utilisateurs :
  - Activation, suspension ou suppression.
- Gestion des contenus :
  - Cours, catégories, tags.
  - Insertion en masse de tags.
- Accès aux statistiques globales :
  - Nombre total de cours, répartition par catégorie.
  - Le cours avec le plus d'étudiants inscrits.
  - Les Top 3 enseignants.

---

## Fonctionnalités Transversales
- **Relation Many-to-Many** : Un cours peut contenir plusieurs tags.
- **Polymorphisme** : Utilisation dans les méthodes d’ajout et d’affichage des cours.
- **Système d’authentification et d’autorisation** :
  - Protection des routes sensibles.
  - Contrôle d’accès basé sur les rôles.
- **Validation des données utilisateur** pour assurer la sécurité.

---

## Exigences Techniques
- **Respect des principes de POO** :
  - Encapsulation, héritage, polymorphisme.
- **Base de données relationnelle** avec gestion des relations :
  - One-to-Many, Many-to-Many.
- **Utilisation des sessions PHP** pour la gestion des utilisateurs connectés.
- **Système de validation des données utilisateur**.

---

## Bonus
- Recherche avancée avec filtres (catégorie, tags, auteur).
- Statistiques avancées :
  - Taux d’engagement par cours, catégories les plus populaires.
- Notifications :
  - Validation de compte enseignant, confirmation d’inscription à un cours.
- Système de commentaires ou d’évaluations sur les cours.
- Génération de certificats PDF de complétion pour les étudiants.

---

   git clone https://github.com/votre-utilisateur/youdemy.git
