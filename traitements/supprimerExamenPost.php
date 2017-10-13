<?php
session_start();
 include('connexion.php');
 $_GET['IdExamen']=intval($_GET['IdExamen']);
 
 $requete1=$bdd->prepare('DELETE FROM EXAMEN WHERE IdExamen=:IdExamen');

 

 
 $supprExam=$requete1->execute(array('IdExamen'=>$_GET['IdExamen']));
 echo $supprExam;
  header('location:../vue/examens.php?supprExam='.$supprExam.'&delExam='.$_GET['NomExamen']);
?>