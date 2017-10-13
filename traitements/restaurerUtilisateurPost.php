<?php
session_start();
include('connexion.php');
$idUtilisateur=intval($_GET['idUtilisateur']);


$req=$bdd->prepare('UPDATE PERSONNE SET VisibleUser=1 WHERE Id=:idUtilisateur');
$req->execute(array('idUtilisateur'=>$idUtilisateur));

header('location:../vue/restauration.php?operation=res');

?>