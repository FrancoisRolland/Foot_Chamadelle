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
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
  <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
  <script>
    $(function() {
         $( "#accordion" ).accordion({
			heightStyle: "content"
			//collapsible: true
		});
       $( "#accordion2" ).accordion({
			heightStyle: "content"
		});

    });
   </script>

</head>

<body>
  <div id="main">
   
   <?php
   		include('header.php');
   	
		/************ Requetes  ************/
		// Id match
		$num_match = $_GET['num'];
		//Id adherent
		$id_adherent = $_SESSION['id_adherent'];
		
		$req_detail_match=$bdd->query("SELECT e1.id_equipe as id_e1,
									   e1.nom_equipe as nom_e1,
									   e2.id_equipe as id_e2,
									   e2.nom_equipe as nom_e2,
									   m.id_match,
									   m.date_match 
									   FROM `match` m 
									   JOIN equipe as e1 ON e1.id_equipe = m.id_equipe_dom 
									   JOIN equipe as e2 ON e2.id_equipe = m.id_equipe 
									   WHERE m.id_match=$num_match");
					
		$detail_match = $req_detail_match->fetch(PDO::FETCH_OBJ);

		// Date Match
		$explo = explode("-",$detail_match->date_match);
		$dateMatch = $explo[2]."/".$explo[1]."/".$explo[0];

		// Id des deux équipes
		$equipeDom = $detail_match->id_e1;
		$equipeExt = $detail_match->id_e2;
		
		// Requete participation joueur
		$req_participe_connect = $bdd->query("SELECT * FROM participation_match where id_adherent = $id_adherent AND id_match='$num_match'");						$participe_connect = $req_participe_connect->fetch(PDO::FETCH_OBJ);
		
		if(sizeof($participe_connect) == 0)
		{
			$choixMatch = "null"; 
			$choixRepas = "null"; 
		}
		else
		{
			echo $participe_connect->top_participation_match;
			if($participe_connect->top_participation_match=="null"){$choixMatch = "null";} 
			if($participe_connect->top_participation_repas=="null"){$choixRepas = "null";} 
			if($participe_connect->top_participation_match=="oui"){$choixMatch = "oui";} 
			if($participe_connect->top_participation_match=="non"){$choixMatch = "non";} 
			if($participe_connect->top_participation_repas=="oui"){$choixRepas = "oui";} 
			if($participe_connect->top_participation_repas=="non"){$choixRepas = "non";} 
		}

		// Requetes equipe domicile
		$req_match_oui_dom = $bdd->query("SELECT * FROM participation_match p, adherent a WHERE a.id_adherent=p.id_adherent AND id_match ='$num_match' AND top_participation_match='oui' AND a.id_equipe=$equipeDom");		
		
		$req_match_non_dom = $bdd->query("SELECT * FROM participation_match p, adherent a WHERE a.id_adherent=p.id_adherent AND id_match ='$num_match' AND top_participation_match='non' AND a.id_equipe=$equipeDom");
		
		$req_repas_oui_dom = $bdd->query("SELECT * FROM participation_match p, adherent a WHERE a.id_adherent=p.id_adherent AND id_match ='$num_match' AND top_participation_repas='oui' AND a.id_equipe=$equipeDom");
		
		$req_incomplet_dom = $bdd->query("SELECT DISTINCT login_adherent,nom_adherent,prenom_adherent,mail_adherent,actif_adherent FROM adherent WHERE actif_adherent = 1 AND id_equipe=$equipeDom AND id_adherent IN (SELECT id_adherent FROM participation_match WHERE  id_match = '$num_match' AND top_participation_match = 'null' OR id_match = '$num_match' AND top_participation_repas = 'null') ");
	
	
	
				

		// Requetes equipe exterieure
		$req_match_oui_ext = $bdd->query("SELECT * FROM participation_match p, adherent a WHERE a.id_adherent=p.id_adherent AND id_match ='$num_match' AND top_participation_match='oui' AND a.id_equipe=$equipeExt");
		
		$req_match_non_ext = $bdd->query("SELECT * FROM participation_match p, adherent a WHERE a.id_adherent=p.id_adherent AND id_match ='$num_match' AND top_participation_match='non' AND a.id_equipe=$equipeExt");
		
		$req_repas_oui_ext = $bdd->query("SELECT * FROM participation_match p, adherent a WHERE a.id_adherent=p.id_adherent AND id_match ='$num_match' AND top_participation_repas='oui' AND a.id_equipe=$equipeExt");
		
		
		$req_incomplet_ext = $bdd->query("SELECT DISTINCT login_adherent,nom_adherent,prenom_adherent,mail_adherent,actif_adherent FROM adherent WHERE actif_adherent = 1 AND id_equipe=$equipeExt AND id_adherent IN (SELECT id_adherent FROM participation_match WHERE  id_match = '$num_match' AND top_participation_match = 'null' OR id_match = '$num_match' AND top_participation_repas = 'null') ");
	

		
					
		/************ Fin Requetes  ************/
	?>
  
  
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

      <div class="content">
        <?php
        echo '<img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Match du '.$dateMatch.' '.$detail_match->nom_e1.' contre '.$detail_match->nom_e2.'</h1>';
		?>
		
		<form action="#" method="post">
          <div class="form_settings">
			  <p><span>Participation au match:</span> 
			  	Oui
			  	<input class="checkbox" type="radio" name="match" value="oui" <?php if($choixMatch=="oui") echo("checked"); ?>/>
			  	Non
			  	<input class="checkbox" type="radio" name="match" value="non" <?php if($choixMatch=="non") echo("checked"); ?>/> 
			  	Je sais pas 
			  	<input class="checkbox" type="radio" name="match" value="null" <?php if($choixMatch=="null") echo("checked"); ?>/>
			  </p>
			  <p><span>Participation au Repas:</span> 
			  	Oui
			  	<input class="checkbox" type="radio" name="repas" value="oui" <?php if($choixRepas=="oui") echo("checked"); ?> />
			  	Non
			  	<input class="checkbox" type="radio" name="repas" value="non" <?php if($choixRepas=="non") echo("checked"); ?> /> 
			  	Je sais pas 
			  	<input class="checkbox" type="radio" name="repas" value="null" <?php if($choixRepas=="null") echo("checked"); ?> />
			  </p>
			  <input class="submit" type="submit" name="validation_participation" value="Valider" />	
          </div>
		</form>
			
		 <div id="accordion" style="margin-top:10px;float:left;width:49%">
		 
			<h2>Participants au Match </h2>
			
			<div>
				<?php
					while ($match_oui_dom = $req_match_oui_dom->fetch(PDO::FETCH_OBJ))
					{
						echo'<li><FONT size="2pt">'.$match_oui_dom->nom_adherent.' - '.$match_oui_dom->prenom_adherent.'</FONT></li>';
					} 
				?>
			</div>
			
			<h2>Participants au Repas</h2>
				<?php
					while ($repas_oui_dom = $req_repas_oui_dom->fetch(PDO::FETCH_OBJ))
					{
						echo'<li><FONT size="2pt">'.$repas_oui_dom->nom_adherent.' - '.$repas_oui_dom->prenom_adherent.'</FONT></li>';
					} 
				?>
			<div>
				
			</div>
			
			<h2>Réponses incompletes</h2>
			<div>
				<ul>
				<?php
					while ($incomplet_dom = $req_incomplet_dom->fetch(PDO::FETCH_OBJ))
					{
						echo'<li><FONT size="2pt">'.$incomplet_dom->nom_adherent.' - '.$incomplet_dom->prenom_adherent.'</FONT></li>';
					} 
				?>
				</ul>
			</div>
			
			<h2>Absents</h2>
			<div>
				<?php
					while ($match_non_dom = $req_match_non_dom->fetch(PDO::FETCH_OBJ))
					{
						echo'<li><FONT size="2pt">'.$match_non_dom->nom_adherent.' - '.$match_non_dom->prenom_adherent.'</FONT></li>';
					} 
				?>
			</div>
			
		 </div>
		 
		 <div id="accordion2" style="margin-top:10px;float:right;width:49%">
		 
			<h2>Participants au Match</h2>
			<div>
				<?php
					while ($match_oui_ext = $req_match_oui_ext->fetch(PDO::FETCH_OBJ))
					{
						echo'<li><FONT size="2pt">'.$match_oui_ext->nom_adherent.' - '.$match_oui_ext->prenom_adherent.'</FONT></li>';
					} 
				?>
			</div>
			
			<h2>Participants au Repas</h2>
			<div>
				<?php
					while ($repas_oui_ext = $req_repas_oui_ext->fetch(PDO::FETCH_OBJ))
					{
						echo'<li><FONT size="2pt">'.$repas_oui_ext->nom_adherent.' - '.$repas_oui_ext->prenom_adherent.'</FONT></li>';
					} 
				?>
			</div>
			
			<h2>Réponses incompletes</h2>
			<div>
				<ul>
				<?php
					while ($incomplet_ext = $req_incomplet_ext->fetch(PDO::FETCH_OBJ))
					{
						echo'<li><FONT size="2pt">'.$incomplet_ext->nom_adherent.' - '.$incomplet_ext->prenom_adherent.'</FONT></li>';
					} 
				?>
				</ul>
			</div>
			
			<h2>Absents</h2>
			<div>
				<?php
					while ($match_non_ext = $req_match_non_ext->fetch(PDO::FETCH_OBJ))
					{
						echo'<li><FONT size="2pt">'.$match_non_ext->nom_adherent.' - '.$match_non_ext->prenom_adherent.'</FONT></li>';
					} 
				?>
			</div>

		 </div>
      </div>
    </div>
    <?php
    if(isset($_POST['match']) && isset($_POST['repas']) )
	{
		$top_match = $_POST['match'];
		$top_repas = $_POST['repas'];
	}

	if(isset($_POST['validation_participation']))
	{
		$bdd->exec("UPDATE participation_match SET top_participation_match='$top_match',top_participation_repas='$top_repas' WHERE id_adherent = '$id_adherent' AND id_match= '$num_match'");

	
		$lien = "participation.php?&num=$num";
		?>	
		<script>
			document.location.replace("<?php $lien ?>");	
		</script>
		<?php
	}
    include('footer.php');
    ?>
  </div>
 
</body>
</html>
