<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){
?>
<html>
<head>
<title>Admin - Modifier un utilisateur</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include('include/menu.php'); ?>
	<div class="main">
<?php
	if(sizeof($_POST)>0){
		require "../script/sqlconnect.php";
		
		if ($_POST['password']==""){

		$req = $bdd->prepare("UPDATE utilisateur SET uti_statut=:statut, uti_mail=:mail WHERE uti_id=:id");
		$req->bindParam(':statut', $_POST['statut']);
		$req->bindParam(':id', $_POST['utilisateur']);
		$req->bindParam(':mail', $_POST['mail']);
		$req -> execute();
		}else{
		$password = md5($_POST['password']);
		$req = $bdd->prepare("UPDATE utilisateur SET uti_password=:password, uti_statut=:statut, uti_mail=:mail WHERE uti_id=:id");
		$req->bindParam(':password', $password);
		$req->bindParam(':statut', $_POST['statut']);
		$req->bindParam(':id', $_POST['utilisateur']);
		$req->bindParam(':mail', $_POST['mail']);
		$req -> execute();
	}}
?>
<script type="text/javascript">
	var uti = [];
	var i = 0;
	<?php
			 	require "../script/sqlconnect.php";
				$reponse = $bdd->query('SELECT * from utilisateur');
				while($donnees = $reponse->fetch()){
					?>
					uti[<?php echo($donnees['uti_id']) ?>] = '<?php echo($donnees['uti_mail']); ?>';
					i=i+1;
					<?php
				}
	?>
	function trpwd(){
		var pwd1 = document.getElementById('password');
		var pwd2 = document.getElementById('password2');
		if(pwd1.value == "" && pwd2.value == ""){
			return true;
		}
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
			<label for="utilisateur">Utilisateur</label>
			<select id="utilisateur" name="utilisateur" onchange="document.getElementById('mail').value = uti[document.getElementById('utilisateur').value];">
			 	<?php
			 	require "../script/sqlconnect.php";
				$reponse = $bdd->query('SELECT * from utilisateur');
				if($reponse){
				while($donnees = $reponse->fetch()){
			 	?>
				  <option value="<?php echo($donnees['uti_id']); ?>"><?php echo($donnees['uti_nom'].' '.$donnees['uti_prenom']); ?></option>
				<?php
				}
				}
				?>
			</select>

			<label for="mail">Mail utilisateur</label>
			<input id="mail" type="email" autocomplete="off" name="mail">

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
<script type="text/javascript">
	document.getElementById('mail').value = uti[document.getElementById('utilisateur').value];
</script>
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