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
   <!--<li class="grandchild">»Restauration</li>
    <br /> -->
   <li class="grandchild"><a href="materiel.php">»Matériel</a></li>
    <br />
   <li class="grandchild" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">»Examens</li>
   <br />
   <li class="grandchild"><a href="produits.php">»Produits</a></li>
   
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

$reponse=$bdd->prepare('SELECT * FROM EXAMEN order by NomExamen'); 
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM EXAMEN'); 
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       <div class="panel-heading entete" style="padding-left:8%;">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span>Examens médicaux enregistrés
          <div class="pull-right"><button class="btn btn-success" data-toggle="modal" href="#enregExamen" data-backdrop="false">Nouveau</button></div></h4>
         
       </div>
  
       <?php
	    include('corpsPanneauListeExamens.php'); //on inclut le corps du panneau
       ?>
       
      </div><!--exams -->
      
      
      
    </div><!--col-xs-12 listeExams-->
    
    
     
   </div><!--row 2 -->
   
 </div><!--container-->
 
 
 
 
<footer class="footer">
 <span id="date_heure" style="font-size:84%;"> </span>
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

<!--le modal d'enregistrement de chambre-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="enregExamen">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 enreg">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
                    Enregistrement
				  </h4>
				 </div>
				   
				 <div class="panel panel-body">
				 
				   
					 <h3>
					   <form action="../traitements/nouveauExamenPost.php" method="post" id="formEnregExamen">
                        <label class="label label-default" for="examen">
                         Examen médical
                        </label>
                        <input class="form-control input-lg nom" type="text" name="examen" id="examen" spellcheck="false" autocomplete="off" placeholder="Nom ou désignation de l'examen médical" required="required" maxlength="50"/>
                         <br />
                         <div class="col-xs-6 text-left">
                         <button class="btn btn-danger btn-lg" type="reset">Vider</button>
                         </div>
                         
                         <div class="col-xs-6 text-right">
                         <button class="btn btn-success btn-lg" type="submit">Valider</button>
                         </div>
                         
                         
                       </form>
					 
					 </h3>
					 
				
					  </div>
					
				   
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--enreg -->
		  
		  
		  
		 
		  
          
         
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
 </div>
   
   <!--fin du modal de suppression -->




<!--le modal de confirmation de l'enreg de la chambre-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="enregExamenConf">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="examens.php"><button type="button" class="btn btn-danger">x</button></a>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
                    Enregistrement
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   
					 <h3>
					 <?php
					  if($_GET['newExamen']==0)
					  {echo 'Il existe déja un examen dénommé "'.$_GET['examen'].'" ! <br/> Aucun nouvel examen médical enregistré.';}
					  if($_GET['newExamen']==1)
					  {echo 'L\'examen médical dénommé "'.$_GET['examen'].'" a été créé avec succès !';}
					  
                     ?> 
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="examens.php"><button type="button" class="btn btn-info">Fermer</button></a>
					  </div>
					
				   
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--enregChambreConf -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de confirmation -->
<input type="hidden"data-toggle="modal" href="#enregExamenConf" data-backdrop="false" id="btnEnregExamenConf" />
 
 
           <?php
			  if(isset($_GET['newExamen']))
			  {
				  
				  echo '<script type="text/javascript">
			  document.getElementById("btnEnregExamenConf").click();
			     </script>';
			  }
             ?>
             
             
<div class="modal fade col-xs-12 col-xs-offset-1" id="supprExamConf">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="examens.php"><button type="button" class="btn btn-danger">x</button></a>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
                    Suppression
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   
					 <h3>
					 <?php
					  if($_GET['supprExam']==1)
					  {
					  echo 'L\'examen médical dénommé "'.$_GET['delExam'].'" a bien été supprimé.';
					  }
					  else
					  
					  {
					  echo 'Désolé il est impossible de supprimer l\'examen médical dénommé "'.$_GET['delExam'].'".';
					  }
					  
                     ?> 
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="examens.php"><button type="button" class="btn btn-info">Fermer</button></a>
					  </div>
					
				   
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--enregChambreConf -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de confirmation -->
<input type="hidden"data-toggle="modal" href="#supprExamConf" data-backdrop="false" id="btnSupprExamConf" />
 
 
           <?php
			  if(isset($_GET['supprExam']))
			  {
				  
				  echo '<script type="text/javascript">
			  document.getElementById("btnSupprExamConf").click();
			     </script>';
			  }
             ?>

</body>
</html>