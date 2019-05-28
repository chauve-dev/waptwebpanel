<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=0){
?>
<html>
<head>
<title>Mes informations</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include("include\menu.php"); ?>
	<div class="main">
		<h1>Vos informations</h1>
		<table>
		  <tr>
		    <td>Nom</td>
		    <td><?php echo($_SESSION['uti_nom']); ?></td>
		  </tr>
		  <tr>
		    <td>Prenom</td>
		    <td><?php echo($_SESSION['uti_prenom']); ?></td>
		  </tr>
		  <tr>
		    <td>Email</td>
		    <td><?php echo($_SESSION['uti_email']); ?></td>
		  </tr>
		</table>
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