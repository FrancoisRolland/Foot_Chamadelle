<?php
	session_start();
	include('connexion.php');
        //header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
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
		$derniere_modif = explode("-" , $infos_adherent->dernier_modif);
		$dermodifannee = $derniere_modif[0];
		$dermodifmois = $derniere_modif[1];
		$dermodifjour = $derniere_modif[2];
		$datedernieremodif = $dermodifjour."/".$dermodifmois."/".$dermodifannee;
                $password_Adherent = $infos_adherent->pass_adherent;
                $pass1 = md5($password_Adherent);
		/************ Fin Requetes  ************/
		
                
    ?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Mon profil</h1>
       
        <!------ Début Formulaire ------- -->

        <form  id="form_co" name="form_co" method="POST" action="profil_post.php" onsubmit="return verification_form()" >
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
            	<span>Téléphone Mobile</span>
		<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone" id="telephone" value="<?php echo $telephone;?>" />
            	<label class="error" id="tel_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
                <span>Téléphone fixe</span>
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
            <p>
            	<span>Pseudo</span>
                <input class="pseudo" type="text" name="pseudo" value="<?php echo $login;?>" disabled="disabled" />
            </p>
            </br>
            
            <!------ Modification du mot de passe ---->
            <p>
            </br>
                <a  style="cursor:pointer" title="Cliquez sur le lien pour changer le mot de passe" onclick="plus()">Modifier son mot de passe </a>
            </br>
                <span style="display:none" id="labelpass1">Nouveau mot de passe</span>
                <input type="password" name="pass1" style="display:none" id="pass1" value="<?php echo $pass1;?>"/>
                <span style="display:none" id="labelpass2">Confirmation mot de passe</span>
                <input type="password" name="pass2" style="display:none" id="pass2" value="<?php echo $pass1;?>"/>
                <label class="error" id="pass2_error">Mot de passe différent</label>
            </br>

                <!-----<a style="text-decoration:underline" HREF="modif_mdp.php?&id_adherent=<?php echo $id;?> ">Modifier son mot de passe </a></p>----->
            <p>
                
            <!--<div id="cadre" style="margin-left:100px;width:200px">
            </div>-->
              
            	<span>Dernière modification</span>
                <input type="text" name="datedernieremodif" value="<?php echo $datedernieremodif;?>" disabled="disabled" />
            </p>
            <p>
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
            </p>        
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
   var c,c2, ch1, ch2;
   var pass1 = $("input#pass1").val(); 
   var pass2 = $("input#pass2").val(); 
	
 
    // ajouter un champ avec son "name" propre;
    function plus(){
    
    document.getElementById('labelpass1').style.display='inline';
    document.getElementById('labelpass2').style.display='inline';
    document.getElementById('pass1').style.display='inline';
    document.getElementById('pass1').value="";
    document.getElementById('pass2').style.display='inline';
    document.getElementById('pass2').value="";
    
    //c.appendChild(ch1);
    //c.appendChild(ch2);
    
    }
     
   /*********** Fin fonction ajouter champ *************/
  
  function verification_form()
  {
  	$('.error').hide();  
  	var argument = "";
	var equipe = $('#equipe option:selected').val();
	var nom = $("input#nom").val();  
	var prenom = $("input#prenom").val(); 
	var pseudo = $("input#pseudo").val(); 
        var mail = $("input#mail").val(); 
	var mail2 = $("input#mail2").val(); 
	var adresse = $("input#adresse").val(); 
	var cp = $("input#cp").val(); 
	var ville = $("input#ville").val(); 
	var tel = $("input#telephone").val(); 
	var tel2 = $("input#telephone2").val(); 
	var tel3 = $("input#telephone3").val();  
	var date = $("input#date").val();  
        var pass1 = $("input#pass1").val(); 
        var pass2 = $("input#pass2").val(); 
	
	//argument += "equipe=" + equipe  
	
	if (nom === "") 
	{  
		$("label#nom_error").show();  
		$("input#nom").focus();  
		return false;  
	}  
	//argument += "&nom=" + nom  
	
	if (prenom === "") 
	{  
		$("label#prenom_error").show();  
		$("input#prenom").focus();  
		return false;  
	}  
	//argument += "&prenom=" + prenom  
   
	if (mail === "" || !verifiermail(mail)) 
	{  
		$("label#mail_error").show();  
		$("input#mail").focus();  
		return false;  
	}  
		      
	if (adresse === "") 
	{  
		$("label#adresse_error").show();  
		$("input#adresse").focus();  
		return false;  
	}  
   //argument += "&adresse=" + adresse  
		      
        if (cp === "") 
        {  
   		$("label#cp_error").show();  
		$("input#cp").focus();  
		return false;  
	} 
	//argument += "&cp=" + cp  
	
	if (ville === "") 
	{  
		$("label#ville_error").show();  
		$("input#ville").focus();  
		return false;  
	} 
	 //argument += "&ville=" + ville  
		     
	if (tel === "") 
	{  
		$("label#tel_error").show();  
		$("input#telephone").focus();  
		return false;  
	}
	
	/*if (tel2 == "") 
	{  
		$("label#tel2_error").show();  
		$("input#telephone2").focus();  
		return false;  
	}

	if (tel3 == "") 
	{  
		$("label#tel3_error").show();  
		$("input#telephone3").focus();  
		return false;  
	}*/
	//argument += "&tel=" + tel + "&date=" + date + "&tel2" + tel2 + "&tel3" + tel3	  
        
        if (pass1 !== pass2) 
	{                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
            $("label#pass2_error").show();  
            $("input#pass2").focus();  
            return false;  
	}
        else 
        {
            pass2 === pass1;
            alert("Modification reussie");
        }    
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
        		
	
</html>
