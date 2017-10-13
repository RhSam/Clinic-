<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clinic +</title>
<link rel="stylesheet" href="../ressources/css/polices.css" />
<link rel="stylesheet" href="../ressources/bootstrap-3.1.1-dist/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link rel="stylesheet" href="../ressources/css/style.css" />
<link rel="icon" type="image/gif" href="../ressources/images/icone.gif" />
<?php 

$reponseCalculSessions=$bdd->prepare('SELECT * FROM SESSION WHERE Id=:idUtilisateur'); //requete pour calculer le nbr de sessions de cet user
$reponseCalculSessions->execute(array('idUtilisateur'=>$idUtilisateur));
$total=0;
$total=count($reponseCalculSessions->fetchAll());


$reponseSessions=$bdd->prepare('SELECT IdSession, DATE_FORMAT(DateDebutSession, \'%d/%m/%Y \à %H:%i:%S\') AS dateDebut, DATE_FORMAT(DateFinSession, \'%d/%m/%Y \à %H:%i:%S\') AS dateFin FROM SESSION WHERE Id=:idUtilisateur ORDER BY IdSession DESC');
$reponseSessions->execute(array('idUtilisateur'=>$idUtilisateur));
?>

 <div class="col-xs-6">

      <div class="panel panel-info">
      
       <div class="panel-heading entete">
         <h4>Sessions de <?php echo $nomUtilisateur.' '.$prenomsUtilisateur.' : ' ?><span class="badge"><?php echo $total ?></span></h4>
       </div><!--panel-heading -->
       
       <div class="panel-body">
         <table class="table table-bordered table-striped header-fixed">
           <thead>
             <tr>
               <th height="58">Numéro de session</th>
               <th height="58">Date de début de session</th>
               <th height="58">Date de fin de session</th>
             </tr>
           </thead>
           
           <tbody>
             <?php
			  while( $donneesSessions=$reponseSessions->fetch()) 
			  {
				  echo '<tr>
				         <td height="58">'.$donneesSessions['IdSession'].'</td>
						 <td height="58">'.$donneesSessions['dateDebut'].'</td>
						 <td height="58">';
						 if (empty($donneesSessions['dateFin'])) //au cas ou la date de fin de session n'est pas spécifiéée on affiche un message
						     {echo '  Non définie';}
							 else
							 {echo $donneesSessions['dateFin'];} echo '</td>
						</tr>';
			  }
			 ?>
           </tbody>
         </table>
       </div><!--panel-body-->
       
      </div><!--panel -->
      
 </div>