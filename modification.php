<?php
header('Content-Type: text/html; charset=utf-8');
include('connexion.php');

	if(isset($_GET["match"]))
	{
		$match=$_GET["match"];
		$req_liste_equipesE = $bdd->query("SELECT * FROM equipe");
		$req_liste_equipesD = $bdd->query("SELECT * FROM equipe");
		$req_information_match = $bdd->query("SELECT * from `match` where id_match=$match");
		$information_match = $req_information_match->fetch(PDO::FETCH_OBJ);
		$sel = "";
	}
	
	echo '<h3>Modification de match</h3>';
	  			echo '<div class="form_settings">';
		  			echo '<input name="id_matchModif" style="visibility:hidden" value="'.$match.'" type="text">';
		  			echo '<p>';
		  				echo '<span>Equipe Domicile</span>';
		  				echo '<input type="text" name="new_date" id="new_date" /> (sous forme 25/11/1991)';
		  			echo '</p>';
		  			echo '<p>';
		  				echo '<span>Equipe Domicile</span>';
		  				echo '<select class="contact" name="equipeD" id="equipeD" required >';
		  						while ($liste_equipesD = $req_liste_equipesD->fetch(PDO::FETCH_OBJ)) 
		  						{
			  						if ($information_match->id_equipe_dom == $liste_equipesD->id_equipe)
			  							$sel = $liste_equipesD->id_equipe;
			  						else 
			  							$sel .= $information_match->id_equipe_dom. " -- ".$liste_equipesD->id_equipe;
			  						
			  							
		  							echo '<option name="id_equipeD" selected="" value="'.$liste_equipesD->id_equipe.'">'.$liste_equipesD->nom_equipe.'</option>';
		  							
		  						}
		  				echo '</select>';
		  				echo $sel;
		  			
		  			echo '</p>';
		  			echo '<p>';
		  				echo '<span>Equipe Exterieure</span>';
		  				echo '<select class="contact" name="equipeE" id="equipeE" required >';
		  						while ($liste_equipesE = $req_liste_equipesE->fetch(PDO::FETCH_OBJ)) 
		  						{
		  							echo '<option name="id_equipeE" value="'.$liste_equipesE->id_equipe.'">'.$liste_equipesE->nom_equipe.'</option>';
		  						}
		  				echo '</select>';
		  			
		  			echo '</p>';
		  			echo '<p>';
			  			echo '<input style="cursor:pointer" type="submit" name="valider" id="valider" value="Valider" />';
			  			echo '<input style="cursor:pointer" type="submit" onclick="quitter()" name="annuler" id="annuler" value="Quitter" />';
		  			echo '</p>';
	  		   echo '</div>';
	  
?>