

<div class="panel-body">
         <table class="table table-bordered table-striped header-fixed3">
           <thead>
             <tr>
               <th width="350">Nom</th>
               <th>Prénoms</th>
               <th>Date de naissance</th>
               
               <th>Actions</th>
             </tr>
           </thead>
           
           <tbody>
             <?php
			  while( $donnees=$reponse->fetch())  //ici on crée une fenetre modale qui nous demande confirmation, la fenetre est créée pour chaque user , d'ou l'idUtilisateur est associé à l'id de la fenetre modale
			  {
				  echo '<tr>
				         <td height="50">'.$donnees['Nom'].'</td>
						 <td height="50">'.$donnees['Prenoms'].'</td>
						 <td height="50">'.dateFr($donnees['DateDeNaissance']).'</td>
						 <td height="50">
						   
						    
						     <button data-toggle="modal" href="#restauration'.$donnees['Id'].'" data-backdrop="false" class="btn btn-primary btn-block" id="btnRestaurer'.$donnees['Id'].'">Restaurer</button>
							
							
						 </td>
				        </tr>
						
   
   
   <!--le modal qui demande  -->
   
  <div class="modal fade col-xs-12 col-xs-offset-1" id="restauration'.$donnees['Id'].'">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 restauration">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Restauration d\'un patient
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
					 <h3>
					    
						  Êtes-vous sûr(e) de vouloir restaurer le patient "'.$donnees['Nom'].' '.$donnees['Prenoms'].' né le '.dateFr($donnees['DateDeNaissance']).'" ? 
					   
					   
					 </h3>
					 
				        
						<br/>
				        
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="../traitements/restaurerPatientPost.php?idUtilisateur='.$donnees['Id'].'"><button type="submit" class="btn btn-success">Oui</button></a>
					  </div>
					  
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--restauration -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de restauration -->
';
			  }
             ?>
           </tbody>
         </table>
   </div><!--panel-body-->
   
   