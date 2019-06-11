<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Accueil</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include/menu.php'); ?>
	<div class="main">
		<h1>Accueil</h1>
		<p>Bienvenu sur la panel administrateur.<br>Nous sommes le <?php date_default_timezone_set('Europe/Luxembourg'); echo(date('d/m/Y à H:i')) ?>.</p>
		<?php
		require "../script/apiconnect.php";
		$json=file_get_contents("http://".$ip."/ping", false);
		$data=json_decode($json, true);
		echo ('<a> état du WAPT : '.$data['msg'].'<a><br>');
		echo ('<a> Version du WAPT : '.$data['result']['version'].'<a><br>');
		echo ('<a> Version de l\'api est : '.$data['result']['api_version'].'<a>');
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