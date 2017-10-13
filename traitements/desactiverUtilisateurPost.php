<?php
session_start();
include('connexion.php');
$idUtilisateur=intval($_GET['idUtilisateur']);

if($idUtilisateur==1) //la désactivation du super-admin (MOI) est impossible
{
}
else
{
$req=$bdd->prepare('UPDATE PERSONNE SET IdPrivilege=0 WHERE Id=:idUtilisateur');
$req->execute(array('idUtilisateur'=>$idUtilisateur));
}
header('location:../vue/comptesUtilisateurs.php?operation=des');

?>