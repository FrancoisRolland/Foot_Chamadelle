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


        // Requete participants 
        $req_participants = $bdd->query("SELECT ad.id_adherent as id_adherent,
                                                ad.nom_adherent as nom_adherent,
                                                ad.prenom_adherent as prenom_adherent,
                                                p.id_match,
                                                p.id_adherent,
                                                p.top_participation_match,
                                                p.top_participation_repas
                                                FROM `participation_match` p
                                                JOIN adherent as ad ON ad.id_adherent = p.id_adherent 
                                                where id_match='$num_match'
                                                order by ad.nom_adherent ASC");	

        $req_NbParticipantsMatch = $bdd-> query("SELECT COUNT(*) as nbMatch from participation_match 
                                                 where id_match='$num_match' and top_participation_match='oui'");
        $req_NbParticipantsRepas = $bdd-> query("SELECT COUNT(*) as nbRepas from participation_match 
                                                 where id_match='$num_match' and top_participation_repas='oui'");
         
        $NbMatch = $req_NbParticipantsMatch->fetch();
        $req_NbParticipantsMatch->closeCursor();
        $NbRepas = $req_NbParticipantsRepas->fetch();
        $req_NbParticipantsRepas->closeCursor();
        
        
        /************ Fin Requetes  ************/
    ?>
   
    <div id="site_content">
      
	<?php
		include('sidebar.php');
	?>      

        <div class="content">
            
            <?php
                echo '<img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/page.png" /><h1 style="margin: 15px 0 0 0;">Match du '.$dateMatch.'</h1>';
                echo 'Nombre de participants au match :'.$NbMatch['nbMatch'].'</br>';
                echo 'Nombre de participants au repas :'.$NbRepas['nbRepas'];
            ?>
        
            <form action="#" method="post">
                
                <div class="form_settings">
	
                   <!------ liste participants -------->
                    <table id="hor-minimalist-b" summary="Employee Pay Sheet">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col"></th>
                                <th class="tableCenter" colspan="6" scope="col">Participation au match</th>
                                <th scope="col"></th>
                                <th class="tableCenter" colspan="6" scope="col">Participation au repas</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                while ($participants = $req_participants->fetch(PDO::FETCH_OBJ)) 
                                {
                                    $id=$participants->id_adherent;
                                    $TopMatch = $participants->top_participation_match;
                                    $TopRepas = $participants->top_participation_repas;

                                    echo '<tr>';				    			
                                        echo '<td>'.$participants->nom_adherent.'</td>';
                                        echo '<td>'.$participants->prenom_adherent.'</td>';
                                        echo '<td class="tableLigneVerticale"></td>';

                                        echo '<td>oui</td>';
                                        if($TopMatch=='oui') $checkedMatch = 'checked' ;
                                        else $checkedMatch = '' ;
                                        echo "<td><input type='radio' class='checkbox'  name='match_".$id."' id='match_".$id."' value='oui' ".$checkedMatch." /></td>";

                                        echo '<td>non</td>';
                                        if($TopMatch=='non') $checkedMatch = 'checked' ;
                                        else $checkedMatch = '' ;
                                        echo "<td><input class='checkbox' type='radio' name='match_".$id."' id='match_".$id."' value='non' ".$checkedMatch." </td>";

                                        echo '<td>Je sais pas</td>';
                                        if($TopMatch=='null') $checkedMatch = 'checked' ;
                                        else $checkedMatch = '' ;
                                        echo "<td><input class='checkbox' type='radio' name='match_".$id."' id='match_".$id."' value='null' ".$checkedMatch." </td>";
                                        echo '<td class="tableLigneVerticale"></td>';

                                        echo '<td>oui</td>';
                                        if($TopRepas=='oui') $checkedRepas = 'checked' ;
                                        else $checkedRepas = '' ;
                                        echo "<td><input class='checkbox' type='radio' name='repas_".$id."' id='repas_".$id."' value='oui' ".$checkedRepas." </td>";

                                        echo '<td>non</td>';
                                        if($TopRepas=='non') $checkedRepas = 'checked' ;
                                        else $checkedRepas = '' ;
                                        echo "<td><input class='checkbox' type='radio' name='repas_".$id."' id='repas_".$id."' value='non' ".$checkedRepas." </td>";
                                        if($TopRepas=='null') $checkedRepas = 'checked' ;
                                        else $checkedRepas = '' ;
                                        echo '<td>Je sais pas</td>';
                                        echo "<td><input class='checkbox' type='radio' name='repas_".$id."' id='repas_".$id."' value='null' ".$checkedRepas." </td>";
                                        echo '<td></td>';
                            }
                               rqtMaj($num_match);
                               $req_participants->closeCursor();
                            ?>
                        </tbody>
                    </table>
                        
                        
                   <!------- Fin Calendrier -->
                
                    <p style="padding-top: 15px"><span>&nbsp;</span>
                    <input style="float:center;width:50%" class="submit" type="submit" name="validation_participation" value="Valider" />
                    
                </div>
            </form>
        </div>
    </div>
      
    <!------- Requete de mise à jour ------->  
    
    
    <?php
    
    function rqtMaj($num_match)
    {
    
    include('connexion.php');
       
        $req1_participants = $bdd->query("SELECT ad.id_adherent as id_adherent,
                                                ad.nom_adherent as nom_adherent,
                                                ad.prenom_adherent as prenom_adherent,
                                                p.id_match,
                                                p.id_adherent,
                                                p.top_participation_match,
                                                p.top_participation_repas
                                                FROM `participation_match` p
                                                JOIN adherent as ad ON ad.id_adherent = p.id_adherent 
                                                where id_match='$num_match'
                                                order by ad.nom_adherent ASC");	
        
        if(isset($_POST['validation_participation']))
        {  
            foreach($req1_participants as $element)
            {
                $ida = $element[0];
                $top_match = $_POST['match_' .$ida];
                $top_repas = $_POST['repas_' .$ida];
            
                $bdd->exec("UPDATE participation_match SET top_participation_match='$top_match',
                                                       top_participation_repas='$top_repas' 
                                                       WHERE id_adherent = $ida AND id_match= $num_match");
            }
            $lien = "index.php?&num=$num_match";
        ?>	
        <script>
            document.location.replace("<?php $lien ?>");	
        </script>
    <?php
        }
        
    }
        include('footer.php');
    ?>
    
  </div>
</body>
</html>
