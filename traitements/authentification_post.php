<?php
session_start();
 include('../traitements/connexion.php');
$_POST['login']=htmlspecialchars($_POST['login']);
$_POST['password']=htmlspecialchars($_POST['password']);
$reponse=$bdd->prepare('SELECT * FROM PERSONNE WHERE Login=:login AND Pass=:password'); //requete qui retourne les infos de l'user
$reponse->execute(array(
          'login'=>$_POST['login'],
		  'password'=>$_POST['password']));
		  
	
		  
        $donnees=$reponse->fetch();
		print_r($donnees);
       echo 'le id'.$donnees['Id'];
	if(isset($donnees['Id']))   //on vérifie que la req a bien renvoyé des données et donc que cet user existe bien
	{
		$_SESSION['authentification']='oui'; //on met l'authentification à oui
		$_SESSION['idUser']=$donnees['Id'];  //on remplit la session avec les infos de l'user qui seront utiles
		$_SESSION['clearance']=intval($donnees['IdPrivilege']); //cette variable doit etre en entier , elle sera utilisée plus tard avec des "case"  et des "if"
		$_SESSION['userName']=$donnees['Nom'];
		$_SESSION['userFirstName']=$donnees['Prenoms'];
		
		echo 'le id'.$donnees['Id'];
		echo $_SESSION['idUser'];
        
		$reqSession=$bdd->prepare('INSERT INTO SESSION (Id, DateDebutSession) VALUES (:idUtilisateur, :dateDebutSession)');
		$reqSession->execute(array(
       'idUtilisateur'=>$_SESSION['idUser'],
	   'dateDebutSession'=>date('Y-m-d H:i:s')));
	   
	   //now on va receuillir l'id de la session créée
	   
	   
	   
	   $reponseSession=$bdd->prepare('SELECT * FROM SESSION ORDER BY IdSession DESC LIMIT 0, 1');
	   $reponseSession->execute();
	   $donneesSession=$reponseSession->fetch();
	   $_SESSION['idSession']=$donneesSession['IdSession'];
	   
	   echo $_SESSION['idSession'];
	}
	else
	{
		$_SESSION['authentification']='non';
	}
	 header('location:../vue/acceuil.php'); //on redirige l'user vers la page d'acceuil
	
?>
