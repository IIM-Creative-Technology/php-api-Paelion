## Api du Pôle Léonard de Vinci 

Cette API permet de gérer les promotions, élèves, interveants et matières.

## Lancement de l'API : 

- Installer le projet sur votre machine
- Lancer la commande `composer Install`
- Créer la base de donnée grâce au fichier .env.local(copier/coller du fichier .env en adaptant selon les propriétés de votre BDD) et lancer la commande `php bin/console doctrine:database:create`

Une fois ces étapes faites lancez les commandes suivantes afin de créer les entitées :
- `php bin/console doctrine:migrations:diff`
- `php bin/console doctrine:migrations:migrate`
- `php bin/console doctrine:fixture:load`

Pour finir il faut mettre en place JWT : 
- `mkdir config/jwt`
- `openssl genrsa -out config/jwt/private.pem -aes256 4096` (saisir un mot de passe)
- `openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem` (saisir le même mot de passe que pécédement)
- dans votre fichier .env.local indiquez le JWT_PASSPHRASE qui est le mot de passe saisie précédement

Vous pouvez maintenant saisir la commande symfony server:start afin de lancer l'API


## Manipulation de l'API

Vous pouvez maintenant vous rendre sur l'API via l'adresse http://localhost:8000/api/doc

Pour effectuer des requêtes il vous faut nécessairement avoir un JWT, ce dernier est disponible uniquement pour les profils admin de :
- alexis.bougy@devinci.fr
- karine.mousdik@devinci.fr
- nicolas.rauber@devinci.fr
