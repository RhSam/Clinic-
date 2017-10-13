<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}

session_start();
 include('connexion.php');
 $_POST['examen']=trimUltime(strtoupper($_POST['examen']));  //
 
 $requetePrincipale=$bdd->prepare('SELECT * FROM EXAMEN WHERE NomExamen=:NomExamen');
 $requetePrincipale->execute(array('NomExamen'=>$_POST['examen']));
 $donneesRequetePrincipale=$requetePrincipale->fetch();
 
 $IdExam=$donneesRequetePrincipale['IdExamen'];
 
 $newExamen=0;
 if($IdExam!="") 
 {             
  echo "Il existe deja"; 
  
  $newExamen=0;   
  
 }
	 else
 {
		 //on va juste créer l'exam
		 
	 $requeteNewExam=$bdd->prepare('INSERT INTO EXAMEN(NomExamen) VALUES (:NomExamen)');
			 
	 $requeteNewExam->execute(array(
			       'NomExamen'=>$_POST['examen']));
	 $newExamen=1;   
 }
 

  header('location:../vue/examens.php?newExamen='.$newExamen.'&examen='.$_POST['examen']);
?>