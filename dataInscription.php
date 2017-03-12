<?php
header("Content-Type:text/plain; charset=iso-8859-1");
	
	
include('connexion.php');


		
	if(isset($_GET['pseudo']) )
	{
	 	$pseudo=addslashes($_GET['pseudo']);
	}

	//mysql_query("SET NAMES 'utf8'");
    // Pr�paration des donn�es pour les requ�tes � l'aide de la fonction mysql_real_escape_string
    //$pseudo = mysql_real_escape_string($pseudo);
   
   
     // Requ�te pour compter le nombre d'enregistrements r�pondant � la clause : champ du pseudo de la table = pseudo GET� dans le formulaire
     $req1 = "SELECT * FROM adherent WHERE login_adherent = '".$pseudo."'";

     // Ex�cution de la requ�te
     $reqq = $bdd->query($req1);

     // Cr�ation du tableau associatif du r�sultat
     //$reqq->fetchAll();
    // echo count($reqq);
     $check_pseudo = $reqq->fetch(PDO::FETCH_ASSOC);
	 //$nb = $reqq->rowCount();
	 if ( $check_pseudo == "")
	 {	
	 	echo "oui";
	 }
	 else
	 {
	 	echo "non";
	 }
		 

?>