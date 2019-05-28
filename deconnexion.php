<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
session_destroy();
session_abort();
header("location: connexion.php");
?>