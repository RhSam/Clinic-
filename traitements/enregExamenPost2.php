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



			 $requeteExam=$bdd->prepare('INSERT INTO PRESCRIRE_EXAMEN(Id, Per_Id, Date, Designation, CodeConsultation) VALUES (:Id, :Per_Id, :Date, :Designation, :CodeConsultation)');


			 
			  $requeteExam->execute(array(
				   'Id'=>$_POST['user'],
				   'Per_Id'=>$_POST['patient'],
				   'Date'=>date('Y-m-d H:i:s'),
				   'Designation'=>strtoupper(trimUltime($_POST['designation'])),
				   'CodeConsultation'=>$_POST['codeConsult']));
			
			
			 
				


    //echo $_POST['user'];          
		
		$newExam=1;	
			echo 'bon';

  header('location:../vue/consultationTous.php?newExam='.$newExam);
?>
