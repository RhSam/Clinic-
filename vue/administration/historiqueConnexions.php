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
<link rel="stylesheet" href="../../ressources/css/polices.css" />
<link rel="stylesheet" href="../../ressources/bootstrap-3.1.1-dist/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link rel="stylesheet" href="../../ressources/css/style.css" />
<link rel="icon" type="image/gif" href="../../ressources/images/icone.gif" />

</head>

     

<body>

<?php //sécurité contre l'accès à la page par l'url directement
 if ($_SESSION['clearance']<4) 
 {      //les users avec un niveau inf à 4(médecins simples , infirmiers , secrétaires et externes) ne peuvent accéder à la partie administration
	 include('../accesInterdit.php');
 }
 else
 {
?>
 
 <div class="container">
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
			  case 0:include('../listeAcceuil.php');
			   break;
			  case 1:include('../listeSecretaire.php');
			   break;
			  case 2:include('../listeInfirmier.php');
			   break;
			  case 3:include('../listeMedecin.php');
			   break;
			  case 4:include('../listeAdministrateur.php');
			   break;
		  }
	      ?>
       </div>
     </nav><!--nav -->
   </div><!--row 1 -->
   
   
   
 </div><!--container-->
 
<?php
 }
?>

<script type="text/javascript" src="../../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../../ressources/js/script.js"></script>
<script type="text/javascript" src="../../ressources/js/revealPassword.js"></script>

</body>
</html>