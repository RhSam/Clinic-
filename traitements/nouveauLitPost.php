<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}

session_start();
 include('connexion.php');
 $_POST['lit']=trimUltime(str_ireplace('LIT','',(strtoupper($_POST['lit']))));  //
 $_POST['numChambre']=intval($_POST['numChambre']);
 
 $requetePrincipale1=$bdd->prepare('SELECT * FROM LIT WHERE NumChambre=:NumChambre AND LibelleLit=:LibelleLit');
 $requetePrincipale1->execute(array('NumChambre'=>$_POST['numChambre'],
                                   'LibelleLit'=>$_POST['lit']));
 $donneesRequetePrincipale1=$requetePrincipale1->fetch();
 
 $numLit=$donneesRequetePrincipale1['NumLit'];
 
 $newLit=0;
 if($numLit!="") 
 {             
  echo "Il existe deja"; //si oui on verif si c un patient
  
  $newLit=0;   
  
 }
	 else
 {
		 //on va juste créer la chambre
		 
	 $requeteNewLit=$bdd->prepare('INSERT INTO LIT (NumChambre, LibelleLit, Occupe) VALUES (:NumChambre, :LibelleLit, 0)');
			 
	 $requeteNewLit->execute(array('NumChambre'=>$_POST['numChambre'],
                                   'LibelleLit'=>$_POST['lit']));
	 $newLit=1;   
 }
 
echo 'new lit='.$newLit;
echo '       lit='.$_POST['lit'];
  header('location:../vue/materiel.php?newLit='.$newLit.'&lit='.$_POST['lit'].'&chambre='.$_POST['libelleChambre']);
?>