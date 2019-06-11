<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
require "script/sqlconnect.php";
if (isset($_POST['identifiant']) AND isset($_POST['password'])){
	if($_POST['identifiant']!="" AND $_POST['password']!=""){
	$reponse = $bdd->query('SELECT * from utilisateur where uti_username=\''.$_POST['identifiant'].'\'');
	$donnees = $reponse->fetch();
	if(md5($_POST['password'])==$donnees['uti_password']){
		session_start();
		$_SESSION['uti_email']=$donnees['uti_mail'];
		$_SESSION['uti_username']=$donnees['uti_username'];
		$_SESSION['uti_nom']=$donnees['uti_nom'];
		$_SESSION['uti_prenom']=$donnees['uti_prenom'];
		$_SESSION['uti_id']=$donnees['uti_id'];
		$_SESSION['uti_statut']=$donnees['uti_statut'];
		header("location: index.php");
	}
}
}
?>
<html style="overflow: hidden;">
<head>
	<title>Connexion</title>
	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-color: #293133;">
	<script type="text/javascript">
		var click=0;
		var rotated = false;
		function clickme(){
			if (click==19){
				var div = document.getElementById('connec');
				if(div.style.transform != 'rotate(180deg)'){
    				div.style.transform = 'rotate(180deg)'; 
    			}
    			else{
    				div.style.transform = 'rotate(0deg)';
    			}
    			click=0;
			}else{
			click=click+1;
		}
		}
	</script>
	<div id="connec" class="divconnexion" onclick="clickme();">
		<form class="connexion" method="POST">	
			<label for="identifiant">Identifiant</label>		
			<input type="text" id="identifiant" name="identifiant">
			<label for="password">Mot de passe</label>
			<input type="password" id="password" name="password">
			<input class="connectb" type="submit" name="connexion" value="Connexion">
		</form>
	</div>
</body>
</html>
