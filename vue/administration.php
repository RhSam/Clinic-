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
   <li class="mother" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">Administration</li>
   <li class="child"><a href="comptesUtilisateurs.php">►Comptes</a></li>
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
   
   
   <div class="col-xs-12 row row2">
     <div class="col-xs-5">
       <br />
       <br />
       
       <br />
       
       <a href="comptesUtilisateurs.php"><img src="../ressources/images/icones/user2.jpg" class="img-circle img-responsive" width="400" id="Utilisateurs" alt="Utilisateurs" title="Utilisateurs"/></a>
       <br />
       <br />
       
       <a href="comptesUtilisateurs.php"><button class="btn btn-primary titreIcone">Comptes d'utilisateurs</button></a>
     </div><!--col-xs-6-1 -->
       
       <div class="col-xs-2" style="margin-top:25%;padding-left:2.2%">
        <a href="autres.php"><img src="../ressources/images/icones/Autres1.jpg" class="img-circle img-responsive" width="120" id="Autres" alt="Autres" title="Autres"/></a>
          <br />
          <div style="margin-top:8%;margin-left:17%;"><a href="autres.php"><button class="btn btn-primary">Autres</button></a></div>
       </div>
       
       
     <div class="col-xs-5">
       <br />
       <br />
       
       <br />
       
       <a href="historiqueConnexions.php"><img src="../ressources/images/icones/historique2.jpg" class="img-circle img-responsive" width="400" id="Historique" alt="Historique de navigation" title="Historique de navigation"/></a>
       <br />
       <br />
       
       <a href="historiqueConnexions.php"><button class="btn btn-primary titreIcone2">Historique des connexions</button></a>
     </div><!--col-xs-6-2 -->
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

</body>
</html>