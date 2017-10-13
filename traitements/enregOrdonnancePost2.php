<?php
function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
$chaine = preg_replace("( +)", " ", $chaine);
return $chaine;
}



session_start();
 include('connexion.php');
 
$_POST['patient']=intval($_POST['patient']);
$_POST['user']=intval($_POST['user']);

$details='1:'.trimUltime($_POST['1']);
if($_POST['2']!="")
{
	$details=$details.' 2:'.trimUltime($_POST['2']);
}

if($_POST['3']!="")
{
	$details=$details.' 3:'.trimUltime($_POST['3']);
}

if($_POST['4']!="")
{
	$details=$details.' 4:'.trimUltime($_POST['4']);
}

if($_POST['5']!="")
{
	$details=$details.' 5:'.trimUltime($_POST['5']);
}

			 $requeteExam=$bdd->prepare('INSERT INTO PRESCRIRE_ORDONNANCE(Id, Per_Id, Date, DetailsOrdonnance, CodeConsultation) VALUES (:Id, :Per_Id, :Date, :Designation, :CodeConsultation)');


			 
			  $requeteExam->execute(array(
				   'Id'=>$_POST['user'],
				   'Per_Id'=>$_POST['patient'],
				   'Date'=>date('Y-m-d H:i:s'),
				   'Designation'=>strtoupper($details),
				   'CodeConsultation'=>$_POST['codeConsult']));
			
			
			 
				


    //echo $_POST['user'];          
		
		$newOrdon=1;	
			echo 'bon';


  header('location:../vue/consultationTous.php?newOrdon='.$newOrdon);
?>
