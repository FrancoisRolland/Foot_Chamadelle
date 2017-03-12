<?php
header("Content-Type:text/plain; charset=iso-8859-1");
include('connexion.php');

	if(isset($_GET["match"]))
	{
		$match=$_GET["match"];
		
		$bdd->exec("DELETE FROM `participation_match` WHERE id_match= '".$match."'");
		$bdd->exec("DELETE FROM `match` WHERE id_match= '".$match."'");
		
	}
?>