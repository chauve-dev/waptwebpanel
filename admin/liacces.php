<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Liste des utilisateurs</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include/menu.php'); ?>
	<div class="main">
<?php
		require "../script/sqlconnect.php";
			$reponse = $bdd->query('SELECT * from utilisateur');
			if($reponse){
			while($donnees = $reponse->fetch()){
				?>
				<ul>
					<div id="uti<?php echo($donnees['uti_id']); ?>" class="salle" onmouseover="document.getElementById('uti<?php echo($donnees['uti_id']); ?>').getElementsByTagName('div')[1].style.display = 'block';" onmouseleave="document.getElementById('uti<?php echo($donnees['uti_id']); ?>').getElementsByTagName('div')[1].style.display = 'none';" onclick="window.location='acces.php?uti=<?php echo($donnees['uti_id']) ?>';" style="height: ">
					<div>
					<li><a><?php echo($donnees['uti_nom']); ?></a></li>
					<li><a><?php echo($donnees['uti_prenom']); ?></a></li>
					</div>
					<div style="display: none;">
					<?php
					$acces = $bdd->query('SELECT * from acces inner join salle on acces.sal_id = salle.sal_id WHERE uti_id='.$donnees['uti_id']);
					if($acces){
					while($donneesacces = $acces->fetch()){
						echo('<li>'.$donneesacces['sal_nom'].'</li>');
					}
					}
					?>
					</div>
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
else{
	header('location: ../index.php');
}
}
else{
	header('location: ../connexion.php');
}
?>