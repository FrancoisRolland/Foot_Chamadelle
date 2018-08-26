<?php
	session_start();
	include('connexion.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
  <title>Foot Santé</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="robots" content="noindex,nofollow" />
  <link rel="stylesheet" type="text/css" id="theme" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">
   
   <?php
   		include('header.php');
   	
		/************ Requetes  ************/
		
		
		// Connexion
		if( !isset($_SESSION['login']) && isset($_POST['connexion']) && isset($_POST['pseudo']) && isset($_POST['pass']))
		{
						
			$pseudo = strtoupper($_POST['pseudo']);
			$req_trouve_pseudo =  $bdd->query("SELECT * FROM adherent WHERE UPPER(login_adherent) = '$pseudo'");
			$trouve_pseudo = $req_trouve_pseudo->fetch(PDO::FETCH_OBJ);
			$req_liste_saison = $bdd->query("SELECT * FROM saison where top_cloture_saison = 0");
                        $trouve_saison = $req_liste_saison->fetch(PDO::FETCH_OBJ);
                               
                        
			if(!empty($trouve_pseudo))
			{
				if(md5($_POST['pass']) == $trouve_pseudo->pass_adherent)
				{
						$_SESSION['id_adherent'] = $trouve_pseudo->id_adherent;
						$_SESSION['login'] = $trouve_pseudo->login_adherent;
						$_SESSION['top_admin'] = $trouve_pseudo->top_admin;
						$_SESSION['id_equipe'] = $trouve_pseudo->id_equipe;
						$_SESSION['id_saison'] = $trouve_saison->id_saison;
				}
				else
				{		
						echo 'Votre mot de passe est incorrect';
						exit;
				}
			}
			else
			{
				echo' Votre login est incorrect';
				exit;
			}
		
			header('Location: index.php');
		}
		
				
		/************ Fin Requetes  ************/
	?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Se connecter</h1>
       
        <!------ Début Formulaire --------->
        
         <form id="form_co" method="post">
          <div class="form_settings">
            <!-- Pseudo -->
            <p>
            	<span>Pseudo</span>
            	<input class="contact" type="text" name="pseudo" />
            </p>
            
            <p>
            	<span>Mot de passe</span>
				<input class="contact" type="password" name="pass" />
            </p>
            
            <p style="padding-top: 15px">
            	<span>&nbsp;</span><input class="submit" type="submit" name="connexion" value="Se connecter" />
            </p>
          </div>
        </form>
        <!------- Fin Formualire ------->
        
      </div>
    </div>
    <?php
    include('footer.php');
    ?>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
    });
  </script>
</body>
</html>
