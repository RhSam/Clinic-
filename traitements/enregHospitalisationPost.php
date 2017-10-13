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


$requeteVerif=$bdd->prepare('SELECT * FROM HOSPITALISER WHERE Per_Id=:Per_Id ORDER BY Date DESC LIMIT 0, 1');
$requeteVerif->execute(array('Per_Id'=>$_POST['patient']));

$donneesRequeteVerif=$requeteVerif->fetch();

$dateDebut=$donneesRequeteVerif['Date'];
$dateFin=$donneesRequeteVerif['DateFinHospitalisation'];

echo 'date debut :'.$dateDebut;
echo '  date Fin :'.$dateFin;

if($dateDebut!='' AND $dateFin=='')
{
	$hospi=0;
}
else
{

			
			 $requeteHospi=$bdd->prepare('INSERT INTO HOSPITALISER(Id, Per_Id, Date, Motif, PremiersSoins, NumLit) VALUES (:Id, :Per_Id, :Date, :Motif, :PremiersSoins, :NumLit)');


			 
			  $requeteHospi->execute(array(
				   'Id'=>$_POST['user'],
				   'Per_Id'=>$_POST['patient'],
				   'Date'=>date('Y-m-d H:i:s'),
				   'Motif'=>$_POST['motif'],
				   'PremiersSoins'=>$_POST['premiersSoins'],
				   'NumLit'=>$_POST['lit']));
				   
			
			
			  $requeteLit=$bdd->prepare('UPDATE LIT SET Occupe=1 WHERE NumLit=:NumLit');
			  $requeteLit->execute(array('NumLit'=>$_POST['lit']));
				


    //echo $_POST['user'];          
		
		$hospi=1;	
			echo 'bon';
}
  header('location:../vue/hospitalisationUn.php?hospi='.$hospi.'&Nom='.$_POST['Nom'].'&Prenoms='.$_POST['Prenoms'].'&Per_Id='.$_POST['patient']);
?>
