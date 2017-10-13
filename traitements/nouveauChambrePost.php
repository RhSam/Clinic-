<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}

session_start();
 include('connexion.php');
 $_POST['chambre']=trimUltime(str_ireplace('CHAMBRE','',(strtoupper($_POST['chambre']))));  //
 
 $requetePrincipale=$bdd->prepare('SELECT * FROM CHAMBRE WHERE LibelleChambre=:LibelleChambre');
 $requetePrincipale->execute(array('LibelleChambre'=>$_POST['chambre']));
 $donneesRequetePrincipale=$requetePrincipale->fetch();
 
 $numChambre=$donneesRequetePrincipale['NumChambre'];
 
 $newChambre=0;
 if($numChambre!="") 
 {             
  echo "Elle existe deja"; //si oui on verif si c un patient
  
  $newChambre=0;   
  
 }
	 else
 {
		 //on va juste créer la chambre
		 
	 $requeteNewChambre=$bdd->prepare('INSERT INTO CHAMBRE(LibelleChambre) VALUES (:LibelleChambre)');
			 
	 $requeteNewChambre->execute(array(
			       'LibelleChambre'=>$_POST['chambre']));
	 $newChambre=1;   
 }
 

  header('location:../vue/materiel.php?newChambre='.$newChambre.'&chambre='.$_POST['chambre']);
?>