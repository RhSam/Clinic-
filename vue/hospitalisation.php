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
 if ($_SESSION['clearance']<2) //les users avec un niveau inf à 2(secrétaires et externes) ne peuvent accéder à l'hospitalisation
 {
	 include('accesInterdit.php');
 }
 else
 {
?>  

<div class="col-xs-2 bread">
 
 <ul  class="list-inline">
   <li class="mother" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;" id="current">Hospitalisation</li>
  <li class="child"><a href="hospitalisationPatients.php">►Patients</a></li>
    <br />
  <li class="child"><a href="hospitalisationTous.php">►Registre</a></li>
  
   
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
          $nav_en_cours='hospitalisation';
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
       
       <a href="hospitalisationPatients.php"><img src="../ressources/images/icones/hospiUn46.jpg" class="img-circle img-responsive" width="400" id="Hospitalisations des patients " alt="Hospitalisations des patients " title="Hospitalisation des patients "/></a>
       <br />
       <br />
       
       <a href="hospitalisationPatients.php"><button class="btn btn-primary titreIcone" style="margin-left:0%;">Hospitalisations des patients </button></a>
     </div><!--col-xs-6-1 -->
       
       
     <div class="col-xs-5 col-xs-push-2">
       <br />
       <br />
       
       <br />
       
       <a href="hospitalisationTous.php"><img src="../ressources/images/icones/hospiTous5.jpg" class="img-circle img-responsive" width="400" id="oldPatient" alt="Registre des hospitalisations" title="Registre des hospitalisations"/></a>
       <br />
       <br />
       
       <a href="hospitalisationTous.php"><button class="btn btn-primary titreIcone2" style="margin-left:-2%;">Registre des hospitalisations</button></a>
     </div><!--col-xs-6-2 -->
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