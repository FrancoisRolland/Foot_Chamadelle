<?php
	session_start();
	include('connexion.php');
?>        
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
   
<?php		

  		/*********************** CONTROLE DES VALEURS ************************/
		if( isset($_POST['inscription']) )
		{
			$datemodif = date("Y-m-d");
			$message = null;
                            
			if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['pass2']))
			{
				$nom=$_POST['nom'];
				$prenom=$_POST['prenom'];
				$datenaissance=$_POST['datenaissance'];
                                $dat = explode("/",$datenaissance);
                                $annee = $dat[2];
				$mois = $dat[1];
				$jour = $dat[0];
                                $datenaissBDD = $annee."-".$mois."-".$jour;
                                $pass = md5($_POST['pass2']);
                                $id = $_POST['id'];
                        }	

                        if(isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['telephone']) 
                                 /*&& isset($_POST['tel2']) && isset($_POST['tel3'])*/ && isset($_POST['mail']))
			{
				$adresse=$_POST['adresse'];
				$cp=$_POST['cp'];
				$ville=$_POST['ville'];
				$telephone=$_POST['telephone'];
				$telephone2=$_POST['telephone2'];
				$telephone3=$_POST['telephone3'];
				$mail=$_POST['mail'];
			
                        }
                                              
			/*********************** FIN CONTROLE DES VALEURS ************************/

		
			/*********************** CONSTRUCTION ET ENVOI DE LA REQUETE ************************/
			
			$req = $bdd->prepare('UPDATE adherent SET nom_adherent = :nom, 
				                                  prenom_adherent = :prenom, 
				                                  rue_adherent = :adresse, 
				                                  code_postale_adherent = :cp,
				                                  bureau_distributeur_adherent = :ville, 
				                                  telephone_adherent = :telephone, 
				                                  telephone2_adherent = :telephone2,
				                         	  telephone3_adherent = :telephone3, 
				                                  date_naissance_adherent = :datenaissBDD,
                                                                  mail_adherent = :mail, 
				                                  dernier_modif = :datemodif,
                                                                  pass_adherent = :pass
                                                                  WHERE id_adherent = :id');

                        $req->execute(array('nom' => $nom, 
				            'prenom' => $prenom, 
				            'adresse'=> $adresse, 
				            'cp' => $cp,
				            'ville'=> $ville,
				            'telephone' => $telephone,
				            'telephone2' => $telephone2,
				            'telephone3' => $telephone3,
                                            'datenaissBDD' => $datenaissBDD,
				            'mail' => $mail, 
				            'datemodif' => $datemodif,
                                            'pass' => $pass,    
                                            'id' => $id));
                }         
                
                 
        header('Location: profil.php');
?>

</html>