<?php
session_start();
include('connexion.php');
$idPatient=intval($_GET['idPatient']);


$req=$bdd->prepare('DELETE FROM PERSONNE WHERE Id=:idPatient');
$operation=$req->execute(array('idPatient'=>$idPatient));

header('location:../vue/patients.php?operation='.$operation);

?>