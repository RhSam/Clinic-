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
 if ($_SESSION['clearance']<2) //les users avec un niveau inf à 2( secrétaires et externes) ne peuvent accéder à la consultation
 {
	 include('accesInterdit.php');
 }
 else
 {
 ?>
	 <div class="col-xs-2 bread">
 
 <ul  class="list-inline">
   <li class="mother"><a href="consultation.php">Consultation</a></li>
   <li class="child" id="current">►Constantes</a></li>
    
  
  
   
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
        <?php
		        include_once('../traitements/connexion.php');
		        $reponseCalculConst=$bdd->prepare('SELECT * FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id'); 
                $reponseCalculConst->execute(array('Per_Id'=>$_GET['Per_Id']));
                $totalConst=count($reponseCalculConst->fetchAll());
				   
                $reponseConst=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id ORDER BY Date DESC'); 
				
                $reponseConst->execute(array('Per_Id'=>$_GET['Per_Id']));
		?>
             
                       <div class="panel panel-primary">
                         <div class="panel-heading entete" style="padding-left:21%;">
                          <h4>
                          <?php echo 'Constantes de "'.$_GET['Nom'].' '.$_GET['Prenoms'].'" <span class="badge" id="chiffre">'.$totalConst.'</span>Prises ';?>
                          
                          <div class="pull-right">
                      <button class="btn btn-default"><a href="consultation.php">
                      Revenir à la liste des patients </a>
                      </button>
                    </div> 
                          </h4>
                         </div>
                           
                         <div class="panel-body">
						 
                           
				 <table class="table table-bordered table-striped header-fixed4">
                   <thead>
                     <tr>
                        <th height="79">Date</th>
                       <th height="79">Responsable</th>
                       <th height="79">Température (°C)</th>
                       <th height="79">Poids (Kg)</th>
                       <th height="79">Tension artérielle (mm de Hg)</th>
					   <th height="79">Taille (Cm)</th>
					   <th height="79">Pouls (Battements/min)</th>
                      
                     </tr>
                   </thead>
                   
                   <tbody>
                      
                      <?php while( $donneesConst=$reponseConst->fetch()) 
                      {      
					           $reponseResponsable=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id');                               $reponseResponsable->execute(array('Id'=>$donneesConst['Id']));
							   $donneesResponsable=$reponseResponsable->fetch();
							   
							   
					            
                          echo '<tr>
                                 <td height="62">'.$donneesConst['date'].'</td>
                                 <td height="62">';if($donneesResponsable['IdPrivilege']>2)
								 {echo 'Dr :';} else {echo 'Inf :';} echo ' '.$donneesResponsable['Nom'].' '.$donneesResponsable['Prenoms'].'</td>
                                 <td height="62">'.$donneesConst['Temperature'].'</td>
								 <td height="62">'.$donneesConst['PoidsEnKg'].'</td> 
                                 <td height="62">';if(!empty($donneesConst['TensionArterielleBG'])){echo '-B.G: '.$donneesConst['TensionArterielleBG'].'</br>';} if(!empty($donneesConst['TensionArterielleBD'])){echo '-B.D: '.$donneesConst['TensionArterielleBD'];} echo '</td> 
								 
                                 <td height="62">'.$donneesConst['TailleEnCm'].'</td>
								 <td height="62">'.$donneesConst['Pouls'].'</td>
                               </tr>';
						   
					  }
					  ?>
					  
					       </tbody>
                          </table>
                
               
                         </div><!--panel-body -->
                       </div><!--panel -->
                    
                  
                  
                  
                  
                  
                
     </div><!--col-xs-12-2 -->
   
   </div><!--row-2 -->
   
   
   
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