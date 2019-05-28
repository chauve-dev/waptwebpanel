<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Supprimer un pc</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<script type="text/javascript">
		
		function suppr(id){
		var answer = confirm("Supprimer le pc ?");
		if (answer) {
		    window.location="supprpc.php?pc="+id;
		}
	}
	</script>
<?php include('include\menu.php'); ?>
	<div class="main">
<?php
		require "..\script\sqlconnect.php";
			$reponse = $bdd->query('SELECT * from pc ORDER BY pc_nom');
			if($reponse){
			while($donnees = $reponse->fetch()){
				?>
				<ul>
					<div class="salled" onclick='suppr(<?php echo($donnees['pc_id']);?>);'>
					<li><a><?php echo($donnees['pc_nom']); ?></a></li>
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