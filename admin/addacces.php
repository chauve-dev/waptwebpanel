<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=1){

	require "../script/sqlconnect.php";
	if(sizeof($_GET)>0){
		$req = $bdd->prepare("INSERT INTO acces (uti_id, sal_id) VALUES (:uti, :sal)");
		$req->bindParam(':uti', $_GET['uti']);
		$req->bindParam(':sal', $_GET['salle']);
		$req -> execute();
	}
	header('location: acces.php?uti='.$_GET['uti']);
}
else{
	header('location: ../index.php');
}
}
else{
	header('location: ../connexion.php');
}
?>