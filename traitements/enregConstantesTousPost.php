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
 
$_POST['TABGMax']=intval($_POST['TABGMax']);
$_POST['TABGMin']=intval($_POST['TABGMin']);

echo 'TABG Max'.$_POST['TABGMax'].'<br/>';
echo 'TABG Min'.$_POST['TABGMin'].'<br/>';



$_POST['TABDMax']=intval($_POST['TABDMax']);
$_POST['TABDMin']=intval($_POST['TABDMin']);


echo 'TABDMax'.$_POST['TABDMax'].'<br/>';
echo 'TABDMin'.$_POST['TABDMin'].'<br/>';

$BG='oui';
$BD='oui';

 if($_POST['TABGMax']<$_POST['TABGMin'])
 {
	 echo 'TABG Max> TABGMin';
	 $BG='non';
 }
  if(($_POST['TABGMax']==$_POST['TABGMin']) AND $_POST['TABGMin']!=0)
 {
	 echo 'TABG Max = TABGMin =0';
	 $BG='non';
 }
 
if(($_POST['TABGMax']>0) AND $_POST['TABGMin']==0)
 {
	 echo 'TABG Max >0 et TABGMin =0';
	 $BG='non';
 }
 
 
 
  if($_POST['TABDMax']<$_POST['TABDMin'])
 {
	 echo 'TABD Max> TABDMin';
	 $BD='non';
 }
  if(($_POST['TABDMax']==$_POST['TABDMin']) AND $_POST['TABDMin']!=0)
 {
	 $BD='non';
	 echo 'TABD Max = TABDMin = 0';
 }
  if(($_POST['TABDMax']>0) AND $_POST['TABDMin']==0)
 {
	 echo 'TABD Max >0 et TABDMin =0';
	 $BD='non';
 }
 
if(($BG=='oui')AND($BD=='oui'))
{
$TABG=$_POST['TABGMax'].'/'.$_POST['TABGMin'];
$TABD=$_POST['TABDMax'].'/'.$_POST['TABDMin'];

		  if($TABG=='0/0')
		  {
			  $TABG='';
		  }
		  
		  if($TABD=='0/0')
		  {
			  $TABD='';
		  }
echo 'TABG='.$TABG;
echo 'TABD='.$TABD;

$_POST['user']=intval($_POST['user']);
$_POST['patient']=intval($_POST['patient']);
			
			 $requeteConst=$bdd->prepare('INSERT INTO RELEVER_PARAMETRE(Id, Per_Id, Date, PoidsEnKg, TailleEnCm, Temperature, TensionArterielleBG, TensionArterielleBD, Pouls) VALUES (:Id, :Per_Id, :Date, :PoidsEnKg, :TailleEnCm, :Temperature, :TensionArterielleBG, :TensionArterielleBD, :Pouls)');


			 
			  $requeteConst->execute(array(
				   'Id'=>$_POST['user'],
				   'Per_Id'=>$_POST['patient'],
				   'Date'=>date('Y-m-d H:i:s'),
				   'PoidsEnKg'=>$_POST['poids'],
				   'TailleEnCm'=>$_POST['taille'],
				   'Temperature'=>$_POST['temperature'],
				   'TensionArterielleBG'=>$TABG,
				   'TensionArterielleBD'=>$TABD,
				   'Pouls'=>$_POST['pouls']));
				   
				


    //echo $_POST['user'];          
		
		$constInf=1;	
			echo 'bon';
}
else
{
	    $constInf=0;
}
  
  header('location:../vue/constantesTous.php?const='.$constInf.'&BG='.$BG.'&BD='.$BD);
?>
