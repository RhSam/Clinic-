<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}

session_start();
 include('connexion.php');
 $_POST['produit']=trimUltime(strtoupper($_POST['produit']));  //
  $_POST['format']=trimUltime(strtoupper($_POST['format']));  //
   $_POST['dosage']=trimUltime(strtoupper($_POST['dosage']));  //
 
 $requetePrincipale=$bdd->prepare('SELECT * FROM PRODUIT WHERE NomProduit=:NomProduit AND FormatProduit=:FormatProduit AND DosageProduit=:DosageProduit');
 
 $requetePrincipale->execute(array('NomProduit'=>$_POST['produit'],
                                   'FormatProduit'=>$_POST['format'],
								   'DosageProduit'=>$_POST['dosage']));
								   
 $donneesRequetePrincipale=$requetePrincipale->fetch();
 
 $IdProduit=$donneesRequetePrincipale['IdProduit'];
 
 $newProduit=0;
 if($IdProduit!="") 
 {             
  echo "Il existe deja"; 
  
  $newProduit=0;   
  
 }
	 else
 {
		 //on va juste créer le produit
		 
	 $requeteNewProduit=$bdd->prepare('INSERT INTO PRODUIT(NomProduit, FormatProduit, DosageProduit) VALUES (:NomProduit, :FormatProduit, :DosageProduit)');
			 
	 $requeteNewProduit->execute(array(
			       'NomProduit'=>$_POST['produit'],
				   'FormatProduit'=>$_POST['format'],
				   'DosageProduit'=>$_POST['dosage']));
	 $newProduit=1;   
 }
 

  header('location:../vue/produits.php?newProduit='.$newProduit.'&produit='.$_POST['produit'].'&format='.$_POST['format'].'&dosage='.$_POST['dosage']);
?>