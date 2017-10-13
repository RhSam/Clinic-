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
 if ($_SESSION['clearance']==0) //les users  externes ne peuvent accéder à l'admission
 {
	 include('accesInterdit.php');
 }
 else
 {
?>  

<div class="col-xs-2 bread">
 
 <ul  class="list-inline">
   <li class="mother"><a href="admission.php">Admission</a></li>
   <li class="child"><a href="nouveauPatient.php">►Nouveau</a></li>
    <br />
   <li class="child" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">►Ancien</li>
  
   
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
          $nav_en_cours='admission';
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
       <div class="panel panel-primary">
            <?php
	   //requete pour retourner le nombre de patients
	    include_once('../traitements/connexion.php');

$reponseCalcul=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=1'); 
$reponseCalcul->execute();
$total=count($reponseCalcul->fetchAll());
              ?>
         
         
         <div class="panel-body">
           <form method="get" action="admissionPourConsultation.php"> 
           
             <div class="col-xs-12 input-group">
             
              <input class="form-control input-lg nom" type="text" autocomplete="off" id="codePatient" name="codePatient" spellcheck="false" onclick="document.getElementById('nom').value='';" placeholder="Code du patient à rechercher" <?php if(isset($_GET['codePatient'])){echo 'value="'.$_GET['codePatient'].'"';}?>/>
             
             <span class="input-group-btn">
              <button type="submit" class="btn btn-primary btn-lg" id="btnRechercher"><span class="glyphicon glyphicon-search"></span>Rechercher</button>
             </span>
             
              
              <input class="form-control input-lg nom" type="text" autocomplete="off" id="nom" name="nom" spellcheck="false" onclick="document.getElementById('codePatient').value='';" placeholder="Nom du patient à rechercher"  <?php if(isset($_GET['nom'])){echo 'value="'.$_GET['nom'].'"';}?>/>
             
              
             </div><!--col-xs-12 input-group -->
            
            </form>
           
            
         </div><!--panel-body -->
         
       </div><!--panel -->
     </div><!--col-xs-12-1 -->
     
     <div class="col-xs-12">
               <?php
			   //requete paramétrée
			   include_once('../traitements/connexion.php');
               
			   if(isset($_GET['nom']))//si le nom a été saisi en recherche
			   {
				
				
				$reponseCalcul2=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=1 AND Nom LIKE :Nom AND CodePatient LIKE :Code ORDER BY Nom'); 
				
				
                $reponseCalcul2->execute(array('Nom'=>trimUltime(strtoupper($_GET['nom'])).'%',
				                         'Code'=>trimUltime(strtoupper($_GET['codePatient'])).'%'));
                $total2=count($reponseCalcul2->fetchAll());
				
				$reponseCalcul2->closeCursor();
				   
                $reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE VisiblePatient=1 AND Nom LIKE :Nom AND CodePatient LIKE :Code ORDER BY Nom'); 
				
				
                $reponse->execute(array('Nom'=>trimUltime(strtoupper($_GET['nom'])).'%',
				                         'Code'=>trimUltime(strtoupper($_GET['codePatient'])).'%'));
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
                      Aficher tous les patients
                      </button>
                    </div>
                  </h4>
                    
                </div><!--panel-heading -->
                
                <div class="panel-body">
                   <table class="table table-bordered table-striped header-fixed2">
                   <thead>
                     <tr>
                       <th height="70">Nom</th>
                       <th height="70">Prénoms</th>
                       <th height="70">Ȃge (ans)</th>
                       <th height="70">Catégorie de patient<br />Et statut</th>
                       <th height="70">N° de Telephone <br />(Domicile et professionnel)</th>
                       
                       <th height="70">Code d'identification</th>
                       <th height="70">Actions</th>
                     </tr>
                   </thead>
                   
                   <tbody>
                     <?php  //fonctions pour calculer l'age
					 
					 

                       
                      while( $donnees=$reponse->fetch()) 
                      {      
					           
		 
		  $req2=$bdd->prepare('SELECT * FROM CATEGORIE WHERE IdCategorie=:IdCategorie'); //requete qui retourne les categories de patient
          $req2->execute(array('IdCategorie'=>$donnees['IdCategorie']));
		  $donnees2=$req2->fetch();
		  
		  
		  
		  
					            $dateFr=dateFr($donnees['DateDeNaissance']);
                          echo '<tr>
                                 <td height="83" style="overflow:auto;">'.$donnees['Nom'].'</td>
                                 <td height="83" style="overflow:auto;">'.$donnees['Prenoms'].'</td>
                                 <td height="83">'.Age($dateFr).'</td>
								 <td height="83" style="overflow:auto;">'.$donnees2['LibelleCategorie'].'<br/><span style="text-decoration:underline">Statut : </span>'.$donnees['Statut'].'</td>
                                 <td height="83" style="overflow:auto;">Dom: '.$donnees['TelephoneDomicile'].'</br>Prof: '.$donnees['TelephoneProfessionnel'].'</td> 
								 <td height="83">'.$donnees['CodePatient'].'</td> 
                                 <td height="83" width="50%">
                                   
                                     
                                     <button data-toggle="modal" href="#modificationVerif'.$donnees['Id'].'" data-backdrop="false" class="btn btn-warning btn-sm btn-block">Afficher/Modifier</button>
									 <div style="padding-top:5%">
                                     <a href="bonDeConsultation.php?Id='.$donnees['Id'].'"><button class="btn btn-default btn-sm btn-block">Bon de consultation</button></a>	
									 </div> 
                                    
                                 </td>
                                </tr>
                                
       
	    <div class="modal fade col-xs-12 col-xs-offset-1" id="modificationVerif'.$donnees['Id'].'">
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
                          Modification
                          </h4>
                         </div>
                           
                         <div class="panel panel-body text-center">
                         
                        <h3>   Afficher et/ou modifier les informations du patient ? </h3>
						   
						       <div class="col-xs-6 text-left">
                               <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
                              </div>
                              
                              <div class="col-xs-6 text-right">
                               <a href="../vue/modifierPatient.php?IdPatient='.$donnees['Id'].'"><button type="button" class="btn btn-success">Oui</button></a>
                              </div>
                              
                           
                         </div><!--panel-body -->
                       </div><!--panel -->
                    </div><!--modification -->
                  
                  
                  
                  
                  
                  
                 </div>
                 
                 <div class="modal-footer">
                
                 </div>
                 
               </div>
             </div>
           </div>
           
           <!--fin du modal de modificatinVerif -->
	                            
        
           
           
         <!--le modal qui demande la confirmation de la désactivation -->
          <div class="modal fade col-xs-12 col-xs-offset-1" id="desactivation'.$donnees['Id'].'">
             <div class="modal-dialog">
               <div class="modal-content">
               
                 <div class="modal-header text-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
                 </div>
                 
                 <div class="modal-body">
                  
                  
                  
                  
                  
                     <div class="col-xs-12 désactivation">
                       <div class="panel panel-default">
                         <div class="panel-heading entete">
                          <h4>
                          Désactivation
                          </h4>
                         </div>
                           
                         <div class="panel panel-body text-center">
                         
                           <form class="form">
                             <h3>
                              ';
                             if($donnees['Id']==1)
                             {
                                 echo 'Il est impossible de désactiver cet administrateur !
                              </h3>
                             
                              <div class="col-xs-12 text-center">
                               <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
                              </div>';
                             }
                             else
                             {
                               echo 'Ȇtes-vous sûr(e) de vouloir désactiver cet utilisateur ?
                               
                               
                             </h3>
                             
                              
                      
                              <div class="col-xs-6 text-left">
                               <button type="button" class="btn btn-success" data-dismiss="modal">Non</button>
                              </div>
                              
                              <div class="col-xs-6 text-right">
                               <a href="../traitements/desactiverUtilisateurPost.php?idUtilisateur='.$donnees['Id'].'"><button type="button" class="btn btn-danger">Oui</button></a>
                              </div>';
                             }
                             echo '
                           </form>
                         </div><!--panel-body -->
                       </div><!--panel -->
                    </div><!--desactiver -->
                  
                  
                  
                  
                  
                  
                 </div>
                 
                 <div class="modal-footer">
                
                 </div>
                 
               </div>
             </div>
           </div>
           
           <!--fin du modal de la désactivation -->
        
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