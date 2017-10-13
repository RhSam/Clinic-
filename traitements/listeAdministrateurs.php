<?php
include_once('../../modele/connexion.php');

$reponse=$bdd->prepare('SELECT Id, Nom, Prenoms WHERE IdPrivilege=4 FROM PERSONNE order by Id DESC'); //requete qui retourne les infos de l'user et trie du plus récent au plus ancien
$reponse->execute();
$total=count($reponse->fetchAll());
?>