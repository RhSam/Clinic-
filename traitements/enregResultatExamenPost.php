<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}



session_start();
 include('connexion.php');
 
$_POST['patient']=intval($_POST['patient']);
$_POST['user']=intval($_POST['user']);



			 $requeteExam=$bdd->prepare('UPDATE ENREGISTRER_EXAMEN SET Laboratoire=:Laboratoire, Resultat=:Resultat WHERE CodeConsultation=:CodeConsultation AND Date=:Date');


			 
			  $requeteExam->execute(array(
				   
				   'CodeConsultation'=>$_POST['codeConsult'],
				   'Date'=>$_POST['date'],
				   'Laboratoire'=>strtoupper(trimUltime($_POST['laboratoire'])),
				   'Resultat'=>$_POST['resultat']));
			
			
echo $_POST['date'];			 
				


    //echo $_POST['user'];          
		
		$resultExam=1;	
			//echo 'bon';

 header('location:../vue/consultationSuivi.php?resultExam='.$resultExam.'&IdPatient='.$_POST['patient'].'&codeConsult='.$_POST['codeConsult']);
?>
