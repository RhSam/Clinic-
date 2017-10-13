<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}

function dateFr($date)
					  {
						  return strftime('%d/%m/%Y',strtotime($date));
					  }

session_start();
 include('connexion.php');
 
$_POST['patient']=intval($_POST['patient']);
$_POST['user']=intval($_POST['user']);
$_POST['lit']=intval($_POST['lit']);
$_POST['oldLit']=intval($_POST['oldLit']);




			
			 $requeteHospi=$bdd->prepare('UPDATE HOSPITALISER SET DateFinHospitalisation=:DateFin WHERE Id=:Id AND Per_Id=:Per_Id AND Date=:Date');


			 
			  $requeteHospi->execute(array(
				   'Id'=>$_POST['user'],
				   'Per_Id'=>$_POST['patient'],
				   'Date'=>$_POST['date'],
				   'DateFin'=>date('Y-m-d H:i:s')));
				   
			
			
				

              $requeteLitOld=$bdd->prepare('UPDATE LIT SET Occupe=0 WHERE NumLit=:NumLit');
			  $requeteLitOld->execute(array('NumLit'=>$_POST['oldLit']));
			  
			  $clotureHospi=1;

  header('location:../vue/hospitalisationUn.php?clotureHospi='.$clotureHospi.'&Nom='.$_POST['Nom'].'&Prenoms='.$_POST['Prenoms'].'&Per_Id='.$_POST['patient']);
?>