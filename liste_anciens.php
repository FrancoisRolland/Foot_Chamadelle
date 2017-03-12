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
   
   		/*********** Variables *************/
		
		$ToD = date('Ymd'); // date du jour
		$equipeSession = $_SESSION['id_equipe'];
		echo $equipeSession;
	
		/********** FIn Variables ********/
	
	
		/************ Requetes  ************/
		$req_liste_adherent =  $bdd->query("SELECT * FROM `adherent` WHERE actif_adherent = 0 AND id_equipe = $equipeSession order by nom_adherent");
			
		/************ Fin Requetes  ************/
	?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/liste.png" alt="liste" /><h1 style="margin: 15px 0 0 0;">Liste adherents</h1>
       
        <!------ Calendrier --------->
      <br>		
        <ul>
        <?php
        while ($liste_adherent = $req_liste_adherent->fetch(PDO::FETCH_OBJ)) 
		{
        	echo '<li>';
        	if($liste_adherent->top_admin == 1) 
        		echo '<img src="images/siflet.gif" title="admin"/>    --    '; 
        	else  
        		echo '<img src="images/sans_siflet.gif" title="non admin"/>    --    ';
        		        	echo $liste_adherent->nom_adherent.' '.$liste_adherent->prenom_adherent.' ------ '.$liste_adherent->login_adherent;

        	echo '</li>';
        }
        ?>
        </ul>
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
