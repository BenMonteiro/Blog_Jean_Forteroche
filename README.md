# Blog_Jean_Forteroche
Blog de l'écrivain Jean Forteroche présentant les chapitres de son dernier livre à paraitre.

## Description du blog
Le blog est constitué d'un coté client accessible à tous et d'un coté administrateur accessible uniquemet aux utilisateurs enregistrés en base de données et protégé par un mot de passe propre à chaque administrateur.

La partie client du blog est constituée :
- d'une page d'acceuil présentant les derniers articles
- d'une page pour chaque article comportant un espace commentaires (ceux-ci pouvant être signalés par les visiteurs)
- d'une page présentant l'auteur
- d'une page contenant un formulaire de contact

La partie administration quant à elle est constitué: 
- d'une page d'acceuil informant sur les commentaires en attente de modération ainsi que sur le dernier article publié
- d'une page de gestion des articles ou l'administrateur peut ajouter, supprimer ou mettre à jour un article
- d'une page de modération des commentaires ou l'administrateur peut validé le commentaire ou le supprimer (les commentaires signalés apparaissent en premier dans la liste)

Le site integre l'affichage de message en fonction des action de l'utilisateur (suppression, ajout... d'articles ou de commentaires).
Le site est totalement responsive.

## Installation
Afin de faire fonctionner le projet, il faut au préalable:
1) Installer composer afin de faire fonctionner twig
2)Avoir un vhost avec blog comme nom d'hôte
3)Renseigner les données de connexions de votre bdd dans le fichier PDOConnection.php
4)Créer un nouvel utilisateur en bdd afin de se connecter à l'espace administration ou utiliser les logs JFadmin pour l'identifiant et JFpass pour le mot de passe

## Fonctionnement 
Le projet a été dévoloppé en PHP et MySQL. Une architecture MVC a été mise en place et le site a été réalisé en programmation orienté objet.

Le fonctionnement du site est le suivant : 
1) Un fichier index.php se charge de démarrer la session, d'instancier le routeur et d'appeler la methode dispatch
2) Le routeur récupère les informations de l'url via la classe request (Noms du controller et de la methode)
3) La méthode dispatch vérifie si le controller et la methode à appeler existe bien. Si c'est le cas, on instancie le controller et on appele la méthode. Sinon, on est redirigé sur une page 404.
4) La methode appelée récupere les informations dont elle a besoin auprès de la classe request via les methodes GET ou POST
   <ol>
    <li>Et auprès des managers si elle doit récupérés des informations stockées en base de données</li>
    <li>Le manager va envoyer une requête à la base de données pour récupérer les données voulues</li></ol>
5) Une fois toutes les données récupérées, la méthode va charger,via twig, un template enfant qui va étendre un template parent. Le tout forme la vue que l'on retrouvera à l'écran

### Connexion à l'espace administrateur
L'accès à la page de connexion de l'espace administrateur se fait via l'url (en remplacant le premier composant de l'url par login, ainsi si vous avez un vhost "blog" il suffit de taper blog/login).
Il est nécéssaire de créer son compte administrateur dans la base de donnée et de crypter le mot de passe en md5. 

### Ajout/Mise à jour d'un article
La rédaction et la mise à jour d'un article se fait via un formulaire. Le champ de rédaction du texte intègre tinyMCE pour une écriture plus simple des textes.

### Suppression d'un article
A la suppression d'un article, une fenêtre de confirmation s'ouvre afin de renforcer la sécurité 

### Commentaires
Si un commentaire est signalé par un visiteurs, il n'est plus visible dans la liste de commentaires avant qu'ils ait été modéré. Les commentaires ne peuvent être signalés, ou modérés qu'une fois.
