

<div class="panel-body">
         
             <?php
			 
			  while( $donnees2=$reponse2->fetch())  //ici on crée une fenetre modale qui nous demande confirmation, la fenetre est créée pour chaque user , d'ou l'idUtilisateur est associé à l'id de la fenetre modale
			  {
				  echo '
				  
				<div class="col-xs-5 col-xs-push-1 panel panel-primary lit">';
									  
				    ?>
						 <div class="panel-heading entete">
						  <h4><div>Lit <span id="chiffre"><?php echo $donnees2['LibelleLit'] ?></span></div>
							</h4>
						   
						 </div>
                         
                         <div class="panel-body">
                          
                           
                          
                          <button type="button" data-toggle="modal" href="#supprimerLit<?php echo $donnees2['NumLit'];?>" data-backdrop="false" class="btn btn-danger btn-block btn-xs">Supprimer</button>
                          
                         
                          
                         </div><!--body -->
					
						 <?php
						  
						 
						echo ' 
						</div><!--fin panel ? -->
						
   
   
  <!--le modal qui demande confirmation pour la suppression du lit  -->
   
  <div class="modal fade col-xs-12 col-xs-offset-1" id="supprimerLit'.$donnees2['NumLit'].'">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppress">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Suppression
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
					 <h3>
					    Êtes-vous sûr(e) de vouloir supprimer le lit "'.$donnees2['LibelleLit'].'" de la chambre "'.$donnees['LibelleChambre'].'" ?
					   
					   
					 </h3>
					 
				        
						<br/>
				        
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-success" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="../traitements/supprimerLitPost.php?libelleChambre='.$donnees['LibelleChambre'].'&libelleLit='.$donnees2['LibelleLit'].'&idLit='.$donnees2['NumLit'].'"><button type="submit" class="btn btn-danger">Oui</button></a>
					  </div>
					  
				   </form>
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--suppr conf -->
		  
		  
		  
		  
		  
          
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
   
   <!--fin du modal de suppression-->
   
';
			  }
             ?>
           </tbody>
         </table>
   </div><!--panel-body-->
   
   