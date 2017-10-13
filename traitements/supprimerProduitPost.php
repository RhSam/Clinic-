<?php
session_start();
 include('connexion.php');
 $_GET['IdProduit']=intval($_GET['IdProduit']);
 
 $requete1=$bdd->prepare('DELETE FROM PRODUIT WHERE IdProduit=:IdProduit');

 

 
 $supprProduit=$requete1->execute(array('IdProduit'=>$_GET['IdProduit']));
 echo $supprProduit;
  header('location:../vue/produits.php?supprProduit='.$supprProduit.'&delProduit='.$_GET['NomProduit'].'&formatProduit='.$_GET['FormatProduit'].'&dosageProduit='.$_GET['DosageProduit']);
?>