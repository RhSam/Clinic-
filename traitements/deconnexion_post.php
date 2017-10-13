<?php

session_start();
 include('../traitements/connexion.php');


//on enregistre la fin de session ouverte pour l'user

$reqSession=$bdd->prepare('UPDATE SESSION SET DateFinSession=:dateFinSession WHERE IdSession=:idSession');
 
$reqSession->execute(array(
       'dateFinSession'=>date('Y-m-d H:i:s'),
	   'idSession'=>$_SESSION['idSession']));

 //on remet les variables de session à vide à vide
$_SESSION['authentification']='';
$_SESSION['idUser']=0;
$_SESSION['idSession']=0;
$_SESSION['clearance']=0;
$_SESSION['userName']='';
$_SESSION['userFirstName']='';

header('location:../vue/acceuil.php'); //on redirige l'user vers la page d'acceuil
?>