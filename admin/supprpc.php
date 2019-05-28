<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){

	require "..\script\sqlconnect.php";
	if(sizeof($_GET)>0){
		$req = $bdd->prepare("DELETE FROM pc WHERE pc_id=:id;");
		$req->bindParam(':id', $_GET['pc']);
		$req -> execute();
		header('location: lisupprpc.php');
	}

}
else{
	header('location: ../index.php');
}
}
else{
	header('location: ../connexion.php');
}
?>