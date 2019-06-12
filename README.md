# wapt web panel
Le panel web WAPT permet la gestion de gérer plusieurs utilisateurs ainsi que des groupes de pc (salles)
L'application est actuellement en Alpha et est sujette à diverse modification et amélioration.
ce mode de fonctionnement peut s'avérer intéressant pour des collèges ou des lycées qui n'ont pas de besoin de sécurité élevée.

En effet le modèle de sécurité WAPT est basé sur la cryptographie asymétrique, avec la clef privée protégée par mot de passe et stockée sur le poste de l'admin ou sur un token externe. Dans le code, la clef ainsi que son mot de passe sont stockés directement en clair sur le serveur. Il faut prendre en compte que l'accès à la clef de signature code signing déchiffrée est globalement la même chose qu'avoir les droits admin local sur tous les postes.


Pour l'installer il faut :
  1. accèder à la bdd du serveur wapt et ajouter un utilisateur attention l'utilisateur doit avoir les droits sur la db 'wapt'
  2. installer la bdd sur le serveur (script dans /script/sql)
  3. modifier les fichiers /script/apiconnect.php et /script/sqlconnect.php pour y apporter les modification nécessaire au fonctionnement sur votre serveur
  4. installer le site sur un serveur web ayant PHP configurer pour utiliser postgres
  5. le script python dans /script/python doit être modifié pour y ajouter le lien vers la clé et ces infos et ensuite déplacé dans /opt/wapt/
  6. Le cron doit être configuré pour executer et vider un script.sh créer par le php :
      Exemple : dans /etc/cron.d/01wapt :
          
          */10 * * * * wapt /var/www/html/script.sh; echo '' > /var/www/html/script.sh
          
          le contenu de script.sh étant générer automatiquement par le php lors de modification

 
voici le lien vers le thread expliquant comment executer script python.
https://forum.tranquil.it/viewtopic.php?f=13&t=1834





*Le fichier note est inutile il contient des lien vers l'api pour aider au développement
*Il est possible que le selinux empêche l'écriture du php

Pour la connexion :
User admin
Mdp waptpanel

- JEANTET Joey
Dernière mise a jour : 28/05/2019
