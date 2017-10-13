<?php
session_start();
 include('connexion.php');  //le formulaire du modal nous est venu avec le idUtilisateur en GET
$idUtilisateur=intval($_POST['idUtilisateur']);  //on convertit le $_GET['idUtilisateur'] en entier
                                            //requete d'insertion
$req=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:idUtilisateur');
 
$req->execute(array('idUtilisateur'=>$idUtilisateur));

$donnees = $req->fetch();  

if($donnees['Pass']==$_POST['password'])
{
	header('location:../vue/modifierUtilisateur.php?idUtilisateur='.$idUtilisateur.'');
}
else
{
	$trouve='non';
	header('location:../vue/comptesUtilisateurs.php?idUtilisateur='.$idUtilisateur.'&trouve='.$trouve);
}
?>

