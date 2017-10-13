<?php

function dateFr($date)
					  {
						  return strftime('%d-%m-%Y',strtotime($date));
					  }
					// function Age($date){
						//  $date = preg_split('/\//', $date);
						  
						 // return @floor((strtotime("now") - strtotime($date[1].'/'.$date[2].'/'.$date[0]))/60/60/24/365.25);
					 //}
					 



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
 if ($_SESSION['clearance']<2) //les users avec un niveau inf à 2( secrétaires et externes) ne peuvent accéder à la consultation
 {
	 include('accesInterdit.php');
 }
 elseif($_SESSION['clearance']==2) //pour l'infirmier
 {
 ?>
	 <div class="col-xs-2 bread">
 
 <ul  class="list-inline">
   <li class="mother" id="current">Consultation</li>
  
  
   
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
          $nav_en_cours='consultation';
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
   
     <div class="col-xs-12">
       <div class="panel panel-primary table-responsive">
                         <div class="panel-heading entete">
                          <h4>
                          <?php echo'
                          Constantes de "'.$_GET['Nom'].' '.$_GET['Prenoms'].'" relevées par "'.$_SESSION['userFirstName'].' '.$_SESSION['userName'].'"';
						  
						 ?>
                          </h4>
                         </div>
                           
                         <div class="panel panel-body">
                           <form class="form" action="../traitements/enregConstantesPost.php" method="post">
						      <input type="hidden" name="patient" value="<?php echo $_GET['Id'];?>"/>
							  <input type="hidden" name="user" value="<?php echo $_SESSION['idUser'];?>"/>
                            <div class="col-xs-6">
						     <label class="label label-default" for="temperature">Température (ºC)</label>
							 <input class="form-control input-lg" name="temperature" id="temperature" type="number" min="35" max="40" step="0.1" placeholder="Température en degré Celcius" required="required"/>
						    </div> 
							
							<div class="col-xs-6">
						     <label class="label label-default" for="poids">Poids (Kg)</label>
							 <input class="form-control input-lg" name="poids" id="poids" type="number" min="3.5" max="200" step="0.1" placeholder="Poids en kilogrammes" />
						    </div> 
							
							 <br/>
							 <br/>
							 <br/>
							 <br/>
							 
							<div class="col-xs-6">
							 <label class="label label-default" for="TABGMax">Tension artérielle bras gauche (mmHg)</label>
							 <br/>
							 <br/>
							 <div class="col-xs-6 maxima">
							  <input class="form-control input-lg" type="number" max="200" min="80" step="10" placeholder="maxima" id="TABGMax" name="TABGMax"/> 
							 </div><!--maxima -->
							 <div class="col-xs-6 minima">
							  <input class="form-control input-lg" type="number" max="120" min="40" step="10" placeholder="minima" id="TABGMin" name="TABGMin" /> 
							 </div><!--minima -->
							</div>
							
							<div class="col-xs-6">
							 <label class="label label-default" for="TABDMax">Tension artérielle bras droit (mmHg)</label>
							 <br/>
							 <br/>
							 <div class="col-xs-6 maxima">
							  <input class="form-control input-lg" type="number" max="200" min="80" step="10" placeholder="maxima" id="TABDMax" name="TABDMax"/> 
							 </div><!--maxima -->
							 <div class="col-xs-6 minima">
							  <input class="form-control input-lg" type="number" max="120" min="40" step="10" placeholder="minima" id="TABDMin" name="TABDMin"/> 
							 </div><!--minima -->
							</div>
						   
						      <br/>
							 <br/>
							 <br/>
							 <br/>
							 <br/>
							 <br/>
						     <div class="col-xs-6">
						     <label class="label label-default" for="pouls">Pouls (battements/min)</label>
							 <input class="form-control input-lg" name="pouls" id="pouls" type="number" min="50" max="130" step="1" placeholder="Fréquence cardiaque"/>
						    </div> 
							
							<div class="col-xs-6">
						     <label class="label label-default" for="taille">Taille (Cm)</label>
							 <input class="form-control input-lg" name="taille" id="taille" type="number" min="35" max="220" step="1" placeholder="Taille en centimètres" />
						    </div> 
						   
						       <br/>
							   <br/>
							   <br/>
							   <br/>
						      <div class="col-xs-6 text-left">
                               <button type="reset" class="btn btn-danger btn-lg">Vider</button>

                              </div>
                              
                              <div class="col-xs-6 text-right">
                               <button type="submit" class="btn btn-success btn-lg">Valider</button>
                              </div>
                              
                           </form>
                         </div><!--panel-body -->
                       </div><!--panel -->
  
     </div><!--col-xs-12-2 -->
   
   </div><!--row-2 -->
   
   
   <!--le modal de confirmation -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confEnregConst">
     <div class="modal-dialog">
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
					 
                       Enregistrement des constantes effectué avec succès ! 
					 
					 </h3>
					 
					  
			  

					  
					  <div class="col-xs-12 text-center">
					   <a href="consultation.php"><button type="button" class="btn btn-info">Fermer</button></a>
					  </div>
					
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--confirmation -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de suppression -->
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confEnregConst" data-backdrop="false" id="btnConfirmEnregConst" />


            <script type="text/javascript">
			  document.getElementById("btnConfirmEnregConst").click();
			     </script>
 </div><!--container-->



<footer>
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
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

</body>
</html>