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
 $Privilege=intval($_POST['privilege']);  //on convertit le $_POST['privilege'] en entier
                                            //requete d'insertion
 //on teste si ce patient n'est pas déja dans la base
 $requetePrincipale=$bdd->prepare('SELECT * FROM PERSONNE WHERE Nom=:Nom AND Prenoms=:Prenoms AND DateDeNaissance=:DateDeNaissance');
 $requetePrincipale->execute(array('Nom'=>trimUltime(strtoupper($_POST['nom'])),
                      'Prenoms'=>trimUltime(ucwords($_POST['prenoms'])),
					  'DateDeNaissance'=>$_POST['dateDeNaissance']
					  ));
 $donneesRequetePrincipale=$requetePrincipale->fetch();
 
 $idPersonne=$donneesRequetePrincipale['Id'];
 $idPrivilege=$donneesRequetePrincipale['IdPrivilege'];
 
 echo $donneesRequetePrincipale['Id'];
 echo $_POST['dateDeNaissance'];
 $codePatient=$donneesRequetePrincipale['CodePatient'];
 if($idPersonne!="") 
 {             
  echo "Il existe deja"; //si oui on verif si c un patient
  
     
  
	 if($idPrivilege=="") //on verif si il est juste patient
	 {
		 //on va alors le update
	
	 $_POST['login']=$_POST['login'].$idPersonne;
	
	 $newUser=3; //on fait va le update
	 
	  $requeteNewUser=$bdd->prepare('UPDATE PERSONNE SET Login=:Login, Pass=:Pass, IndicePass=:IndicePass, TelephoneDomicile=:TelephoneDomicile, TelephoneProfessionnel=:TelephoneProfessionnel, Email=:Email, NomDeJeuneFille=:NomDeJeuneFille, IdPrivilege=:IdPrivilege, VisibleUser=:VisibleUser, Adresse=:Adresse, PaysOrigine=:PaysOrigine, Profession=:Profession, GroupeSanguin=:GroupeSanguin, PapNom=:PapNom, PapPrenoms=:PapPrenoms, PapTelephoneDomicile=:PapTelephoneDomicile, PapTelephoneProfessionnel=:PapTelephoneProfessionnel, PapEmail=:PapEmail, IdCategorie=:IdCategorie, Statut=:Statut WHERE Id=:Id');

echo $_POST['nom'];
			 
			$requeteNewUser->execute(array(
			       'Id'=>$idPersonne,
				   'Login'=>$_POST['login'],
				   'Pass'=>$_POST['password'],
				   'IndicePass'=>$_POST['indice'],
				   'TelephoneDomicile'=>$_POST['telephoneDomicile'],
				   'TelephoneProfessionnel'=>$_POST['telephoneProfessionnel'],
				   'Email'=>trimUltime($_POST['email']),
				   'NomDeJeuneFille'=>trimUltime($_POST['nomDeJeuneFille']),
				   'IdPrivilege'=>intval($_POST['privilege']),
				   'VisibleUser'=>true,
				   'Adresse'=>trimUltime($_POST['adresse']),
				   'PaysOrigine'=>$_POST['paysOrigine'],
				   'Profession'=>trimUltime($_POST['profession']),
				   'GroupeSanguin'=>$_POST['groupeSanguin'],
				   'PapNom'=>trimUltime(strtoupper($_POST['nomPap'])),
				   'PapPrenoms'=>trimUltime(ucwords($_POST['prenomsPap'])),
				   'PapTelephoneDomicile'=>$_POST['telephoneDomicilePap'],
				   'PapTelephoneProfessionnel'=>$_POST['telephoneProfessionnelPap'],
				   'PapEmail'=>trimUltime($_POST['emailPap']),
				   'IdCategorie'=>$_POST['categorie'],
				   'Statut'=>'Actif'));
				   
				


              
			
			
			  
				  
				
				  
				  
		if(!empty($_FILES['photo']['name']))
		{		 
		 $cheminPhoto="C:/wamp\www/clinic+/ressources/photos/";
		 $nomPhoto=$idPersonne.'.jpg';
		 move_uploaded_file($_FILES['photo']['tmp_name'],$cheminPhoto.$nomPhoto);
		 $laPhoto=$idPersonne;
		 
		 $req4=$bdd->prepare('UPDATE PERSONNE SET Photo=:Photo WHERE Id=:Id');
			  $req4->execute(array(
			                       
								   'Id'=>$idPersonne,
								   'Photo'=>$laPhoto));
		 
		}
		
	 
	 }
	 else
	 {
		 //ce user existe bien déja
		 if($donneesRequetePrincipale['VisibleUser']!=1)
		 {
			 $newUser=2;
		 }
		 else
		 {
		 $newUser=0;
		 }
	 }
	 
	 
 }
 
 else
 
 {
	 echo "Il n'existe pas encore";
 
			
		
			
			 $requeteNewUser=$bdd->prepare('INSERT INTO PERSONNE(Pass, IndicePass, IdPrivilege, VisibleUser, Nom, Prenoms, TelephoneDomicile, TelephoneProfessionnel, Email, NomDeJeuneFille, Sexe, DateDeNaissance, Adresse, PaysOrigine, Profession, GroupeSanguin, Patient, VisiblePatient, PapNom, PapPrenoms, PapTelephoneDomicile, PapTelephoneProfessionnel, PapEmail, IdCategorie, Statut) VALUES (:Pass, :IndicePass, :IdPrivilege, :VisibleUser, :Nom, :Prenoms, :TelephoneDomicile, :TelephoneProfessionnel, :Email, :NomDeJeuneFille, :Sexe, :DateDeNaissance, :Adresse, :PaysOrigine, :Profession, :GroupeSanguin, :Patient, :VisiblePatient, :PapNom, :PapPrenoms, :PapTelephoneDomicile, :PapTelephoneProfessionnel, :PapEmail, :IdCategorie, :Statut)');

echo $_POST['nom'];
			 
			$requeteNewUser->execute(array(
			       
				   'Pass'=>$_POST['password'],
				   'IndicePass'=>$_POST['indice'],
				   'IdPrivilege'=>intval($_POST['privilege']),
				   'VisibleUser'=>true,
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
			  
			   $_POST['login']=$_POST['login'].$donneesRequetePrepareCodePatient['Id'];
			  
			  $req4=$bdd->prepare('UPDATE PERSONNE SET CodePatient=:CodePatient, Photo=:Photo, Login=:Login WHERE Id=:Id');
			  $req4->execute(array(
			                       
								   'Id'=>$donneesRequetePrepareCodePatient['Id'],
								   'Login'=>$_POST['login'],
								   'Photo'=>$laPhoto,
								   'CodePatient'=>$codePatient));
								   
			  $newUser=1;
			  //echo $newPatient;
 }
 $_POST['dateDeNaissance']=dateFr($_POST['dateDeNaissance']);
 $_POST['nom']=strtoupper($_POST['nom']);
 $_POST['prenoms']=ucwords($_POST['prenoms']);
  header('location:../vue/comptesUtilisateurs.php?newUser='.$newUser.'&nom='.$_POST['nom'].'&prenoms='.$_POST['prenoms'].'&privilege='.$idPrivilege.'&dateDeNaissance='.$_POST['dateDeNaissance'].'&codePatient='.$codePatient.'&login='.$_POST['login']);
?>