<?php function dateFr($date)
					  {
						  return strftime('%d/%m/%Y',strtotime($date));
					  }?>

<div class="panel-body">
         <table class="table table-bordered table-striped header-fixed8">
           <thead>
             <tr>
               
               
             </tr>
           </thead>
           
           <tbody>
             <?php
			  while( $donnees=$reponse->fetch())  
			  {
				  echo '<tr>
				         <td height="50">'.$donnees['NomExamen'].'
						 
						   
						    
						     <div class="pull-right"><button data-toggle="modal" href="#supprimer'.$donnees['IdExamen'].'" data-backdrop="false" class="btn btn-danger" id="btnSuppr'.$donnees['IdExamen'].'">Supprimer</button></div>
							
							
						 </td>
				        </tr>
						
   
   
   <!--le modal qui demande vérifie le mot de passe de l\'utilisateur pour la modification  -->
   
  <div class="modal fade col-xs-12 col-xs-offset-1" id="supprimer'.$donnees['IdExamen'].'">
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
				  Suppression d\'un examen médical
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
					 <h3>
					    
						  Êtes-vous sûr(e) de vouloir supprimer l\'examen médical dénommé <br/> "'.$donnees['NomExamen'].'" ? 
					   
					   
					 </h3>
					 
				        
						<br/>
				        
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="../traitements/supprimerExamenPost.php?IdExamen='.$donnees['IdExamen'].'&NomExamen='.$donnees['NomExamen'].'"><button class="btn btn-success">Oui</button></a>
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
   
   <!--fin du modal de restauration -->
';
			  }
             ?>
           </tbody>
         </table>
   </div><!--panel-body-->
   
   