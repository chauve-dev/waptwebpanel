<?php
$hostnamedb='';
$dbname='';
$portdb='5432';
$userdb='';
$mdpdb='';
$bdd = new PDO('pgsql:host='.$hostnamedb.';dbname='.$dbname.';port='.$portdb.';', $userdb, $mdpdb);
?>