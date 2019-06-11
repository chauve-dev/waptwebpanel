<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Créer une salle</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include/menu.php'); ?>
	<div class="main">
<?php
	if(sizeof($_POST)>0){
		require "../script/sqlconnect.php";
		$nom=strtolower($_POST['nom']);
		$reponse = $bdd->query("SELECT * from salle WHERE sal_nom='".$nom."'");
			$res = $reponse -> fetch();
			if($res){
				echo('<a>Cette salle existe déjà</a>');
			}else{
		$req = $bdd->prepare("INSERT INTO salle (sal_nom, sal_desc) VALUES (:nom, :descr)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':descr', $_POST['description']);
		$req -> execute();
	}
	}
?>
<div class="whitebox">
		<form method="POST">
			<label for="nom">Nom de la salle </label>
			<input id="nom" type="text" name="nom">
			<label for="description">Description de la salle </label>
			<input id="description" type="text" name="description">
			<input type="submit" name="submit" value="Valider">
		</form>
</div>


	</div>
</body>
</html>
<?php
}
else{
	header('location: ../index.php');
}
}
else{
	header('location: ../connexion.php');
}
?>