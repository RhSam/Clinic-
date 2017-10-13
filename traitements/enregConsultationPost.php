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


if($_POST['issue']=="")
{
			
			 $requeteconsult=$bdd->prepare('INSERT INTO CONSULTATION(Id, Per_Id, DateDebutConsultation, Plaintes, ObservationsEtExamenClinique, DiagnosticClinique, Diagnostic,  Remarques) VALUES (:Id, :Per_Id, :Date, :Plaintes, :ObservationsEtExamenClinique, :DiagnosticClinique, :Diagnostic, :Remarques)');


			 
			 $requeteconsult->execute(array(
				   'Id'=>$_POST['user'],
				   'Per_Id'=>$_POST['patient'],
				   'Date'=>date('Y-m-d H:i:s'),
				  
				   'Plaintes'=>$_POST['plaintes'],
				   'ObservationsEtExamenClinique'=>$_POST['observationEtExamenClinique'],
				   'DiagnosticClinique'=>$_POST['diagnosticClinique'],
				   'Diagnostic'=>$_POST['diagnostic'],
				   
				   'Remarques'=>$_POST['remarques']));
				   
			
}

else
{
	
	$requeteconsult=$bdd->prepare('INSERT INTO CONSULTATION(Id, Per_Id, DateDebutConsultation, Plaintes, ObservationsEtExamenClinique, DiagnosticClinique, Diagnostic, Remarques, Issue, DateFinConsultation) VALUES (:Id, :Per_Id, :Date, :Plaintes, :ObservationsEtExamenClinique, :DiagnosticClinique, :Diagnostic, :Remarques, :Issue, :DateFinConsultation)');


			 
			 $requeteconsult->execute(array(
				   'Id'=>$_POST['user'],
				   'Per_Id'=>$_POST['patient'],
				   'Date'=>date('Y-m-d H:i:s'),
				   
				   'Plaintes'=>$_POST['plaintes'],
				   'ObservationsEtExamenClinique'=>$_POST['observationEtExamenClinique'],
				   'DiagnosticClinique'=>$_POST['diagnosticClinique'],
				   'Diagnostic'=>$_POST['diagnostic'],
				   
				   'Remarques'=>$_POST['remarques'],
				   'Issue'=>$_POST['issue'],
				   'DateFinConsultation'=>date('Y-m-d H:i:s')));
	
}
				


    echo $_POST['user'];          
		
		$consult=1;	
		echo $consult;

  header('location:../vue/nouvelleConsultation.php?consult='.$consult.'&IdPatient='.$_POST['patient']);
?>
