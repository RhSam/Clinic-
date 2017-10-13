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

function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
//$chaine = eregi_replace("[ ]+", " ", $chaine);
return $chaine;
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
<title>dossier médical édité le <?php echo date('d-m-Y \à H:i:s');?> </title>
<link rel="stylesheet" href="../ressources/css/polices2.css" />
<link rel="stylesheet" href="../ressources/bootstrap-3.1.1-dist/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link rel="stylesheet" href="../ressources/css/style2.css" />
<link rel="icon" type="image/gif" href="../ressources/images/icone.gif" />
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>
<script type="text/javascript" src="../ressources/js/heure.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>

<script language="javascript">
<!--
window.print()
//-->
</script> 
</head>

     

<body>

<?php //sécurité contre l'accès à la page par l'url directement
 if ($_SESSION['clearance']<1) //les users avec un niveau inf à 3(infirmiers , secrétaires et externes) ne peuvent accéder aux dossiers  des patients
 {
	 include('accesInterdit.php');
 }
 else
 {
 include('../traitements/connexion.php');
 $requete1=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id');
 $requete1->execute(array('Id'=>$_POST['Id']));
 $donneesRequete1=$requete1->fetch();
 
 
?> 

<div class="container col-xs-12">
 

   <div class="row row1">

   	 <div class="text-center">

   	 	<h1 style="font-size:40px;">Ma CLINIQUE</h1>
        <h2>Arrêté Nº 021/99/MS du 11 Fév. 1999</h2>
        <h2>Docteur NKOUNOU Y. C. Eddie</h2>
        <h3>Route de KEGUE près du Nouveau Stade Municipal<br />B.P. 30032 Tél: 22 25 75 45 Lomé-TOGO</h3>
<hr />
   	 </div>
     
     <div class="text-center">
     <label class="label label-default">
      Clinic+
     </label>
     </div>
     
     <div>
      <h3 class="text-center">Lomé le <?php echo date('d/m/Y');?></h3>
      <h2 class="text-center" style="text-decoration:underline;">Rapport médical du <?php echo date("d/m/Y", strtotime($_POST['date']));; ?><h2><h2 class="text-center"><?php if($donneesRequete1['Sexe']='M'){echo 'M. ';} else {echo 'Mme. ';} echo $donneesRequete1['Nom'].' '.$donneesRequete1['Prenoms'];?> </h2>
       <br />
      
      <h3 style="font-size:18px;">
      &nbsp;&nbsp;<strong style="">Code d'identification</strong> <?php echo ': '.$donneesRequete1['CodePatient'];?>
      
       <br />
       
      &nbsp;&nbsp;<strong style="">Nom</strong> <?php echo ': '.$donneesRequete1['Nom'];?>
      
       <br />
       
      &nbsp;&nbsp;<strong style="">Prenoms</strong> <?php echo ': '.$donneesRequete1['Prenoms'];?>
      
      <br />
       
      &nbsp;&nbsp;<strong style="">Âge</strong> <?php echo ': '.Age(dateFr($donneesRequete1['DateDeNaissance'])).' ans';?>
      
      <br />
      
      <?php if(!empty($donneesRequete1['NomDeJeuneFille'])) echo '&nbsp;&nbsp;<strong>Nom de jeune fille</strong>'.$donneesRequete1['NomDeJeuneFille'].'
      
      <br />';?>
      
      
       
      &nbsp;&nbsp;<strong style="">Sexe</strong> <?php if($donneesRequete1['Sexe']=='M') echo ': Masculin'; else echo ': Féminin';?>
      
      <br />
       
      &nbsp;&nbsp;<strong style="">Contact</strong> <?php if(!empty($donneesRequete1['TelephoneDomicile'])) echo ' <br/>&nbsp;&nbsp;&nbsp;&nbsp;Domicile : '.$donneesRequete1['TelephoneDomicile'].'<br/>'; if(!empty($donneesRequete1['TelephoneProfessionnel'])) echo ' &nbsp;&nbsp;&nbsp;&nbsp;Professionnel : '.$donneesRequete1['TelephoneProfessionnel']; if(!empty($donneesRequete1['Email'])) echo ' <br/>&nbsp;&nbsp;&nbsp;&nbsp;E-Mail : '.$donneesRequete1['Email'];?>
      
      
      </h3>
     </div>
     
     
     <hr>
      <hr>
      <br />
      
            <div><!--constantes -->
     
      <div class="col-xs-12 const">
      
    
    <?php  
                $reponseCalculConst=$bdd->prepare('SELECT * FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date LIKE :Date ORDER BY Date DESC'); 
                $reponseCalculConst->execute(array('Per_Id'=>$_POST['Id'],
				                                    'Date'=>$_POST['date'].'%'));
                $totalConst=count($reponseCalculConst->fetchAll());
				   
                $reponseConst=$bdd->prepare('SELECT Id, Per_Id, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date  FROM RELEVER_PARAMETRE WHERE Per_Id=:Per_Id AND Date LIKE :Date ORDER BY Date DESC'); 
				
                $reponseConst->execute(array('Per_Id'=>$_POST['Id'],
				                             'Date'=>$_POST['date'].'%'));
		?>
             
                      
                          <h3 class="text-center">
                          <label class="label label-danger"><?php echo 'Constantes ('.$totalConst.'Prises)';?>
                          
                          </label><br /><br />
                          </h3>
                         
                           
                         
						 
                           
				 <table class="table table-bordered table-striped">
                   <thead>
                     <tr>
                        <th height="50" width="10%">Date</th>
                       <th height="50" width="14%">Responsable</th>
                       <th height="50" width="15%">T°</th>
                       <th height="50">Poids</th>
                       <th height="50" width="20%">Tension artérielle</th>
					   <th height="50">Taille</th>
					   <th height="50">Pouls </th>
                      
                     </tr>
                   </thead>
                   
                   <tbody>
                      
                      <?php while( $donneesConst=$reponseConst->fetch()) 
                      {      
					           $reponseResponsable=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id');                               $reponseResponsable->execute(array('Id'=>$donneesConst['Id']));
							   $donneesResponsable=$reponseResponsable->fetch();
							   
							   
					            
                          echo '<tr>
                                 <td height="62">'.$donneesConst['date'].'</td>
                                 <td height="62" width="19%">';if($donneesResponsable['IdPrivilege']>2)
								 {echo 'Dr ';} else {echo 'Infirmier(e) ';} echo ' '.$donneesResponsable['Nom'].' '.$donneesResponsable['Prenoms'].'</td>
                                 <td height="62">'.$donneesConst['Temperature'].' °C</td>
								 ';
								 
								 if(!empty($donneesConst['PoidsEnKg'])){echo '<td>'.$donneesConst['PoidsEnKg'].' Kg</td>';}else{echo'<td></td>';}
								  
								  echo '
                                 <td height="62">';if(!empty($donneesConst['TensionArterielleBG'])){echo '-B.G: '.$donneesConst['TensionArterielleBG'].'</br>';} if(!empty($donneesConst['TensionArterielleBD'])){echo '-B.D: '.$donneesConst['TensionArterielleBD'];} echo '</td> ';
								 
								 
								 if(!empty($donneesConst['TailleEnCm'])){echo '<td>'.$donneesConst['TailleEnCm'].' Cm</td>';}else{echo'<td></td>';}
								 
								 if(!empty($donneesConst['Pouls'])){echo '<td>'.$donneesConst['Pouls'].'</td>';}else{echo'<td></td>';}
								 echo '
                                 
								
                               </tr>';
						   
					  }
					  ?>
					  
					       </tbody>
                          </table>
                
          </div><!--const -->     
                         
             </div><!--constantes -->






<div class="col-xs-12 consult">
<hr />
<hr />
 
  <br />
  <br />
  <br />
  
  <?php $reponseCalcul2=$bdd->prepare('SELECT * FROM CONSULTATION WHERE Per_Id=:Per_Id AND DateDebutConsultation LIKE :Date '); 
                $reponseCalcul2->execute(array('Per_Id'=>$_POST['Id'],
				                               'Date'=>$_POST['date'].'%'));
				
                $total2=count($reponseCalcul2->fetchAll());
				   
                $reponse=$bdd->prepare('SELECT Id, Per_Id, CodeConsultation, Plaintes, ObservationsEtExamenClinique, DiagnosticClinique, Diagnostic, Remarques, Issue, DATE_FORMAT(DateFinConsultation, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin, DATE_FORMAT(DateDebutConsultation, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DATE_FORMAT(DateDebutConsultation, \'%d-%m-%Y-%H-%i-%S\') AS dateUnique, DateDebutConsultation, Issue FROM CONSULTATION WHERE Per_Id=:Per_Id AND DateDebutConsultation LIKE :Date ORDER BY dateDebut'); 
				
                $reponse->execute(array('Per_Id'=>$_POST['Id'],
				                        'Date'=>$_POST['date'].'%'));
   ?>
 <h3 class="text-center"> <label class="label label-danger">Consultations (<?php echo $total2 ?>)</label> </h3>

<br />
<br />
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
								
								
								
								$reponseExam=$bdd->prepare('SELECT CodeConsultation, IdExamen, Laboratoire, Resultat, Date, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date FROM ENREGISTRER_EXAMEN WHERE CodeConsultation=:CodeConsultation'); 
				
                                $reponseExam->execute(array('CodeConsultation'=>$donnees['CodeConsultation']));
								
								
								$reponseOrdon=$bdd->prepare('SELECT CodeConsultation, IdProduit, Quantite, Posologie, Date, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS date FROM ENREGISTRER_PRODUIT WHERE CodeConsultation=:CodeConsultation'); 
				
                                $reponseOrdon->execute(array('CodeConsultation'=>$donnees['CodeConsultation']));
								
								
					  
 echo '<strong>Consultation du : </strong>'.$donnees['dateDebut'].'<br/>';
 
 echo '<strong>Médecin traitant : </strong>Dr '.$donneesOperateur['Nom'].' '.$donneesOperateur['Prenoms'].'<br/><br/>';
 
 echo '<strong>Plaintes : </strong>'.$donnees['Plaintes'].'<br/>';
 
 echo '<strong>Observations et examen clinique : </strong>'.$donnees['ObservationsEtExamenClinique'].'<br/>';
 
 echo '<strong>Diagnostic clinique : </strong>'.$donnees['DiagnosticClinique'].'<br/>';
 
 echo '<strong>Diagnostic définitif : </strong>'.$donnees['Diagnostic'].'<br/>';
 
 
 echo '<strong>Date de clôture : </strong>'.$donnees['dateFin'].'<br/>';
 
 echo '<strong>Issue : </strong>'.$donnees['Issue'].'<br/><br/>';
 
  echo '<label class="label label-danger">Examens médicaux</label><br/><br/>';
 
 
 while($donneesExam=$reponseExam->fetch())
					 {
						 $reponseExamNom=$bdd->prepare('SELECT * FROM EXAMEN WHERE IdExamen=:IdExamen'); 
				
                                $reponseExamNom->execute(array('IdExamen'=>$donneesExam['IdExamen'])); 
								$donneesExamNom=$reponseExamNom->fetch();
								
						 echo '<div style="text-decoration:underline"><strong>'.$donneesExamNom['NomExamen'].'</strong></div>
								 
								 
								';
								  if(empty($donneesExam['Resultat']))
								  {
									  echo'Date : '.$donneesExam['date'];
									  echo '<br/>En attente de résultat<br/><br/>
									  
									 ';
								  }
								  else
								  {
									  echo'Date : '.$donneesExam['date'].'<br/>Laboratoire : '.$donneesExam['Laboratoire'].'<br/>Résultat : '.$donneesExam['Resultat'].'<br/><br/>';
								  }
								
					 }
					 
					 
					 
					 
					 
  echo '<br /><label class="label label-danger">Prescriptions</label><br/><br/>';		
  
   while($donneesProduit=$reponseOrdon->fetch())
					 {
						 $reponseProduitNom=$bdd->prepare('SELECT * FROM PRODUIT WHERE IdProduit=:IdProduit'); 
				
                                $reponseProduitNom->execute(array('IdProduit'=>$donneesProduit['IdProduit'])); 
								$donneesProduitNom=$reponseProduitNom->fetch();
								
								
								
						 echo '<div style="text-decoration:underline"><strong>'.$donneesProduitNom['NomProduit'].' '.$donneesProduitNom['FormatProduit'].' '.$donneesProduitNom['DosageProduit'].'
								 </strong></div>
								 
								
								  Date : '.$donneesProduit['date'].'<br/>
								  Quantité : '.$donneesProduit['Quantite'].'<br/>
								  Posologie : '.$donneesProduit['Posologie'].'
								  
								  
								<br/><br/>';
					 }			 
					 
 echo '<br/><hr><br/><br/>';
					  }
?>
<hr /><hr />
</div><!--consultations -->








<div class="col-xs-12 hospi">
<br />

<?php

$reponseCalcul4=$bdd->prepare('SELECT * FROM HOSPITALISER WHERE Per_Id=:Per_Id AND Date LIKE :Date'); 
                $reponseCalcul4->execute(array('Per_Id'=>$_POST['Id'],
				                                'Date'=>$_POST['date'].'%'));
				
                $total4=count($reponseCalcul4->fetchAll());
				   
                $reponse4=$bdd->prepare('SELECT NumLit, Id, Per_Id, Motif, PremiersSoins, DATE_FORMAT(DateFinHospitalisation, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin, DATE_FORMAT(Date, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DATE_FORMAT(Date, \'%d-%m-%Y-%H-%i-%S\') AS dateUnique, Date FROM HOSPITALISER WHERE Per_Id=:Per_Id AND Date LIKE :Date ORDER BY dateDebut DESC'); 
				
                $reponse4->execute(array('Per_Id'=>$_POST['Id'],
				                           'Date'=>$_POST['date'].'%'));
 ?>
<h3 class="text-center"> <label class="label label-danger">Hospitalisations (<?php echo $total4 ?>)</label> </h3>
<br />
<br />
<?php 

 while( $donnees4=$reponse4->fetch()) 
                      {     
					  
					  
					  $reponseOperateur4=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id'); 
				
                                $reponseOperateur4->execute(array('Id'=>$donnees4['Id']));
								$donneesOperateur4=$reponseOperateur4->fetch();
					  
					  echo '<strong>Débutée le: </strong>'.$donnees4['dateDebut'].'<br/>';
 
 echo '<strong>Responsable : </strong>'; if($donneesOperateur['IdPrivilege']>=3){echo 'Dr ';}else{echo 'Infirmier(e) ';} echo $donneesOperateur['Nom'].' '.$donneesOperateur['Prenoms'].'<br/>';
 echo '<strong>Motif: </strong>'.$donnees4['Motif'].'<br/>';
 echo '<strong>Premiers soins: </strong>'.$donnees4['PremiersSoins'].'<br/><br/><hr/>';
					  }
					  
					  ?>
</div><!--hospi -->


   </div>

</div>

<?php
//header('location:admissionPourConsultation.php');

 }
?>         
          

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">history.go(-1);</script>



 
 
</body>
</html>