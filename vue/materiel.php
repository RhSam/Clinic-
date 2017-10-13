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
	border-radius:4px 4px 4px 4px;">»Matériel</li>
    <br />
   <li class="grandchild"><a href="examens.php">»Examens</a></li>
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
     
     <div class="col-xs-12 chambres">
     
      <div class="panel panel-primary chambres">
       <?php
	   
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM CHAMBRE order by LibelleChambre'); //requete qui retourne les infos de la chambre
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM CHAMBRE'); //requete pour calculer le nbr de chambres
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       <div class="panel-heading entete" style="padding-left:8%;">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span>Chambres
          <div class="pull-right"><button class="btn btn-success" data-toggle="modal" href="#enregChambre" data-backdrop="false">Nouveau</button></div></h4>
         
       </div>
  
       <?php
	    include('corpsPanneauListeChambres.php'); //on inclut le corps du panneau
       ?>
       
      </div><!--chambres -->
      
      
    </div><!--col-xs-12 chambres-->
     
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
  <div class="modal fade col-xs-12 col-xs-offset-1" id="enregChambre">
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
					   <form action="../traitements/nouveauChambrePost.php" method="post" id="formEnregChambre">
                        <label class="label label-default" for="chambre">
                         Chambre
                        </label>
                        <input class="form-control input-lg nom" type="text" name="chambre" id="chambre" spellcheck="false" autocomplete="off" placeholder="Numéro ou nom de la chambre" required="required" maxlength="10"/>
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
  <div class="modal fade col-xs-12 col-xs-offset-1" id="enregChambreConf">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="materiel.php"><button type="button" class="btn btn-danger">x</button></a>
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
					  if($_GET['newChambre']==0)
					  {echo 'Il existe déja dans votre clinique une chambre "'.$_GET['chambre'].'" ! <br/> Aucune nouvelle chambre créée.';}
					  if($_GET['newChambre']==1)
					  {echo 'La chambre "'.$_GET['chambre'].'" a été créée avec succès !';}
					  
                     ?> 
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="materiel.php"><button type="button" class="btn btn-info">Fermer</button></a>
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
<input type="hidden"data-toggle="modal" href="#enregChambreConf" data-backdrop="false" id="btnEnregChambreConf" />
 
 
           <?php
			  if(isset($_GET['newChambre']))
			  {
				  
				  echo '<script type="text/javascript">
			  document.getElementById("btnEnregChambreConf").click();
			     </script>';
			  }
             ?>
             
             
             
             
 
 
 <!--le modal de confirmation de l'enreg du lit-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="enregLitConf">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="materiel.php"><button type="button" class="btn btn-danger">x</button></a>
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
					  if($_GET['newLit']==0)
					  {echo 'Il existe déja dans la chambre "'.$_GET['chambre'].'" un lit "'.$_GET['lit'].'"! <br/> Aucun nouveau lit créé.';}
					  if($_GET['newLit']==1)
					  {echo 'Le lit "'.$_GET['lit'].'" de la chambre "'.$_GET['chambre'].'" a été créée avec succès !';}
					  
                     ?> 
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="materiel.php"><button type="button" class="btn btn-info">Fermer</button></a>
					  </div>
					
				   
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--enregLitConf -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de confirmation -->
<input type="hidden"data-toggle="modal" href="#enregLitConf" data-backdrop="false" id="btnEnregLitConf" />
 
 
           <?php
			  if(isset($_GET['newLit']))
			  {
				  
				  echo '<script type="text/javascript">
			  document.getElementById("btnEnregLitConf").click();
			     </script>';
			  }
             ?>
             
             
             
             
             
             
             <!--le modal de confirmation de la suppression de la chambre-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="supprChambreLitConf">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="materiel.php"><button type="button" class="btn btn-danger">x</button></a>
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
					  if($_GET['suppr']==1)
					  {
					  echo 'La chambre "'.$_GET['delChambre'].'" a bien été supprimée ainsi que tous les lits qui y étaient enregistrés.';
					  }
					  if($_GET['suppr']==2)
					  {
					  echo 'Le lit "'.$_GET['delLit'].'" de la chambre "'.$_GET['delChambre'].'" a bien été supprimée.';
					  }
					  if($_GET['suppr']==3)
					  {
					  echo 'Désolé il est impossible de supprimer le lit "'.$_GET['delLit'].'" de la chambre "'.$_GET['delChambre'].'", ce lit est actuellement occupé par un patient hospitalisé.';
					  }
					  
                     ?> 
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="materiel.php"><button type="button" class="btn btn-info">Fermer</button></a>
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
<input type="hidden"data-toggle="modal" href="#supprChambreLitConf" data-backdrop="false" id="btnSupprChambreLitConf" />
 
 
           <?php
			  if(isset($_GET['suppr']))
			  {
				  
				  echo '<script type="text/javascript">
			  document.getElementById("btnSupprChambreLitConf").click();
			     </script>';
			  }
             ?>

</body>
</html>