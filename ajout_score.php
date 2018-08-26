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
   	
        /*********** Variables *************/
		
	$ToD = date('Ymd'); // date du jour
	$equipeSes = $_SESSION['id_equipe'];
	$id_saison = $_SESSION['id_saison'];
        $equipe_co = $_SESSION['id_equipe'];
        
	/********** FIn Variables ********/
	
        /************ Requetes  ************/
	
	$req_liste_saison = $bdd->query("SELECT * FROM saison where top_cloture_saison = 0");
        //$req_liste_match = $bdd->query("SELECT * FROM `match` WHERE (nb_but_equipe1 is null and id_saison = $id_saison)");
        $req_tableEquipeMatch = "SELECT e1.id_equipe as id_e1,
					       e1.nom_equipe as nom_e1,
			                       e2.id_equipe as id_e2,
					       e2.nom_equipe as nom_e2,
                                               m.id_match,
					       m.date_match 
					       FROM `match` m 
					       JOIN equipe as e1 ON e1.id_equipe = m.id_equipe_dom 
	                                       JOIN equipe as e2 ON e2.id_equipe = m.id_equipe ";                               
        $req_liste_match = $bdd->query("$req_tableEquipeMatch
					       WHERE m.nb_but_equipe1 is null
				               AND (m.id_equipe_dom = $equipe_co OR m.id_equipe = $equipe_co)
                                               order by m.date_match");
										   						
		/************ Fin Requetes  ************/
    ?>
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Saisie du score</h1>
       
        <!------ Début Formulaire ------- -->

    <form  id="form_co" name="form_co" method="POST" action="" onsubmit="return verification_form()" >
        <div class="form_settings">
          
            <p>
            	<span>Saison</span>
            	<select class="contact" name="saison" id="saison" required >
                    <?php
			while ($liste_saison = $req_liste_saison->fetch(PDO::FETCH_OBJ)) 
                        {
                            echo '<option name="id_saison" value="'.$liste_saison.'">'.$liste_saison->libelle.'</option>';
			}
                    ?>
                    
                </select>
            </p>
            
            <p>
            	<span>Sélection du match</span>
                <select class="contact" name="liste_match" id="liste_Match" required onkeypress="fctSubmit()">
                <!--<select class="contact" name="liste_match" id="liste_Match" required onkeydown="toto()">-->
                    <?php
                        echo "<option>faites un choix</option>";
			while ($liste_match = $req_liste_match->fetch(PDO::FETCH_OBJ)) 
                        {
                            echo '<option value="'.$liste_match->id_match.'">'.$liste_match->date_match."-->".$liste_match->nom_e1. "  contre  " .$liste_match->nom_e2.'</option>';
                        }
                        ?>
                    
                </select>
                
            </p>
            
            <?php
                
                if (isset($_POST['liste_match']))
                {
                // L'élément "list" existe bien
                   $idMatch = $_POST['liste_match'];
                   $req_matchChoisi= $bdd->query("$req_tableEquipeMatch WHERE m.id_match = $idMatch"); 
                   $equipe_match = $req_matchChoisi->fetch(PDO::FETCH_OBJ);
                   $e1 = $equipe_match->nom_e1;
                   $e2 = $equipe_match->nom_e2;
                }   
                
            ?>
       
            <p>                
                </br>Saisir le score :</br>
                <label id='titi'><?php if (isset($_POST['liste_match'])) echo $e1 ?></label>
                <input class="contact" size="2" style="width:20px" type="text" name="score1"> -
                <input class="contact" size="2" style="width:20px" type="text" name="score2">
                <label><?php if (isset($_POST['liste_match'])) echo $e2 ?></label>
            </p>
            
            <p>
            	<span>Match annulé</span>
            	<input class="checkbox" type="checkbox" name="match_annule" value="" />
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

    // ajouter un champ avec son "name" propre;
    function fctSubmit(){
        document.forms['form_co'].submit(); 
        var toto = document.getElementById('liste_Match');
//        toto[0].value= 'faite '; 
//        toto[0].textContent= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'; 
//        var toto = document.getElementById('titi');
//        titi.value = 

        console.log("+++++++", toto.value)
    }
     
   /*********** Fin fonction ajouter champ *************/
  
</script>
<?php
	
        
	if (isset($_GET['ajout']))
	{
		
		 if (isset($_GET['saison']) && isset($_GET['lequipe']) && isset($_GET['date']))
		 {
		 	 $saison 		= $_GET['saison'];
			 $lequipe 		= $_GET['lequipe'];
			 $date   		= $_GET['date'];  
		 } 
	
		 if(isset($_GET['code_domicile']))
		 {
		 	$equipeExt = $lequipe;
			$equipeDom = $equipeSes;
		 }
		 else
		 {
		 	$equipeDom = $lequipe;
			$equipeExt = $equipeSes;
			
		 
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


