Marche à suivre : 
=======

#Lancer composer :
composer install dans le dossier

#Lancer docker : 
> docker run --name mysql -e MYSQL_ROOT_PASSWORD=root -d mysql:latest

#Alternative : 
> phpMyAdmin : modifier au besoin le fichier parameters.yml

#Créer la base de données : 
> php bin/console doctrine:database:create

#Créer la structure de la base de données :
> php bin/console doctrine:schema:update --force

#Lancer le serveur :
> php bin/console server:run

#Lancer le site :
>http://localhost:8080/home

#Liste des routes disponibles : 
	
*>/home
*>/add
*>/login
*>/logout
*>/profile/
*>/profile/edit
*>/register/
*>/register/check-email
*>/resetting/send-email
*>/resetting/check-email
*>/resetting/reset/{token}
*>/profile/change-password
*>/post/{idPost}
*>/post/like/{idPost}
*>/post/unlike/{idPost}
*>/api/post/{idPost}
*>/api/home
*>/api/post/{idPost}/addComment


*Pour lancer les tests 
> php .\phpunit
fonctionnent pas
