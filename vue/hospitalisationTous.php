

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
 if ($_SESSION['clearance']<2) //les users avec un niveau inf à 2(secrétaires et externes) ne peuvent accéder à l'hospitalisation
 {
	 include('accesInterdit.php');
 }
 else
 {
?>  

<div class="col-xs-2 bread">
 
 <ul  class="list-inline">
   <li class="mother"><a href="hospitalisation.php">Hospitalisation</a></li>
  <li class="child"><a href="hospitalisationPatients.php">►Patients</a></li>
    <br />
  <li class="child" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;" id="current">►Registre</li>
  
   
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
   
   <div class="row row2">
     
     
     
       
            <?php
	   //requete pour retourner le nombre de patients
	    include_once('../traitements/connexion.php');

$reponseCalcul=$bdd->prepare('SELECT * FROM HOSPITALISER'); 
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
              ?>
         
         
        
     
     <div class="col-xs-12">
               <?php
			   //requete paramétrée
			   include_once('../traitements/connexion.php');
               
			   if(isset($_GET['annee-mois']))//si le nom a été saisi en recherche
			   {
				
				
				$reponseCalcul2=$bdd->prepare('SELECT * FROM HOSPITALISER WHERE Date LIKE :Date'); 
				
				
                $reponseCalcul2->execute(array('Date'=>$_GET['annee-mois'].'%'));
                $total2=count($reponseCalcul2->fetchAll());
				
				$reponseCalcul2->closeCursor();
				   
                $reponse=$bdd->prepare('SELECT NumLit, Id, Per_Id, Motif, PremiersSoins, DATE_FORMAT(DateFinHospitalisation, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DATE_FORMAT(Date, \'%d-%m-%Y-%H-%i-%S\') AS dateUnique, Date FROM HOSPITALISER WHERE Date LIKE :Date ORDER BY dateDebut DESC'); 
				
				
                $reponse->execute(array('Date'=>$_GET['annee-mois'].'%'));
			   }
			   else
			   {$reponseCalcul2=$bdd->prepare('SELECT * FROM HOSPITALISER'); 
                $reponseCalcul2->execute();
                $total2=count($reponseCalcul2->fetchAll());
				   
                $reponse=$bdd->prepare('SELECT NumLit, Id, Per_Id, Motif, PremiersSoins, DATE_FORMAT(DateFinHospitalisation, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DATE_FORMAT(Date, \'%d-%m-%Y-%H-%i-%S\') AS dateUnique, Date FROM HOSPITALISER ORDER BY dateDebut DESC'); 
				
                $reponse->execute();
			   }
              ?>
        <span id="tableau">      
              <div class="panel panel-primary">
                <div class="panel panel-heading">
                
                <form method="get" action="hospitalisationTous.php"> 
                  <div class="col-xs-5"> 
                   <div class="col-xs-8">
                   <label class="label label-default" for="mois">Mois-Année</label>
                  <input type="month" name="annee-mois" id="annee-mois" class="form-control" <?php if(isset($_GET['annee-mois'])){echo 'value="'.$_GET['annee-mois'].'"';}?>/>
                   </div>
                   
                   <div class="col-xs-4" style="padding-top:2.6%;margin-left:-4%;">
   
                  <button type="submit" class="btn btn-default" id="btnRechercher"><span class="glyphicon glyphicon-search"></span>Rechercher</button>
                   </div>
                  </div><!--col-xs-4 -->
                 </form>   
                    
                  <h4  style="padding-left:41.3%;">  <span class="badge" id="chiffre"><?php echo $total2 ?>/<?php echo $total ?></span>Hospitalisations
                    <div class="pull-right">
                      <button class="btn btn-default" onclick="document.getElementById('annee-mois').value='';document.getElementById('btnRechercher').click();">
                      <a>Afficher toutes les hospitalisations</a>
                      </button>
                    </div>
                  </h4>
                    
                </div><!--panel-heading -->
                
                <div class="panel-body">
                   <table class="table table-bordered header-fixed5">
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
                                 <td height="175" style="overflow:auto;">'.$donneesPatient['Prenoms'].'<br/>
								                 '.$donneesPatient['Nom'].'<br/>
												 '.Age($dateFrPatient).' ans</td>
                                 <td height="175" style="word-wrap: break-word;">'; if($donneesOperateur['IdPrivilege']==2)
								                      {echo 'Inf.  ';}
													if($donneesOperateur['IdPrivilege']>2)
													  {echo 'Dr. ';}
													  echo '<br/>'.$donneesOperateur['Prenoms'].' 
								                 '.$donneesOperateur['Nom'].'</td>
								 <td height="175">Ch:'.$donneesReqChambre['LibelleChambre'].'<br/>
								                 Lit:'.$donneesReqLit['LibelleLit'].'</td>
                                 <td height="175" style="overflow:auto;">'.$donnees['Motif'].'</td> 
								 <td height="175" style="overflow:auto;">'.$donnees['PremiersSoins'].'</td> 
								 <td height="175">'.$donnees['dateFin'].'</td>
                                 <td height="175">';
                                   if(empty($donnees['dateFin'])){echo '
								  <div style="padding-top:14%;">
								   <a href="consultationUn.php?Per_Id='.$donnees['Per_Id'].'"><button class="btn btn-primary btn-sm btn-block">Consulter</button></a>
								  </div>
									
									<div style="padding-top:17%;">
									<button data-toggle="modal" href="#changerLit'.$donnees['dateUnique'].'" data-backdrop="false" class="btn btn-default btn-sm btn-block">Changer de lit</button>
									</div>
									
									<div style="padding-top:16%;">
                                    <button data-toggle="modal" href="#cloturer'.$donnees['dateUnique'].'" data-backdrop="false" class="btn btn-info btn-sm btn-block">Clôturer</button>
									</div>';}
                                    
									 
                                     echo '
									 
                                    
                                 </td>
                                </tr>
                                
       
	 
		   
		  <div class="modal fade col-xs-12 col-xs-offset-1" id="changerLit'.$donnees['dateUnique'].'">
             <div class="modal-dialog">
               <div class="modal-content">
               
                 <div class="modal-header text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
                 </div>
                 
                 <div class="modal-body">
                  
                     <div class="col-xs-12 modificationVerif">
                       <div class="panel panel-default">
                         <div class="panel-heading entete">
                          <h4>
                          Changement de lit du patient "'.$donneesPatient['Prenoms'].' '.$donneesPatient['Nom'].'"
                          </h4>
                         </div>
                           
                         <div class="panel panel-body">
                         
                             <label class="label label-default">Nouveau Chambre-Lit</label>
                                
                              <form method="post" action="../traitements/changerLitTousPost.php">  
                                <select class="form-control input-lg" name="lit" id="lit">
                                
							   ';
                               
                                include_once('../traitements/connexion.php');
								  $reponseChambre=$bdd->prepare('SELECT * FROM CHAMBRE order by LibelleChambre'); //requete qui retourne les infos de la chambre
                                  $reponseChambre->execute();
                               
                                 
                                  while( $donneesChambre=$reponseChambre->fetch()) 
                                  {
                           
									
									$reponseLit=$bdd->prepare('SELECT * FROM LIT WHERE NumChambre=:NumChambre AND Occupe=0 order by LibelleLit'); //requete qui retourne les infos des lits de la chambre
				                    $reponseLit->execute(array('NumChambre'=>$donneesChambre['NumChambre']));
                                       while( $donneesLit=$reponseLit->fetch()) 
                                       {
										   echo '<option value="'.$donneesLit['NumLit'].'">Chambre '.$donneesChambre['LibelleChambre'].', Lit '.$donneesLit['LibelleLit'].'</option>';
									   }
									   
								  }
								    
                                
							echo '    
						       </select>
						<input type="hidden" name="date" value="'.$donnees['Date'].'"/>
						<input type="hidden" name="patient" value="'.$donnees['Per_Id'].'"/>
						<input type="hidden" name="user" value="'.$donnees['Id'].'"/>
						<input type="hidden" name="oldLit" value="'.$donnees['NumLit'].'"/>
						
						       <br/>
							   <br/>
							   
						
						   
						       <div class="col-xs-6 text-left">
                               <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Annuler</button>
                              </div>
                              
                              <div class="col-xs-6 text-right">
                               <button type="submit" class="btn btn-success btn-lg">Valider</button>
                              </div>
                              
                         </form>  
						   
                         </div><!--panel-body -->
                       </div><!--panel -->
                    </div><!--modification -->
                  
                  
                  
                  
                  
                  
                 </div>
                 
                 <div class="modal-footer">
                
                 </div>
                 
               </div>
             </div>
           </div>
           
           <!--fin du modal de modification de lit -->
		   
		   
		   
		   
		    <div class="modal fade col-xs-12 col-xs-offset-1" id="cloturer'.$donnees['dateUnique'].'">
             <div class="modal-dialog">
               <div class="modal-content">
               
                 <div class="modal-header text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
                 </div>
                 
                 <div class="modal-body">
                  
                     <div class="col-xs-12 modificationVerif">
                       <div class="panel panel-default">
                         <div class="panel-heading entete">
                          <h4>
                          Clôture de l\'hospitalisation du patient "'.$donneesPatient['Prenoms'].' '.$donneesPatient['Nom'].'"
                          </h4>
                         </div>
                           
                         <div class="panel panel-body entete">
                         
                             
                                
                              <form method="post" action="../traitements/cloturerHospiTousPost.php">  
							  
                                <h3>
								Êtes vous sûr(e) de vouloir clôturer cette hospitalisation ?
						        <h3/>
						   
						<input type="hidden" name="date" value="'.$donnees['Date'].'"/>
						<input type="hidden" name="patient" value="'.$donnees['Per_Id'].'"/>
						<input type="hidden" name="user" value="'.$donnees['Id'].'"/>
						<input type="hidden" name="oldLit" value="'.$donnees['NumLit'].'"/>
							
						       <div class="col-xs-6 text-left">
                               <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Non</button>
                              </div>
                              
                              <div class="col-xs-6 text-right">
                               <button type="submit" class="btn btn-success btn-lg">Oui</button>
                              </div>
                              
                         </form>  
						   
                         </div><!--panel-body -->
                       </div><!--panel -->
                    </div><!--modification -->
                  
                  
                  
                  
                  
                  
                 </div>
                 
                 <div class="modal-footer">
                
                 </div>
                 
               </div>
             </div>
           </div>
           
           <!--fin du modal de modification de lit -->
		 
		 
		   
		   
		   
		   
	                            
        
 
        ';
                      }
                     ?>
                   </tbody>
                </table>
                
                </div><!--panel-body -->
              </div><!--panel -->
          </span><!--tableau -->    
      
      
     </div><!--col-xs-12-2 -->
     
     
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
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confirmationModifLit">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="hospitalisationTous.php"><button type="button" class="btn btn-danger">x</button></a>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Modification
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  
					 Modification effectuée avec succès !
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="hospitalisationTous.php"><button type="button" class="btn btn-info">Fermer</button></a>
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
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confirmationModifLit" data-backdrop="false" id="btnConfirmModifLit" />



<!--le modal de confirmation de cloture-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confirmationClotureHospi">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="hospitalisationTous.php"><button type="button" class="btn btn-danger">x</button></a>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Clôture
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  
					 La clôture de l'hospitalisation s'est effectuée avec succès !
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="hospitalisationTous.php"><button type="button" class="btn btn-info">Fermer</button></a>
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
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confirmationClotureHospi" data-backdrop="false" id="btnConfirmClotureHospi" />


<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

             <?php
			  if(isset($_GET['modifLit']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirmModifLit").click();
			     </script>';
			  }
             ?>
             
             <?php
			  if(isset($_GET['clotureHospi']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirmClotureHospi").click();
			     </script>';
			  }
             ?>

</body>
</html>