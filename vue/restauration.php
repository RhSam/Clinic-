<?php
if(!isset($_SESSION))  //au cas ou la session n'est pas encore démarrée on la démarre.
{
session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clinic +</title>
<link rel="stylesheet" href="../ressources/css/polices.css" />
<link rel="stylesheet" href="../ressources/bootstrap-3.1.1-dist/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link rel="stylesheet" href="../ressources/css/style.css" />
<link rel="icon" type="image/gif" href="../ressources/images/icone.gif" />
<script type="text/javascript" src="../ressources/js/heure.js"></script>
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>

</head>

     

<body>

<?php //sécurité contre l'accès à la page par l'url directement
 if ($_SESSION['clearance']<4) 
 {      //les users avec un niveau inf à 4(médecins simples , infirmiers , secrétaires et externes) ne peuvent accéder à la partie administration
	 include('accesInterdit.php');
 }
 else
 {
?>
<div class="col-xs-2 bread">
 <ul class="list-inline">
   <li class="mother"><a href="administration.php">Administration</a></li>
   <li class="child"><a href="comptesUtilisateurs.php">►Comptes</a></li>
    <br />
   <li class="child"><a href="historiqueConnexions.php">►Historique</a></li>
   <br />
   <li class="child"><a href="autres.php">►Autres</a></li>
    <br />
   <li class="grandchild" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">»Restauration</li>
    <br />
   <li class="grandchild"><a href="materiel.php">»Matériel</a></li>
   
 </ul>
</div>
 
 <div class="container col-xs-10 col-xs-push-2">
   <div class="row row1">
     <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
       <div class="navbar-header">
          <div>
            <span class="appli">Clinic + </span>
          </div><!--navbar-brand -->
       </div><!--navbar header -->
       
       <div class="navbar-collapse collapse navbar-right">
          <?php
          $nav_en_cours='administration';
          switch($_SESSION['clearance'])
		  {
			  case 0:include('listeAcceuil.php');
			   break;
			  case 1:include('listeSecretaire.php');
			   break;
			  case 2:include('listeInfirmier.php');
			   break;
			  case 3:include('listeMedecin.php');
			   break;
			  case 4:include('listeAdministrateur.php');
			   break;
		  }
	      ?>
       </div>
     </nav><!--nav -->
   </div><!--row 1 -->
   
   
   <div class="row row2">
     
     <div class="col-xs-12 listeUtilisateurs">
     
      <div class="panel panel-primary Utilisateurs table-responsive">
       <?php
	   
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisibleUser=0 order by Nom'); //requete qui retourne les infos des users supprimés et les ordonne
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisibleUser=0'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       <div class="panel-heading entete">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span>Utilisateurs à restaurer
          </h4>
         
       </div>
  
       <?php
	    include('corpsPanneauListeUtilisateursSupprimes.php'); //on inclut le corps du panneau
       ?>
       
      </div><!--administrateur -->
      
      
      
    </div><!--col-xs-12 listePatients-->
    
    <div class="col-xs-12 listePatients">
     
      <div class="panel panel-primary Patients table-responsive">
       <?php
	   
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=0 order by Nom'); //requete qui retourne les infos des patients supprimés et les ordonne
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=0'); //requete pour calculer le nbr de patients de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       <div class="panel-heading entete">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span>Patients à restaurer
          </h4>
         
       </div>
  
       <?php
	    include('corpsPanneauListePatientsSupprimes.php'); //on inclut le corps du panneau
       ?>
       
      </div><!--patients -->
      
      
      
    </div><!--col-xs-12 patients-->
     
   </div><!--row 2 -->
   
 </div><!--container-->
 
 
 
 
<footer class="footer">
 <span id="date_heure"> </span>
 <span id="time" class="time"> </span>
  <br />
  
 <span class="user text-center">
 Session de :
 <br />
  
   <?php
     echo $_SESSION['userFirstName'].' '.$_SESSION['userName'];
    ?>
    
  
 </span>
</footer>
 
<?php
 }
?>

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

<!--le modal de confirmation de la restauration-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="res">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="restauration.php"><button type="button" class="btn btn-danger">x</button></a>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
                    Restauration
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   
					 <h3>
					  
					 Restauration effectuée avec succès !
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="restauration.php"><button type="button" class="btn btn-info">Fermer</button></a>
					  </div>
					
				   
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--suppression -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de suppression -->
<input type="button" class="btn btn-danger" data-toggle="modal" href="#res" data-backdrop="false" id="btnOperation" />
 
 
           <?php
			  if(isset($_GET['operation']))
			  {
				  
				  echo '<script type="text/javascript">
			  document.getElementById("btnOperation").click();
			     </script>';
			  }
             ?>

</body>
</html>