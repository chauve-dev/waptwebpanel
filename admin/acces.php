<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Droit</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include\menu.php'); ?>
	<div class="main">
		<?php
		require "..\script\sqlconnect.php";
		$sallei= array();
		$reponse = $bdd->query('
			SELECT * 
			from acces
			inner join salle on acces.sal_id = salle.sal_id
			where acces.uti_id = '.$_GET['uti'].'
			');
		if($reponse){
		while($donnees = $reponse->fetch()){
			array_push($sallei, $donnees['sal_nom']);
		}}
		$infouti = $bdd->query('SELECT * FROM utilisateur WHERE uti_id='.$_GET['uti']);
		$dinfouti = $infouti->fetch();
		?>


<button class="bouton" onclick="window.location='liacces.php'">Retour</button>
<h1>Accès de <?php echo($dinfouti['uti_nom'].' '.$dinfouti['uti_prenom']) ?></h1>
<div style="display: flex; width: 100%;">
<div style="width: 45%;">
	<h1>Ajouter Accès</h1>
		<?php 
		$reponse = $bdd->query('SELECT * from salle');
		if($reponse){
		while($donnees = $reponse->fetch()){
				if (!in_array($donnees['sal_nom'], $sallei)){
				 ?>
				 <div style="display: flex;" class="salle" onclick="window.location='addacces.php?uti=<?php echo($_GET['uti']) ?>&salle=<?php echo($donnees['sal_id']) ?>';">
				<?php echo('<a>'.$donnees['sal_nom'].'</a>'); ?></div>
				<?php 
		}}}
				 ?>
</div>
<div style="width: 45%;">
	<h1>Supprimer Accès</h1>
			<?php 
		$reponse = $bdd->query('SELECT * from salle');
		if($reponse){
		while($donnees = $reponse->fetch()){
				if (in_array($donnees['sal_nom'], $sallei)){
				 ?>
				 <div style="display: flex;" class="salled" onclick="window.location='remacces.php?uti=<?php echo($_GET['uti']) ?>&salle=<?php echo($donnees['sal_id']) ?>';">
				<?php echo('<a>'.$donnees['sal_nom'].'</a>'); ?></div>
				<?php 
		}}}
				 ?>
</div>
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