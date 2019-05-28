<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Modifier un pc</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include\menu.php'); ?>
	<div class="main">
<?php
		require "..\script\sqlconnect.php";
			$reponse = $bdd->query('SELECT * from pc ORDER BY sal_id, pc_nom');
			if($reponse){
			while($donnees = $reponse->fetch()){
				?>
				<ul>
					<div class="salle" onclick='window.location="modifpc.php?pc=<?php echo($donnees["pc_id"]); ?>";'>
					<li><a><?php echo($donnees['pc_nom']); ?></a></li>
					<?php
						$salle = $bdd->query('SELECT * from salle WHERE sal_id='.$donnees['sal_id']);
						$donneessalle = $salle->fetch();
					?>
					<li><a><?php echo($donneessalle['sal_nom']); ?></a></li>
					</div>
				</ul>
				<?php
			}
			}else{echo('<a>Aucun pc n\'a été trouvé</a>');}
		?>
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