## Projet symfony

# Apprentissage du framework par la pratique
 ## Les étapes que j'ai suivi
1. Modifier le fichier .env

2. Créer la bdd avec `symfony console d:d:c`

3. `symfony console make:user` pour commencer à créer un utilisiteur avant de mettre en place l'authentification
Avec `symfony console make:entity`, et en demandant User, rajouter les attributs

4. pour mettre à jour la bdd, `symfony console make:migration` et suivre les instructions.
L'ordre n'est pas important, mais il est préférable d'utiliser un système d'authentification avant l'inscription.

5. `symfony console make:auth` et donner par exemple ici le nom AppAuthenticator
Pour tester les autorisations, j'ai tracé des routes en créant DefaultController, ClientController et AdminController
J'ai rempli la BDD directement dans phpMyAdmin et pour le mdp, je l'ai hashé à partir de la console avec :
`symfony console sec:hash`

6. Les autorisations d'accès aux pages selon le rôle peuvent être gérées 
-> sur config/packages/security.yaml
    `access_control:`
        `- { path: ^/admin, roles: ROLE_ADMIN }`
        `- { path: ^/profile, roles: ROLE_USER }`

-> sur config/packages/security.yaml, sous security
    `role_hierarchy:`
        `ROLE_ADMIN: ROLE_USER `
Cela veut dire que le ROLE_ADMIN aura toutes les autorisations d'accès que le ROLE_USER

-> directement sur le controller avant le nom de la class pour une manière générale,
ou bien juste avant les méthodes, sous la route
`#[isGranted('ROLE_ADMIN')]`

-> a l'intérieur de la méthode avec :
`$this->denyAccessUnlessGranted('ROLE_ADMIN', null, "tu n'as pas accès");`

7. Réalisation du formulaire d'enregistrement avec la commande :
`symfony console make:registration-form`
