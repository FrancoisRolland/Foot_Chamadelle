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
  <script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
  
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js" ></script>
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#date" ).datepicker();
  });
  </script>

</head>

<body>
  <div id="main">
   
   <?php
   		include('header.php');
   	
		/************ Requetes  ************/
		$equipeSes =  $_SESSION['id_equipe'];

		$req_liste_saison = $bdd->query("SELECT * FROM saison where top_cloture_saison = 0");
		$req_liste_equipe = $bdd->query("SELECT * FROM equipe where id_equipe <> $equipeSes");
				
				 
		/************ Fin Requetes  ************/
	?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Ajout d'un match</h1>
       
        <!------ Début Formulaire ------- -->

         <form  id="form_co" name="form_co" method="GET" action="" onsubmit="return verification_form()" >
          <div class="form_settings">
          
           <p>
            	<span>Saison</span>
            	<select class="contact" name="saison" id="saison" required >
            		<?php
					 	while ($liste_saison = $req_liste_saison->fetch(PDO::FETCH_OBJ)) 
				    	{
				    		echo '<option name="id_saison" value="'.$liste_saison->id_saison.'">'.$liste_saison->libelle.'</option>';
				    	}
					?>
				</select>
            </p>
            
            <p>
            	<span>Date</span>
            	<input class="contact" type="text" name="date" id="date"  />
            </p>
            
            <p>
            	<span>Equipe</span>
            	<select class="contact" name="equipe" id="equipe" required >
            		<?php
					 	while ($liste_equipe = $req_liste_equipe->fetch(PDO::FETCH_OBJ)) 
				    	{
				    		echo '<option name="id_equipe" value="'.$liste_equipe->id_equipe.'">'.$liste_equipe->nom_equipe.'</option>';
				    	}
					?>
				</select>
            </p>
            
            
            <p>
            	<span>Domicile</span>
            	<input class="checkbox" type="checkbox" name="code_domicile" value="" />
            </p>
           
                     
            <p style="padding-top: 15px"><span>&nbsp;</span>
            <input class="submit" type="submit" name="ajout" id="ajout" value="Ajouter" /></p>
          </div>
        </form>
        <!------- Fin Formualire ------->
        
      </div>
    </div>
    <?php
	/************* Requete de mise à jour **************/
    
    
    
    
    include('footer.php');
    ?>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
 
  
  
	  $(document).ready(function() {
	  			  $('ul.sf-menu').sooperfish();
		  $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
		  
	   });

	
</script>
<?php
		
	if (isset($_GET['ajout']))
	{
		 if (isset($_GET['saison']) && isset($_GET['equipe']) && isset($_GET['date']) && isset($_GET['code_domicile']))
		 {
		 	 $saison 		= $_GET['saison'];
			 $equipe 		= $_GET['equipe'];
			 $date   		= $_GET['date']; 
			 $code_domicile = $_GET['code_domicile']; 
		 } 
		 if($code_domicile == "")
		 {
			$equipeDom = $equipe;
			$equipeExt = $equipeSes;
		 }
		 else
		 {
			$equipeExt = $equipe;
			$equipeDom = $equipeSes;
		 }
		 $explodmot=explode("/" , $date);
		 $dateSql = $explodmot[2]."-".$explodmot[1]."-".$explodmot[0];
		 $journee = $explodmot[2].$explodmot[1].$explodmot[0];	
		
		 $requete_match = "INSERT INTO `match` VALUES ('',$equipeExt,'$dateSql',$saison,NULL,NULL,$equipeDom,0,0,$journee)";
		 $bdd->exec($requete_match);
		 
		 // Récupérer le dernier match ajouté
		 $numMatch = $bdd->lastInsertId();

		 $req_liste_adherent = $bdd->query("SELECT id_adherent from adherent where `actif_adherent` = 1 AND (id_equipe = $equipeExt  OR id_equipe = $equipeDom)");
		
		 while ($liste_adherent = $req_liste_adherent->fetch(PDO::FETCH_OBJ)) 
		 {
		 	$numAdherent = $liste_adherent->id_adherent;
			$bdd->exec("INSERT INTO participation_match VALUES ($numMatch,$numAdherent,'null','null')");
		 }
		 ?>
		 <script> alert("Match ajouté"); </script>
		 <?php
	}
	 	 
?>
</body>
</html>
