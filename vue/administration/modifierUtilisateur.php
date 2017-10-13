<?php
if(!isset($_SESSION))  //au cas ou la session n'est pas encore démarrée on la démarre.
{
session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clinic +</title>
<link rel="stylesheet" href="../../ressources/css/polices.css" />
<link rel="stylesheet" href="../../ressources/bootstrap-3.1.1-dist/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link rel="stylesheet" href="../../ressources/css/style.css" />
<link rel="icon" type="image/gif" href="../../ressources/images/icone.gif" />

</head>

     

<body>

<?php //sécurité contre l'accès à la page par l'url directement
 if ($_SESSION['clearance']<4) 
 {      //les users avec un niveau inf à 4(médecins simples , infirmiers , secrétaires et externes) ne peuvent accéder à la partie administration
	 include('../accesInterdit.php');
 }
 else
 {
?>
 
 <div class="container">
   <div class="row row1">
     <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
       <div class="navbar-header">
          <div>
            <span class="appli">Clinic + </span>
          </div><!--navbar-brand -->
       </div><!--navbar header -->
       
       <div class="navbar-collapse collapse navbar-right">
          <?php
          $nav_en_cours='administration';
          switch($_SESSION['clearance'])
		  {
			  case 0:include('../listeAcceuil.php');
			   break;
			  case 1:include('../listeSecretaire.php');
			   break;
			  case 2:include('../listeInfirmier.php');
			   break;
			  case 3:include('../listeMedecin.php');
			   break;
			  case 4:include('../listeAdministrateur.php');
			   break;
		  }
	      ?>
       </div>
     </nav><!--nav -->
   </div><!--row 1 -->
   
   <div class="col-xs-10 col-xs-push-1 row 2">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="text-center">
         <h4>
         
          <?php
		  
          include('../../traitements/connexion.php');
		  $_GET['idUtilisateur']=intval($_GET['idUtilisateur']);
		  
		  $reponse=$bdd->prepare('SELECT * FROM utilisateur WHERE idUtilisateur=:idUtilisateur'); //requete qui retourne les infos de l'user
    $reponse->execute(array('idUtilsateur'=>$_GET['idUtilisateur']));
	while($donnees=$reponse->fetch())
	{
          $privilege=intval($donnees['idPrivilege']);
		  $utilisateur=intval($donnees['idUtilisateur']);
		  $nom=$donnees['nomUtilisateur'];
		  $prenoms=$donnees['prenomsUtilisateur'];
          $login=$donnees['loginUtilisateur'];
		  $pass=$donnees['passUtilisateur'];
		  $indicePass=$donnees['indicePassUtilisateur'];
	}
	      ?>
          Modification des informations de l'utilsateur
         </h4>
        </div>
      </div><!--heading -->
      <?php
    
      ?>
      <div class="panel-body">
      
        <form id="modifierUtilisateur" action="../../traitements/modifierUtilisateurPost.php" method="post" class="form modifierUtilisateur">
          <input type="hidden" name="privilege" id="privilege" tabindex="6" value="<?php echo $privilege ?>" />
          <input type="hidden" name="utilisateur" id="privilege" tabindex="7" value="<?php echo $utilisateur ?>" />
        
          <div class="col-xs-6">
           <label class="label label-default">Nom</label>
           <input type="text" class="input-lg form-control nom" name="nom" id="nom" required="required" placeholder="nom de l'utilisateur" spellcheck="false" maxlength="25" autocomplete="off" tabindex="1" value="<?php echo $nom ?>"/>
          </div>
          
          <div class="col-xs-6">
           <label class="label label-default">Prénoms</label>
           <input type="text" class="input-lg form-control prenom" name="prenoms" id="prenoms" required="required" placeholder="prénoms de l'utilisateur" spellcheck="false" maxlength="25" autocomplete="off" tabindex="2" value="<?php echo $prenoms ?>"/>
          </div>
           <br />
           <br />
           <br />
           <br />
           
          <div class="col-xs-6">
           <label class="label label-default">Login</label>
           <input type="text" class="input-lg form-control" name="login" id="login" required="required" placeholder="nom d'utilisateur" spellcheck="false" maxlength="25" autocomplete="off" tabindex="3" value="<?php echo $login ?>"/>
          </div>
          
          <div class="col-xs-6 form-group">
          <label class="label label-default">Password</label>
           <div class="input-group">
           
           
           
           <input type="password" class="input-lg form-control" name="password" id="password" placeholder="mot de passe" autocomplete="off" required="required" spellcheck="false" maxlength="25" tabindex="4" value="<?php echo $pass ?>"/>
               <span class="input-group-addon">
                 <span class="glyphicon glyphicon-eye-close">
               </span>
               <input type="checkbox" id="reveal" />
               </span>
           </div><!--input-group --> 
          </div>
          
           
           <br />
           <br />
           <br />
           <br />
          
          <div class="col-xs-12">
           <label class="label label-default">Indice du mot de passe</label>
           <input type="text" class="input-lg form-control" name="indice" id="indice" required="required" placeholder="indice pour retrouver le mot de passe" spellcheck="false" maxlength="50" autocomplete="off" tabindex="5" value="<?php echo $indicePass ?>"/>
          </div>
          
           <br />
           <br />
           <br />
           <br />
           
          <div class="col-xs-12">
           <div class="col-xs-6 text-left">
            <button type="reset" class="btn btn-danger btn-lg">Annuler</button>
           </div>
           
             <!--le bouton valider renvoie à la fenetre modale et sur la fenetre modale le bouton OK zt lié à ce formulaire et envoie les infos à nouveauUtilisateurPost -->
           <div class="col-xs-6 text-right">
            <button data-toggle="modal" data-backdrop="false" href="#alterUser" type="button" class="btn btn-success btn-lg">Valider</button>
           </div>
          </div>
           
        </form>
      
      </div>
      
    </div><!--panel -->
   </div><!--row 2 -->
   
 </div><!--container-->
 
<?php
 }
?>


<div class="modal fade" id="alterUser">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header">
            
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 modificationUser">
			   <div class="panel panel-default">
				 <div class="panel-heading">
				  Modification
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					   
					   Modification effectuée avec succès !
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-12 text-center">
					   <button type="submit" form="modifierUtilisateur" class="btn btn-info">OK!</button>
					  </div>
					  
					  
					  
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--suppression -->
            
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>


<script type="text/javascript" src="../../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../../ressources/js/script.js"></script>
<script type="text/javascript" src="../../ressources/js/revealPassword.js"></script>

</body>
</html>