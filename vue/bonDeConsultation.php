<?php
function dateFr($date)
					  {
						  return strftime('%d-%m-%Y',strtotime($date));
					  }
					// function Age($date){
						//  $date = preg_split('/\//', $date);
						  
						 // return @floor((strtotime("now") - strtotime($date[1].'/'.$date[2].'/'.$date[0]))/60/60/24/365.25);
					 //}
					 
					 function Age($date_naissance)
{
	$arr1 = explode('-', $date_naissance);
	$arr2 = explode('-', date('d-m-Y'));
		
	if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
	return $arr2[2] - $arr1[2];

	return $arr2[2] - $arr1[2] - 1;
}

function trimUltime($chaine){
$chaine = trim($chaine);
$chaine = str_replace("\t", " ", $chaine);
//$chaine = eregi_replace("[ ]+", " ", $chaine);
return $chaine;
}


if(!isset($_SESSION))  //au cas ou la session n'est pas encore démarrée on la démarre.
{
session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>bon de consultation édité le <?php echo date('d-m-Y \à H:i:s');?></title>
<link rel="stylesheet" href="../ressources/css/polices2.css" />
<link rel="stylesheet" href="../ressources/bootstrap-3.1.1-dist/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link rel="stylesheet" href="../ressources/css/style2.css" />
<link rel="icon" type="image/gif" href="../ressources/images/icone.gif" />
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>
<script type="text/javascript" src="../ressources/js/heure.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>

<script language="javascript">
<!--
window.print()
//-->
</script> 
</head>

     

<body>

<?php //sécurité contre l'accès à la page par l'url directement
 if ($_SESSION['clearance']<1) //les users avec un niveau inf à 3(infirmiers , secrétaires et externes) ne peuvent accéder aux dossiers  des patients
 {
	 include('accesInterdit.php');
 }
 else
 {
 include('../traitements/connexion.php');
 $requete1=$bdd->prepare('SELECT * FROM PERSONNE WHERE Id=:Id');
 $requete1->execute(array('Id'=>$_GET['Id']));
 $donneesRequete1=$requete1->fetch();
 
 $requete2=$bdd->prepare('SELECT * FROM BON ORDER BY Id DESC LIMIT 0, 1');
 $requete2->execute();
 $donneesRequete2=$requete2->fetch();
 
 if ($donneesRequete2['Date']<date('Y-m-d'))
 {
	  $requeteBon=$bdd->prepare('INSERT INTO BON(Date, Numero) VALUES (:Date, :Numero)');


			 
			  $requeteBon->execute(array(
				   'Date'=>date('Ymd'),
				   'Numero'=>1));
			  $numero=1;
 }
 else
 {
	 $numero=intval($donneesRequete2['Numero'])+1;
	 
	 $requeteBon=$bdd->prepare('UPDATE BON SET Date=:Date, Numero=:Numero WHERE Id=:Id');


			 
			  $requeteBon->execute(array(
				   'Date'=>date('Ymd'),
				   'Numero'=>$numero,
				   'Id'=>$donneesRequete2['Id']));
	 
 }
?> 

<div class="container col-xs-12">
 

   <div class="row row1">

   	 <div class="text-center">

   	 	<h1 style="font-size:40px;">Ma CLINIQUE</h1>
        <h2>Arrêté Nº 021/99/MS du 11 Fév. 1999</h2>
        <h2>Docteur NKOUNOU Y. C. Eddie</h2>
        <h3>Route de KEGUE près du Nouveau Stade Municipal<br />B.P. 30032 Tél: 22 25 75 45 Lomé-TOGO</h3>
<hr />
   	 </div>
     
     <div>
      <h3 class="text-center">Lomé le <?php echo date('d/m/Y');?></h3>
      <h2 class="text-center" style="text-decoration:underline;">Bon de consultation</h2> <br /> <h2 class="text-center"><?php if($donneesRequete1['Sexe']=='M'){echo 'M. ';} else {echo 'Mme. ';} echo $donneesRequete1['Nom'].' '.$donneesRequete1['Prenoms'].' : '.Age(dateFr($donneesRequete1['DateDeNaissance'])).' ans';?> </h2>
       
      
      
      
      <h4>Veuillez vous approcher des infirmiers lorsque votre numéro sera appelé, Merci ! </h4>
       <br />
       
       <h4>Aujourd'hui le <?php echo date('d/m/Y');?> Vous êtes le patient numéro</h4>
      <h1 class="text-center" style="font-size:220px;"><?php echo $numero ?></h1>
      <div class="text-center">NB : Ce bon est valide uniquement ce <?php echo date('d/m/Y');?> . Merci !</div>
      <hr />
     </div>
   
     <div class="text-center">
     <label class="label label-default">
      Clinic+
     </label>
     </div>

   </div>

</div>

<?php
//header('location:admissionPourConsultation.php');

 }
?>         
          

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">history.go(-1);</script>



 
 
</body>
</html>