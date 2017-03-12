<?php
	$req_mess_admin = $bdd->query ("SELECT * FROM `message_admin` ORDER BY `id_message` DESC LIMIT 0,1");	

	while ($mess_admin = $req_mess_admin->fetch(PDO::FETCH_OBJ)) 
	{
		echo '<strong>Message Admin :</strong> '.$mess_admin->message ;
	
	}
	$req_mess_admin->closeCursor(); // on ferme le curseur des résultats
?>