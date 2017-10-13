<?php
include_once('connexion.php');

$reponse=$bdd->prepare('SELECT Id, Nom, Prenoms WHERE IdPrivilege=:privilege FROM PERSONNE order by Id DESC'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute(array(
          'privilege'=>$_GET['privilege']));
		  $total=count($reponse->fetchAll());
?>