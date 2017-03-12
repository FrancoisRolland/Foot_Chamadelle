<?php
$dns = 'mysql:host=localhost;dbname=c420_football';
$utilisateur = 'root';
$motDePasse = '';
try
{
	$bdd = new PDO( $dns, $utilisateur, $motDePasse );
	$bdd->exec("SET CHARACTER SET utf8");
	
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>