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
				         <td>'.$donnees['nomUtilisateur'].'</td>
						 <td>'.$donnees['prenomsUtilisateur'].'</td>
						 <td>'.$donnees['loginUtilisateur'].'</td>
						 <td>'.$donnees['indicePassUtilisateur'].'</td> 
						 <td><a href="modifierUtilisateur.php?idUtilisateur='.$donnees['idUtilisateur'].'"><button class="btn btn-warning">Modifier</button></a><button data-toggle="modal" href="#suppression'.$donnees['nomUtilisateur'].'" data-backdrop="false"  class="btn btn-danger pull-right">Supprimer</button></td>
				        </tr>
						
						

  <div class="modal fade" id="suppression'.$donnees['nomUtilisateur'].'">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header">
        
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppression">
			   <div class="panel panel-default">
				 <div class="panel-heading">
				  Suppression
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
				   <form class="form">
					 <h3>
					   La suppression de cet utilisateur entrainera la suppression définitive de son historique de connexion. Ȇtes-vous sûr(e) de vouloir supprimer cet utilisateur ?
					   
					   
					 </h3>
					 
					  
			  
					  <div class="col-xs-6 text-left">
					   <a href="modifierUtilisateur.php?idUtilisateur='.$donnees['idUtilisateur'].'"><button type="button" class="btn btn-success" data-dismiss="modal">Non</button></a>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="../../traitements/supprimerUtilisateurPost.php?idUtilisateur='.$donnees['idUtilisateur'].'"><button type="button" class="btn btn-danger">Oui</button></a>
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
';
			  }
             ?>
           </tbody>
         </table>
   </div><!--panel-body-->