<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Liste des salles</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include\menu.php'); ?>
	<div class="main">
<?php
	require "..\script\sqlconnect.php";
	$reponse = $bdd->query('SELECT * from pc WHERE pc_id='.$_GET['pc']);
	$donnees = $reponse->fetch();
	if(sizeof($_POST)>0){
		$nom=strtolower($_POST['nom']);
		$reponse = $bdd->query("SELECT * from pc WHERE pc_nom='".$nom."'");
			$res = $reponse -> fetch();
			if($res){
				echo('<a>Ce nom est déjà pris</a>');
			}else{

		$req = $bdd->prepare("UPDATE pc SET pc_nom=:nom, sal_id=:id WHERE pc_id=".$_GET['pc']);
		$req->bindParam(':nom', $nom);
		$req->bindParam(':id', $_POST['id']);
		$req -> execute();
		header('Location: limodifpc.php');
	}}
?>
<div class="whitebox">
		<form method="POST">
			<label for="nom">Nom du pc</label>
			<input id="nom" type="text" name="nom" value="<?php echo($donnees['pc_nom']); ?>">
			<label for="id">Salle</label>
			 <select id="id" name="id">
			 	<?php
				$reponse = $bdd->query('SELECT * from salle ORDER BY sal_nom');
				if($reponse){
				while($donnees = $reponse->fetch()){
			 	?>
				  <option value="<?php echo($donnees['sal_id']); ?>"><?php echo($donnees['sal_nom']); ?></option>
				<?php
				}
				}
				?>
			</select>
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