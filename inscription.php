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
		
		$req_liste_equipes = $bdd->query("SELECT * FROM equipe");
				
				 
		/************ Fin Requetes  ************/
	?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Inscription</h1><h4>* Champs obligatoires</h4>
       
        <!------ Début Formulaire ------- -->

         <form  id="form_co" name="form_co" method="GET" action="" onsubmit="return verification_form()" >
          <div class="form_settings">
          
           <p>
            	<span>Equipe *</span>
            	<select class="contact" name="equipe" id="equipe" required >
            		<option name="id_equipe" id="id_equipe" value="null" selected>---Choisir son equipe---</option>
					<?php
					 	while ($liste_equipes = $req_liste_equipes->fetch(PDO::FETCH_OBJ)) 
				    	{
				    		echo '<option name="id_equipe" value="'.$liste_equipes->id_equipe.'">'.$liste_equipes->nom_equipe.'</option>';
				    	}
					?>
				</select>
				<label class="error" id="equipe_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Nom *</span>
            	<input class="contact" type="text" name="nom" id="nom"  />
            	<label class="error" id="nom_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Date de naissance </span>
            	<input class="contact" type="text" name="date" id="date"  /> (sous forme 25/11/1991)
            	<label class="error" id="date_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Prénom *</span>
            	<input class="contact" type="text" name="prenom" id="prenom"  />
            	<label class="error" id="prenom_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Pseudo *</span>
            	<input class="contact" type="text" onBlur="verif_pseudo(this.value)" name="pseudo" id="pseudo"  />
            	<label class="error" id="pseudo_error">Erreur sur ce champs</label> 
            	<label class="error" id="pseudo_error2">Pseudo déjà utilisé</label>  
            </p>

            <p>
            	<span>Mot de passe *</span>
				<input class="contact" type="password" name="pass" id="pass"  />
            	<label class="error" id="pass_error">Erreur sur ce champs</label>  
            </p>

            <p>
            	<span>Confirmation mot de passe *</span>
				<input class="contact" type="password" name="pass2" id="pass2"  />
            	<label class="error" id="pass2_error">Erreur sur ce champs</label>  
            </p>

            <p>
            	<span>Adresse mail *</span>
				<input class="contact" type="text" name="mail" id="mail"  />
            	<label class="error" id="mail_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Confirmation Adresse mail *</span>
				<input class="contact" type="text" name="mail2" id="mail2"  />
            	<label class="error" id="mail2_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Adresse Postale *</span>
				<input class="contact" type="text" name="adresse" id="adresse"  />
            	<label class="error" id="adresse_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Code postale *</span>
				<input class="contact" maxlength="5" type="text" name="cp" id="cp"  />
            	<label class="error" id="cp_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
            	<span>Ville *</span> 
				<input class="contact" type="text" name="ville" id="ville"  />
            	<label class="error" id="ville_error">Erreur sur ce champs</label>  
            </p>
            <p>
            	<span>Téléphones Mobile *</span>
				<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone" id="telephone"  />
            	<label class="error" id="tel_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
                <span>Téléphone</span>
            	<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone2" id="telephone2" />
            	<label class="error" id="tel2_error">Erreur sur ce champs</label>  
            </p>
            
            <p>
                <span>Autre numéro</span>
            	<input class="contact" onkeypress="verifInt()" maxlength="10" type="text" name="telephone3" id="telephone3" />            	
            	<label class="error" id="tel3_error">Erreur sur ce champs</label>  
            </p>
            
            <p style="padding-top: 15px"><span>&nbsp;</span>
            <input class="submit" type="submit" name="inscription" id="inscription" value="S'inscrire" /></p>
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
		     
	if (equipe == "null") 
	{  
		$("label#equipe_error").show();  
		$("#equipe").focus();  
		return false;  
	}       
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
      
    if (pseudo == "") 
	{  
		$("label#pseudo_error").show();  
		$("input#pseudo").focus();  
		return false;  
	} 
	
	//argument += "&pseudo=" + pseudo   
	
	if (pass == "") 
	{  
		$("label#pass_error").show();  
		$("input#pass").focus();  
		return false;  
	}  
	
	if (pass2 == "") 
	{  
		$("label#pass2_error").show();  
		$("input#pass2").focus();  
		return false;  
	}  

	if(pass != pass2)
	{
		alert("Mots de passe différents")
		$("label#pass_error").show(); 
		$("label#pass2_error").show(); 
		$("input#pass").focus(); 
		return false;
	}
	//argument += "&pass=" + pass  
	
	if (mail == "" || !verifiermail(mail)) 
	{  
		$("label#mail_error").show();  
		$("input#mail").focus();  
		return false;  
	}  
	if (mail2 == "") 
	{  
		$("label#mail2_error").show();  
		$("input#mail2").focus();  
	  	return false;  
	 }  
	if(mail != mail2)
	{
		alert("Adresses mail différentes")
		$("label#mail_error").show(); 
		$("label#mail2_error").show(); 
		$("input#mail").focus(); 
		return false;
	}
	//argument += "&mail=" + mail  
		      
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
		
				
		
		function verif_pseudo(str)
		{
			if (window.XMLHttpRequest)
	    	{// code for IE7+, Firefox, Chrome, Opera, Safari
	    	  xmlhttp=new XMLHttpRequest();
	    	}
	    	else
	    	{// code for IE6, IE5
	    	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	    	}
	    	xmlhttp.onreadystatechange=function()
	    	{
	    		
	    		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    		{	
	    			
	    			if (xmlhttp.responseText == "non")
	    			{
	    				$("label#pseudo_error").hide();
						$("label#pseudo_error2").show();  
						$("input#pseudo").focus();
						return false;  
	    			} 
	    			else
	    			{
						$("label#pseudo_error2").hide();  		    			
	    			}
				}
	    	}
	    	xmlhttp.open("GET","dataInscription.php?pseudo="+str,true);
	    	xmlhttp.send();

	    }
  </script>
  <?php		
  		/*********************** CONTROLE DES VALEURS ************************/
		if( isset($_GET['inscription']) )
		{
			$today = ('Y-m-d');
			$message = null;
	
			if(isset($_GET['nom']) && isset($_GET['equipe']) && isset($_GET['prenom']) && isset($_GET['pseudo']) && isset($_GET['pass']) && isset($_GET['date']) )
			{
				$nom=$_GET['nom'];
				$equipe=$_GET['equipe'];
				$prenom=$_GET['prenom'];
				$pseudo=$_GET['pseudo'];
				$pass=$_GET['pass'];
				$date=$_GET['date'];
			    $dat = explode("/",$date);

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
		
			 mysql_query("SET NAMES 'utf8'");
	         // Pr�paration des donn�es pour les requ�tes � l'aide de la fonction mysql_real_escape_string
	         $pseudo = mysql_real_escape_string($pseudo);
	         $password = mysql_real_escape_string(md5($pass));
	   
	   
	         // Requ�te pour compter le nombre d'enregistrements r�pondant � la clause : champ du pseudo de la table = pseudo GET� dans le formulaire
	         $requete = "SELECT count(*) as nb FROM adherent WHERE login_adherent = '".$pseudo."'";
	   
	         // Ex�cution de la requ�te
	         $req_exec = $bdd->query($requete) or die(mysql_error());
	   
	         // Cr�ation du tableau associatif du r�sultat
	         $resultat = $req_exec->fetch(PDO::FETCH_OBJ);
	         
	         // nb est le nom de l'allias associ� � count(*) et retourne le r�sultat de la requ�te dans le tableau $resultat;
	         if (isset($resultat->nb) && $resultat->nb == 0)
	         // R�sultat du comptage = 0 pour ce pseudo, on peut donc l'enregistrer
	         {

					$inser_exec = $bdd->exec("INSERT INTO adherent(id_adherent, id_equipe , nom_adherent, prenom_adherent, login_adherent, pass_adherent, rue_adherent, code_postale_adherent,bureau_distributeur_adherent, telephone_adherent,telephone2_adherent,telephone3_adherent, mail_adherent, date_naissance_adherent, photo, actif_adherent, top_admin,dernier_modif,top_master) VALUES ('',$equipe,'$nom','$prenom','$pseudo','$password','$adresse','$cp','$ville','$telephone','$telephone2','$telephone3','$mail','".$dat[2]."-".$dat[1]."-".$dat[0]."','',1,0,'$today',0)");
						
	         	
	             // Ex�cution de la requ�te d'insertion
	             //$inser_exec = $bdd->exec($insertion);
	             $numAdherent = $bdd->lastInsertId();
	          
	             /* Si l'insertion s'est faite correctement (une requ�te d'insertion retourne "true" en cas de succ�s, je peux donc utiliser
	             l'op�rateur de comparaison strict '==='  c.f. http://fr.php.net/manual/fr/language.op ... arison.php) */
	             if ($inser_exec === 1)
	             {
			
	             	$insert_particip = $bdd->query("SELECT DISTINCT match.id_match FROM participation_match,`match` WHERE participation_match.id_match = match.id_match AND (TO_DAYS(date_match)-TO_DAYS(Now()))>0");
	
	
	             	while ($insertion_adherent = $insert_particip->fetch(PDO::FETCH_OBJ))
	             	{
		             	$numMatch = $insertion_adherent->id_match;
		             	$requeteInsertion = "INSERT INTO participation_match VALUES ($numMatch,$numAdherent,'null','null')";
		             	$bdd->query($requeteInsertion);
		             }
	                 /* D�marre la session et enregistre le pseudo dans la variable de session $_SESSION['login']
	                 qui donne au visiteur la possibilit� de se connecter.  */
	                 	           
	             }  
	              ?>
	             <script>
		             alert("Inscription reussie! Vous pouvez vous connecter maintenant.")
		             document.location.replace("se_connecter.php");
	             </script>
	             <?php	
	         }
	         else
	         {   
	             ?>
	             <script>
		             alert("Inscription Impossible. Changez de pseudo !")
	             </script>
	             <?php
			 }
		}
?>
		 

  
</body>
</html>
