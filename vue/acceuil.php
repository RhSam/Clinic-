<?php
if(!isset($_SESSION))  //au cas ou la session n'est pas encore démarrée on la démarre et on initialise les parametres
{
session_start();
if (!isset($_SESSION['clearance']))  {$_SESSION['clearance']= 0;}
if (!isset($_SESSION['authentification'])) {$_SESSION['authentification'] = "";}

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
<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>

<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>

</head>

     

<body>
 <br />
     <br />
     <br />
  <?php
  include('indexe.php');
  ?>
 
     <br />
     <br />
     <br />
     <br />
 
 <div class="container lecorps">
   <div class="row row1">
     <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
       <div class="navbar-header">
          <div>
            <span class="appli">Clinic + </span>
          </div><!--navbar-brand -->
       </div><!--navbar header -->
       
       <div class="navbar-collapse collapse navbar-right">
          <?php
          $nav_en_cours='acceuil';
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
     <br />
     <br />
     <br />
     <br />
   <div class="row row2">
    <div class="col-xs-12">
    
     <div class="col-xs-10 col-xs-push-1">
      <h1 class="titre" ><label class="label label-primary">Clinique "santé pour tous"</label></h1>
     </div>
     
      
      
     <div class="col-xs-4 logo">
      <img class="img-rounded img-thumbnail img-responsive" src="../ressources/images/logo clinique bon2.1.1.jpg" >
     </div><!--col-xs-6-1 -->
     
     <div class="col-xs-8" style="text-align:justify; padding-top:8px; font-size:18px;">
      <br />
      <br />
      <br />
      
      
      
     
      <p>
     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia dui sagittis libero pharetra, elementum vulputate nulla ullamcorper. Nulla tempor vel nunc nec sollicitudin. Cras feugiat dui pellentesque risus semper, ac ultrices augue auctor. Vivamus pretium erat dui, a rutrum nibh vestibulum in. Etiam ut egestas augue, eu venenatis nunc. Proin turpis leo, vestibulum eu adipiscing sit amet, iaculis sit amet nisl. Integer semper dui metus, eu pharetra enim sollicitudin ac. Vestibulum metus eros, tincidunt at erat ac, eleifend aliquam odio. Morbi eu tempor magna. Duis molestie risus eget libero iaculis ornare. Fusce posuere viverra libero a pharetra. Sed pretium mi id aliquam scelerisque.
      </p>
      <p>
  Nunc venenatis neque cursus tortor feugiat iaculis. Aliquam adipiscing convallis erat, eget ullamcorper dolor hendrerit eu. Nulla sit amet blandit lacus. Integer sit amet congue justo, vitae cursus justo. Vestibulum sed dui eu enim ornare volutpat pulvinar id enim. Morbi imperdiet urna in accumsan convallis. Curabitur facilisis ante in fermentum elementum. Nam et scelerisque sapien, quis vestibulum nibh. Integer sodales tempus nulla hendrerit volutpat. Sed laoreet tristique sem, venenatis placerat diam vehicula at. In et commodo felis.
      </p>
     
     </div><!--col-xs-6-2 -->
     
    </div><!--col-xs-12 -->
   </div><!--row 2 -->
   
 </div><!--container-->



<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>


</body>
</html>