
<?php
session_start();
if (isset($_SESSION['userName']))
{
	include('../traitements/deconnexion_post.php');
}
session_unset();
$_SESSION['authentification']='';
$_SESSION['idSession']=0;
$_SESSION['idUser']=0;
$_SESSION['clearance']=0;
$_SESSION['userName']='';
$_SESSION['userFirstName']='';
include('acceuil.php');
?>
