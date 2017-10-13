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
   <li class="child" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">►Historique</li>
    <br />
   <li class="grandchild"><a href="#admin">»Administrateurs</a></li>
    <br />
   <li class="grandchild"><a href="#med">»Médecins</a></li>
    <br />
   <li class="grandchild"><a href="#inf">»Infirmiers</a></li>
    <br />
   <li class="grandchild"><a href="#sec">»Secrétaires</a></li>
    <br />
   <li class="grandchild"><a href="#des">»Désactivés</a></li>
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
    <div class="col-xs-12 historique">
     
      <div class="col-xs-12 administrateurs" id="admin">
       <?php
	   
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=4 order by Nom'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=4'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
      <br />
      <br />  
      
       <div class="col-xs-12 entete">
     <h1><label class="label label-primary"><span class="badge"><?php echo $total ?></span>Administrateurs</label></h1>
       </div><!--en tete -->
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />  
      <br />
      <br />  
      
       
  
       <?php
	    while ($donnees=$reponse->fetch())
		{
			$idUtilisateur=$donnees['Id'];
			$nomUtilisateur=$donnees['Nom'];
			$prenomsUtilisateur=$donnees['Prenoms'];
			include('panneauHistorique.php');
		}
       ?>
       
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      
     
      </div><!--administrateurs -->       
      
       
    
       <div class="col-xs-12 médecins" id="med">
       <?php
	   $reponse->closeCursor();  
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=3 order by Nom'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=3'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       
      <br />
      <br /> 
      <br />
      <br /> 
       
       <div class="col-xs-12 entete">
     <h1><label class="label label-primary"><span class="badge"><?php echo $total ?></span>Médecins</label></h1>
       </div><!--en tete -->
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />  
      <br />
      <br /> 
       
  
       <?php
	    while ($donnees=$reponse->fetch())
		{
			$idUtilisateur=$donnees['Id'];
			$nomUtilisateur=$donnees['Nom'];
			$prenomsUtilisateur=$donnees['Prenoms'];
			include('panneauHistorique.php');
		}
       ?>
       
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br /> 
      
      </div><!--médecins --> 
      
      
      <div class="col-xs-12 infirmiers" id="inf">
       <?php
	   $reponse->closeCursor();  
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=2 order by Nom'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=2'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       
      <br />
      <br /> 
      <br />
      <br /> 
      
       <div class="col-xs-12 entete">
     <h1><label class="label label-primary"><span class="badge"><?php echo $total ?></span>Infirmiers</label></h1>
       </div><!--en tete -->
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />  
      <br />
      <br /> 
  
       <?php
	    while ($donnees=$reponse->fetch())
		{
			$idUtilisateur=$donnees['Id'];
			$nomUtilisateur=$donnees['Nom'];
			$prenomsUtilisateur=$donnees['Prenoms'];
			include('panneauHistorique.php');
		}
       ?>
       
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br /> 
      
      </div><!--infirmiers --> 
      
      
      <div class="col-xs-12 secrétaires" id="sec">
       <?php
	   $reponse->closeCursor();  
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=1 order by Nom'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=1'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       
      <br />
      <br /> 
      <br />
      <br /> 
      
       <div class="col-xs-12 entete">
     <h1><label class="label label-primary"><span class="badge"><?php echo $total ?></span>Secrétaires</label></h1>
       </div><!--en tete -->
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />  
      <br />
      <br /> 
       
  
       <?php
	    while ($donnees=$reponse->fetch())
		{
			$idUtilisateur=$donnees['Id'];
			$nomUtilisateur=$donnees['Nom'];
			$prenomsUtilisateur=$donnees['Prenoms'];
			include('panneauHistorique.php');
		}
       ?>
       
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br /> 
      
      </div><!--secrétaires --> 
      
      
      <div class="col-xs-12 désactivés" id="des">
       <?php
	   $reponse->closeCursor();  
	    include_once('../traitements/connexion.php');

$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=0 order by Nom'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE IdPrivilege=0'); //requete pour calculer le nbr d'users de cette catégorie
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
       ?>
       
      <br />
      <br /> 
      <br />
      <br /> 
       
       <div class="col-xs-12 entete">
     <h1><label class="label label-primary"><span class="badge"><?php echo $total ?></span>Comptes désactivés</label></h1>
       </div><!--en tete -->
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />  
      <br />
      <br /> 
       
  
       <?php
	    while ($donnees=$reponse->fetch())
		{
			$idUtilisateur=$donnees['Id'];
			$nomUtilisateur=$donnees['Nom'];
			$prenomsUtilisateur=$donnees['Prenoms'];
			include('panneauHistorique.php');
		}
       ?>
       
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br /> 
      
      </div><!--désactivés --> 
      
    </div><!--col-xs-4 Historique-->
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

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

</body>
</html>