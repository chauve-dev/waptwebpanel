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
	<script type="text/javascript">
		
		function suppr(id){
		var answer = confirm("Supprimer la salle ?");
		if (answer) {
		    window.location="supprsalle.php?salle="+id;
		}
	}
	</script>
<?php include('include/menu.php'); ?>
	<div class="main">
		<a style="color: yellow;"> 	&#9888; Attention une salle peut être supprimée à l'unique condition qu'elle ne contient aucun pc</a>
<?php
		require "../script/sqlconnect.php";
			$reponse = $bdd->query('SELECT * from salle ORDER BY sal_nom');
			if($reponse){
			while($donnees = $reponse->fetch()){
				?>
				<ul>
					<div class="salled" onclick='suppr(<?php echo($donnees['sal_id']);?>);'>
					<li><a><?php echo($donnees['sal_nom']); ?></a></li>
					<li><a><?php echo($donnees['sal_desc']); ?></a></li>
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