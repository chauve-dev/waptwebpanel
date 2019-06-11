<!-- Développeur de l'application JEANTET Joey étudiant BTS SIO 2019 -->
<?php
session_start();
if (isset($_SESSION['uti_nom'])){
	if ($_SESSION['uti_statut']>=0){
?>
<html>
<head>
<title>Ordinateur</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include("include\menu.php"); ?>
	<div class="main">
		<?php
		require "script/apiconnect.php";
			$context = stream_context_create(array(
				'http' => array(
					'header'  => "Authorization: Basic " . base64_encode("$username:$password"))));
			$json=file_get_contents("http://".$ip."/api/v1/hosts?uuid=".$_GET['uuid'], false,  $context);
			$data=json_decode($json, true);
			//var_dump($data);
			foreach($data['result'] as $key => $value){
				?>
				<table>
				  <tr>
				    <td>Nom : <?php echo($value['computer_name']); ?></td>
				    <td>OS : <?php echo($value['os_name']); ?></td>
				    <td rowspan="3">Etat de la liaison : <?php echo($value['reachable']); ?></td>
				  </tr>
				  <tr>
				    <td>Constructeur : <?php echo($value['manufacturer']); ?></td>
				    <td>Modèle : <?php echo($value['productname']); ?></td>
				  </tr>
				  <tr>
				    <td>DNS : <?php echo($value['dnsdomain']); ?></td>
				    <td>Dernier enregistrement : <?php echo($value['last_seen_on']); ?><br></td>
				  </tr>
				  <tr>
				    <td>LISTE IP<br><ul>
				    	<?php foreach($value['connected_ips'] as $keyip => $valueip){
							echo('<li>'.$valueip.'</li>');
						} ?>
				    </ul></td>
				    <td>LISTE MAC<br><ul>
				    	<?php foreach($value['mac_addresses'] as $keymac => $valuemac){
							echo('<li>'.$valuemac.'</li>');
						} ?>
				    </ul></td>
				    <td rowspan="3">Etat des paquet : <?php echo($value['host_status']); ?></td>
				  </tr>
				  <tr>
				    <td colspan="2">LISTE UTILISATEUR<br><ul>
				    	<?php 
				    	if (isset($value['connected_users'])){
				    	foreach($value['connected_users'] as $keyusr => $valueusr){
							echo('<li>'.$valueusr.'</li>');
						} 
						}
						?>
				    </ul></td>
				  </tr>
				  <tr>
				    <td>DERNIER MESSAGE :<br><p><?php echo($value['last_update_status']['runstatus']); ?></p></td>
				    <td>DATE : <?php echo($value['last_update_status']['date']); ?></td>
				  </tr>
				</table>
				<?php
				$nompc=$value['computer_name'];
				$paquetpre = $value['depends'];
			}
			?>
				<div>
		<form id="form1" method="GET" action="pc.php" style="display: flex;">
			<div class="border" style="padding: 10px;">
				<h1>Paquets à installer</h1>
				<ul>
					<input style="display: none;" type="text" name="uuid" value="<?php echo($_GET['uuid']); ?>">
					<?php
						require "script/apiconnect.php";
						$context = stream_context_create(array(
							'http' => array(
								'header'  => "Authorization: Basic " . base64_encode("$username:$password"))));
						$json=file_get_contents("http://".$ip."/api/v3/packages", false,  $context);
						$data=json_decode($json, true);


						foreach($data['result'] as $key => $value){
							if (stripos($paquetpre, $value['package']) === false){
							?>
							<li><input type="checkbox" id="v<?php echo($value['package']) ?>" name="voulu<?php echo($value['package']) ?>" value="<?php echo($value['package']) ?>">
			    			<label class="texte" for="<?php echo($value['package']) ?>"><?php echo($value['package']) ?></label></li>
							<?php
						}
						}
						?>
		</ul>
		</div>
		<div class="border" style="padding: 10px;">
			<h1>Paquets à désinstaller</h1>
			<ul>
			<?php
			foreach($data['result'] as $key => $value){
				if (strpos($paquetpre, $value['package']) !== false){
				?>
				<li><input type="checkbox" id="n<?php echo($value['package']) ?>" name="nvoulu<?php echo($value['package']) ?>" value="<?php echo($value['package']) ?>">
    			<label class="texte" for="<?php echo($value['package']) ?>"><?php echo($value['package']) ?></label></li>
				<?php
			}
			}
			?>
		</ul>
		</div>
		</ul>
		</form>
		<?php
			if (sizeof($_GET)>1){
				$macommande="/opt/wapt/script.py ".$_GET['uuid']."add";
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
		?>
	</div>
	<div style="text-align: right;">
	<input type="submit" class="bouton" name="submit" value="Valider" form="form1">
	<?php 
	require "script\sqlconnect.php";
	$reponse = $bdd->query("SELECT * from pc where pc_nom='".strtolower($nompc)."'");
	$donnees = $reponse->fetch();

		?>
	<a class="bouton" href="listepc.php?salle=<?php echo($donnees['sal_id']); ?>">Retour</a>
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
