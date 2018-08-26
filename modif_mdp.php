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
   	
		/************ Requetes  ************/
		$idA = $_GET['id_adherent'];
  
	  	$requete = $bdd->query("SELECT * FROM adherent WHERE id_adherent = $idA");
	  	$infos_adherent = $requete->fetch(PDO::FETCH_OBJ);
	  	
	  	if(isset($_POST['ancien_pass']))
		{
			$ancien_pass=$_POST['ancien_pass'];
		}	
		
		if(isset($_POST['nouveau_pass']))
		{
			$nouveau_pass=$_POST['nouveau_pass'];
		}		
		
		if(isset($_POST['nouveau_pass2']) )
		{
		 	$nouveau_pass2=$_POST['nouveau_pass2'];
		}
		
		if(isset($_POST["changement_mdp"]))
		{
			if($infos_adherent["pass_adherent"] != md5($ancien_pass))
			{
				?>
				<script>alert("Ancien mot de passe incorrect")</script>
				<?php
			}
			else
			{
				if($nouveau_pass != $nouveau_pass2)
				{
					?>
					<script>alert("Les mots de passe sont différents")</script>
					<?php
				}
				else
				{
					$new_pass = md5($nouveau_pass);
					$req = "UPDATE adherent SET pass_adherent = '$new_pass' WHERE id_adherent = $idA";
					mysql_query($req);
					?>
					<script>alert("Modification reussie")</script>
					<?php
					header('Location: modification_profil.php');
				}
			}
		}	 
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
            	<input class="contact" type="text" name="nom" id="nom" value="<?=$nom?>" />
            	<label class="error" id="nom_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Prénom </span>
            	<input class="contact" type="text" name="prenom" id="prenom" value="<?=$prenom?>" />
            	<label class="error" id="prenom_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Date de naissance </span>
            	<input class="contact" type="text" name="datenaissance" id="datenaissance" value="<?=$datenaissance?>" /> 
            	<label class="error" id="date_error">Erreur sur ce champs</label>  
            </p>
            </br>
            
            <p>
            	<span>Adresse Postale</span>
				<input class="contact" type="text" name="adresse" id="adresse" value="<?=$adresse?>" />
            	<label class="error" id="adresse_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Code postale</span>
				<input class="contact" maxlength="5" type="text" name="cp" id="cp" value="<?=$cp?>" />
            	<label class="error" id="cp_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Ville</span> 
				<input class="contact" type="text" name="ville" id="ville" value="<?=$ville?>" />
            	<label class="error" id="ville_error">Erreur sur ce champs</label>  
            </p>
            </br>
            <p>
            	<span>Téléphones Mobile</span>
				<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone" id="telephone" value="<?=$telephone?>" />
            	<label class="error" id="tel_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
                <span>Téléphone</span>
            	<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone2" id="telephone2" value="<?=$telephone2?>" />
            	<label class="error" id="tel2_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
                <span>Autre numéro</span>
            	<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone3" id="telephone3" value="<?=$telephone3?>" />            	
            	<label class="error" id="tel3_error">Erreur sur ce champs</label>  
            </p>
            </br>
            <p>
            	<span>Adresse mail</span>
				<input class="contact" type="text" name="mail" id="mail" value="<?=$mail?>" />
            	<label class="error" id="mail_error">Erreur sur ce champs</label>  
            </p>
            </br>
            <p>
            	<span>Pseudo</span>
				<input class="contact" type="text" name="pseudo" id="pseudo" value="<?php echo $login;?>" />
            	<label class="error" id="pseudo_error">Erreur sur ce champs</label>  
            </p>
            <p>
            	<span>Mot de passe</span>
				<input class="contact" maxlength="32" type="text" name="pass" id="pass" value="<?php echo $pass_adherent;?>" />
            	<label class="error" id="pass_error">Erreur sur ce champs</label>  
            </p>
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
    var pass = $("input#pass").val(); 
	var pass2 = $("input#pass2").val(); 
		     
	   
	//argument += "equipe=" + equipe  
	
	if (pass == "") 
	{  
		$("label#nom_error").show();  
		$("input#nom").focus();  
		return false;  
	}  
	//argument += "&nom=" + nom  
	
	if (pass2 == "") 
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

	         
		 

  
</body>
</html>
