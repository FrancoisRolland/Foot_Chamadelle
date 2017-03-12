<?php

$ToD = date('Ymd'); // date du jour

if(isset($_SESSION['login']))
{
			$equipe_co = $_SESSION['id_equipe'];
			$id_adherent = $_SESSION['id_adherent'];

$req_itineraire_journee=$bdd->query("SELECT e1.id_equipe as id_e1,
								   e1.nom_equipe as nom_e1,
								   e2.id_equipe as id_e2,
								   e2.nom_equipe as nom_e2,
								   e1.gps as test,
								   e2.gps as plop,
								   m.id_match,
								   m.date_match 
								   FROM `match` m 
								   JOIN equipe as e1 ON e1.id_equipe = m.id_equipe_dom 
								   JOIN equipe as e2 ON e2.id_equipe = m.id_equipe 
								   WHERE (m.date_match-$ToD) > 0 
								   AND (m.id_equipe_dom = $equipe_co OR m.id_equipe = $equipe_co)
								   order by m.date_match LIMIT 1");
								   
						   
$req_trouve_adresse =  $bdd->query("SELECT * FROM adherent WHERE id_adherent =$id_adherent");
	
								$itineraire_journee = $req_itineraire_journee->fetch(PDO::FETCH_OBJ);
								$equipe1 = $itineraire_journee->test;
		
								$trouve_adresse = $req_trouve_adresse->fetch(PDO::FETCH_OBJ);
							    $adresse = $trouve_adresse->rue_adherent;
							    $cp = $trouve_adresse->code_postale_adherent;
							    $ville = $trouve_adresse->bureau_distributeur_adherent;
							    $adresse_adherent = $adresse.$cp.$ville;

										    
}
else
{
	
	$req_prochaine_journee2=$bdd->query("SELECT * from `match` WHERE (date_match-$ToD)>0 order by date_match LIMIT 1");
	$prochaine_journee2 = $req_prochaine_journee2->fetch(PDO::FETCH_OBJ);
	$proJournee2 = $prochaine_journee2->date_match;
	$explo2 = explode("-",$proJournee2);
	$dateMatch2 = $explo2[2]."/".$explo2[1]."/".$explo2[0];
							

}
?>

      <!------------------- Bande info ------------------- -->
      <div id="sidebar_container">
        
        <!------------ 1er pavé --------------- -->
        <img class="paperclip" src="images/paperclip.png" alt="paperclip" />
        <div class="sidebar">

        <?php
        	$date = date('d/m/Y');
        	if(isset($_SESSION['login']))
			{
        		echo '<h3>Connecté</h3>';
				echo '<h4>Bonjour  '.$_SESSION['login'].'</h4>';
				echo '<h5>Nous somme le '.$date.'</h5>';
				echo '<p>';
				include('mess_admin.php');
				echo '<br/><br/><a href="logout.php">Se déconnecter</a></p>';

			}
			else
			{
				echo '<h3>Déconnecté</h3>';
				echo '<h4>Veuillez vous connecter ou vous inscrire</h4>';
				echo '<h5>Nous somme le '.$date.'</h5>';
				echo '<p>';
				include('mess_admin.php');
				echo '<br/><br/><a href="se_connecter.php">Se connecter</a>';
				echo '</br><a href="inscription.php">S\'inscrire</a><p>';
			}
		?>
          
        </div>
               
        <!------------ 2eme pavé --------------- -->
        <img class="paperclip" src="images/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <?php
          if(isset($_SESSION['login']))
		  {
	          echo '<h3>Prochaine Rencontre</h3>';
	          
	          echo '<ul>';
	            echo'<li>'.$itineraire_journee->nom_e1.'</li>';
	            echo'<li>VS</li>';
	            echo'<li>'.$itineraire_journee->nom_e2.'</li>';
				echo'</br>';
					echo '<li><a target="_blank" href="http://maps.google.com/maps?saddr='.$adresse_adherent.'&daddr='.$equipe1.'">Itinéraire vers le stade</a></li>';
	          echo'</ul>';
	        }
	        else
	        {
		        echo'<h3>Prochaine Journée</h3>';
		        echo'<ul>';
	            echo 	'<li>'.$dateMatch2.'</li>';
				echo'</ul>';
		        
	        }
	        ?>
          
        </div>
    
       <!------------ 3eme pavé --------------- -->
        <img class="paperclip" src="images/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <h3>Les nouvelles du front</h3>
          <ul>
            <li><a href="#">Message 1 klfjldgdf gjfdmljùgfd j gmfdlkmlgfd jgkfd gjfd rfhdsgfdshgfd l</a></li>
            <li><a href="#">Message 1 klfjldgdf gjfdmljùgfd j gmfdlkmlgfd jgkfd gjfd rfhdsgfdshgfd l</a></li>
            <li><a href="#">Message 1 klfjldgdf gjfdmljùgfd j gmfdlkmlgfd jgkfd gjfd rfhdsgfdshgfd l</a></li>
          </ul>
        </div> 
        
        <!------------ 4eme pavé --------------- -->
        <img class="paperclip" src="images/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <h3>Les News</h3>
          <ul>
            <li><a href="#">Article 1</a></li>
            <li><a href="#">Article 2</a></li>
            <li><a href="#">Article 3</a></li>
          </ul>
        </div>
        
        <!------------ 4eme pavé --------------- -->
       
        
      </div>
      <!------------------- Fin Bande info --------------------->
