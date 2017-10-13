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

       $reponseConsult=$bdd->prepare('SELECT * FROM CONSULTATION WHERE CodeConsultation=:CodeConsultation');
       $reponseConsult->execute(array('CodeConsultation'=>$_POST['codeConsult']));
	   $donneesReponseConsult=$reponseConsult->fetch();

if($_POST['issue']=="")
{
	         
			
			 $requeteconsult=$bdd->prepare('UPDATE CONSULTATION SET Plaintes=:Plaintes, ObservationsEtExamenClinique=:ObservationsEtExamenClinique, DiagnosticClinique=:DiagnosticClinique, Diagnostic=:Diagnostic, Remarques=:Remarques WHERE CodeConsultation=:CodeConsultation');


			 
			 $requeteconsult->execute(array(
				   
				   'CodeConsultation'=>$_POST['codeConsult'],
				   'Plaintes'=>$donneesReponseConsult['Plaintes'].'.&nbsp;&nbsp;'.$_POST['plaintes'],
				   'ObservationsEtExamenClinique'=>$donneesReponseConsult['ObservationsEtExamenClinique'].'.&nbsp;&nbsp;'.$_POST['observationEtExamenClinique'],
				   'DiagnosticClinique'=>$donneesReponseConsult['DiagnosticClinique'].'.&nbsp;&nbsp;'.$_POST['diagnosticClinique'],
				   'Diagnostic'=>$donneesReponseConsult['Diagnostic'].'.&nbsp;&nbsp;'.$_POST['diagnostic'],
				   
				   'Remarques'=>$donneesReponseConsult['Remarques'].'.&nbsp;&nbsp;'.$_POST['remarques']));
				   
			
}

else
{
	
	 $requeteconsult=$bdd->prepare('UPDATE CONSULTATION SET Plaintes=:Plaintes, ObservationsEtExamenClinique=:ObservationsEtExamenClinique, DiagnosticClinique=:DiagnosticClinique, Diagnostic=:Diagnostic, Remarques=:Remarques, Issue=:Issue, DateFinConsultation=:DateFinConsultation WHERE CodeConsultation=:CodeConsultation');


			 
			 $requeteconsult->execute(array(
				   
				   'CodeConsultation'=>$_POST['codeConsult'],
				   'Plaintes'=>$donneesReponseConsult['Plaintes'].'.&nbsp;&nbsp;'.$_POST['plaintes'],
				   'ObservationsEtExamenClinique'=>$donneesReponseConsult['ObservationsEtExamenClinique'].'.&nbsp;&nbsp;'.$_POST['observationEtExamenClinique'],
				   'DiagnosticClinique'=>$donneesReponseConsult['DiagnosticClinique'].'.&nbsp;&nbsp;'.$_POST['diagnosticClinique'],
				   'Diagnostic'=>$donneesReponseConsult['Diagnostic'].'.&nbsp;&nbsp;'.$_POST['diagnostic'],
				  
				   'Remarques'=>$donneesReponseConsult['Remarques'].'.&nbsp;&nbsp;'.$_POST['remarques'],
				   'Issue'=>$_POST['issue'],
				   'DateFinConsultation'=>date('Y-m-d H:i:s')));
	
}
				


    echo $_POST['user'];          
		
		$consult=1;	
		echo $consult;

  header('location:../vue/consultationSuivi.php?consult='.$consult.'&IdPatient='.$_POST['patient'].'&codeConsult='.$_POST['codeConsult']);
?>
