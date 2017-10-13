

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
 if ($_SESSION['clearance']<3) //les users avec un niveau inf à 2(secrétaires, infirmiers et externes) ne peuvent accéder à l'hospitalisation
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
    <li class="child" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">►Registre</li>
  <br />
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
   
   <div class="row row2">
     
     
     
       
            <?php
	   //requete pour retourner le nombre de patients
	    include_once('../traitements/connexion.php');

$reponseCalcul=$bdd->prepare('SELECT * FROM CONSULTATION'); 
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
              ?>
         
         
        
     
     <div class="col-xs-12">
               <?php
			   //requete paramétrée
			   include_once('../traitements/connexion.php');
               
			   if(isset($_GET['annee-mois']))//si le nom a été saisi en recherche
			   {
				
				
				$reponseCalcul2=$bdd->prepare('SELECT * FROM CONSULTATION WHERE DateDebutConsultation LIKE :Date'); 
				
				
                $reponseCalcul2->execute(array('Date'=>$_GET['annee-mois'].'%'));
                $total2=count($reponseCalcul2->fetchAll());
				
				$reponseCalcul2->closeCursor();
				   
                $reponse=$bdd->prepare('SELECT Id, Per_Id, CodeConsultation, Plaintes, DiagnosticClinique, Diagnostic, DATE_FORMAT(DateFinConsultation, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin, DATE_FORMAT(DateDebutConsultation, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DateDebutConsultation, Issue FROM CONSULTATION WHERE DateDebutConsultation LIKE :Date ORDER BY dateDebut DESC'); 
				
				
                $reponse->execute(array('Date'=>$_GET['annee-mois'].'%'));
			   }
			   else
			   {$reponseCalcul2=$bdd->prepare('SELECT * FROM CONSULTATION'); 
                $reponseCalcul2->execute();
                $total2=count($reponseCalcul2->fetchAll());
				   
                $reponse=$bdd->prepare('SELECT Id, Per_Id, CodeConsultation, Plaintes, DiagnosticClinique, Diagnostic, DATE_FORMAT(DateFinConsultation, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin, DATE_FORMAT(DateDebutConsultation, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DateDebutConsultation, Issue FROM CONSULTATION ORDER BY dateDebut DESC'); 
				
                $reponse->execute();
			   }
              ?>
        <span id="tableau">      
              <div class="panel panel-primary">
                <div class="panel panel-heading">
                
                <form method="get" action="consultationTous.php"> 
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
                    
                  <h4  style="padding-left:41.3%;">  <span class="badge" id="chiffre"><?php echo $total2 ?>/<?php echo $total ?></span>Consultations
                    <div class="pull-right">
                      <button class="btn btn-default" onclick="document.getElementById('annee-mois').value='';document.getElementById('btnRechercher').click();">
                      <a>Afficher toutes les consultations</a>
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
                       <th height="79">Diagnostic (clinique et définitif)</th>
                       <th height="79">Examens médicaux</th>
                       <th height="79">Prescriptions</th>
                       <th height="79">Date de fin et issue</th>
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
								
								
								
								$reponseExam=$bdd->prepare('SELECT * FROM ENREGISTRER_EXAMEN WHERE CodeConsultation=:CodeConsultation'); 
				
                                $reponseExam->execute(array('CodeConsultation'=>$donnees['CodeConsultation']));
								
								
								$reponseOrdon=$bdd->prepare('SELECT * FROM ENREGISTRER_PRODUIT WHERE CodeConsultation=:CodeConsultation'); 
				
                                $reponseOrdon->execute(array('CodeConsultation'=>$donnees['CodeConsultation']));
								
								
								
								//$dateFrOperateur=dateFr($donneesOperateur['DateDeNaissance']);
					            
                          echo '<tr '; if(empty($donnees['dateFin'])){echo 'class="info"';} else {echo ' class="default"';} echo'>
                                 <td height="175">'.$donnees['dateDebut'].'</td>
                                 <td height="175" style="word-wrap: break-word;overflow: auto;">'.$donneesPatient['Prenoms'].'<br/>
								                 '.$donneesPatient['Nom'].'<br/>
												 '.Age($dateFrPatient).' ans</td>
                                 <td height="175" style="word-wrap: break-word;overflow: auto;">'; if($donneesOperateur['IdPrivilege']==2)
								                      {echo 'Inf. ';}
													if($donneesOperateur['IdPrivilege']>2)
													  {echo 'Dr. ';}
													  echo '<br/>'.$donneesOperateur['Prenoms'].'<br/>
								                 '.$donneesOperateur['Nom'].'</td>
								 <td height="175" style="overflow: auto;">Cli:'.$donnees['DiagnosticClinique'].'<br/>
								                 Def:'.$donnees['Diagnostic'].'</td>
                                 <td height="175" style="overflow: auto;">
								  '; while( $donneesExam=$reponseExam->fetch()) 
								           {
											  $reponseExamNom=$bdd->prepare('SELECT * FROM EXAMEN WHERE IdExamen=:IdExamen'); 
				
                                $reponseExamNom->execute(array('IdExamen'=>$donneesExam['IdExamen'])); 
								$donneesExamNom=$reponseExamNom->fetch();
								
											   echo '<label class="label label-primary">'.$donneesExamNom['NomExamen'].'</label><br/><br/>';
										   }
										   
                      echo '  </td> 
								 <td height="175" style="overflow: auto;">
								 
								   '; while( $donneesProduit=$reponseOrdon->fetch()) 
								           {
											$reponseProduitNom=$bdd->prepare('SELECT * FROM PRODUIT WHERE IdProduit=:IdProduit'); 
				
                                $reponseProduitNom->execute(array('IdProduit'=>$donneesProduit['IdProduit'])); 
								$donneesProduitNom=$reponseProduitNom->fetch();
											   echo $donneesProduitNom['NomProduit'].' '.$donneesProduitNom['FormatProduit'].' '.$donneesProduitNom['DosageProduit'].'<br/><br/>';
										   }
										   
                      echo '  </td> 
								 <td height="175">'.$donnees['dateFin'];
								 if(!empty($donnees['dateFin']))
								 {echo '<br>
								  Issue : '.$donnees['Issue']; } echo '</td>
                                 <td height="175" width="50%">';
                                   if(empty($donnees['dateFin']) AND ($donnees['Id']==$_SESSION['idUser'])){echo '
								  
									
									<div style="padding-top:3%;">
									<a  href="consultationSuivi.php?IdPatient='.$donnees['Per_Id'].'&codeConsult='.$donnees['CodeConsultation'].'" ><button class="btn btn-primary btn-sm btn-block">Suivi</button></a>
									</div>
									
									<div style="padding-top:11%;">
									<button data-toggle="modal" href="#nouveauExamen'.$donnees['CodeConsultation'].'" data-backdrop="false" class="btn btn-primary btn-sm btn-block">Examen</button>
									</div>
									
									<div style="padding-top:11%;">
									<button data-toggle="modal" href="#nouveauOrdonnance'.$donnees['CodeConsultation'].'" data-backdrop="false" class="btn btn-primary btn-sm btn-block">Ordonnance</button>
									</div>
									
									<a  href="consultationDetails.php?IdPatient='.$donnees['Per_Id'].'&codeConsult='.$donnees['CodeConsultation'].'" >
									<div style="padding-top:11%;">
								   <button data-toggle="modal" href="#" data-backdrop="false" class="btn btn-default btn-sm btn-block">Voir en détail</button>
								   </a>
								    </div>
									
									
									<!--le modal de confirmation -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="nouveauExamen'.$donnees['CodeConsultation'].'">
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
				  Examen médical
				  </h4>
				 </div>
				   
				 <div class="panel panel-body">
				 
				   <form class="form" action="../traitements/enregExamenPost.php" method="post">
					 
                      <input class="form-control hidden" name="codeConsult" id="codeConsult" value="'.$donnees['CodeConsultation'] ?>" /> 
                      
                      <?php $reponseExamen=$bdd->prepare('SELECT * FROM EXAMEN order by NomExamen'); 
$reponseExamen->execute();?>
					  <input type="hidden" name="patient" value="<?php echo $donnees['Per_Id'];?>"/>
                      
                      <?php echo '
                      
                
                 
					  <div class="col-xs-12">
                       <label class="label label-default" for="examen">Examen médical</label>
                       <select name="examen" id="examen" class="form-control input-lg">';
					   
					    While($donneesExamen=$reponseExamen->fetch())
		  {
			  echo '<option value="'.$donneesExamen['IdExamen'].'">'.$donneesExamen['NomExamen'].'</option>';
		  };
		  echo '
					   </select>
                      </div>
					   <br />
                       <br />
                       <br />
                       <br />
					 
					   <div class="col-xs-12">
                        <div class="col-xs-6 text-left">
						
                        <a href="examens.php"><button type="button" class="btn btn-lg btn-primary"> Nouvel examen <span class="glyphicon glyphicon-edit"></span></button></a>
                        </div>
						
                        <div class="col-xs-6 text-right">
                        <button class="btn btn-lg btn-success" type="submit">Valider et imprimer <span class="glyphicon glyphicon-print"></span></button>
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
   
   <!--fin du modal de nouveau examen -->
   
   
   
   
   <!--le modal de ordonnance-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="nouveauOrdonnance'.$donnees['CodeConsultation'].'">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" data-dismiss="modal" class="btn btn-danger">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				 Ordonnance médicale
				  </h4>
				 </div>
				   
				 <div class="panel panel-body">
				 
				   <form class="form" action="../traitements/enregOrdonnancePost.php" method="post">
					 
                      <input class="form-control hidden" name="codeConsult" id="codeConsult" value="'.$donnees['CodeConsultation'] ?>" /> 
                      
                      <input type="hidden" name="patient" value="<?php echo $donnees['Per_Id'];?>"/>
					  <input type="hidden" name="user" value="<?php echo $_SESSION['idUser'];?>"/>
                      
                      <?php 
					  $reponseProduits=$bdd->prepare('SELECT * FROM PRODUIT order by NomProduit'); 
$reponseProduits->execute();

					  echo '
                      
                
                 
					  <br/>
                 
					  <div class="col-xs-4">
					   
                       <label class="label label-info" for="1">1:</label>
					   
					   
                       <select name="1" id="1" class="form-control">';
					   
					   While($donneesProduits=$reponseProduits->fetch())
		  {
			  echo '<option value="'.$donneesProduits['IdProduit'].'">'.$donneesProduits['NomProduit'].' '.$donneesProduits['FormatProduit'].' '.$donneesProduits['DosageProduit'].'</option>';
		  };
		  echo '
					    
					   </select>
					   
                      </div>
					  
					  <div class="col-xs-4">
					   
                       
					   
					   
					   <div class="col-xs-5">
					   <label class="label label-default text-center">Quantité</label>
                       <input class="form-control" name="qt1a" type="number" max="50" step="1" min="1" value="1" required="required"/>
					    </div>
						
						<div class="col-xs-7">
						<label class="label label-default text-center">Forme</label>
						<select name="qt1b" class="form-control">
						 <option value="Boite(s)">Boite(s)</option>*
						 <option value="Flacon(s)">Flacon(s)</option>
						 <option value="Ampoule(s)">Ampoule(s)</option>
						 <option value="Plaquette(s)">Plaquette(s)</option>
						 <option value="Paquet(s)">Paquet(s)</option>
						 <option value="Dose(s)">Dose(s)</option>
						 <option value="Tube(s)">Tube(s)</option>
						</select>
					    </div>
						
                      </div>
					   
					 <div class="col-xs-4">
					   
                       <label class="label label-default" for="posologie1">posologie</label>
					   
					   
                       <input class="form-control" name="posologie1" id="posologie1" required="required" spellcheck="false" />
					   
                      </div>
					  
					  
					   <br/>
					   <br/>
					   <br/>
					   <br/>
					  ';
					  $reponseProduits=$bdd->prepare('SELECT * FROM PRODUIT order by NomProduit'); 
$reponseProduits->execute();
                       
					   echo '
					  <div class="col-xs-4">
					   
                       <label class="label label-info" for="2">2:</label>
					   
					   
                       <select name="2" id="2" class="form-control">
					   <option value=""></option>';
					   
					   While($donneesProduits=$reponseProduits->fetch())
		  {
			  echo '<option value="'.$donneesProduits['IdProduit'].'">'.$donneesProduits['NomProduit'].' '.$donneesProduits['FormatProduit'].' '.$donneesProduits['DosageProduit'].'</option>';
		  };
		  echo '
					    
					   </select>
					   
                      </div>
					  
					  <div class="col-xs-4">
					   
                       
					   
					   
					   <div class="col-xs-5">
					   <label class="label label-default text-center">Quantité</label>
                       <input class="form-control" name="qt2a" type="number" max="50" step="1" min="1"/>
					    </div>
						
						<div class="col-xs-7">
						<label class="label label-default text-center">Forme</label>
						<select name="qt2b" class="form-control">
						 <option value=""></option>
						 <option value="Boite(s)">Boite(s)</option>
						 <option value="Flacon(s)">Flacon(s)</option>
						 <option value="Ampoule(s)">Ampoule(s)</option>
						 <option value="Plaquette(s)">Plaquette(s)</option>
						 <option value="Paquet(s)">Paquet(s)</option>
						 <option value="Dose(s)">Dose(s)</option>
						 <option value="Tube(s)">Tube(s)</option>
						</select>
					    </div>
						
                      </div>
					   
					 <div class="col-xs-4">
					   
                       <label class="label label-default" for="posologie2">posologie</label>
					   
					   
                       <input class="form-control" name="posologie2" id="posologie2" spellcheck="false" />
					   
                      </div>
					  
					  
					   <br />
                       <br />
                       <br />
                       <br />
					   
					   ';
					  $reponseProduits=$bdd->prepare('SELECT * FROM PRODUIT order by NomProduit'); 
$reponseProduits->execute();
                       
					   echo '
					  <div class="col-xs-4">
					   
                       <label class="label label-info" for="3">3:</label>
					   
					   
                       <select name="3" id="3" class="form-control">
					   <option value=""></option>';
					   
					   While($donneesProduits=$reponseProduits->fetch())
		  {
			  echo '<option value="'.$donneesProduits['IdProduit'].'">'.$donneesProduits['NomProduit'].' '.$donneesProduits['FormatProduit'].' '.$donneesProduits['DosageProduit'].'</option>';
		  };
		  echo '
					    
					   </select>
					   
                      </div>
					  
					  <div class="col-xs-4">
					   
                       
					   
					   
					   <div class="col-xs-5">
					   <label class="label label-default text-center">Quantité</label>
                       <input class="form-control" name="qt3a" type="number" max="50" step="1" min="1"/>
					    </div>
						
						<div class="col-xs-7">
						<label class="label label-default text-center">Forme</label>
						<select name="qt3b" class="form-control">
						<option value=""></option>
						 <option value="Boite(s)">Boite(s)</option>*
						 <option value="Flacon(s)">Flacon(s)</option>
						 <option value="Ampoule(s)">Ampoule(s)</option>
						 <option value="Plaquette(s)">Plaquette(s)</option>
						 <option value="Paquet(s)">Paquet(s)</option>
						 <option value="Dose(s)">Dose(s)</option>
						 <option value="Tube(s)">Tube(s)</option>
						</select>
					    </div>
						
                      </div>
					   
					 <div class="col-xs-4">
					   
                       <label class="label label-default" for="posologie3">posologie</label>
					   
					   
                       <input class="form-control" name="posologie3" id="posologie3"  spellcheck="false" />
					   
                      </div>
					  
					  <br />
                       <br />
                       <br />
                       <br/>
					   
					    ';
					  $reponseProduits=$bdd->prepare('SELECT * FROM PRODUIT order by NomProduit'); 
$reponseProduits->execute();
                       
					   echo '
					  <div class="col-xs-4">
					   
                       <label class="label label-info" for="4">4:</label>
					   
					   
                       <select name="4" id="4" class="form-control">
					   <option value=""></option>';
					   
					   While($donneesProduits=$reponseProduits->fetch())
		  {
			  echo '<option value="'.$donneesProduits['IdProduit'].'">'.$donneesProduits['NomProduit'].' '.$donneesProduits['FormatProduit'].' '.$donneesProduits['DosageProduit'].'</option>';
		  };
		  echo '
					    
					   </select>
					   
                      </div>
					  
					  <div class="col-xs-4">
					   
                       
					   
					   
					   <div class="col-xs-5">
					   <label class="label label-default text-center">Quantité</label>
                       <input class="form-control" name="qt4a" type="number" max="50" step="1" min="1"/>
					    </div>
						
						<div class="col-xs-7">
						<label class="label label-default text-center">Forme</label>
						<select name="qt4b" class="form-control">
						<option value=""></option>
						 <option value="Boite(s)">Boite(s)</option>*
						 <option value="Flacon(s)">Flacon(s)</option>
						 <option value="Ampoule(s)">Ampoule(s)</option>
						 <option value="Plaquette(s)">Plaquette(s)</option>
						 <option value="Paquet(s)">Paquet(s)</option>
						 <option value="Dose(s)">Dose(s)</option>
						 <option value="Tube(s)">Tube(s)</option>
						</select>
					    </div>
						
                      </div>
					   
					 <div class="col-xs-4">
					   
                       <label class="label label-default" for="posologie4">posologie</label>
					   
					   
                       <input class="form-control" name="posologie4" id="posologie4"  spellcheck="false" />
					   
                      </div>
					  
					 
					   <br />
                       <br />
                       <br />
                       <br />
					 
					   <div class="col-xs-12">
                        <div class="col-xs-4 text-left">
                        <button class="btn btn-lg btn-danger" type="reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vider&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span></button>
                        </div>
						
						<div class="col-xs-4 text-center">
						
                        <a href="produits.php"><button type="button" class="btn btn-lg btn-primary"> Nouveau produit <span class="glyphicon glyphicon-edit"></span></button></a>
                        </div>
						
                        <div class="col-xs-4 text-right">
                        <button class="btn btn-lg btn-success" type="submit">Valider et imprimer <span class="glyphicon glyphicon-print"></span></button>
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
   
   <!--fin du modal de nouveau ordonnance -->
									';}
									else{
										echo '<div style="padding-top:50%;">
										<a  href="consultationDetails.php?IdPatient='.$donnees['Per_Id'].'&codeConsult='.$donnees['CodeConsultation'].'" >
								   <button data-toggle="modal" href="#" data-backdrop="false" class="btn btn-default btn-sm btn-block">Voir en détail</button>
								   </a>
								  </div>';
										
									}
		 
		   
		   
		   
		   
	                            
        echo '</td>
                                </tr>';

        
		
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


<!--le modal de confirmation de l'examen-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confirmationExamen">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
           <a href="<?php echo 'consultationTous.php';?>"><button type="button" class="btn btn-danger">x</button></a>
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
					  
					 Nouvel examen médical enregistré pour cette consultation !
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="<?php echo 'consultationTous.php';?>"><button type="button" class="btn btn-info">Fermer</button></a>
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
   
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confirmationExamen" data-backdrop="false" id="btnConfirmExamen" />






<!--le modal de confirmation de ordonnance-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confirmationOrdon">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
           <a href="<?php echo 'consultationTous.php';?>"><button type="button" class="btn btn-danger">x</button></a>
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
					  
					 Nouvele ordonnance médicale enregistrée pour cette consultation !
					 
					 </h3>
					 
					  
			  
					  
					  
					  <div class="col-xs-12 text-center">
					   <a href="<?php echo 'consultationTous.php';?>"><button type="button" class="btn btn-info">Fermer</button></a>
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
   
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confirmationOrdon" data-backdrop="false" id="btnConfirmOrdon" />

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

             <?php
			  if(isset($_GET['newExam']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirmExamen").click();
			     </script>';
			  }
             ?>
             
             
              <?php
			  if(isset($_GET['newOrdon']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirmOrdon").click();
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