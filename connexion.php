<?php
$dns = 'mysql:host=localhost;dbname=c410_football';
$utilisateur = 'root';
$motDePasse = 'foot-chamadelle';
try
{
	$bdd = new PDO( $dns, $utilisateur, $motDePasse, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$bdd->exec("SET CHARACTER SET utf8");
	
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>