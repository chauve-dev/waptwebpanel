# wapt web panel
Le panel web WAPT permet la gestion de gérer plusieurs utilisateurs ainsi que des groupes de pc (salles)
L'application est actuellement en Alpha et est sujette à diverse modification et amélioration.

Pour l'installer il faut :
  1. accèder à la bdd du wapt et ajouter un utilisateur
  2. installer la bdd sur le serveur (script dans /script/sql)
  3. modifier les fichiers /script/apiconnect.php et /script/sqlconnect.php pour y apporter les modification nécessaire au fonctionnement sur votre serveur
  4. installer le site sur un serveur web ayant PHP configurer pour utiliser postgres

l'ajout de paquet ne sera pas fonctionnel directement, le site ayant été développer sous windows il ne pointe pas au bon endroit.
Dans pc.php et listepc.php il faut modifier le code : 
 -pc.php : L119 La variable $macommande correspond à un système windows
 -listepc.php : L51 idem
voici le lien vers le thread expliquant le fonctionnement du script python.
https://forum.tranquil.it/viewtopic.php?f=13&t=1834
