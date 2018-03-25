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
		$req_adherent = $bdd->query ("SELECT * FROM adherent WHERE id_adherent ='".$_GET['num']."'");	
		$infos_adherent = $req_adherent->fetch(PDO::FETCH_OBJ);
		$id = $infos_adherent->id_adherent;
		$login = $infos_adherent->login_adherent;		
		$nom = $infos_adherent->nom_adherent;		
		$prenom = $infos_adherent->prenom_adherent;	
		$villeAd = $infos_adherent->bureau_distributeur_adherent;
		$cpAd = $infos_adherent->code_postale_adherent;
		$adresseAd = $infos_adherent->rue_adherent;
		$date_naissance = explode("-" , $infos_adherent->date_naissance_adherent);
		$annee = $date_naissance[0];
		$mois = $date_naissance[1];
		$jour = $date_naissance[2];
		$datenaissance = $jour."/".$mois."/".$annee;
		$telephone = $infos_adherent->telephone_adherent;	
		$telephone2 = $infos_adherent->telephone2_adherent;	
		$telephone3 = $infos_adherent->telephone3_adherent;	
		$mail = $infos_adherent->mail_adherent;		
		$derniere_modif = explode("-", $infos_adherent->dernier_modif);
                $dermodifannee = $derniere_modif[0];
		$dermodifmois = $derniere_modif[1];
		$dermodifjour = $derniere_modif[2];
		$date_derniere_modif = $dermodifjour."/".$dermodifmois."/".$dermodifannee;
	 
		/************ Fin Requetes  ************/
    ?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Consultation de <? echo $prenom.' '.$nom; ?></h1>
       
        <!------ Début Formulaire ------- -->

         <form  id="form_co" name="form_co" method="GET" action=""  >
          <div class="form_settings">
          
                       
            <p>
            	<span>Nom</span>
            	<input class="contact" type="text" disabled name="nom" id="nom" value="<?php echo $nom; ?>" />
            </p>
            
            <p>
            	<span>Prénom </span>
            	<input class="contact" type="text" disabled name="prenom" id="prenom" value="<?php echo $prenom; ?>" />
            </p>
            
            <p>
            	<span>Date de naissance </span>
            	<input class="contact" type="text" disabled name="datenaissance" id="datenaissance" value="<?php echo $datenaissance;?>" /> 
            </p>
            </br>
            
            <p>
            	<span>Adresse Postale</span>
				<input class="contact" type="text" disabled name="adresse" id="adresse" value="<?php echo $adresseAd;?>" />
            </p>
            
            <p>
            	<span>Code postale</span>
				<input class="contact" maxlength="5" disabled type="text" name="cp" id="cp" value="<?php echo $cpAd;?>" />
            </p>
            
            <p>
            	<span>Ville</span> 
				<input class="contact" type="text" disabled name="ville" id="ville" value="<?php echo $villeAd;?>" />
            </p>
            </br>
            <p>
            	<span>Téléphones Mobile</span>
				<input class="contact" disabled maxlength="10" type="text" name="telephone" id="telephone" value="<?php echo $telephone;?>" />
            </p>
            
            <p>
                <span>Téléphone</span>
            	<input class="contact" disabled maxlength="10" type="text" name="telephone2" id="telephone2" value="<?php echo $telephone2;?>" />
            </p>
            
            <p>
                <span>Autre numéro</span>
            	<input class="contact" disabled maxlength="10" type="text" name="telephone3" id="telephone3" value="<?php echo $telephone3;?>" />            	
            </p>
            </br>
            <p>
            	<span>Adresse mail</span>
				<input class="contact" type="text" disabled name="mail" id="mail" value="<?php echo $mail;?>" />
            </p>
            </br>
            <p>
            	<span>Date dernière modif</span>
				<input class="contact" type="text" disabled name="date_derniere_modif" id="date_derniere_modif" value="<?php echo $date_derniere_modif;?>" />
            </p>
            </br>
            
            
            
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
  	         

		 

  
</body>
</html>
