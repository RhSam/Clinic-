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
<script type="text/javascript" src="../ressources/js/dateHeure.js"></script>
<script type="text/javascript" src="../ressources/js/heure.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>


</head>

     

<body>

<?php //sécurité contre l'accès à la page par l'url directement
 if ($_SESSION['clearance']==0) //les users  externes ne peuvent accéder à l'admission
 {
	 include('accesInterdit.php');
 }
 else
 {
?>  

<div class="col-xs-2 bread">
 
 <ul  class="list-inline">
   <li class="mother"><a href="admission.php">Admission</a></li>
   <li class="child" style="border:2px dotted rgba(204,255,255,1);
	border-radius:4px 4px 4px 4px;">►Nouveau</li>
    <br />
   <li class="child"><a href="admissionPourConsultation.php">►Ancien</a></li>
   
   
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
          $nav_en_cours='admission';
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
      
       <div class="panel-heading entete">
        <h3> Enregistrement d'un nouveau patient </h3>
       </div><!--panel-heading -->
       
       <div class="panel-body" style="height:485px;overflow:auto;">
        <form id="formulaireAdmission" class="form" method="post" action="../traitements/nouveauPatientPost.php" enctype="multipart/form-data">
        
        
        
         <div class="col-xs-6">
          <label class="label label-default" for="nom">* Nom</label>
          <input class="form-control input-lg nom" type="text" name="nom" id="nom" required="required" spellcheck="false" tabindex="1" placeholder="Nom du patient" maxlength="50" autocomplete="off"/>
         </div><!--nom -->
         
         <div class="col-xs-6">
          <label class="label label-default" for="prenoms">* Prénoms</label>
          <input class="form-control input-lg prenom" type="text" name="prenoms" id="prenoms" required="required" spellcheck="false" tabindex="2" placeholder="Prénoms du patient" maxlength="50"autocomplete="off"/>
         </div><!--prénoms -->
           
           <br />
           <br />
           <br />
           <br />
           
           
         <div class="col-xs-6">
         
           
          
          <div class="col-xs-9 col-xs-push-3">
          <label class="label label-default" for="nomDeJeuneFille">Nom de jeune fille</label>
          <input class="form-control input-lg nom" type="text" name="nomDeJeuneFille" id="nomDeJeuneFille" spellcheck="false" tabindex="5" placeholder="Nom de jeune fille" maxlength="50" readonly="readonly" autocomplete="off"/>
          </div>
          
          <div class="col-xs-3 col-xs-pull-9">
             
              <div class="panel panel-default">
            
                <label class="label label-default">
                 * Sexe
                </label>
              
                  <br />
                
                <input type="radio" tabindex="3" name="sexe" id="feminin" value="F" onclick="document.getElementById('nomDeJeuneFille').removeAttribute('readonly');"/>
                <label for="feminin" class="label label-primary">
                   Féminin
                </label>
                  <br />
                <input type="radio" tabindex="4" id="masculin" name="sexe" value="M" checked="checked" onclick="document.getElementById('nomDeJeuneFille').value='';document.getElementById('nomDeJeuneFille').readOnly='true';"/>                 
                <label for="masculin" class="label label-primary">
                   Masculin
                  </label>
                  
                
             
             </div><!--panel -->
           
          </div><!--col-xs-3 -->
          
         </div><!--sexe et nom de jeune fille -->
         
         
         <div class="col-xs-3">
          <label class="label label-default" for="dateDeNaissance">* Date de naissance</label>
          <input type="date" tabindex="6" max=<?php echo date('Y-m-d');?> min="1924-01-01" name="dateDeNaissance" id="dateDeNaissance" class="form-control input-lg" placeholder="date de naissance" required="required" autocomplete="off"/> 
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
            <select name="paysOrigine" id="paysOrigine" class="form-control input-lg" tabindex="7">
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
            <input class="form-control input-lg profession" type="text" name="profession" id="profession" spellcheck="true" tabindex="8" placeholder="Profession du patient" maxlength="50" required="required" autocomplete="off"/>
          </div> <!--profession -->
          
          
           <br />
           <br />
           <br />
           <br />
           
           
           <div class="col-xs-6">
            <label class="label label-default" for="telephoneDomicile">* Téléphone</label>
            <input class="form-control input-lg telephone" type="tel" name="telephoneDomicile" id="telephoneDomicile" spellcheck="false" tabindex="9" placeholder="Numéro de téléphone au domicile du patient" pattern="^(([0-9]{5})|(\+[0-9]{3}))?([-. ]?[0-9]{2}){4}$" maxlength="20" required="required" autocomplete="off"/>
           </div> <!--telephone 1 -->
           
           
           <div class="col-xs-6">
            <label class="label label-default" for="telephoneProfessionnel">Téléphone</label>
            <input class="form-control input-lg telephone" type="tel" name="telephoneProfessionnel" id="telephoneProfessionnel" spellcheck="false" tabindex="10" placeholder="Numéro de téléphone professionnel du patient" pattern="^(([0-9]{5})|(\+[0-9]{3}))?([-. ]?[0-9]{2}){4}$" maxlength="20" autocomplete="off"/>
           </div> <!--telephone 2 -->
          
           <br />
           <br />
           <br />
           <br />  
  
           <div class="col-xs-6">
            <label class="label label-default" for="email">E-Mail</label>
            <input class="form-control input-lg email" type="email" name="email" id="email" tabindex="11" placeholder="Adresse électronique du patient" maxlength="50" autocomplete="off"/>
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
            <input class="form-control input-lg adresse" type="text" name="adresse" id="adresse" tabindex="14" placeholder="Adresse du patient" maxlength="250" autocomplete="off" required="required"/>
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
            <input class="form-control input-lg nom" type="text" name="nomPap" id="nomPap" required="required" spellcheck="false" tabindex="15" placeholder="Nom de la personne à prévenir" maxlength="50" autocomplete="off"/>
           </div><!--nomPap -->
           
           
           <div class="col-xs-6">
          <label class="label label-default" for="prenomsPap">* Prénoms</label>
          <input class="form-control input-lg prenomPap" type="text" name="prenomsPap" id="prenomsPap" required="required" spellcheck="false" tabindex="16" placeholder="Prénoms de la personne à prévenir" maxlength="50" autocomplete="off"/>
         </div><!--prénomsPap -->
         
           <br />
           <br />
           <br />
           <br /> 
      
        
          <div class="col-xs-6">
            <label class="label label-default" for="telephoneDomicilePap">* Téléphone</label>
            <input class="form-control input-lg telephone" type="tel" name="telephoneDomicilePap" id="telephoneDomicilePap" spellcheck="false" tabindex="17" placeholder="Numéro de téléphone au domicile de la personne à prévenir" pattern="^(([0-9]{5})|(\+[0-9]{3}))?([-. ]?[0-9]{2}){4}$" autocomplete="off" required="required"/>
          </div> <!--telephone 1 Pap -->
           
           
          <div class="col-xs-6">
            <label class="label label-default" for="telephoneProfessionnelPap">Téléphone</label>
            <input class="form-control input-lg telephone" type="tel" name="telephoneProfessionnelPap" id="telephoneProfessionnelPap" spellcheck="false" tabindex="18" placeholder="Numéro de téléphone professionnel de la personne à prévenir" pattern="^(([0-9]{5})|(\+[0-9]{3}))?([-. ]?[0-9]{2}){4}$" autocomplete="off"/>
          </div> <!--telephone 2 Pap-->
          
         
           <br />
           <br />
           <br />
           <br /> 
         
          
          
         <div class="col-xs-12">
            <label class="label label-default" for="emailPap">E-Mail</label>
            <input class="form-control input-lg email" type="email" name="emailPap" id="emailPap" tabindex="19" placeholder="Adresse électronique de la personne à prévenir" maxlength="50" autocomplete="off"/>
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
       </div><!--panel-body -->
       
      </div><!--panel-primary -->
      
    </div><!--col-xs-12 -->
   </div><!--row 2 -->
 </div><!--container-->
 
 <div class="col-xs-2" style="position:fixed; margin-top:15.7%;">
 
  
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
					   <button type="reset" form="formulaireAdmission" class="hidden" id="resetBtn"></button>
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
					  
					   Enregistrement d'un nouveau patient !
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-danger" id="finModal2" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <button type="submit" form="formulaireAdmission" class="hidden" id="submitBtn"></button>
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
   
   <!--fin du modal de la désactivation -->
   
   
   
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

<!--le modal de confirmation -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="confirmation">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Enregistrement
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  <?php
					 if(isset($_GET['newPatient']))
					 { 
					  if($_GET['newPatient']==0)
					  {
					  echo 'Un patient nommée "'.$_GET['nom'].' '.$_GET['prenoms'].' et né le '.$_GET['dateDeNaissance'].'" existe déja,  si vous voulez créer un nouveau patient de même nom et prénoms, veuillez modifier le nom et prénoms de l\'un des deux(2) patients! Merci! Aucun nouveau patient créé.';}
					  
					  if($_GET['newPatient']==1)
					  {
					  echo 'Le patient  "'.$_GET['nom'].' '.$_GET['prenoms'].'" a bien été créé .<br> Son code d\'identification est : <span id="chiffre"><h2>'.$_GET['codePatient'].'</h2></span>';}
					  
					  if($_GET['newPatient']==2)
					  {
					  echo 'Un patient nommé "'.$_GET['nom'].' '.$_GET['prenoms'].' et né le '.$_GET['dateDeNaissance'].'" existe déja, son identité a été supprimée; veuillez contacter un administrateur si vous souhaitez restaurer ce patient. Si vous voulez créer un nouveau patient de même nom et prénoms, veuillez modifier le nom et prénoms de l\'un des deux(2) patients! Merci! Aucun nouveau patient créé.';}
					  
					 }
                      ?>
					 
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-default btn-block"><a href="admissionPourConsultation.php">Admission pour consultation</a></button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="nouveauPatient.php"><button type="button" class="btn btn-info btn-block">Fermer</button></a>
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
   
   <!--fin du modal de suppression -->
<input type="button" class="btn btn-danger" data-toggle="modal" href="#confirmation" data-backdrop="false" id="btnConfirm" />

<script type="text/javascript" src="../ressources/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../ressources/js/bootstrap.js"></script>
<script type="text/javascript" src="../ressources/js/script.js"></script>
<script type="text/javascript" src="../ressources/js/revealPassword.js"></script>
<script type="text/javascript">window.onload = date_heure('date_heure');</script>
<script type="text/javascript">window.onload = runClock();</script>

             <?php
			  if(isset($_GET['newPatient']))
			  {
				  echo '<script type="text/javascript">
			  document.getElementById("btnConfirm").click();
			     </script>';
			  }
             ?>

</body>
</html>