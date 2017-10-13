<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}

function dateFr($date)
					  {
						  return strftime('%d/%m/%Y',strtotime($date));
					  }

session_start();
 include('connexion.php');
 $_POST['id']=intval($_POST['id']);
 //on teste si ce patient n'est pas déja dans la base
 $requetePrincipale=$bdd->prepare('SELECT * FROM PERSONNE WHERE Nom=:Nom AND Prenoms=:Prenoms AND DateDeNaissance=:DateDeNaissance AND Id<>:Id');
 $requetePrincipale->execute(array('Nom'=>trimUltime(strtoupper($_POST['nom'])),
                      'Prenoms'=>trimUltime(ucwords($_POST['prenoms'])),
					  'DateDeNaissance'=>$_POST['dateDeNaissance'],
					  'Id'=>$_POST['id']));
 $donneesRequetePrincipale=$requetePrincipale->fetch();
 
 $idPersonne=$donneesRequetePrincipale['Id'];
 
 echo $donneesRequetePrincipale['Id'];
 echo $_POST['dateDeNaissance'];
 
 $codePatient='';
 
 if($idPersonne!="") 
 {             
  echo "Il existe deja"; //si oui on verif si c un patient
  
     
  
	
	 $newPatient=0; //on fait rien
	 echo "il est deja patient et visibl";
	
	 
	 if(($donneesRequetePrincipale['Patient']==1)AND($donneesRequetePrincipale['VisiblePatient']!=1)) //on verif si il est mis comme patient et non visible
	 {
		  //on fait rien il existe mais est invisible il faut le restaurer
		 //$requeteRendVisiblePatient=$bdd->prepare('UPDATE PERSONNE SET VisiblePatient=:VisiblePatient WHERE Id=:Id');
		// $requeteRendVisiblePatient->execute(array(
								  // 'Id'=>$donneesRequetePrincipale['Id'],
								   //'VisiblePatient'=>true));
		 $newPatient=2;  //ya pas eu de new patient
	     
		 //on a juste fait une restauration.
	 }
	 
	 
 }
 
 else
 
 {
	 //echo "Il n'existe pas encore";
 
			
		
			
			 $requeteNewPatient=$bdd->prepare('UPDATE PERSONNE SET Nom=:Nom, Prenoms=:Prenoms, TelephoneDomicile=:TelephoneDomicile, TelephoneProfessionnel=:TelephoneProfessionnel, Email=:Email, NomDeJeuneFille=:NomDeJeuneFille, Sexe=:Sexe, DateDeNaissance=:DateDeNaissance, Adresse=:Adresse, PaysOrigine=:PaysOrigine, Profession=:Profession, GroupeSanguin=:GroupeSanguin, PapNom=:PapNom, PapPrenoms=:PapPrenoms, PapTelephoneDomicile=:PapTelephoneDomicile, PapTelephoneProfessionnel=:PapTelephoneProfessionnel, PapEmail=:PapEmail, Allergies=:Allergies, AntecedentsPersonnels=:AntecedentsPersonnels, AntecedentsFamiliaux=:AntecedentsFamiliaux, Vaccins=:Vaccins, IdCategorie=:IdCategorie, Statut=:Statut WHERE Id=:Id');

echo $_POST['nom'];
			 
			$requeteNewPatient->execute(array(
			       'Id'=>$_POST['id'],
				   'Nom'=>trimUltime(strtoupper($_POST['nom'])),
				   'Prenoms'=>trimUltime(ucwords($_POST['prenoms'])),
				   'TelephoneDomicile'=>$_POST['telephoneDomicile'],
				   'TelephoneProfessionnel'=>$_POST['telephoneProfessionnel'],
				   'Email'=>trimUltime($_POST['email']),
				   'NomDeJeuneFille'=>trimUltime($_POST['nomDeJeuneFille']),
				   'Sexe'=>$_POST['sexe'],
				   'DateDeNaissance'=>$_POST['dateDeNaissance'],
				   'Adresse'=>trimUltime($_POST['adresse']),
				   'PaysOrigine'=>$_POST['paysOrigine'],
				   'Profession'=>trimUltime($_POST['profession']),
				   'GroupeSanguin'=>$_POST['groupeSanguin'],
				   'PapNom'=>trimUltime(strtoupper($_POST['nomPap'])),
				   'PapPrenoms'=>trimUltime(ucwords($_POST['prenomsPap'])),
				   'PapTelephoneDomicile'=>$_POST['telephoneDomicilePap'],
				   'PapTelephoneProfessionnel'=>$_POST['telephoneProfessionnelPap'],
				   'PapEmail'=>trimUltime($_POST['emailPap']),
				   'Allergies'=>trimUltime($_POST['allergies']),
				   'AntecedentsPersonnels'=>trimUltime($_POST['antecedentsPersonnels']),
				   'AntecedentsFamiliaux'=>trimUltime($_POST['antecedentsFamiliaux']),
				   'Vaccins'=>trimUltime($_POST['vaccins']),
				   'IdCategorie'=>$_POST['categorie'],
				   'Statut'=>$_POST['statut']));
				   
				


              
			
			
			  $requetePrepareCodePatient=$bdd->prepare('SELECT * FROM PERSONNE WHERE Nom=:Nom AND Prenoms=:Prenoms AND DateDeNaissance=:DateDeNaissance');
 $requetePrepareCodePatient->execute(array('Nom'=>trimUltime(strtoupper($_POST['nom'])),
                      'Prenoms'=>trimUltime(ucwords($_POST['prenoms'])),
					  'DateDeNaissance'=>$_POST['dateDeNaissance']));
				
				
				
					  
									  
									  
				  $donneesRequetePrepareCodePatient=$requetePrepareCodePatient->fetch();
				  
				  echo 'le id est'.$donneesRequetePrepareCodePatient['Id'];
				  
				
				  
				  
		if(!empty($_FILES['photo']['name']))
		{		 
		 $cheminPhoto="C:/wamp\www/clinic+/ressources/photos/";
		 $nomPhoto=$donneesRequetePrepareCodePatient['Id'].'.jpg';
		 move_uploaded_file($_FILES['photo']['tmp_name'],$cheminPhoto.$nomPhoto);
		 $laPhoto=$donneesRequetePrepareCodePatient['Id'];
		 
		 $req4=$bdd->prepare('UPDATE PERSONNE SET Photo=:Photo WHERE Id=:Id');
			  $req4->execute(array(
			                       
								   'Id'=>$donneesRequetePrepareCodePatient['Id'],
								   'Photo'=>$laPhoto));
		 
		}
		
		
				 
			  
			  $codePatient=$donneesRequetePrepareCodePatient['CodePatient'];
								   
			  $newPatient=1;
			  //echo $newPatient;
 }
 $_POST['dateDeNaissance']=dateFr($_POST['dateDeNaissance']);
 $_POST['nom']=strtoupper($_POST['nom']);
 $_POST['prenoms']=ucwords($_POST['prenoms']);
  header('location:../vue/modifierPatientPatient.php?newPatient='.$newPatient.'&nom='.$_POST['nom'].'&prenoms='.$_POST['prenoms'].'&IdPatient='.$_POST['id'].'&dateDeNaissance='.$_POST['dateDeNaissance'].'&codePatient='.$codePatient);
?>