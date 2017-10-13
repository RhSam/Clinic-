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
 if ($_SESSION['clearance']<3) //les users avec un niveau inf à 3( secrétaires et externes) ne peuvent accéder à la consultation
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
  <li class="child" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;" id="current">►Constantes</li>
  
   
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
            <?php
	   //requete pour retourner le nombre de patients
	    include_once('../traitements/connexion.php');

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=1'); 
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
              ?>
         
         
         <div class="panel-body">
           <form method="post" action="constantesTous.php"> 
           
             <div class="col-xs-12 input-group">
             
              <input class="form-control input-lg nom" type="text" autocomplete="off" id="codePatient" name="codePatient" spellcheck="false" onclick="document.getElementById('nom').value='';" placeholder="Code du patient à rechercher" <?php if(isset($_POST['codePatient'])){echo 'value="'.$_POST['codePatient'].'"';}?>/>
             
             <span class="input-group-btn">
              <button type="submit" class="btn btn-primary btn-lg" id="btnRechercher"><span class="glyphicon glyphicon-search"></span>Rechercher</button>
             </span>
             
              
              <input class="form-control input-lg nom" type="text" autocomplete="off" id="nom" name="nom" spellcheck="false" onclick="document.getElementById('codePatient').value='';" placeholder="Nom du patient à rechercher"  <?php if(isset($_POST['nom'])){echo 'value="'.$_POST['nom'].'"';}?>/>
             
              
             </div><!--col-xs-12 input-group -->
            
            </form>
           
            
         </div><!--panel-body -->
         
       </div><!--panel -->
     </div><!--col-xs-12-1 -->
     
     <div class="col-xs-12">
               <?php
			   //requete paramétrée
			   include_once('../traitements/connexion.php');
               
			   if(isset($_POST['nom']))//si le nom a été saisi en recherche
			   {
				
				
				$reponseCalcul2=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=1 AND Nom LIKE :Nom AND CodePatient LIKE :Code ORDER BY Nom'); 
				
				
                $reponseCalcul2->execute(array('Nom'=>trimUltime(strtoupper($_POST['nom'])).'%',
				                         'Code'=>trimUltime(strtoupper($_POST['codePatient'])).'%'));
                $total2=count($reponseCalcul2->fetchAll());
				
				$reponseCalcul2->closeCursor();
				   
                $reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=1 AND Nom LIKE :Nom AND CodePatient LIKE :Code ORDER BY Nom'); 
				
				
                $reponse->execute(array('Nom'=>trimUltime(strtoupper($_POST['nom'])).'%',
				                         'Code'=>trimUltime(strtoupper($_POST['codePatient'])).'%'));
			   }
			   else
			   {$reponseCalcul2=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=1'); 
                $reponseCalcul2->execute();
                $total2=count($reponseCalcul2->fetchAll());
				   
                $reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=1 ORDER BY Nom'); 
				
                $reponse->execute();
			   }
              ?>
        <span id="tableau">      
              <div class="panel panel-primary">
                <div class="panel panel-heading" style="padding-left:44.3%;">
                
                  <h4>  <span class="badge" id="chiffre"><?php echo $total2 ?>/<?php echo $total ?></span>Patients
                    <div class="pull-right">
                      <button class="btn btn-default" onclick="document.getElementById('codePatient').value='';document.getElementById('nom').value='';document.getElementById('btnRechercher').click();">
                      <a>Aficher tous les patients</a>
                      </button>
                    </div>
                  </h4>
                    
                </div><!--panel-heading -->
                
                <div class="panel-body">
                   <table class="table table-bordered table-striped header-fixed2">
                   <thead>
                     <tr>
                       <th height="79">Nom</th>
                       <th height="79">Prénoms</th>
                       <th height="79">Ȃge (ans)</th>
                       <th height="79">Catégorie de patient</th>
                       <th height="79">N° de Telephone <br />(Domicile et professionnel)</th>
                       
                       <th height="79">Code d'identification</th>
                       <th height="79">Constantes</th>
                     </tr>
                   </thead>
                   
                   <tbody>
                     <?php  
					 
					 
                       
                      while( $donnees=$reponse->fetch()) 
                      {      
					            $req2=$bdd->prepare('SELECT * FROM CATEGORIE WHERE IdCategorie=:IdCategorie'); //requete qui retourne les categories de patient
          $req2->execute(array('IdCategorie'=>$donnees['IdCategorie']));
		  $donnees2=$req2->fetch();
		  
		  
		  
		  
					            $dateFr=dateFr($donnees['DateDeNaissance']);
                          echo '<tr>
                                 <td height="83">'.$donnees['Nom'].'</td>
                                 <td height="83">'.$donnees['Prenoms'].'</td>
                                 <td height="83">'.Age($dateFr).'</td>
								 <td height="83">'.$donnees2['LibelleCategorie'].'</td>
                                 <td height="83">Dom: '.$donnees['TelephoneDomicile'].'</br>Prof: '.$donnees['TelephoneProfessionnel'].'</td> 
								 <td height="83">'.$donnees['CodePatient'].'</td> 
                                 <td height="83">
                                   
                                    <button data-toggle="modal" href="#constantes'.$donnees['Id'].'" data-backdrop="false" class="btn btn-primary btn-sm btn-block">Nouvelle prise</button>
									
                                    <button class="btn btn-default btn-sm btn-block"> <a href="constantesUn.php?Nom='.$donnees['Nom'].'&Prenoms='.$donnees['Prenoms'].'&Per_Id='.$donnees['Id'].'">Anciennes</a></button>
									 
                                     
									 
                                    
                                 </td>
                                </tr>
                                
       
	    <div class="modal fade col-xs-12 col-xs-offset-1" id="constantes'.$donnees['Id'].'">
             <div class="modal-dialog modal-lg">
               <div class="modal-content">
               
                 <div class="modal-header text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
                 </div>
                 
                 <div class="modal-body">
                  
                     <div class="col-xs-12 modificationVerif">
                       <div class="panel panel-default">
                         <div class="panel-heading entete">
                          <h4>
                          Constantes de "'.$donnees['Prenoms'].' '.$donnees['Nom'].'" relevées par "'.$_SESSION['userFirstName'].' '.$_SESSION['userName'].'"
                          </h4>
                         </div>
                           
                         <div class="panel panel-body">
                           <form class="form" action="../traitements/enregConstantesTousPost.php" method="post">
						      <input type="hidden" name="patient" value="'.$donnees['Id'].'"/>
							  <input type="hidden" name="user" value="'.$_SESSION['idUser'].'"/>
                            <div class="col-xs-6">
						     <label class="label label-default" for="temperature">Température (ºC)</label>
							 <input class="form-control input-lg" name="temperature" id="temperature" type="number" min="30" max="45" step="0.1" placeholder="Température en degré Celcius" required="required"/>
						    </div> 
							
							<div class="col-xs-6">
						     <label class="label label-default" for="poids">Poids (Kg)</label>
							 <input class="form-control input-lg" name="poids" id="poids" type="number" min="3.5" max="250" step="0.1" placeholder="Poids en kilogrammes" />
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
                    </div><!--modification -->
                  
                  
                  
                  
                  
                  
                 </div>
                 
                 <div class="modal-footer">
                
                 </div>
                 
               </div>
             </div>
           </div>
           
           <!--fin du modal des constantes -->
		   
		   
		   
		   
		 
		   
		   
		   
		   
	                            
        
 
        ';
                      }
                     ?>
                   </tbody>
                </table>
                
                </div><!--panel-body -->
              </div><!--panel -->
          </span><!--tableau -->    
      
      
     </div><!--col-xs-12-2 -->
   
   </div><!--row-2 -->
   
   
   <!--le modal de confirmation -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confEnregConst">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="constantesTous.php"><button type="button" class="btn btn-danger">x</button></a>
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
					   <?php
                       
					   if($_GET['const']==1)
					   {
					   echo 'Enregistrement des constantes effectué avec succès !'; 
					   }
					   if($_GET['const']==0)
					   {
						   if($_GET['BG']=='non')
						   {
							   echo 'La tension artérielle au bras gauche que vous avez saisie est incorrecte <br/>';
						   }
						   if($_GET['BD']=='non')
						   {
							   echo 'La tension artérielle au bras droit que vous avez saisie est incorrecte <br/>';
						   }
					   echo 'Enregistrement des constantes avorté, veuillez recommencer !'; 
					   }
					   
					    ?>
					 </h3>
					 
					  
			  

					  
					  <div class="col-xs-12 text-center">
					   <a href="constantesTous.php"><button type="button" class="btn btn-info">Fermer</button></a>
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
<input type="button" class="btn btn-danger hidden" data-toggle="modal" href="#confEnregConst" data-backdrop="false" id="btnConfirmEnregConst" />


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

             <?php
			  if(isset($_GET['const']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirmEnregConst").click();
			     </script>';
			  }
             ?>
             
             
</body>
</html>