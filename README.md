## Projet symfony

# Apprentissage du framework par la pratique
 ## Les étapes que j'ai suivi
1. Modifier le fichier .env
2. Créer la bdd avec `symfony console d:d:c`
3. `symfony console make:user` pour commencer à créer un utilisiteur avant de mettre en place l'authentification
Avec `symfony console make:entity`, et en demandant User, rajouter les attributs
4. pour mettre à jour la bdd, `symfony console make:migration` et suivre les instructions

L'ordre n'est pas important, mais il est préférable d'utiliser un système d'authentification avant l'inscription
5. `symfony console make:auth` et donner par exemple ici le nom AppAuthenticator
Pour tester les autorisations, j'ai tracé des routes en créant DefaultController, ClientController et AdminController
J'ai rempli la BDD directement dans phpMyAdmin et pour le mdp, je l'ai hashé à partir de la console avec :
`symfony console sec:hash`
6. Les autorisations d'accès aux pages selon le rôle peuvent être gérées 
-> sur config/packages/security.yaml
