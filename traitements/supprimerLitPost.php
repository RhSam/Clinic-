<?php
session_start();
 include('connexion.php');
 $_GET['idLit']=intval($_GET['idLit']);
 
 
 $requeteVerif=$bdd->prepare('SELECT * FROM LIT WHERE NumLit=:NumLit');
 $requeteVerif->execute(array('NumLit'=>$_GET['idLit']));
 $donneesRequeteVerif=$requeteVerif->fetch();
 
 if($donneesRequeteVerif['Occupe']==0)
 {
 
 
 $requete2=$bdd->prepare('DELETE FROM LIT WHERE NumLit=:NumLit');
 $requete2->execute(array('NumLit'=>$_GET['idLit']));
 
 
 $supprLit=2;
 // et non 1 pour pouvoir réutiliser le modal de confirm suppr de materiel.php
 }
 else
 {
	 $supprLit=3;
 }
  header('location:../vue/materiel.php?suppr='.$supprLit.'&delChambre='.$_GET['libelleChambre'].'&delLit='.$_GET['libelleLit']);
?>