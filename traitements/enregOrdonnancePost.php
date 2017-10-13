<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}



session_start();
 include('connexion.php');
$i=1;
$madate=date('Y-m-d_H:i:s');
 
$_POST['patient']=intval($_POST['patient']);
$_POST['user']=intval($_POST['user']);


$requeteProduit=$bdd->prepare('INSERT INTO ENREGISTRER_PRODUIT(Date, IdProduit, CodeConsultation, Quantite, Posologie) VALUES (:Date, :IdProduit, :CodeConsultation, :Quantite, :Posologie)');


			 
			  $requeteProduit->execute(array(
				   
				   'Date'=>date('Y-m-d H:i:s'),
				   'IdProduit'=>$_POST['1'],
				   'CodeConsultation'=>$_POST['codeConsult'],
				   'Quantite'=>$_POST['qt1a'].' '.$_POST['qt1b'],
				   'Posologie'=>$_POST['posologie1']));






if(!empty($_POST['2']))
{
	$i=$i+1;
	$requeteProduit2=$bdd->prepare('INSERT INTO ENREGISTRER_PRODUIT(Date, IdProduit, CodeConsultation, Quantite, Posologie) VALUES (:Date, :IdProduit, :CodeConsultation, :Quantite, :Posologie)');


			 
			  $requeteProduit2->execute(array(
				   
				   'Date'=>date('Y-m-d H:i:s'),
				   'IdProduit'=>$_POST['2'],
				   'CodeConsultation'=>$_POST['codeConsult'],
				   'Quantite'=>$_POST['qt2a'].' '.$_POST['qt2b'],
				   'Posologie'=>$_POST['posologie2']));
}



if(!empty($_POST['3']))
{
	$i=$i+1;
$requeteProduit=$bdd->prepare('INSERT INTO ENREGISTRER_PRODUIT(Date, IdProduit, CodeConsultation, Quantite, Posologie) VALUES (:Date, :IdProduit, :CodeConsultation, :Quantite, :Posologie)');


			 
			  $requeteProduit->execute(array(
				   
				   'Date'=>date('Y-m-d H:i:s'),
				   'IdProduit'=>$_POST['3'],
				   'CodeConsultation'=>$_POST['codeConsult'],
				   'Quantite'=>$_POST['qt3a'].' '.$_POST['qt3b'],
				   'Posologie'=>$_POST['posologie3']));
}



if(!empty($_POST['4']))
{
	$i=$i+1;
$requeteProduit=$bdd->prepare('INSERT INTO ENREGISTRER_PRODUIT(Date, IdProduit, CodeConsultation, Quantite, Posologie) VALUES (:Date, :IdProduit, :CodeConsultation, :Quantite, :Posologie)');


			 
			  $requeteProduit->execute(array(
				   
				   'Date'=>date('Y-m-d H:i:s'),
				   'IdProduit'=>$_POST['4'],
				   'CodeConsultation'=>$_POST['codeConsult'],
				   'Quantite'=>$_POST['qt4a'].' '.$_POST['qt4b'],
				   'Posologie'=>$_POST['posologie4']));
}

			
			
			 
				


    //echo $_POST['user'];          
		
		$newOrdon=1;	
			echo 'bon';

  header('location:../vue/ordonnance.php?newOrdon='.$newOrdon.'&madate='.$madate.'&Id='.$_POST['patient'].'i='.$i);
?>
