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
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
  
  <script>
   $(function() {
  		//$( "#new_date" ).datepicker();
  	});
  </script>
</head>

<body>	
  <div id="main">
   
   <?php
   		include('header.php');
   
   		/*********** Variables *************/
		
		$ToD = date('Ymd'); // date du jour
		
		/********** FIn Variables ********/
	
	
		/************ Requetes  ************/
		if(!isset($_SESSION['id_equipe']))
		{
			$req_prochaine_journee=$bdd->query("SELECT * from `match` WHERE (date_match-$ToD)>0 order by date_match LIMIT 1");
			$prochaine_journee = $req_prochaine_journee->fetch(PDO::FETCH_OBJ);
			$proJournee = $prochaine_journee->id_journee;

			$req_match_journee=$bdd->query("SELECT e1.id_equipe as id_e1,
												   e1.nom_equipe as nom_e1,
												   e2.id_equipe as id_e2,
												   e2.nom_equipe as nom_e2,
												   m.id_match,
												   m.date_match 
												   FROM `match` m 
												   JOIN equipe as e1 ON e1.id_equipe = m.id_equipe_dom 
												   JOIN equipe as e2 ON e2.id_equipe = m.id_equipe 
												   WHERE (m.date_match-$ToD) > 0 AND m.id_journee = $proJournee
												   order by m.date_match");
												 	

		
		}
		else
		{
			$equipe_co = $_SESSION['id_equipe'];
			$id_adherent = $_SESSION['id_adherent'];
			
			
			$req_match_journee=$bdd->query("SELECT e1.id_equipe as id_e1,
										   e1.nom_equipe as nom_e1,
										   e2.id_equipe as id_e2,
										   e2.nom_equipe as nom_e2,
										   m.id_match,
										   m.date_match 
										   FROM `match` m 
										   JOIN equipe as e1 ON e1.id_equipe = m.id_equipe_dom 
										   JOIN equipe as e2 ON e2.id_equipe = m.id_equipe 
										   WHERE (m.date_match-$ToD) > 0 
										   AND (m.id_equipe_dom = $equipe_co OR m.id_equipe = $equipe_co)
										   order by m.date_match");
										   			
							    
					  
		}
	
		/************ Fin Requetes  ************/
	?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      
	

      <div class="content">
		   <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/browser.png" alt="home" /><h1 style="margin: 15px 0 0 0;">Calendrier</h1>
		  
		  <!--   Div de modification de match -->
		  <div id="modification_match" style="visibility:hidden" class="form_modif" >
		  	
		  </div>
		  <!--   Fin Div de modification de match -->
		
		   
		   
        <!------ Calendrier -------->
				<table id="hor-minimalist-b" summary="Employee Pay Sheet">
				    <thead>
				    	<tr>
				        	<th scope="col">Date</th>
				            <th scope="col"></th>
				            <th scope="col">Score</th>
				            <th scope="col"></th>
				            <th scope="col">Statut</th>
				            <?php
				              if(isset($_SESSION['id_adherent']))
						      {
								  echo'<th scope="col"></th>';
								  if($_SESSION['top_admin'] == 1)
								  {
								  	echo'<th scope="col"></th>';
								  	echo'<th scope="col"></th>';
								  }
							   }
				            
				            ?>
				        </tr>
				    </thead>
				    <tbody>
				    	
				    	<?php
				    		while ($match_journee = $req_match_journee->fetch(PDO::FETCH_OBJ)) 
				    		{
				    			$explo = explode("-",$match_journee->date_match);
								$dateMatch = $explo[2]."/".$explo[1]."/".$explo[0];
							
								echo '<tr>';				    			
						        	echo '<td>'.$dateMatch.'</td>';
						            echo '<td>'.$match_journee->nom_e1.'</td>';
						            echo '<td>-</td>';
						            echo '<td>'.$match_journee->nom_e2.'</td>';
						            echo '<td></td>';
						            if(isset($_SESSION['id_adherent']))
						            {
							           echo '<td><a style="cursor:pointer" HREF="participation.php?&num='.$match_journee->id_match.'"><img alt="" src="picto/bouton_participe.png" /></a></td>';
									   if($_SESSION['top_admin'] == 1)
									   {
										   echo '<td><img style="cursor:pointer"  onclick="suppression('.$match_journee->id_match.')" alt="" src="picto/bouton_supprime.png" /></td>';
										   echo '<td><a href="#modification_match"><img style="cursor:pointer"  onclick="modification('.$match_journee->id_match.')" alt="" src="picto/bouton_modifie.png" /></a></td>';
									   }
						            }
						            
						       echo '</tr>';
					        }
				        ?>
				    </tbody>
				</table>
				<!------- Fin Calendrier -->
        
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

    function suppression(str)
    {
    	if(!confirm("Voulez vous supprimer ce match ?"))return;

    	if (str=="")
    	{
    		alert("Aucun match sélectionné.")
    		return;
    	} 
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
    			alert("Suppression reussie.")
    			document.location.replace("index.php");	

    		}
    	}
    	xmlhttp.open("GET","suppression.php?match="+str,true);
    	xmlhttp.send();
    }
    	
    function modification(str)
    {
	   	console.log("la");
	   	
    	if (str=="")
    	{
    		alert("Aucun match sélectionné.")
    		return;
    	} 
    	if (window.XMLHttpRequest)
    	{// code for IE7+, Firefox, Chrome, Opera, Safari
	    	console.log("ici");
    	  xmlhttp=new XMLHttpRequest();
    	}
    	else
    	{// code for IE6, IE5
	    	
    	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    	}
    	xmlhttp.onreadystatechange=function()
    	{
	    		console.log(xmlhttp.readyState);
	    		
    		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
	    		console.log("la");
	    		//console.log(responseText);
    			document.getElementById("modification_match").innerHTML=xmlhttp.responseText;
    			document.getElementById("modification_match").style.visibility = "visible";
    		}
    	}
    	xmlhttp.open("GET","modification.php?match="+str,true);
    	xmlhttp.send();
    }
    
    function quitter() 
    {
	   if (!confirm("Voulez-vous quitter la modification du match ?"))return;
	   document.getElementById("modification_match").style.visibility = "hidden"; 
    }
  </script>
</body>
</html>
