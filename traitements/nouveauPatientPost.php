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
 
 //on teste si ce patient n'est pas déja dans la base
 $requetePrincipale=$bdd->prepare('SELECT * FROM PERSONNE WHERE Nom=:Nom AND Prenoms=:Prenoms AND DateDeNaissance=:DateDeNaissance');
 $requetePrincipale->execute(array('Nom'=>trimUltime(strtoupper($_POST['nom'])),
                      'Prenoms'=>trimUltime(ucwords($_POST['prenoms'])),
					  'DateDeNaissance'=>$_POST['dateDeNaissance']));
					  
 $donneesRequetePrincipale=$requetePrincipale->fetch();
 
 $idPersonne=$donneesRequetePrincipale['Id'];
 
 echo $donneesRequetePrincipale['Id'];
 echo $_POST['dateDeNaissance'];
 $codePatient='';
 if($idPersonne!="") 
 {             
  echo "Il existe deja"; //si oui on verif si c un patient
  
     
  
	 if(($donneesRequetePrincipale['Patient']==1)AND($donneesRequetePrincipale['VisiblePatient']==1)) //on verif si il est mis comme patient et visible
	 {
	 $newPatient=0; //on fait rien
	 echo "il est deja patient et visibl";
	 }
	 
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
	 echo "Il n'existe pas encore";
 
			
		
			
			 $requeteNewPatient=$bdd->prepare('INSERT INTO PERSONNE(Nom, Prenoms, TelephoneDomicile, TelephoneProfessionnel, Email, NomDeJeuneFille, Sexe, DateDeNaissance, Adresse, PaysOrigine, Profession, GroupeSanguin, Patient, VisiblePatient, PapNom, PapPrenoms, PapTelephoneDomicile, PapTelephoneProfessionnel, PapEmail, IdCategorie, Statut) VALUES (:Nom, :Prenoms, :TelephoneDomicile, :TelephoneProfessionnel, :Email, :NomDeJeuneFille, :Sexe, :DateDeNaissance, :Adresse, :PaysOrigine, :Profession, :GroupeSanguin, :Patient, :VisiblePatient, :PapNom, :PapPrenoms, :PapTelephoneDomicile, :PapTelephoneProfessionnel, :PapEmail, :IdCategorie, :Statut)');

echo $_POST['nom'];
			 
			$requeteNewPatient->execute(array(
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
				   'Patient'=>true,
				   'VisiblePatient'=>true,
				   'PapNom'=>trimUltime(strtoupper($_POST['nomPap'])),
				   'PapPrenoms'=>trimUltime(ucwords($_POST['prenomsPap'])),
				   'PapTelephoneDomicile'=>$_POST['telephoneDomicilePap'],
				   'PapTelephoneProfessionnel'=>$_POST['telephoneProfessionnelPap'],
				   'PapEmail'=>trimUltime($_POST['emailPap']),
				   'IdCategorie'=>$_POST['categorie'],
				   'Statut'=>'Actif'));
				   
				


              
			
			
			  $requetePrepareCodePatient=$bdd->prepare('SELECT Id, Nom, Prenoms, Sexe, DATE_FORMAT(DateDeNaissance, \'%m%y\') AS date FROM PERSONNE WHERE Nom=:Nom AND Prenoms=:Prenoms AND DateDeNaissance=:DateDeNaissance');
			  
			  
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
		}
		else
		{
		 $laPhoto=$donneesRequetePrepareCodePatient['Sexe'];
		}
		
				 
			  $num=$donneesRequetePrepareCodePatient['Id'];
			  $date2=date('my');
			  $date1=$donneesRequetePrepareCodePatient['date'];
			  $sexe=$donneesRequetePrepareCodePatient['Sexe'];
			  $nom=substr($donneesRequetePrepareCodePatient['Nom'],0,2);
			  $prenom=strtoupper(substr($donneesRequetePrepareCodePatient['Prenoms'],0,2));
			  
			  $codePatient= 'P'.$num.'-'.$nom.$prenom.'-'.$date1.'-'.$date2.'-'.$sexe;
			  echo $codePatient;
			  $req4=$bdd->prepare('UPDATE PERSONNE SET CodePatient=:CodePatient, Photo=:Photo WHERE Id=:Id');
			  $req4->execute(array(
			                       
								   'Id'=>$donneesRequetePrepareCodePatient['Id'],
								   'Photo'=>$laPhoto,
								   'CodePatient'=>$codePatient));
								   
			  $newPatient=1;
			  //echo $newPatient;
 }
  $_POST['dateDeNaissance']=dateFr($_POST['dateDeNaissance']);
 $_POST['nom']=strtoupper($_POST['nom']);
 $_POST['prenoms']=ucwords($_POST['prenoms']);
  header('location:../vue/nouveauPatient.php?newPatient='.$newPatient.'&nom='.$_POST['nom'].'&prenoms='.$_POST['prenoms'].'&dateDeNaissance='.$_POST['dateDeNaissance'].'&codePatient='.$codePatient);
?>
