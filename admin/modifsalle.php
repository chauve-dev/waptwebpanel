<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Modifier Salle</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include\menu.php'); ?>
	<div class="main">
<?php
	require "..\script\sqlconnect.php";
	$reponse = $bdd->query('SELECT * from salle WHERE sal_id='.$_GET['salle']);
	$donnees = $reponse->fetch();

	if(sizeof($_POST)>0){
		$nom=strtolower($_POST['nom']);
		$reponse = $bdd->query("SELECT * from salle WHERE sal_nom='".$nom."'");
			$res = $reponse -> fetch();
			if($res){
				echo('<a>Cette salle existe déjà</a>');
			}else{
		$req = $bdd->prepare("UPDATE salle SET sal_nom=:nom, sal_desc=:descr WHERE sal_id=".$_GET['salle']);
		$req->bindParam(':nom', $nom);
		$req->bindParam(':descr', $_POST['description']);
		$req -> execute();
		header('Location: limodifsalle.php');
	}}
?>
<div class="whitebox">
		<form method="POST">
			<label for="nom">Nom de la salle </label>
			<input id="nom" type="text" name="nom" value="<?php echo($donnees['sal_nom']); ?>">
			<label for="description">Description de la salle </label>
			<input id="description" type="text" name="description" value="<?php echo($donnees['sal_desc']); ?>">
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