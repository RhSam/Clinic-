

<?php
function dateFr($date)
					  {
						  return strftime('%d-%m-%Y',strtotime($date));
					  }
					// function Age($date){
						//  $date = preg_split('/\//', $date);
						  
						 // return @floor((strtotime("now") - strtotime($date[1].'/'.$date[2].'/'.$date[0]))/60/60/24/365.25);
					 //}
					 
					   function dateFr2($date)
					  {
						  return strftime('%Y-%m-%d',strtotime($date));
					  }
					 
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
   <li class="mother"><a href="consultation.php">Consultation</a></li>
  <li class="child"><a href="consultationPatients.php">►Patients</a></li>
    <br />
   
  <li class="child"><a href="consultationTous.php">►Registre</a></li>
  <br />
  <li class="grandchild" id="current">»Consulter</li>
   <li class="grandchild" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;" id="current">**Suivi</li>
    <br/>
  <li class="child"><a href="constantesTous.php">►Constantes</a></li>
  
   
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
   
   <div class="col-xs-12 row row2">
     
     <div class="panel panel-primary principal">
      
			<?php
               include('../traitements/connexion.php'); //requuete pour retourner les infos du patient
       
       //on teste si ce patient n'est pas déja dans la base
       $requete1=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id');
       $requete1->execute(array('Id'=>$_GET['IdPatient']));
       $donneesRequete1=$requete1->fetch();
	   
	   $requeteConsult=$bdd->prepare('SELECT * FROM CONSULTATION WHERE CodeConsultation=:CodeConsultation');
       $requeteConsult->execute(array('CodeConsultation'=>$_GET['codeConsult']));
       $donneesConsult=$requeteConsult->fetch();
	   
	   
             ?>
      
      <div class="panel-heading entete">
       <h4>
                   <div class="pull-left" style="margin-top:-2%">
                             <a href="../ressources/photos/<?php echo $donneesRequete1['Photo']?>.jpg"><img src="../ressources/photos/<?php echo $donneesRequete1['Photo']?>.jpg" width="45" class="img-thumbnail img-responsive" /></a>
                     </div>
                    <div  style="padding-left:5%;">
       Suivi de consultation du patient "<?php echo $donneesRequete1['Nom'].' '.$donneesRequete1['Prenoms'];?>" par le Dr: "<?php echo $_SESSION['userName'].' '.$_SESSION['userFirstName'];?>"</div></h4>
      </div><!--panel-head -->
      
      <div class="panel-body principal" style="height:500px;overflow:auto;">
      
      
      
      
      
         <div class="col-xs-8 consult">
        
          <div class="panel panel-info">
           <div class="panel-body" style="height:790px;overflow:auto;">
           
             <div class="panel panel-info">
              <div class="panel-heading entete">
               Précédement
              </div>
              
              <div class="panel-body" style="height:250px;overflow:auto;">
               <table class="table table-bordered table-striped">
                  <tbody>
                   
                  <?php 
                            $requeteConsult=$bdd->prepare('SELECT * FROM CONSULTATION WHERE CodeConsultation=:CodeConsultation');
       $requeteConsult->execute(array('CodeConsultation'=>$_GET['codeConsult']));
       $donneesConsult=$requeteConsult->fetch();
                    ?>
                   <tr>
                    <td>Date de début  : <?php echo dateFr($donneesConsult['DateDebutConsultation']); ?></td>
                   </tr>
                   
                   
                   
                   <tr>
                    <td>Plaintes : <br /><?php echo $donneesConsult['Plaintes']; ?></td>
                   </tr>
                   
                   
                   
                   <tr>
                    <td>Observation et examen clinique :<br /><?php echo $donneesConsult['ObservationsEtExamenClinique']; ?></td>
                   </tr>
                   
                   
                   
                   <tr>
                    <td>Diagnostic clinique : <br /><?php echo $donneesConsult['DiagnosticClinique']; ?></td>
                   </tr>
                   
                   
                   
                   <tr>
                    <td>Diagnostic : <br /><?php echo $donneesConsult['Diagnostic']; ?></td>
                   </tr>
                   
                   
                   
                   
                   
                   
                   <tr style="word-wrap: break-word;">
                    <td>Remarques : <br /><?php echo $donneesConsult['Remarques']; ?></td>
                   </tr>
                  </tbody>
                 </table>
              </div>
              
             </div>
             
             
             <div class="panel panel-info">
              <div class="panel-heading entete">
               Examens médicaux
              </div>
              
              <div class="panel-body" style="height:180px;overflow:auto;">
              
                   
                  <?php 
                           	
								$reponseExam=$bdd->prepare('SELECT CodeConsultation, IdExamen, Laboratoire, Resultat, Date, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date, DATE_FORMAT(Date, \'%d%m%Y%H%i%S\') AS DateUnique FROM ENREGISTRER_EXAMEN WHERE CodeConsultation=:CodeConsultation'); 
				
                                $reponseExam->execute(array('CodeConsultation'=>$_GET['codeConsult']));
     
	
	                 while($donneesExam=$reponseExam->fetch())
					 {
						 $reponseExamNom=$bdd->prepare('SELECT * FROM EXAMEN WHERE IdExamen=:IdExamen'); 
				
                                $reponseExamNom->execute(array('IdExamen'=>$donneesExam['IdExamen'])); 
								$donneesExamNom=$reponseExamNom->fetch();
								
						 echo '<div class="col-xs-6">
						        <div class="panel panel-danger">
								 <div class="panel-heading entete">
								  '.$donneesExamNom['NomExamen'].'
								 </div>
								 
								 <div class="panel-body" style="height:110px;overflow:auto;">';
								  if(empty($donneesExam['Resultat']))
								  {
									  echo'Date : '.$donneesExam['date'];
									  echo '<div style="padding-top:17px;"><button data-toggle="modal" href="#resultatExamen'.$donneesExam['DateUnique'].'" data-backdrop="false" class="btn btn-block btn-success btn-lg">Resultat</button></div>
									  
									  <!--le modal de confirmation -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="resultatExamen'.$donneesExam['DateUnique'].'">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" data-dismiss="modal" class="btn btn-danger">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Résultat de "'.$donneesExamNom['NomExamen'].'"
				  </h4>
				 </div>
				   
				 <div class="panel panel-body">
				 
				   
					 
                      ';?>
                   <form class="form" action="../traitements/enregResultatExamenPost.php" method="post">
                      <input type="hidden" name="patient" value="<?php echo $_GET['IdPatient'];?>"/>
                   
                      <input type="hidden" name="codeConsult" value="<?php echo $_GET['codeConsult'];?>"/>
                      <input type="hidden" name="date" value="<?php echo $donneesExam['Date'];?>"/>
                     
                      
                      <?php echo '
                      
                
                 
					  <div class="col-xs-12">
                       <label class="label label-default" for="laboratoire">Laboratoire</label>
                       <input class="form-control input-lg nom" name="laboratoire" maxlength="50" required="required" />
                      </div>
					   <br />
                       <br />
                       <br />
                       <br />
					   
					   <div class="col-xs-12">
                       <label class="label label-default" for="resultat">Résultat</label>
                       <input class="form-control input-lg" name="resultat" maxlength="200" required="required" />
					   </div>
					 
					   <br />
                       <br />
                       <br />
                       <br />
					   
					   
					   <div class="col-xs-12">
                        <div class="col-xs-6 text-left">
                        <button class="btn btn-lg btn-danger" type="reset">Vider</button>
                        </div>
                        <div class="col-xs-6 text-right">
                        <button class="btn btn-lg btn-success" type="submit">Valider</button>
                        </div>
                       </div>
					  
			  
					
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--nvo examen -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de nouveau examen -->';
								  }
								  else
								  {
									  echo'Date : '.$donneesExam['date'].'<br/>Labo : '.$donneesExam['Laboratoire'].'<br/>Résultat : '.$donneesExam['Resultat'];
								  }
								  
								 echo '</div>
								 
								</div>
						       </div>';
					 }
                    ?>
                   
              </div>
             </div>
             
             
             
             
             
             <div class="panel panel-info">
              <div class="panel-heading entete">
               Prescriptions
              </div>
              
              <div class="panel-body" style="height:180px;overflow:auto;">
              
                   
                  <?php 
                           	
								
								
								$reponseOrdon=$bdd->prepare('SELECT CodeConsultation, IdProduit, Quantite, Posologie, Date, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date FROM ENREGISTRER_PRODUIT WHERE CodeConsultation=:CodeConsultation'); 
				
                                $reponseOrdon->execute(array('CodeConsultation'=>$_GET['codeConsult']));
								
     
	 
	                 while($donneesProduit=$reponseOrdon->fetch())
					 {
						 $reponseProduitNom=$bdd->prepare('SELECT * FROM PRODUIT WHERE IdProduit=:IdProduit'); 
				
                                $reponseProduitNom->execute(array('IdProduit'=>$donneesProduit['IdProduit'])); 
								$donneesProduitNom=$reponseProduitNom->fetch();
								
								
								
						 echo '<div class="col-xs-6">
						        <div class="panel panel-warning" style="height:150px;overflow:auto;">
								 <div class="panel-heading entete">
								  '.$donneesProduitNom['NomProduit'].' '.$donneesProduitNom['FormatProduit'].' '.$donneesProduitNom['DosageProduit'].'
								 </div>
								 
								 <div class="panel-body">
								  Date : '.$donneesProduit['date'].'<br/>
								  Quantité : '.$donneesProduit['Quantite'].'<br/>
								  Posologie : '.$donneesProduit['Posologie'].'
								  
								  
								 </div>
								 
								</div>
						       </div>';
					 }
                    ?>
                   
              </div>
             </div>
           
              
               <form method="post" action="../traitements/enregSuiviConsultationPost.php" id="formEnregConsultation">
               
                  <br />
                  <br />
                  <input class="form-control hidden" name="codeConsult" id="codeConsult" value="<?php if(isset($_GET['codeConsult'])){echo $_GET['codeConsult'];} else {echo $_SESSION['idUser'].'-'.$donneesRequete1['Id'].'-'.date('Y-m-d-H-i-s');} ?>" /> 
                  
                  
                      <input type="hidden" name="patient" value="<?php echo $_GET['IdPatient'];?>"/>
					  <input type="hidden" name="user" value="<?php echo $_SESSION['idUser'];?>"/>
                  
                 <div class="col-xs-12">
                  <label class="label label-default" for="plaintes">Plaintes</label>
                  <textarea class="form-control input-lg" name="plaintes" id="plaintes" placeholder="Plaintes du patient" ></textarea>
                 </div>
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  
                 <div class="col-xs-12">
                  <label class="label label-default" for="observationEtExamenClinique">Observation et examen clinique</label>
                  <textarea class="form-control input-lg" name="observationEtExamenClinique" id="observationEtExamenClinique" placeholder="Conclusions de l'observation et de l'examen clinique du patient" ></textarea>
                 </div>
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  
                 <div class="col-xs-12">
                  <label class="label label-default" for="diagnosticClinique">Diagnostic clinique</label>
                  <textarea class="form-control input-lg" name="diagnosticClinique" id="diagnosticClinique" placeholder="Diagnostic premier basé sur les plaintes, l'observation et l'examen" ></textarea>
                 </div>
                 
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  
                  
                 <!--<div class="col-xs-12">
                  <div class="panel panel-info">
                   <div class="panel-heading entete">
                    <div>
                     Examens médicaux
                     </div>
                     <div class="pull-right" style="margin-top:-4.5%; margin-right:-2%">
                     <button type="button" data-toggle="modal" href="#nouveauExamen" data-backdrop="false" class="btn btn-default btn-sm">Nouveau</button>
                     </div>
                   </div><!--heading -->
                   
                  <!-- <div class="panel-body">
                   </div><!--panel-body -->
                 <!-- </div><!--panel-war -->
              <!--   </div>-->
                 
                 
                  
                  
                 <div class="col-xs-12">
                  <label class="label label-default" for="diagnostic">Diagnostic</label>
                  <textarea class="form-control input-lg" name="diagnostic" id="diagnostice" placeholder="Diagnostic certain, basé sur les résultats d'examens médicaux" ></textarea>
                 </div>
                 
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  
               
                  
                  <!--<div class="col-xs-12">
                  <div class="panel panel-info">
                   <div class="panel-heading entete">
                    Ordonnances
                   </div><!--heading -->
                   
                  <!-- <div class="panel-body">
                   </div><!--panel-body -->
                  <!--</div><!--panel- -->
                <!-- </div> --> 
                 
                 
                  
                  <div class="col-xs-12">
                  <label class="label label-default" for="remarques">Remarques</label>
                  <textarea class="form-control input-lg" name="remarques" id="remarques" placeholder="Remarques diverses concernant la consultation" ></textarea>
                 </div>
                 
                 <br />
                 <br />
                 <br />
                 <br /> 
                 <br />
                 <br />
                 
                 
                 <div class="col-xs-12">
                  <label class="label label-default" for="issue">Issue</label>
                  <select class="form-control input-lg" name="issue" id="issue">
                   <option value="">En attente</option>
                   <option value="Guérison">Guérison</option>
                   <option value="Référé">Référé vers un autre praticien</option>
                   <option value="Mort">Mort</option>
                  </select>
                 </div>
           
                  <br />
                 <br />
                 <br /> 
                 <br />
                 <br /> 
                 
                 
           <div class="col-xs-6 text-left">
            <button type="button" data-toggle="modal" href="#reset" data-backdrop="false" class="btn btn-danger btn-lg">Vider</button>
            
           </div>
           
           <div class="col-xs-6 text-right">
            <button type="button" data-toggle="modal" href="#submit" data-backdrop="false" class="btn btn-success btn-lg">Valider</button>
            </div>
            
               </form>
             </div><!--panel-body -->
           </div><!--panel info -->    
         </div><!-- col-xs-8 offset consult-->    
         
         
         
         
         
      
         <div class="col-xs-4 const">
           <div class="panel panel-info">
            <div class="panel-heading entete">
            Constantes depuis le <?php echo ' <span id="chiffre">'.dateFr($donneesConsult['DateDebutConsultation']).'</span>';?>
            </div><!--panel-heading -->
            
            <div class="panel-body" style="height:166px;overflow:auto;">
              <table class="table table-bordered table-striped">
                  <tbody>
                   
                    <?php 
                            $reponseConstantes=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date >= :Date ORDER BY Date'); 
                            
                            $reponseConstantes->execute(array('Per_Id'=>$_GET['IdPatient'],
                                                  'Date'=>dateFr2($donneesConsult['DateDebutConsultation']).'%'));
                            $constantes=$reponseConstantes;
                    ?>
                   
                   <tr>
                    <td>Date</td><?php while($donneesConstantes=$reponseConstantes->fetch()){if(!empty($donneesConstantes['date'])){echo '<td>'.$donneesConstantes['date'].'</td>';}else{echo'<td></td>';}}?>
                   </tr>
                   
                  <?php 
                            $reponseConstantes=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date >= :Date ORDER BY Date'); 
                            
                            $reponseConstantes->execute(array('Per_Id'=>$_GET['IdPatient'],
                                                  'Date'=>dateFr2($donneesConsult['DateDebutConsultation']).'%'));
                            $constantes=$reponseConstantes;
                    ?>
                   <tr>
                    <td>T°</td><?php while($donneesConstantes=$reponseConstantes->fetch()){if(!empty($donneesConstantes['Temperature'])){echo '<td>'.$donneesConstantes['Temperature'].' °C</td>';}else{echo'<td></td>';}}?>
                   </tr>
                   
                  <?php 
                            $reponseConstantes=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date >= :Date ORDER BY Date'); 
                            
                            $reponseConstantes->execute(array('Per_Id'=>$_GET['IdPatient'],
                                                  'Date'=>dateFr2($donneesConsult['DateDebutConsultation']).'%'));
                            $constantes=$reponseConstantes;
                    ?>
                   
                   <tr>
                    <td>Poids</td><?php while($donneesConstantes=$reponseConstantes->fetch()){if(!empty($donneesConstantes['PoidsEnKg'])){echo '<td>'.$donneesConstantes['PoidsEnKg'].' Kg</td>';}else{echo'<td></td>';}}?>
                   </tr>
                  <?php 
                            $reponseConstantes=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date >= :Date ORDER BY Date'); 
                            
                            $reponseConstantes->execute(array('Per_Id'=>$_GET['IdPatient'],
                                                  'Date'=>dateFr2($donneesConsult['DateDebutConsultation']).'%'));
                            $constantes=$reponseConstantes;
                    ?>
                   
                   <tr>
                    <td>T.A</td><?php while($donneesConstantes=$reponseConstantes->fetch()){echo '<td>BG: '.$donneesConstantes['TensionArterielleBG'].'<br/>BD: '.$donneesConstantes['TensionArterielleBD'].'</td>';}?>
                   </tr>
                   
                   <?php 
                            $reponseConstantes=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date >= :Date ORDER BY Date'); 
                            
                            $reponseConstantes->execute(array('Per_Id'=>$_GET['IdPatient'],
                                                  'Date'=>dateFr2($donneesConsult['DateDebutConsultation']).'%'));
                            $constantes=$reponseConstantes;
                    ?>
                   
                   <tr>
                    <td>Taille</td><?php while($donneesConstantes=$reponseConstantes->fetch()){if(!empty($donneesConstantes['TailleEnCm'])){echo '<td>'.$donneesConstantes['TailleEnCm'].' Cm</td>';}else{echo'<td></td>';}}?>
                   </tr>
                   
                   <?php 
                            $reponseConstantes=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date >= :Date ORDER BY Date'); 
                            
                            $reponseConstantes->execute(array('Per_Id'=>$_GET['IdPatient'],
                                                  'Date'=>dateFr2($donneesConsult['DateDebutConsultation']).'%'));
                            $constantes=$reponseConstantes;
                    ?>
                   
                   <tr>
                    <td>Pouls</td><?php while($donneesConstantes=$reponseConstantes->fetch()){if(!empty($donneesConstantes['Pouls'])){echo '<td>'.$donneesConstantes['Pouls'].'</td>';}else{echo'<td></td>';}}?>
                   </tr>
                   
                  
                   
                  <?php 
                            $reponseConstantes=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date >= :Date ORDER BY Date'); 
                            
                            $reponseConstantes->execute(array('Per_Id'=>$_GET['IdPatient'],
                                                  'Date'=>dateFr2($donneesConsult['DateDebutConsultation']).'%'));
                            $constantes=$reponseConstantes;
                    ?>
                   
                   <tr style="word-wrap: break-word;">
                    <td>Resp:</td><?php while($donneesConstantes=$reponseConstantes->fetch()){
						       $reponseResponsable=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id');                               $reponseResponsable->execute(array('Id'=>$donneesConstantes['Id']));
							   $donneesResponsable=$reponseResponsable->fetch();
							   if($donneesResponsable['IdPrivilege']==2){echo '<td>Inf ';} else {echo '<td>Dr ';} echo ''.$donneesResponsable['Nom'].' '.$donneesResponsable['Prenoms'].'</td>';}?>
                   </tr>
                  </tbody>
                 </table>
             
            </div><!--panel-body -->
           </div><!--panel -->
         </div>
         
         
         
         
      
         <div class="col-xs-4 infos">
       
          <div class="panel panel-info">
            <div class="panel-heading entete">
             
             
             Informations personnelles
             
            </div><!--panel-heading -->
            
            <div class="panel-body infos"  style="height:541px;overflow:auto;">
              
              <table class="table table-striped table-bordered">
                <span id="chiffre">
                <tbody>
                       <tr>
                       <td width="5"><strong>Nom:</strong></td><td><?php echo $donneesRequete1['Nom']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Prénoms:</strong></td><td><?php echo $donneesRequete1['Prenoms']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Âge:</strong></td><td><?php $dateFr=dateFr($donneesRequete1['DateDeNaissance']); echo Age($dateFr);?> ans</td>
                       </tr>
                       <tr>
                       <td><strong>Sexe:</strong></td><td><?php echo $donneesRequete1['Sexe']; ?></td>
                       </tr>
                       
                        <tr>
                       <td><strong>Catégorie :</strong></td><td><?php $req2=$bdd->prepare('SELECT * FROM CATEGORIE WHERE IdCategorie=:IdCategorie'); //requete qui retourne les categories de patient
          $req2->execute(array('IdCategorie'=>$donneesRequete1['IdCategorie']));
		  $donnees2=$req2->fetch(); echo $donnees2['LibelleCategorie'];?></td>
                       </tr>
                       
                       <tr>
                       <td><strong>N° de Téléphone:</strong></td><td><?php echo 'Dom: <span id="chiffre">'.$donneesRequete1['TelephoneDomicile'].'</span><br/>Prof: <span id="chiffre">'.$donneesRequete1['TelephoneProfessionnel'].'</span>';; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Adresse:</strong></td><td><?php echo $donneesRequete1['Adresse']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Pays:</strong></td><td><?php echo $donneesRequete1['PaysOrigine']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Profession:</strong></td><td><?php echo $donneesRequete1['Profession']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Groupe sanguin:</strong></td><td><?php echo $donneesRequete1['GroupeSanguin']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Allergies:</strong></td><td><?php echo $donneesRequete1['Allergies']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Antécédents familiaux:</strong></td><td><?php echo $donneesRequete1['AntecedentsFamiliaux']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Antécédents personnels:</strong></td><td><?php echo $donneesRequete1['AntecedentsPersonnels']; ?></td>
                       </tr>
                       
                       <tr>
                       <td><strong>Vaccinations</strong></td><td><?php echo $donneesRequete1['Vaccins']; ?></td>
                       </tr>
                       <tr>
                       <td><strong>Personne à prévenir:</strong></td><td><?php echo 'Nom: '.$donneesRequete1['PapNom'].'<br/>Prenoms: '.$donneesRequete1['PapPrenoms'].'<br/>Tel Dom: <span id="chiffre">'.$donneesRequete1['PapTelephoneDomicile'].'</span><br/>Tel Prof: <span id="chiffre">'.$donneesRequete1['PapTelephoneProfessionnel'].'</span><br/>E-mail: '.$donneesRequete1['PapEmail']; ?></td>
                       </tr>
                     
                   
                </tbody>
                   
               
              </table>
              
            </div><!--panel-body -->
            
          </div><!--panel-info -->
        
       
        </div><!--col-xs-4 infos-->
       
        
        
        
 
       
        
               
               
       </div><!--panel-body principal-->
           
	  </div><!--panel -->	 
      
  
     
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


<!--le modal qui demande la confirmation du reset -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="reset">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
			 <div class="col-xs-12 reset">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Réinitialisation du formulaire
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  
					   Ȇtes-vous sûr(e) de vouloir vider ce formulaire ?
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-success" id="finModal" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <button type="reset" form="formEnregConsultation" class="hidden" id="resetBtn"></button>
                       <button type="button" onclick="document.getElementById('resetBtn').click();document.getElementById('finModal').click();" class="btn btn-danger">Oui</button>
                       
                       
					  </div>
					 
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--reset -->
            
         </div>
         
        <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de reset-->
   
   
   <!--le modal qui demande confirmation de l'enregistrement -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="submit">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
			 <div class="col-xs-12 submit">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Enregistrement
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  
					   Enregistrement de la consultation !
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-danger" id="finModal2" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <button type="submit" form="formEnregConsultation" class="hidden" id="submitBtn"></button>
                       <button type="button" onclick="document.getElementById('finModal2').click();document.getElementById('submitBtn').click();" class="btn btn-success">Oui</button>
					  </div>
					 
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--reset -->
            
         </div>
         
        <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de la désactivation -->



<!--le modal de confirmation -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confirmationConsult">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="<?php echo 'consultationUn.php?Nom='.$donneesRequete1['Nom'].'&Prenoms='.$donneesRequete1['Prenoms'].'&Per_Id='.$donneesRequete1['Id'];?>"><button type="button" class="btn btn-danger">x</button></a>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 enreg">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Enregistrement
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  
					 La consultation du patient "<?php echo $donneesRequete1['Nom'].' '.$donneesRequete1['Prenoms'];?>" a bien été enregistrée.<br />
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="<?php echo 'consultationUn.php?Nom='.$donneesRequete1['Nom'].'&Prenoms='.$donneesRequete1['Prenoms'].'&Per_Id='.$donneesRequete1['Id'];?>"><button type="button" class="btn btn-info">Fermer</button></a>
					  
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
   
   <!--fin du modal de enregistrement-->
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confirmationConsult" data-backdrop="false" id="btnConfirmEnregConsult" />




<!--le modal de confirmation de l'examen-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confirmationResultExamen">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
           <a href="<?php echo 'consultationSuivi.php?IdPatient='.$_GET['IdPatient'].'&codeConsult='.$_GET['codeConsult'];?>"><button type="button" class="btn btn-danger">x</button></a>
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
					  
					 Résultat d'analyse enregistré avec succès !
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="<?php echo 'consultationSuivi.php?IdPatient='.$_GET['IdPatient'].'&codeConsult='.$_GET['codeConsult'];?>"><button type="button" class="btn btn-info">Fermer</button></a>
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
   
   <!--fin du modal de examen -->
   
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confirmationResultExamen" data-backdrop="false" id="btnConfirmResultExamen" />

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

             <?php
			  if(isset($_GET['consult']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirmEnregConsult").click();
			     </script>';
			  }
             ?>
             
              <?php
			  if(isset($_GET['resultExam']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirmResultExamen").click();
			     </script>';
			  }
             ?>



</body>
</html>
</body>
</html>