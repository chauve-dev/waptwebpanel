<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Créer un utilisateur</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include/menu.php'); ?>
	<div class="main">
<?php
	if(sizeof($_POST)>0){
		require "../script/sqlconnect.php";
		$id=strtolower($_POST['id']);
		$reponse = $bdd->query("SELECT * from utilisateur WHERE uti_username='".$id."'");
		$res = $reponse -> fetch();
			if($res){
				echo('<a>Cet identifiant d\'utilisateur existe déjà</a>');
			}else{
		$password = md5($_POST['password']);
		$nom = strtoupper($_POST['nom']);
		$req = $bdd->prepare("INSERT INTO utilisateur (uti_nom, uti_prenom, uti_mail, uti_username, uti_password, uti_statut) VALUES (:nom, :prenom, :mail, :username, :password, :statut)");
		$req->bindParam(':nom', $nom);
		$req->bindParam(':prenom', $_POST['prenom']);
		$req->bindParam(':mail', $_POST['mail']);
		$req->bindParam(':username', $id);
		$req->bindParam(':password', $password);
		$req->bindParam(':statut', $_POST['statut']);
		$req -> execute();
		}
	}
?>
<script type="text/javascript">
	function trpwd(){
		var pwd1 = document.getElementById('password');
		var pwd2 = document.getElementById('password2');
		if(pwd1.value == pwd2.value && pwd1.value!="" && pwd2.value!=""){
			pwd2.style.boxShadow = "-1px -1px 5px 2px green";
			return true;
		}
		else{
			pwd2.style.boxShadow = "-1px -1px 5px 2px red";
			return false;
		}
	}
</script>
<div class="whitebox">
		<form method="POST" onsubmit="return trpwd();">
			<label for="nom">Nom utilisateur</label>
			<input id="nom" type="text" name="nom">

			<label for="prenom">Prénom utilisateur</label>
			<input id="prenom" type="text" name="prenom">

			<label for="mail">Mail utilisateur</label>
			<input id="mail" type="email" autocomplete="off" name="mail">

			<label for="id">Identifiant utilisateur</label>
			<input id="id" type="text" name="id">

			<label for="password">Mot de passe utilisateur</label>
			<input id="password" type="password" onchange="trpwd();" name="password">

			<label for="password2">Valider le mot de passe</label>
			<input id="password2" type="password" onchange="trpwd();" name="password2">

			<label for="statut">Statut utilisateur</label>
			<select id="statut" name="statut">
				<option value="0">Utilisateur</option>
				<option value="1">Administrateur</option>
			</select>

			<input type="submit" name="submit" value="Valider">
		</form>
</div>


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