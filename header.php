<?php
	if(!isset($_SESSION['id_equipe']))
	{
		
		$equipe = "";
	}
	else
	{
		
		$req_nom_equipe = $bdd->query("SELECT * FROM equipe WHERE id_equipe=".$_SESSION['id_equipe']);
		$nom_equipe = $req_nom_equipe->fetch(PDO::FETCH_OBJ);
		$equipe = $nom_equipe->nom_equipe;	
	}
	
?>

<header>
  <div id="logo">
    <div id="logo_text">
      <!-- class="logo_colour", allows you to change the colour of the text -->
      <h1><a href="index.php">Foot Santé<span class="logo_colour"> <?php echo $equipe;?></span></a></h1>
      <h2>Les footballeurs du vendredi soir !</h2>
    </div>
  </div>
  <nav>
    <div id="menu_container">
      <ul class="sf-menu" id="nav">
      	<li><a href="index.php">Accueil</a></li>
      <?php
			if(!isset($_SESSION['login']))
			{

				echo '<li><a href="se_connecter.php">Se connecter</a></li>';
				echo '<li><a href="inscription.php">S\'inscrire</a></li>';

			}
			else
			{

				echo '<li><a href="profil.php">Mon profil</a></li>';
				echo '<li><a href="#">Consultation</a>';
					echo '<ul>';
						echo'<li><a href="liste_adherents.php">Liste adherents</a></li>';
						echo'<li><a href="liste_anciens.php">Liste des anciens</a></li>';
						//echo'<li><a href="liste_equipes.php">Liste equipes</a></li>';
						//echo'<li><a href="liste_equipes.php">Consultation journée</a></li>';
						//echo'<li><a href="historique.php">Historique des matchs</a></li>';
					echo'</ul>';
				echo'</li>';		
						
				if($_SESSION['top_admin'] == '1')
				{
					echo '<li><a href="contact.html">Administration</a>';	
                                            echo '<ul>';
				            //echo '<li><a href="envoi_mail.php">Envoyer un mail</a></li>';
				            echo '<li><a href="mess_admin.php">Modifier message admin</a></li>';
				            echo '<li><a href="ajout_match.php">Ajouter / Modifier un match</a></li>';
				            echo '<li><a href="ajout_saison.php">Ajouter / Clôturer une saison</a></li>';
				            echo '<li><a href="ajout_score.php">Saisie du score</a></li>';
                                            //echo '<li><a href="ajout_equipe.php">Ajouter / Modification d\'une équipe</a></li>';
				            //echo '<li><a href="cotisation.php">Cotisations et certificats</a></li>';
                                            //echo '<li><a href="liste_adherents_admin.php">Liste adherents</a></li>';
                                            echo '</ul>';
			       echo '</li>';
				}	
				//echo '<li><a href="contact.html">Galerie</a></li>';
				//echo '<li><a href="contact.html">Forum</a></li>';
				echo '</ul>';
			}
		?>

      
    </div>
  </nav>
</header>