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
		$login = $_SESSION['login'];
		$req_adherent = $bdd->query ("SELECT * FROM adherent WHERE login_adherent = '$login'");	
		$infos_adherent = $req_adherent->fetch(PDO::FETCH_OBJ);
		$id = $infos_adherent->id_adherent;
		$nom = $infos_adherent->nom_adherent;		
		$prenom = $infos_adherent->prenom_adherent;	
		$date_naissance = explode("-" , $infos_adherent->date_naissance_adherent);
		$annee = $date_naissance[0];
		$mois = $date_naissance[1];
		$jour = $date_naissance[2];
		$datenaissance = $jour."/".$mois."/".$annee;
		$telephone = $infos_adherent->telephone_adherent;	
		$telephone2 = $infos_adherent->telephone2_adherent;	
		$telephone3 = $infos_adherent->telephone3_adherent;	
		$mail = $infos_adherent->mail_adherent;			 
		/************ Fin Requetes  ************/
	?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Mon profil</h1>
       
        <!------ Début Formulaire ------- -->

         <form  id="form_co" name="form_co" method="GET" action="" onsubmit="return verification_form()" >
          <div class="form_settings">
          
                       
            <p>
            	<span>Nom</span>
            	<input class="contact" type="text" name="nom" id="nom" value="<?php echo $nom; ?>" />
            	<label class="error" id="nom_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Prénom </span>
            	<input class="contact" type="text" name="prenom" id="prenom" value="<?php echo $prenom; ?>" />
            	<label class="error" id="prenom_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Date de naissance </span>
            	<input class="contact" type="text" name="datenaissance" id="datenaissance" value="<?php echo $datenaissance;?>" /> 
            	<label class="error" id="date_error">Erreur sur ce champs</label>  
            </p>
            </br>
            
            <p>
            	<span>Adresse Postale</span>
				<input class="contact" type="text" name="adresse" id="adresse" value="<?php echo $adresse;?>" />
            	<label class="error" id="adresse_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Code postale</span>
				<input class="contact" maxlength="5" type="text" name="cp" id="cp" value="<?php echo $cp;?>" />
            	<label class="error" id="cp_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Ville</span> 
				<input class="contact" type="text" name="ville" id="ville" value="<?php echo $ville;?>" />
            	<label class="error" id="ville_error">Erreur sur ce champs</label>  
            </p>
            </br>
            <p>
            	<span>Téléphones Mobile</span>
				<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone" id="telephone" value="<?php echo $telephone;?>" />
            	<label class="error" id="tel_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
                <span>Téléphone</span>
            	<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone2" id="telephone2" value="<?php echo $telephone2;?>" />
            	<label class="error" id="tel2_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
                <span>Autre numéro</span>
            	<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone3" id="telephone3" value="<?php echo $telephone3;?>" />            	
            	<label class="error" id="tel3_error">Erreur sur ce champs</label>  
            </p>
            </br>
            <p>
            	<span>Adresse mail</span>
				<input class="contact" type="text" name="mail" id="mail" value="<?php echo $mail;?>" />
            	<label class="error" id="mail_error">Erreur sur ce champs</label>  
            </p>
            </br>
            <p><a style="text-decoration:underline" HREF="modif_mdp.php?&id_adherent=<?php echo $id;?> ">Modifier son mot de passe </a></p>

            
            <p style="padding-top: 15px"><span>&nbsp;</span>
            <input class="submit" type="submit" name="inscription" id="inscription" value="Modifier" /></p>
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
  <script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
  $('.error').hide(); 
   var testPseudo = false;
  function verification_form()
  {
  	
  	
  	$('.error').hide();  
  	var argument = "";
	var equipe = $('#equipe option:selected').val();
	var nom = $("input#nom").val();  
	var prenom = $("input#prenom").val(); 
	var pseudo = $("input#pseudo").val(); 
    var pass = $("input#pass").val(); 
	var pass2 = $("input#pass2").val(); 
	var mail = $("input#mail").val(); 
	var mail2 = $("input#mail2").val(); 
	var adresse = $("input#adresse").val(); 
	var cp = $("input#cp").val(); 
	var ville = $("input#ville").val(); 
	var tel = $("input#telephone").val(); 
	var date = $("input#date").val();  
	var tel2 = $("input#telephone2").val(); 
	var tel3 = $("input#telephone3").val();  
		     
	   
	//argument += "equipe=" + equipe  
	
	if (nom == "") 
	{  
		$("label#nom_error").show();  
		$("input#nom").focus();  
		return false;  
	}  
	//argument += "&nom=" + nom  
	
	if (prenom == "") 
	{  
		$("label#prenom_error").show();  
		$("input#prenom").focus();  
		return false;  
	}  
	//argument += "&prenom=" + prenom  
   
	if (mail == "" || !verifiermail(mail)) 
	{  
		$("label#mail_error").show();  
		$("input#mail").focus();  
		return false;  
	}  
		      
	if (adresse == "") 
	{  
		$("label#adresse_error").show();  
		$("input#adresse").focus();  
		return false;  
	}  
   //argument += "&adresse=" + adresse  
		      
   if (cp == "") 
   {  
   		$("label#cp_error").show();  
		$("input#cp").focus();  
		return false;  
	} 
	//argument += "&cp=" + cp  
	
	if (ville == "") 
	{  
		$("label#ville_error").show();  
		$("input#ville").focus();  
		return false;  
	} 
	 //argument += "&ville=" + ville  
		     
	if (tel == "") 
	{  
		$("label#tel_error").show();  
		$("input#telephone").focus();  
		return false;  
	}
	
	//argument += "&tel=" + tel + "&date=" + date + "&tel2" + tel2 + "&tel3" + tel3	  
  }
  
  
	  $(document).ready(function() {
		  $('ul.sf-menu').sooperfish();
		  $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
		  
	   });

		function verifInt() 
		{	
		
		}
		
		function verifiermail(mail) 
		{
			if ((mail.indexOf("@")>=0)&&(mail.indexOf(".")>=0)) 
			{
				return true 
			} 
			else 
			{
				//alert("Mail invalide !");
				return false
			}
		}
		
				
		
  </script>
  <?php		
  		/*********************** CONTROLE DES VALEURS ************************/
		if( isset($_GET['inscription']) )
		{
			$today = ('Y-m-d');
			$message = null;
	
			if(isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['datenaissance']) )
			{
				$nom=$_GET['nom'];
				$equipe=$_GET['equipe'];
				$prenom=$_GET['prenom'];
				$pseudo=$_GET['pseudo'];
				$pass=$_GET['pass'];
				$datenaissance=$_GET['datenaissance'];
			    $dat = explode("/",$datenaissance);
			    $annee = $dat[2];
				$mois = $dat[1];
				$jour = $dat[0];

			}	
				
			if(isset($_GET['adresse']) && isset($_GET['cp']) && isset($_GET['ville']) && isset($_GET['tel']) && isset($_GET['tel2']) && isset($_GET['tel3']) && isset($_GET['mail']))
			{
				$adresse=$_GET['adresse'];
				$cp=$_GET['cp'];
				$ville=$_GET['ville'];
				$telephone=$_GET['tel'];
				$telephone2=$_GET['tel2'];
				$telephone3=$_GET['tel3'];
				$mail=$_GET['mail'];
			}
			/*********************** FIN CONTROLE DES VALEURS ************************/
		
		

			/*********************** CONSTRUCTION ET ENVOI DE LA REQUETE ************************/
		
				$insertion="UPDATE adherent SET nom_adherent = '$nom', prenom_adherent='$prenom', rue_adherent='$adresse', code_postale_adherent='$cp',bureau_distributeur_adherent='$ville' ,telephone_adherent='$telephone',telephone2_adherent='$telephone2',telephone3_adherent='$telephone3', mail_adherent='$mail', date_naissance_adherent = '".$annee."-".$mois."-".$jour."', dernier_modif='$today' WHERE id_adherent='$id'";
			
             	
             	
             	$inser_exec = $bdd->exec($insertion);
						
	         	
		
			 			 header('Location:index.php');
	}
	         
?>
		 

  
</body>
</html>
