<?php
session_start();
include('connexion.php');
$idUtilisateur=intval($_GET['idUtilisateur']);

if($idUtilisateur==1) //la suppression du super-admin (MOI) est impossible
{
}
else
{
$req=$bdd->prepare('DELETE FROM PERSONNE WHERE Id=:idUtilisateur');
$operation=$req->execute(array('idUtilisateur'=>$idUtilisateur));
}
header('location:../vue/comptesUtilisateurs.php?operation='.$operation);

?>