<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=0){
?>
<html>
<head>
<title>Accueil</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="text-align: justify;">
	<?php include("include/menu.php"); ?>
	<div class="main">
		<h1>Accueil de l'application</h1>
		<p>Bienvenu sur le panel de gestion WAPT.<br>Cette application web à été conçu pour permettre la gestion d'utilisateur et de groupe d'ordinateur dans l'application <a href="https://www.tranquil.it/solutions/wapt-deploiement-d-applications/">WAPT</a>.</p>
		<h2>Utilisation</h2>
		<p>Cette application est divisée en plusieurs menus, "Mes salles" et "Mon compte". "Mon compte" permet d'avoir des information basique sur vous.<br>"Mes salles" Permet l'accès à une page affichant toutes les salles auxquelles vous avez accès. <br>Si vous choisissez une salle vous accédée à une page affichant : <br> <ul><li>- Les ordinateurs de la salle.</li><li>- Les paquet à installer dans la salle.</li></ul>L'ajout de paquet à la salle permet d'installer ou désinstaller des logiciel sur l'ensemble des ordinateurs d'une salle.<br>L'accès aux ordinateurs lui permet l'installation de manière plus spécifique et ainsi installer ou désinstaller des paquet sur l'ordinateur choisis.
</p>
	</div>
</body>
</html>
<?php
}
}
else{
	header('location: connexion.php');
}
?>
