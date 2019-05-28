<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=0){
?>
<html>
<head>
<title>Mes Salles</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include("include\menu.php"); ?>
	<div class="main">
		<h1>Liste des salles disponibles pour <?php echo($_SESSION['uti_nom']);echo(" ".$_SESSION['uti_prenom']); ?></h1>
		<?php
		require "script\sqlconnect.php";
			$reponse = $bdd->query('SELECT acces.sal_id, salle.sal_nom, salle.sal_desc from acces inner join salle on acces.sal_id = salle.sal_id where uti_id=\''.$_SESSION['uti_id'].'\' ORDER BY sal_nom');
			if($reponse){
			while($donnees = $reponse->fetch()){
				?>
				<ul>
					<div class="salle" onclick='window.location="listepc.php?salle=<?php echo($donnees["sal_id"]); ?>";'>
					<li><?php echo($donnees['sal_nom']); ?></li>
					<li><?php echo($donnees['sal_desc']); ?></li>
					</div>
				</ul>
				<?php
			}
			}else{echo('<a>Aucune salle n\'a été trouvé</a>');}
		?>
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