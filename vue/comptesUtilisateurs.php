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
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>
<script type="text/javascript" src="../ressources/js/heure.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>

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
   <li class="child" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">►Comptes</li>
    <br />
    
   <li class="child"><a href="historiqueConnexions.php">►Historique</a></li>
   <br />
   <li class="child"><a href="autres.php">►Autres</a></li>
   
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
     
      <div class="panel panel-primary administrateurs table-responsive">
       <?php
	   
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=4 AND VisibleUser=1 order by Id DESC'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=4 AND VisibleUser=1'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       <div class="panel-heading entete">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span>Administrateurs
          <div class="pull-right"><a href="nouveauUtilisateur.php?privilege=4"><button class="btn btn-success">Nouveau</button></a></div></h4>
         
       </div>
  
       <?php
	    include('corpsPanneauListeUtilisateurs.php'); //on inclut le corps du panneau
       ?>
       
      </div><!--administrateur -->
      
      <div class="panel panel-primary médecins table-responsive">
       <?php
	   $reponse->closeCursor();
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=3 AND VisibleUser=1 order by Id DESC'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=3 AND VisibleUser=1'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       <div class="panel-heading entete">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span> Médecins
        <div class="pull-right"><a href="nouveauUtilisateur.php?privilege=3"><button class="btn btn-success">Nouveau</button></a></div></h4>
       </div>
       
       <?php
	    include('corpsPanneauListeUtilisateurs.php');
       ?>
       
      </div><!--medecins -->
      
      <div class="panel panel-primary infirmiers table-responsive">
       <?php
	   $reponse->closeCursor();
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=2 AND VisibleUser=1 order by Id DESC'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=2 AND VisibleUser=1'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       <div class="panel-heading entete">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span> Infirmiers
        <div class="pull-right"><a href="nouveauUtilisateur.php?privilege=2"><button class="btn btn-success">Nouveau</button></a></div></h4>
       </div>
       
       <?php
	    include('corpsPanneauListeUtilisateurs.php');
       ?>
       
      </div><!--infirmiers -->
      
      <div class="panel panel-primary secrétaires table-responsive">
       <?php
	    $reponse->closeCursor();
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=1 AND VisibleUser=1 order by Id DESC'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=1 AND VisibleUser=1'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());

       ?>
       <div class="panel-heading entete">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span> Secrétaires
        <div class="pull-right"><a href="nouveauUtilisateur.php?privilege=1"><button class="btn btn-success">Nouveau</button></a></div></h4>
       </div>
       
       <?php
	    include('corpsPanneauListeUtilisateurs.php');
       ?>
       
      </div><!--secrétaires -->
      
      
      <div class="panel panel-primary désactivés table-responsive">
       <?php
	    $reponse->closeCursor();
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=0 AND VisibleUser=1 order by Id DESC'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=0 AND VisibleUser=1'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());

       ?>
       <div class="panel-heading enteteDesactive">
        <h4><span class="badge" id="chiffre"><?php echo $total ?></span>Comptes désactivés</h4>
       </div>
       <?php
	    include('corpsPanneauListeUtilisateursBis.php');
       ?>
       
      </div><!--secrétaires -->
      
      
    </div><!--col-xs-4 listeUtilisateurs-->
   </div><!--row 2 -->
   
 </div><!--container-->
 
 
<footer>
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

<!--le modal de confirmation -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confirmation">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
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
				 
				   <form class="form">
					 <h3>
					  <?php
					 if(isset($_GET['newUser']))
					 { 
					  if(($_GET['newUser']==0)OR($_GET['newUser']==2))
					  {
					  echo 'Un utilisateur nommé "'.$_GET['nom'].' '.$_GET['prenoms'].' et né le '.$_GET['dateDeNaissance'].'" existe déja,  si vous voulez créer un nouveau utilisateur de même nom et prénoms, veuillez modifier le nom et prénoms de l\'un des deux(2) utilisateurs! Merci! Aucun nouvel utilisateur créé.';}
					  
					  if($_GET['newUser']==1)
					  {
					  echo 'L\'utilisateur  "'.$_GET['nom'].' '.$_GET['prenoms'].'" a bien été créé. <br> Son code d\'identification en tant que patient est: <span id="chiffre"><h2>'.$_GET['codePatient'].'</h2></span>.<br/> Son nom d\'utilisateur est : '.$_GET['login'].'<br/>';}
					  
					  
					  if($_GET['newUser']==3)
					  {
					  echo 'L\'utilisateur  "'.$_GET['nom'].' '.$_GET['prenoms'].'" a bien été créé.<br> Son code d\'identification en tant que patient est : <span id="chiffre"><h2>'.$_GET['codePatient'].'</h2></span>.<br/> Son nom d\'utilisateur est : '.$_GET['login'].'<br/>';}
					  
					 }
                      ?>
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="comptesUtilisateurs.php"><button type="button" class="btn btn-info btn-lg">Fermer</button></a>
					  </div>
					
				   </form>
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
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confirmation" data-backdrop="false" id="btnConfirm" />

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

             <?php
			  if(isset($_GET['newUser']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirm").click();
			     </script>';
			  }
             ?>
             
             <?php
			  if(isset($_GET['trouve'])AND($_GET['trouve']=='non'))
			  {
				  $id=intval($_GET['idUtilisateur']);
				  echo '<script type="text/javascript">
			  document.getElementById("btnModifier'.$id.'").click();
			     </script>';
			  }
             ?>


<!--le modal de confirmation de suppr et desactivation-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="supdes">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="comptesUtilisateurs.php"><button type="button" class="btn btn-danger">x</button></a>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
                    <?php 
					 if($_GET['operation']=='des'){echo 'Désactivation';}
					 if($_GET['operation']=='sup'){echo 'Suppression';}
					?>
				  
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  <?php
					    if($_GET['operation']=='des'){echo 'Désactivation effectuée avec succès !';}
					    if($_GET['operation']=='1'){echo 'Suppression effectuée avec succès !';}
						if(empty($_GET['operation']))
						{echo 'Désolé la suppression de cet utilisateur est impossible';}
                      ?>
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="comptesUtilisateurs.php"><button type="button" class="btn btn-info">Fermer</button></a>
					  </div>
					
				   </form>
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
<input type="button" class="btn btn-danger" data-toggle="modal" href="#supdes" data-backdrop="false" id="btnOperation" />
 
 
 <script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
 
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