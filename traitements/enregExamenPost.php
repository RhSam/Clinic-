<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}



session_start();
 include('connexion.php');
 



			 $requeteExam=$bdd->prepare('INSERT INTO ENREGISTRER_EXAMEN(Date, IdExamen, CodeConsultation) VALUES (:Date, :Examen, :CodeConsultation)');


			 
			  $requeteExam->execute(array(
				   
				   'Date'=>date('Y-m-d H:i:s'),
				   'Examen'=>$_POST['examen'],
				   'CodeConsultation'=>$_POST['codeConsult']));
			
			
			 
				


    //echo $_POST['user'];          
		
		$newExam=1;	
			echo 'bon';

  header('location:../vue/examen.php?exam='.$_POST['examen'].'&Id='.$_POST['patient']);
?>
