

<?php
function dateFr($date)
					  {
						  return strftime('%d-%m-%Y',strtotime($date));
					  }
					// function Age($date){
						//  $date = preg_split('/\//', $date);
						  
						 // return @floor((strtotime("now") - strtotime($date[1].'/'.$date[2].'/'.$date[0]))/60/60/24/365.25);
					 //}
					 
					 function Age($date_naissance)
{
	$arr1 = explode('-', $date_naissance);
	$arr2 = explode('-', date('d-m-Y'));
		
	if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
	return $arr2[2] - $arr1[2];

	return $arr2[2] - $arr1[2] - 1;
}



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
 if ($_SESSION['clearance']<3) //les users avec un niveau inf à 2(secrétaires et externes) ne peuvent accéder à l'hospitalisation
 {
	 include('accesInterdit.php');
 }
 else
 {
?>  

<div class="col-xs-2 bread">
 
 <ul  class="list-inline">
   <li class="mother"><a href="patients.php">Patients</a></li>
   <li class="child" id="current"  style="font-size:24px;">►Hospitalisations</li>
   
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
          $nav_en_cours='patients';
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
     
     
     
       
            <?php
	   //requete pour retourner le nombre de patients
	    include_once('../traitements/connexion.php');

$reponseCalcul=$bdd->prepare('SELECT * FROM HOSPITALISER WHERE Per_Id=:Per_Id'); 
$reponseCalcul->execute(array('Per_Id'=>$_GET['Per_Id']));
$total=count($reponseCalcul->fetchAll());
              ?>
         
         
        
     
     <div class="col-xs-12">
               <?php
			   //requete paramétrée
			   include_once('../traitements/connexion.php');
               
			   if(isset($_GET['annee-mois']))//si le nom a été saisi en recherche
			   {
				
				
				$reponseCalcul2=$bdd->prepare('SELECT * FROM HOSPITALISER WHERE Date LIKE :Date AND Per_Id=:Per_Id'); 
				
				
                $reponseCalcul2->execute(array('Date'=>$_GET['annee-mois'].'%',
				                                'Per_Id'=>$_GET['Per_Id']));
                $total2=count($reponseCalcul2->fetchAll());
				
				$reponseCalcul2->closeCursor();
				   
                $reponse=$bdd->prepare('SELECT NumLit, Id, Per_Id, Motif, PremiersSoins, DATE_FORMAT(DateFinHospitalisation, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DATE_FORMAT(Date, \'%d-%m-%Y-%H-%i-%S\') AS dateUnique, Date FROM HOSPITALISER WHERE Date LIKE :Date AND Per_Id=:Per_Id ORDER BY dateDebut DESC'); 
				 
				
                $reponse->execute(array('Date'=>$_GET['annee-mois'].'%',
				                        'Per_Id'=>$_GET['Per_Id']));
			   }
			   else
			   {$reponseCalcul2=$bdd->prepare('SELECT * FROM HOSPITALISER WHERE Per_Id=:Per_Id'); 
                $reponseCalcul2->execute(array('Per_Id'=>$_GET['Per_Id']));
				
                $total2=count($reponseCalcul2->fetchAll());
				   
                $reponse=$bdd->prepare('SELECT NumLit, Id, Per_Id, Motif, PremiersSoins, DATE_FORMAT(DateFinHospitalisation, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DATE_FORMAT(Date, \'%d-%m-%Y-%H-%i-%S\') AS dateUnique, Date FROM HOSPITALISER WHERE Per_Id=:Per_Id ORDER BY dateDebut DESC'); 
				
                $reponse->execute(array('Per_Id'=>$_GET['Per_Id']));
			   }
              ?>
        <span id="tableau">      
              <div class="panel panel-primary">
                <div class="panel panel-heading">
                
                  <div class="entete">
                   <h4>
                   Patient "<?php echo $_GET['Nom'].' '.$_GET['Prenoms'];?>"
                   </h4>
                  </div>
                  
                 <hr />
                
                <form method="get" action="hospitalisationUnPatient.php"> 
                  <div class="col-xs-5"> 
                   <div class="col-xs-8" style="padding-top:-5%;">
                   
                   <input type="hidden" name="Per_Id" id="Per_Id" value="<?php echo $_GET['Per_Id'] ?>" />
                   <input type="hidden" name="Nom" id="Nom" value="<?php echo $_GET['Nom'] ?>" />
                   <input type="hidden" name="Prenoms" id="Prenoms" value="<?php echo $_GET['Prenoms'] ?>" />
                   
                   <label class="label label-default" for="mois">Mois-Année</label>
                  <input type="month" name="annee-mois" id="annee-mois" class="form-control" <?php if(isset($_GET['annee-mois'])){echo 'value="'.$_GET['annee-mois'].'"';}?>/>
                   </div>
                   
                   <div class="col-xs-4" style="padding-top:2.6%;margin-left:-4%;">
   
                  <button type="submit" class="btn btn-default" id="btnRechercher"><span class="glyphicon glyphicon-search"></span>Rechercher</button>
                   </div>
                  </div><!--col-xs-4 -->
                 </form>   
                    
                  <h4  style="padding-left:41.3%;">  <span class="badge" id="chiffre"><?php echo $total2 ?>/<?php echo $total ?></span>Hospitalisations
                    <div class="pull-right" style="padding-top:1.8%;">
                      <button class="btn btn-default" onclick="document.getElementById('annee-mois').value='';document.getElementById('btnRechercher').click();">
                      <a>Afficher toutes les hospitalisations</a>
                      </button>
                    </div>
                    
                  </h4>
                    <br />
                </div><!--panel-heading -->
                
                <div class="panel-body">
                   <table class="table table-bordered header-fixed6">
                   <thead>
                     <tr>
                       <th height="79">Date de début</th>
                       <th height="79">Patient</th>
                       <th height="79">Responsable</th>
                       <th height="79">Chambre-Lit</th>
                       <th height="79">Motif</th>
                       <th height="79">Premiers soins</th>
                       <th height="79">Date de fin</th>
                       <th height="79">Actions</th>
                     </tr>
                   </thead>
                   
                   <tbody>
                     <?php  
					 
					 
                       
                      while( $donnees=$reponse->fetch()) 
                      {      
					            
                          $reponsePatient=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id'); 
				
                                $reponsePatient->execute(array('Id'=>$donnees['Per_Id']));
								$donneesPatient=$reponsePatient->fetch();
								$dateFrPatient=dateFr($donneesPatient['DateDeNaissance']);
								
								
								$reponseOperateur=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id'); 
				
                                $reponseOperateur->execute(array('Id'=>$donnees['Id']));
								$donneesOperateur=$reponseOperateur->fetch();
								
								
								$reqLit=$bdd->prepare('SELECT * FROM LIT WHERE NumLit=:NumLit'); 
				                $reqLit->execute(array('NumLit'=>$donnees['NumLit']));
								$donneesReqLit=$reqLit->fetch();
								
								$reqChambre=$bdd->prepare('SELECT * FROM CHAMBRE WHERE NumChambre=:NumChambre'); 
				                $reqChambre->execute(array('NumChambre'=>$donneesReqLit['NumChambre']));
								$donneesReqChambre=$reqChambre->fetch();
								
								
								//$dateFrOperateur=dateFr($donneesOperateur['DateDeNaissance']);
					            
                          echo '<tr '; if(empty($donnees['dateFin'])){echo 'class="info"';} else {echo ' class="default"';} echo'>
                                 <td height="175">'.$donnees['dateDebut'].'</td>
                                 <td height="175" style="word-wrap: break-word;">'.$donneesPatient['Prenoms'].'<br/>
								                 '.$donneesPatient['Nom'].'<br/>
												 '.Age($dateFrPatient).' ans</td>
                                 <td height="175" style="word-wrap: break-word;">'; if($donneesOperateur['IdPrivilege']==2)
								                      {echo 'Inf. ';}
													if($donneesOperateur['IdPrivilege']>2)
													  {echo 'Dr. ';}
													  echo '<br/>'.$donneesOperateur['Prenoms'].'<br/>
								                 '.$donneesOperateur['Nom'].'</td>
								 <td height="175">Ch:'.$donneesReqChambre['LibelleChambre'].'<br/>
								                 Lit:'.$donneesReqLit['LibelleLit'].'</td>
                                 <td height="175" style="word-wrap: break-word;">'.$donnees['Motif'].'</td> 
								 <td height="175" style="word-wrap: break-word;">'.$donnees['PremiersSoins'].'</td> 
								 <td height="175">'.$donnees['dateFin'].'</td>
                                 <td height="175" width="50%"></td>
								 
                                </tr>';
					  }
       
	?>
		 
     
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
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

            
</body>
</html>
</body>
</html>