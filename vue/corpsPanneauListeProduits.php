<?php function dateFr($date)
					  {
						  return strftime('%d/%m/%Y',strtotime($date));
					  }?>

<div class="panel-body">
         <table class="table table-bordered table-striped header-fixed9">
           <thead>
             <tr>
               
               <th>Noms</th>
               <th>Formats</th>
               <th>Dosages</th>
               <th>Actions</th>
             </tr>
           </thead>
           
           <tbody>
             <?php
			  while( $donnees=$reponse->fetch())  
			  {
				  echo '<tr>
				         <td height="60"  style="overflow:auto;">'.$donnees['NomProduit'].'</td>
						 <td height="60"  style="overflow:auto;">'.$donnees['FormatProduit'].'</td>
						 <td height="60">'.$donnees['DosageProduit'].'</td>
						 
						  <td height="60">
						    
						    <button data-toggle="modal" href="#supprimer'.$donnees['IdProduit'].'" data-backdrop="false" class="btn btn-danger btn-block" id="btnSuppr'.$donnees['IdProduit'].'">Supprimer</button>
							
							
						 </td>
				        </tr>
						
   
   
   <!-- -->
   
  <div class="modal fade col-xs-12 col-xs-offset-1" id="supprimer'.$donnees['IdProduit'].'">
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
				  Suppression d\'un produit
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
					 <h3>
					    
						  Êtes-vous sûr(e) de vouloir supprimer <br/> "'.$donnees['NomProduit'].' '.$donnees['FormatProduit'].' '.$donnees['DosageProduit'].'" ? 
					   
					   
					 </h3>
					 
				        
						<br/>
				        
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="../traitements/supprimerProduitPost.php?IdProduit='.$donnees['IdProduit'].'&NomProduit='.$donnees['NomProduit'].'&FormatProduit='.$donnees['FormatProduit'].'&DosageProduit='.$donnees['DosageProduit'].'"><button class="btn btn-success">Oui</button></a>
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
   
   