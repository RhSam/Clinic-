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
<link rel="stylesheet" href="../ressources/css/polices.css" />
<link rel="stylesheet" href="../ressources/bootstrap-3.1.1-dist/bootstrap-3.1.1-dist/css/bootstrap.css" />
<link rel="stylesheet" href="../ressources/css/style.css" />
<link rel="icon" type="image/gif" href="../ressources/images/icone.gif" />
<script type="text/javascript" src="../ressources/js/heure.js"></script>
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>

</head>

     

<body>

<?php //sécurité contre l'accès à la page par l'url directement
 if ($_SESSION['clearance']<4) 
 {      //les users avec un niveau inf à 4(médecins simples , infirmiers , secrétaires et externes) ne peuvent accéder à la partie administration
	 include('accesInterdit.php');
 }
 else
 {
?>
<div class="col-xs-2 bread">
 <ul class="list-inline">
   <li class="mother"><a href="administration.php">Administration</a></li>
   <li class="child"><a href="comptesUtilisateurs.php">►Comptes</a></li>
    <br />
    <li class="grandchild" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">»Nouveau</li>
    <br />
   <li class="child"><a href="historiqueConnexions.php">►Historique</a></li>
   <br />
   <li class="child"><a href="autres.php">►Autres</a></li>
   
 </ul>
</div>
 
 <div class="container col-xs-10 col-xs-push-2">
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
			  case 0:include('listeAcceuil.php');
			   break;
			  case 1:include('listeSecretaire.php');
			   break;
			  case 2:include('listeInfirmier.php');
			   break;
			  case 3:include('listeMedecin.php');
			   break;
			  case 4:include('listeAdministrateur.php');
			   break;
		  }
	      ?>
       </div>
     </nav><!--nav -->
   </div><!--row 1 -->
   
  <div class="row row2">
    <div class="col-xs-12">
      
      <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="text-center">
         <h4>
          <?php
          $privilege=intval($_GET['privilege']);
          switch($privilege)
		  {
			  case 1:echo 'Nouveau secrétaire';
			   break;
			  case 2:echo 'Nouvel infirmier';
			   break;
			  case 3:echo 'Nouveau médecin';
			   break;
			  case 4:echo 'Nouvel administrateur';
			   break;
		  }
	      ?>
         </h4>
        </div>
      </div><!--heading -->
      
      <div class="panel-body" style="height:502px;overflow:auto;">
      
        <form id="nouveauUtilisateur" action="../traitements/nouveauUtilisateurPost.php" method="post" class="form nouveauUtilisateur" enctype="multipart/form-data">
          <input type="hidden" name="privilege" id="privilege" tabindex="" value="<?php echo $privilege ?>" />
        
          <div class="col-xs-6">
           <label class="label label-default" for="nom">*Nom</label>
           <input type="text" class="input-lg form-control nom" name="nom" id="nom" required="required" placeholder="Nom de l'utilisateur" spellcheck="false" maxlength="25" autocomplete="on" tabindex="1"/>
          </div>
          
          <div class="col-xs-6">
           <label class="label label-default" for="prenoms">*Prénoms</label>
           <input type="text" class="input-lg form-control prenom" name="prenoms" id="prenoms" required="required" placeholder="Prénoms de l'utilisateur" spellcheck="false" maxlength="25" autocomplete="on" tabindex="2"/>
          </div>
           <br />
           <br />
           <br />
           <br />
           
          <div class="col-xs-6">
           <label class="label label-default" for="login">*Login</label>
           <input type="text" class="input-lg form-control" name="login" id="login" required="required" placeholder="Nom d'utilisateur" spellcheck="false" maxlength="25" autocomplete="on" tabindex="3"/>
          </div>
          
          <div class="col-xs-6 form-group">
          <label class="label label-default" for="password">*Password</label>
           <div class="input-group">
           
           
           
           <input type="password" class="input-lg form-control" name="password" id="password" placeholder="Mot de passe" autocomplete="on" required="required" spellcheck="false" maxlength="25" tabindex="4" />
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
           <label class="label label-default" for="indice">*Indice du mot de passe</label>
           <input type="text" class="input-lg form-control" name="indice" id="indice" required="required" placeholder="Indice pour retrouver le mot de passe" spellcheck="false" maxlength="50" autocomplete="on" tabindex="5"/>
          </div>
          
           <br />
           <br />
           <br />
           <br />
           
           
           <div class="col-xs-12 entete">
            <h2>
            <label class="label label-primary">
             Informations complémentaires
            </label>
            </h2>
           </div>
           
           <br />
           <br />
           <br />
           <br />  
           
          <div class="col-xs-6">
         
           
          
          <div class="col-xs-9 col-xs-push-3">
          <label class="label label-default" for="nomDeJeuneFille">Nom de jeune fille</label>
          <input class="form-control input-lg nom" type="text" name="nomDeJeuneFille" id="nomDeJeuneFille" spellcheck="false" tabindex="8" placeholder="Nom de jeune fille" maxlength="50" readonly="readonly" autocomplete="on"/>
          </div>
          
          <div class="col-xs-3 col-xs-pull-9">
             
              <div class="panel panel-default">
            
                <label class="label label-default">
                 * Sexe
                </label>
              
                  <br />
                
                <input type="radio" tabindex="6" name="sexe" id="feminin" value="F" onclick="document.getElementById('nomDeJeuneFille').removeAttribute('readonly');"/>
                <label for="feminin" class="label label-primary">
                   Féminin
                </label>
                  <br />
                <input type="radio" tabindex="7" id="masculin" name="sexe" value="M" checked="checked" onclick="document.getElementById('nomDeJeuneFille').value='';document.getElementById('nomDeJeuneFille').readOnly='true';"/>                 
                <label for="masculin" class="label label-primary" style="margin-left:-2%">
                   Masculin
                  </label>
                  
                
             
             </div><!--panel -->
           
          </div><!--col-xs-3 -->
          
         </div><!--sexe et nom de jeune fille -->
         
         
         <div class="col-xs-3">
          <label class="label label-default" for="dateDeNaissance">* Date de naissance</label>
          <input type="date" tabindex="9" max=<?php echo date('Y-m-d');?> min="1914-01-01" name="dateDeNaissance" id="dateDeNaissance" class="form-control input-lg" placeholder="date de naissance" required="required"  /> 
         </div> <!--date de naissance -->
         
         <div class="col-xs-3">
           <label class="label label-default" for="photo">Photo</label>
           <input class="form-control input-lg" type="file" accept="image/jpeg" name="photo" id="photo" placeholder="Sélectionnez une photo" />
         </div>
         

           <br />
           <br />
           <br />
           <br />
           <br />
           
           
          <div class="col-xs-6">
            <label class="label label-default" for="paysOrigine">* Pays d'origine</label>
            <select name="paysOrigine" id="paysOrigine" class="form-control input-lg" tabindex="10">
             <option value="Afrique du Sud">Afrique du Sud</option>
             <option value="Algérie">Algérie</option>
             <option value="Allemagne">Allemagne</option>
             <option value="Angleterre">Angleterre</option>
             <option value="Angola">Angola</option>
             <option value="Belgique">Belgique</option>
             <option value="Bénin">Bénin</option>
             <option value="Botswana">Botswana</option>
             <option value="Brésil">Brésil</option>
             <option value="Burundi">Burundi</option>
             <option value="Cameroun">Cameroun</option>
             <option value="Canada">Canada </option>
             <option value="Cap-Vert">Cap-Vert</option>
             <option value="Centrafrique">Centrafrique</option>
             <option value="Chine">Chine</option>
             <option value="Congo-Brazzaville">Congo-Brazzaville</option>
             <option value="Congo-Kinshasa">Congo-Kinshasa</option>
             <option value="Corée du Sud">Corée du Sud</option>
             <option value="Côte d’Ivoire">Côte d’Ivoire</option>
             <option value="Danemark">Danemark</option>
             <option value="Égypte">Égypte</option>
             <option value="Érythrée ">Érythrée </option>
             <option value="Espagne">Espagne</option>
             <option value="États-Unis">États-Unis</option>
             <option value="Éthiopie">Éthiopie</option>
             <option value="France & DOM-TOM ">France & DOM-TOM </option>
             <option value="Gabon" selected="selected">Gabon</option>
             <option value="Gambie">Gambie</option>
             <option value="Ghana">Ghana</option>
             <option value="Grèce">Grèce</option>
             <option value="Guinée-Bissau">Guinée-Bissau</option>
             <option value="Guinée-Conakry">Guinée-Conakry</option>
             <option value="Guinée équatoriale">Guinée équatoriale</option>
             <option value="Haïti">Haïti</option>
             <option value="Hong-Kong">Hong-Kong</option>
             <option value="Inde">Inde</option>
             <option value="Irak">Irak</option>
             <option value="Iran">Iran</option>
             <option value="Irlande (république)">Irlande (république)</option>
             <option value="Israël">Israël</option>
             <option value="Italie">Italie</option>
             <option value="Japon">Japon</option>
             <option value="Kenya">Kenya</option>
             <option value="Koweït">Koweït</option>
             <option value="Lesotho">Lesotho</option>
             <option value="Liban">Liban</option>
             <option value="Liberia">Liberia</option>
             <option value="Libye">Libye</option>
             <option value="Mali">Mali</option>
             <option value="Maroc">Maroc</option>
             <option value="Mexique">Mexique</option>
             <option value="Mozambique">Mozambique</option>
             <option value="Namibie">Namibie</option>
             <option value="Népal">Népal</option>
             <option value="Niger">Niger</option>
             <option value="Nigeria">Nigeria</option>
             <option value="Ouganda">Ouganda</option>
             <option value="Pakistan">Pakistan</option>
             <option value="Palestine">Palestine</option>
             <option value="Pays-Bas">Pays-Bas</option>
             <option value="Portugal">Portugal</option>
             <option value="Québec">Québec</option>
             <option value="Qatar">Qatar</option>
             <option value="Royaume-Uni">Royaume-Uni</option>
             <option value="Russie">Russie</option>
             <option value="Sénégal">Sénégal</option>
             <option value="Sierra Leone">Sierra Leone</option>
             <option value="Somalie">Somalie</option>
             <option value="Soudan">Soudan</option>
             <option value="Soudan du Sud">Soudan du Sud</option>
             <option value="Suède">Suède</option>
             <option value="Suisse">Suisse</option>
             <option value="Swaziland">Swaziland</option>
             <option value="Syrie">Syrie</option>
             <option value="Togo" selected="selected">Togo</option>
             <option value="Tunisie">Tunisie</option>
             <option value="Turquie">Turquie</option>
             <option value="Vatican">Vatican</option>
             <option value="Yémen">Yémen</option>
             <option value="Zambie">Zambie</option>
             <option value="Zimbabwe">Zimbabwe</option>
             <option value="Autres">Autres</option>
            </select>
          </div> <!--nationalité -->
          
          <div class="col-xs-6">
            <label class="label label-default" for="profession">* Profession</label>
            <input class="form-control input-lg profession" type="text" name="profession" id="profession" spellcheck="true" tabindex="11" placeholder="Profession de l'utilisateur" maxlength="50" required="required" autocomplete="on"/>
          </div> <!--profession -->
          
          
           <br />
           <br />
           <br />
           <br />
           
           
           <div class="col-xs-6">
            <label class="label label-default" for="telephoneDomicile">* Téléphone</label>
            <input class="form-control input-lg telephone" type="tel" name="telephoneDomicile" id="telephoneDomicile" spellcheck="false" tabindex="12" placeholder="Numéro de téléphone au domicile de l'utilisateur" pattern="^(([0-9]{5})|(\+[0-9]{3}))?([-. ]?[0-9]{2}){4}$" maxlength="20" autocomplete="on" required="required"/>
           </div> <!--telephone 1 -->
           
           
           <div class="col-xs-6">
            <label class="label label-default" for="telephoneProfessionnel">Téléphone</label>
            <input class="form-control input-lg telephone" type="tel" name="telephoneProfessionnel" id="telephoneProfessionnel" spellcheck="false" tabindex="13" placeholder="Numéro de téléphone professionnel de l'utilisateur" pattern="^(([0-9]{5})|(\+[0-9]{3}))?([-. ]?[0-9]{2}){4}$" maxlength="20" autocomplete="on"/>
           </div> <!--telephone 2 -->
          
           <br />
           <br />
           <br />
           <br />  
  
           <div class="col-xs-6">
            <label class="label label-default" for="email">E-Mail</label>
            <input class="form-control input-lg email" type="email" name="email" id="email" tabindex="14" placeholder="Adresse électronique de l'utilisateur" maxlength="50" autocomplete="on"/>
           </div> <!--E-Mail -->   
           
          <div class="col-xs-4">
            <label class="label label-default" for="categorie">Catégorie</label>
            <select name="categorie" id="categorie" class="form-control input-lg categorie" tabindex="12">
            <?php 
			 include('../traitements/connexion.php');
		 
		  
		  $req=$bdd->prepare('SELECT * FROM CATEGORIE'); //requete qui retourne les categories de patient
          $req->execute();
	                                    //on récupère les données de la requete
	      while($donnees=$req->fetch())
		  {
			  echo '<option value="'.$donnees['IdCategorie'].'">'.$donnees['LibelleCategorie'].'</option>';
		  };
			?>
             
            </select>
          </div> <!--categorie -->
          
          <div class="col-xs-2">
            <label class="label label-default" for="groupeSanguin">* Groupe Sanguin</label>
            <select name="groupeSanguin" id="groupeSanguin" class="form-control input-lg groupeSanguin" tabindex="13">
             <option value="A+">A+</option>
             <option value="A-">A-</option>
             <option value="B+">B+</option>
             <option value="B-">B-</option>
             <option value="O+">O+</option>
             <option value="O-">O-</option>
             <option value="AB+">AB+</option>
             <option value="AB-">AB-</option>
             <option value="" selected="selected">Indéterminé</option>
            </select>
          </div> <!--groupeSanguin -->
            
           <br />
           <br />
           <br />
           <br />
         
          <div class="col-xs-12">
            <label class="label label-default" for="adresse">* Adresse</label>
            <input class="form-control input-lg adresse" type="text" name="adresse" id="adresse" tabindex="16" placeholder="Adresse de l'utilisateur" maxlength="250" spellcheck="false" autocomplete="on" required="required" spellcheck="false"/>
           </div> <!--Adresse -->  
           
           <br />
           <br />
           <br />
           <br />  
           
           <div class="col-xs-12 entete">
            <h2>
            <label class="label label-primary">
             Personne à prévenir en cas d'urgence
            </label>
            </h2>
           </div>
           
           <br />
           <br />
           <br />
           <br />  
           
           <div class="col-xs-6">
            <label class="label label-default" for="nomPap">* Nom</label>
            <input class="form-control input-lg nom" type="text" name="nomPap" id="nomPap" required="required" spellcheck="false" tabindex="17" placeholder="Nom de la personne à prévenir" maxlength="50" autocomplete="on"/>
           </div><!--nomPap -->
           
           
           <div class="col-xs-6">
          <label class="label label-default" for="prenomsPap">* Prénoms</label>
          <input class="form-control input-lg prenomPap" type="text" name="prenomsPap" id="prenomsPap" required="required" spellcheck="false" tabindex="18" placeholder="Prénoms de la personne à prévenir" maxlength="50" autocomplete="on"/>
         </div><!--prénomsPap -->
         
           <br />
           <br />
           <br />
           <br /> 
      
        
          <div class="col-xs-6">
            <label class="label label-default" for="telephoneDomicilePap">* Téléphone</label>
            <input class="form-control input-lg telephone" type="tel" name="telephoneDomicilePap" id="telephoneDomicilePap" spellcheck="false" tabindex="19" placeholder="Numéro de téléphone au domicile de la personne à prévenir" pattern="^(([0-9]{5})|(\+[0-9]{3}))?([-. ]?[0-9]{2}){4}$" autocomplete="on" required="required"/>
          </div> <!--telephone 1 Pap -->
           
           
          <div class="col-xs-6">
            <label class="label label-default" for="telephoneProfessionnelPap">Téléphone</label>
            <input class="form-control input-lg telephone" type="tel" name="telephoneProfessionnelPap" id="telephoneProfessionnelPap" spellcheck="false" tabindex="20" placeholder="Numéro de téléphone professionnel de la personne à prévenir" pattern="^(([0-9]{5})|(\+[0-9]{3}))?([-. ]?[0-9]{2}){4}$" autocomplete="on"/>
          </div> <!--telephone 2 Pap-->
          
         
           <br />
           <br />
           <br />
           <br /> 
         
          
          
         <div class="col-xs-12">
            <label class="label label-default" for="emailPap">E-Mail</label>
            <input class="form-control input-lg email" type="email" name="emailPap" id="emailPap" tabindex="21" placeholder="Adresse électronique de la personne à prévenir" maxlength="50" autocomplete="on"/>
         </div> <!--E-Mail -->   
           
           <br />
           <br />
           <br />
           <br /> 
           
           <div class="col-xs-6 text-left">
            <button type="button" data-toggle="modal" href="#reset" data-backdrop="false" class="btn btn-danger btn-lg">Vider</button>
            
           </div>
           
           <div class="col-xs-6 text-right">
            <button type="button" data-toggle="modal" href="#submit" data-backdrop="false" class="btn btn-success btn-lg">Valider</button>
            
  
             
           </div>
           
           
        </form>
           
      
      </div>
      
   </div><!--panel-primary -->
      
    </div><!--col-xs-12 -->
   </div><!--row 2 -->
 </div><!--container-->


<div class="col-xs-2" style="position:fixed; margin-top:39.47%;">
 
  
  <div class="alert alert-danger text-center">
   Attention !
   <br />
   Tous les champs marquées du signe " * " sont obligatoires. Merci !
  </div>
 </div>
 
<!--le modal qui demande la confirmation du reset -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="reset">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
			 <div class="col-xs-12 reset">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Réinitialisation du formulaire
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  
					   Ȇtes-vous sûr(e) de vouloir vider ce formulaire ?
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-success" id="finModal" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <button type="reset" form="nouveauUtilisateur" class="hidden" id="resetBtn"></button>
                       <button type="button" onclick="document.getElementById('resetBtn').click();document.getElementById('finModal').click();" class="btn btn-danger">Oui</button>
                       
                       
					  </div>
					 
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--reset -->
            
         </div>
         
        <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de reset-->
   
   
   <!--le modal qui demande confirmation de l'enregistrement -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="submit">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
			 <div class="col-xs-12 submit">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Enregistrement
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  
					   Enregistrement d'un nouvel utilisateur !
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-danger" id="finModal2" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <button type="submit" form="nouveauUtilisateur" class="hidden" id="submitBtn"></button>
                       <button type="button" onclick="document.getElementById('finModal2').click();document.getElementById('submitBtn').click();" class="btn btn-success">Oui</button>
					  </div>
					 
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--reset -->
            
         </div>
         
        <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de l'enregistrement -->

<footer>
 <span id="date_heure" style="font-size:84%;"> </span>
 <span id="time" class="time"> </span>
  <br />
  
 <span class="user text-center">
 Session de :
 <br />
  
   <?php
    echo $_SESSION['userFirstName'].' '.$_SESSION['userName'];
    ?>
   
 </span>
</footer>
 
<?php
 }
?>


<div class="modal fade col-xs-12 col-xs-offset-1" id="newUser">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button class="btn btn-danger" type="button" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 enregistrement">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  Enregistrement
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					   
					   Enregistrement d'un nouvel utilisateur !
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-12 text-center">
					   <button id="submitForm" form="nouveauUtilisateur" type="submit" class="hidden"></button>
                       <input data-dismiss="modal" class="hidden" id="finModal" />
                       
                       <button type="button" class="btn btn-success" onclick="document.getElementById('finModal').click();document.getElementById('submitForm').click();">OK !</button>
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


 <!--le modal qui demande la informe -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="info">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
			 <div class="col-xs-12 info">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Information
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  
					   L'utilisateur que vous enregistrez sera aussi enregistré en tant que patient de la clinique, pour ce faire vous êtes prié de renseigner ses informations complètes. Merci !
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-12 text-center">
					   <button type="button" class="btn btn-info" id="finModal" data-dismiss="modal">Fermer</button>
					  </div>
					  
                       
					  
					 
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--info -->
           
         </div>
         
        <div class="modal-footer">
        </div>
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal d'information-->


<input type="hidden" class="btn btn-danger" data-toggle="modal" href="#info" data-backdrop="false" id="btnInfo" />

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>
                 <script type="text/javascript">
			  document.getElementById("btnInfo").click();
			     </script>
			  
</body>
</html>