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
				
				 
		/************ Fin Requetes  ************/
	?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Ajout d'une saison</h1>
       
        <!------ Début Formulaire ------- -->

         <form  id="form_ajout" name="form_ajout" method="GET" action="" onsubmit="return verification_form()" >
          
         	<div class="form_settings">
          
			 	
            
	            <p>
	            	<span>Saison</span>
	            	<input class="contact" type="text" name="annee1" id="annee1" style="width:50px" maxlength="4" /> / <input class="contact" type="text" name="annee2" id="annee2" style="width:50px" maxlength="4"/>
	            <input class="submit" type="submit" name="ajout" id="ajout" value="Ajouter" style="margin-left:50px"/>
	            </p>
                     
	            
	            
	         </div>
        </form>
        <!------- Fin Formualire -------> 
        
        
        <br><br>
         <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Clôturer une saison</h1>
              
        <!------ Début Formulaire ------- -->

         <form  id="form_cloture" name="form_cloture" method="GET" action="" onsubmit="return verification_form()" >
          
         	<div class="form_settings">
          
	             <p>
	            	<span>Saison</span>
	            	<select class="contact" name="saison" id="saison" style="width:140px" required >
	            		<?php
						 	while ($liste_saison = $req_liste_saison->fetch(PDO::FETCH_OBJ)) 
					    	{
					    		echo '<option name="id_saison" value="'.$liste_saison->id_saison.'">'.$liste_saison->libelle.'</option>';
					    	}
						?>
					</select>
					 <input class="submit" type="submit" name="cloture" id="cloture" value="Clôturer" style="margin-left:50px"/>
	           
				</p>
                     
	            
	            
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
		 if (isset($_GET['annee1']) && isset($_GET['annee2']))
		 {
		 	 $annee1 		= $_GET['annee1'];
			 $annee2 		= $_GET['annee2'];
		 } 
		 $libelle = $annee1."/".$annee2;
		 
		 $requete_saison = "INSERT INTO `saison` VALUES ('','$libelle',0)";
		 $bdd->exec($requete_saison);
		 
		 ?>
		 <script> alert("Saison ajoutée"); </script>
		 <?php
		 header("Location: ajout_saison.php" );
	}
	
	if (isset($_GET['cloture']))
	{
		 if (isset($_GET['saison']))
		 {
		 	 $saison 		= $_GET['saison'];
		 } 
		 $cloture_saison = "UPDATE `saison` SET top_cloture_saison = 1 WHERE id_saison=$saison";
		 $bdd->exec($cloture_saison);
		 
		 ?>
		 <script> alert("Saison clôturée"); </script>
		 <?php
		 header("Location: ajout_saison.php" );
	}
	 	 
?>
</body>
</html>
