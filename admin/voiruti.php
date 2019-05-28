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
<?php include('include\menu.php'); ?>
	<div class="main">
<?php
		require "..\script\sqlconnect.php";
			$reponse = $bdd->query('SELECT * from utilisateur');
			if($reponse){
			while($donnees = $reponse->fetch()){
				?>
				<ul>
					<div id="uti<?php echo($donnees['uti_id']); ?>" class="salle" onmouseover="document.getElementById('uti<?php echo($donnees['uti_id']); ?>').getElementsByTagName('div')[1].style.display = 'block';" onmouseleave="document.getElementById('uti<?php echo($donnees['uti_id']); ?>').getElementsByTagName('div')[1].style.display = 'none';">
					<div>
					<li><a><?php echo($donnees['uti_nom']); ?></a></li>
					<li><a><?php echo($donnees['uti_prenom']); ?></a></li>
					</div>
					<div style="display: none">
					<table>
					<tr>
						<th><a>Mail</a></th>
						<th><a>Identifiant</a></th>
						<th><a>Statut</a></th>
					</tr>
					<tr>
						<td><a><?php echo($donnees['uti_mail']); ?></a></td>
						<td><a><?php echo($donnees['uti_username']); ?></a></td>
						<td><a><?php if($donnees['uti_statut']>=1){echo("Administrateur");}else{echo("Utilisateur");} ?></a></td>
					</tr>
					</table>
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