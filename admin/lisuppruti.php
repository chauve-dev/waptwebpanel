<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Supprimer un utilisateur</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<script type="text/javascript">
		
		function suppr(id){
		var answer = confirm("Supprimer l'utilisateur ?");
		if (answer) {
		    window.location="suppruti.php?uti="+id;
		}
	}
	</script>
<?php include('include\menu.php'); ?>
	<div class="main">
<?php
		require "..\script\sqlconnect.php";
			$reponse = $bdd->query('SELECT * from utilisateur ORDER BY uti_nom');
			if($reponse){
			while($donnees = $reponse->fetch()){
				?>
				<ul>
					<div class="salled" onclick='suppr(<?php echo($donnees['uti_id']);?>);'>
					<li><a><?php echo($donnees['uti_nom']); ?> <?php echo($donnees['uti_prenom']); ?></a></li>
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