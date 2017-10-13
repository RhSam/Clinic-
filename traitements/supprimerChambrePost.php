<?php
session_start();
 include('connexion.php');
 $_GET['idChambre']=intval($_GET['idChambre']);
 
 $requete1=$bdd->prepare('DELETE FROM LIT WHERE NumChambre=:NumChambre');
 $requete1->execute(array('NumChambre'=>$_GET['idChambre']));
 
  $requete2=$bdd->prepare('DELETE FROM CHAMBRE WHERE NumChambre=:NumChambre');
 $requete2->execute(array('NumChambre'=>$_GET['idChambre']));
 
 $supprChambre=1;

  header('location:../vue/materiel.php?suppr='.$supprChambre.'&delChambre='.$_GET['libelleChambre']);
?>