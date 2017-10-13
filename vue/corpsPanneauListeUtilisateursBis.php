<div class="panel-body">
         <table class="table table-bordered table-striped">
           <thead>
             <tr>
               <th>Nom</th>
               <th>Prénoms</th>
               <th>Nom d'utilisateur</th>
               <th>Indice du mot de passe</th>
               <th>Actions</th>
             </tr>
           </thead>
           
           <tbody>
             <?php
			  while( $donnees=$reponse->fetch())  //ici on crée une fenetre modale qui nous demande confirmation, la fenetre est créée pour chaque user , d'ou l'idUtilisateur est associé à l'id de la fenetre modale
			  {
				  echo '<tr>
				         <td>'.$donnees['Nom'].'</td>
						 <td>'.$donnees['Prenoms'].'</td>
						 <td>'.$donnees['Login'].'</td>
						 <td>'.$donnees['IndicePass'].'</td> 
						 <td width="190">
						   <div class="btn-group">
						    
						     <a data-toggle="modal" href="#modificationVerif'.$donnees['Id'].'" data-backdrop="false" class="btn btn-warning" id="btnModifier'.$donnees['Id'].'">Modifier</a>
						     <a data-toggle="modal" href="#suppression'.$donnees['Id'].'" data-backdrop="false"  class="btn btn-danger">Supprimer</a>
							
							</div>
						 </td>
				        </tr>
						
						
<!--le modal qui demande la confirmation de la suppression -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="suppression'.$donnees['Id'].'">
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
				  Suppression
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					 ';
					 if($donnees['Id']==1)
					 {
						 echo 'Il est impossible de supprimer cet administrateur !
					  </h3>
					 
					  <div class="col-xs-12 text-center">
					   <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
					  </div>';
					 }
					 else
					 {
					   echo 'La suppression de cet utilisateur entrainera la suppression de son historique de connexion. Ȇtes-vous sûr(e) de vouloir supprimer cet utilisateur ?
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-success" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="../traitements/supprimerUtilisateurPost.php?idUtilisateur='.$donnees['Id'].'"><button type="button" class="btn btn-danger">Oui</button></a>
					  </div>';
					 }
					 echo '
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
   
   
   
   <!--le modal qui demande la confirmation de la désactivation -->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="desactivation'.$donnees['Id'].'">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
			 <div class="col-xs-12 désactivation">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Désactivation
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					  ';
					 if($donnees['Id']==1)
					 {
						 echo 'Il est impossible de désactiver cet administrateur !
					  </h3>
					 
					  <div class="col-xs-12 text-center">
					   <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
					  </div>';
					 }
					 else
					 {
					   echo 'Ȇtes-vous sûr(e) de vouloir désactiver cet utilisateur ?
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-success" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="../traitements/desactiverUtilisateurPost.php?idUtilisateur='.$donnees['Id'].'"><button type="button" class="btn btn-danger">Oui</button></a>
					  </div>';
					 }
					 echo '
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--desactiver -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de la désactivation -->
   
   
   
   <!--le modal qui demande vérifie le mot de passe de l\'utilisateur pour la modification  -->
   
  <div class="modal fade col-xs-12 col-xs-offset-1" id="modificationVerif'.$donnees['Id'].'">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <a href="comptesUtilisateurs.php"><button type="button" class="btn btn-danger">x</button></a>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 modificationVerif">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Vérification du mot de passe de l\'utilisateur
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form method="post" action="../traitements/modifierUtilisateurVerifPost.php" class="form">
					 <h3>
					    
						  <input type="hidden" value='.$donnees['Id'].' name="idUtilisateur">
					    
					     <div class="col-xs-12">
                         <input class="form-control input-lg" type="text" readonly="readonly" value="'.$donnees['Login'].'"/>
                         </div>
                   <br/>
                   <br/>
				   <br/>
						
						
						
          <div class="col-xs-12 form-group">
          
           <div class="input-group">
           
          
		   
           <input type="password" class="input-lg form-control" name="password" id="password" placeholder="mot de passe" autocomplete="off" required="required" spellcheck="false" maxlength="25"/>
               <span class="input-group-addon">
                 <span class="glyphicon glyphicon-eye-close">
               </span>
               <input type="checkbox" id="reveal" />
               </span>
           </div><!--input-group --> 
          </div>
					   
					   
					 </h3>
					 
					 
					 
					 ';
	    if(isset($_GET['trouve'])) //si l'authentification est erronnée on renvoie un 
		{                                           // label danger.
          echo '<div class="col-xs-12 text-center"> <h4><div class="alert alert-danger">Mot de passe incorrect, veuillez recommencer.
           </div></h4>
              
           </div>';
		}
	
		echo '
					    <br/>
					    <br/>
				        <br/>
						<br/>
				        
			  
					  <div class="col-xs-6 text-left">
					   <a href="comptesUtilisateurs.php"><button type="button" class="btn btn-danger btn-lg">Annuler</button></a>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <button type="submit" class="btn btn-success btn-lg">Valider</button>
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
';
			  }
             ?>
           </tbody>
         </table>
   </div><!--panel-body-->
   
   