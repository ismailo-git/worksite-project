# Worksite-Project
 ## Version
  - Symfony 4.4
 ## Front
  - Bootstrap 4 ( Bootswatch Flaty template)
 ## Installation
 
  1. Clonez le dépot dans un dossier de votre choix 
  2. Installez les dépendances : `composer install`
  3. Créer une base de données : `symfony console doctrine:database:create` si elle n'existe pas. sinon configurer le fichier .env
  4. Faites les migrations: `symfony console make:migration` 
  5. Tapez : `YES`
  6. puis faites `symfony console doctrine:migrations:migrate`
  7. Tapez : `Yes`
  8. Vous aurez un message d'erreur comme quoi la table **Chantier** existe**
  9. Pour résoudre ce probleme, supprimer la derniere fichier de migration dans le dossier **migrations**
  10. Refaites `symfony console doctrine:migrations:migrate`
  11. Remplissez avec des fausses données (fixtures) : `symfony console doctrine:fixtures:load --no-interaction`
  12. Lancez le serveur : `symfony serve -d` ou `php -S localhost:3000 -t public`
  13. Enjoy it !
  
