<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=0){
?>
<html>
<head>
<title>Liste des ordinateurs</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include("include/menu.php"); ?>
	<div class="main">
		<ul>
		<?php
			require "script/apiconnect.php";
			$context = stream_context_create(array(
				'http' => array(
					'header'  => "Authorization: Basic " . base64_encode("$username:$password"))));
			$json=file_get_contents("http://".$ip."/api/v1/hosts", false,  $context);
			$data=json_decode($json, true);
			//var_dump($data);
			foreach($data['result'] as $key => $value){
				require "script/sqlconnect.php";
				$reponsedroit = $bdd->query("SELECT * from acces where uti_id=".$_SESSION['uti_id']." AND sal_id=".$_GET['salle']);
				if($reponsedroit->fetch()){
				$reponse = $bdd->query('SELECT * from pc');
				while($donnees = $reponse->fetch()){
					if(is_array($value)){
					if(strtolower($value['computer_name']) == strtolower($donnees['pc_nom'])){
						if($_GET['salle'] == $donnees['sal_id']){
				?>
				<div class="salle border" style="margin-bottom: 10px;" onclick='window.location="pc.php?uuid=<?php echo($value['uuid']) ?>";'>
					<li><?php echo($value['computer_name']); ?></li>
				<?php
				if (sizeof($_GET)>1){
							$macommande="/opt/wapt/script.py ".$value['uuid']."add";
							$remove="remove";
							foreach ($_GET as $key => $value) {
								if($value!="Valider"){
									if(strpos($key, 'voulu') === 0){
									$macommande=$macommande." ".$value;
									}
									if(strpos($key, 'nvoulu') === 0){
										$remove=$remove." ".$value;
									}
								}
							}
							$macommande = $macommande." ".$remove;
                                			$file = fopen('/var/www/html/script.sh', 'a+');
                                			fwrite($file, $macommande.PHP_EOL);
                                			fclose($file);
                                			echo('La mise à jour de l\'ordinateur sera effectué dans ~10 minutes');
						}


				?></div><?php
				}
				}
				}
				}
				}
				?>
				
				<?php
			}
				
			?>
		</ul>
		<form id="form1" method="GET" action="listepc.php" style="display: flex;">
			<div class="border" style="padding: 10px;">
				<h1>Paquets à installer</h1>
				<ul>
					<input style="display: none;" type="text" name="salle" value="<?php echo($_GET['salle']); ?>">
					<?php
						require "script/apiconnect.php";
						$context = stream_context_create(array(
							'http' => array(
								'header'  => "Authorization: Basic " . base64_encode("$username:$password"))));
						$json=file_get_contents("http://".$ip."/api/v3/packages", false,  $context);
						$data=json_decode($json, true);


						foreach($data['result'] as $key => $value){
							?>
							<li><input type="checkbox" id="v<?php echo($value['package']) ?>" name="voulu<?php echo($value['package']) ?>" value="<?php echo($value['package']) ?>">
			    			<label class="texte" for="<?php echo($value['package']) ?>"><?php echo($value['package']) ?></label></li>
							<?php
						}
						?>
		</ul>
		</div>
		<div class="border" style="padding: 10px;">
			<h1>Paquets à désinstaller</h1>
			<ul>
			<?php
			foreach($data['result'] as $key => $value){
				?>
				<li><input type="checkbox" id="n<?php echo($value['package']) ?>" name="nvoulu<?php echo($value['package']) ?>" value="<?php echo($value['package']) ?>">
    			<label class="texte" for="<?php echo($value['package']) ?>"><?php echo($value['package']) ?></label></li>
				<?php
			}
			?>
		</ul>
		</div>
		</ul>
		</form>
		<div style="text-align: right;">
		<input type="submit" class="bouton" name="submit" value="Valider" form="form1">
		</div>
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
