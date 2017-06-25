Marche à suivre : 
=======

Lancer docker : 
> docker run --name mysql -e MYSQL_ROOT_PASSWORD=root -d mysql:latest

Créer la base de données : 
> php bin/console doctrine:database:create

Créer la structure de la base de données :
> php bin/console doctrine:schema:update --force

Lancer le serveur :
> php bin/console server:run

Lancer le site :
>http://localhost:8080/home

Liste des routes disponibles : 
	


>home                                                  GET|POST   ANY      ANY    /home
add                                                           ANY        ANY      ANY    /add
fos_user_security_login                        GET|POST   ANY      ANY    /login
fos_user_security_logout                      GET|POST   ANY      ANY    /logout
fos_user_profile_show                               GET        ANY      ANY    /profile/
fos_user_profile_edit                             GET|POST   ANY      ANY    /profile/edit
fos_user_registration_register               GET|POST   ANY      ANY    /register/
fos_user_registration_check_email            GET        ANY      ANY    /register/check-email
fos_user_resetting_send_email                POST       ANY      ANY    /resetting/send-email
fos_user_resetting_check_email                GET        ANY      ANY    /resetting/check-email
fos_user_resetting_reset                       GET|POST   ANY      ANY    /resetting/reset/{token}
fos_user_change_password                  GET|POST   ANY      ANY    /profile/change-password
onePost                                                    ANY        ANY      ANY    /post/{idPost}
post_like                                                  ANY        ANY      ANY    /post/like/{idPost}
post_unlike                                              ANY        ANY      ANY    /post/unlike/{idPost}
getPostApi                                               GET        ANY      ANY    /api/post/{idPost}
getAllPostApi                                           GET        ANY      ANY    /api/home
addCommentApi                                    POST        ANY      ANY    /api/post/{idPost}/addComment