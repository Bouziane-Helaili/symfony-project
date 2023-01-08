# Apprentissage du framework Symfony par la pratique


 ## Création de la BDD, l'authentification et formulaire d'enregistrement
1. Modifier le fichier .env

2. Créer la bdd avec `symfony console d:d:c`

3. `symfony console make:user` pour commencer à créer un utilisiteur avant de mettre en place l'authentification
Avec `symfony console make:entity`, et en demandant User, rajouter les attributs

4. pour mettre à jour la bdd, `symfony console make:migration` et suivre les instructions.
L'ordre n'est pas important, mais il est préférable d'utiliser un système d'authentification avant l'inscription.

5. `symfony console make:auth` et donner par exemple ici le nom AppAuthenticator.
Pour tester les autorisations, j'ai tracé des routes en créant DefaultController, ClientController et AdminController
J'ai rempli la BDD directement dans phpMyAdmin et pour le mdp, je l'ai hashé à partir de la console avec :
`symfony console sec:hash`

6. Les autorisations d'accès aux pages selon le rôle peuvent être gérées:

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

## BOOTSTRAP
1. Installation de Bootstrap avec sass
Dans le fichier config/packages/twig.yaml, sous twig:
Il faut rajouter
    `form_themes: ['bootstrap_5_layout.html.twig']`

2. Par le terminal, j'installe le composant webpack-encore-bundle. je lui demande de charger les modules js qu'il va utliser et de me générer le fichier qui sera chargé dans mon application
    `composer require symfony/webpack-encore-bundle` pour le dossier de base, puis `npm i -f`, puis `npm i bootstrap -D`

3. Je renomme css par scss le fichier assets/styles/app.css j'importe bootstrap à l'intérieur avec :
`@import "~bootstrap/scss/bootstrap";`

4. je corrige le nom aussi dans fichier assets/app.css qui l'importe et je lance `npm run dev`

5. Dans le fichier webpack.config.js, je décommente  `//.enableSassLoader()` et je suis ce qui met indiqué dans le terminal,
mettre la commande `npm install sass-loader@^13.0.0 sass --save-dev` et relancer `npm run dev`

## Création entity Product et CRUD
1. `symfony console m:entity`
2. `symfony console m:crud`
Si problème de migration
1. Supprimer le fichier dans dossier migrations
2. Effacer base de donner et refaire à partir de zéro
Sinon
1. Forcer la mise à jour de la BDD avec `php bin/console doctrine:schema:update --f`


