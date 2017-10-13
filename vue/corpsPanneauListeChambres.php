

<div class="panel-body" style="height:500px; overflow:auto;">
         
             <?php
			 
			  while( $donnees=$reponse->fetch())  //ici on crée une fenetre modale qui nous demande confirmation, la fenetre est créée pour chaque user , d'ou l'idUtilisateur est associé à l'id de la fenetre modale
			  {
				  echo '
				  
				<div class="col-xs-6 panel panel-danger" style="height:460px;overflow:auto;">';
									  
						 
				  
				  $reponse2=$bdd->prepare('SELECT * FROM LIT WHERE NumChambre=:NumChambre order by LibelleLit'); //requete qui retourne les infos des lits de la chambre
				  $reponse2->execute(array('NumChambre'=>$donnees['NumChambre']));
				  
				  $reponse2Calcul=$bdd->prepare('SELECT * FROM LIT WHERE NumChambre=:NumChambre'); //requete pour calculer le nbr de lits
				  $reponse2Calcul->execute(array('NumChambre'=>$donnees['NumChambre']));
				  $total2=count($reponse2Calcul->fetchAll());
						 ?>
						 <div class="panel-heading entete">
						  <h4><div>Chambre <?php echo $donnees['LibelleChambre'] ?></div>
                          <div class="pull-right" style="padding-top:1%"><button type="button" class="btn btn-default btn-sm" data-toggle="modal" href="#enregLit<?php echo $donnees['NumChambre'];?>" data-backdrop="false">Nouveau Lit</button></div>
                          <div class="pull-left" style="padding-top:1%"><button type="button" data-toggle="modal" href="#supprimer<?php echo $donnees['NumChambre'];?>" data-backdrop="false" class="btn btn-danger btn-sm">Supprimer</button></div><hr/>
                            <span class="badge" id="chiffre"><?php echo $total2 ?></span>Lits
							</h4>
						   
						 </div>
					
						 <?php
						  include('corpsPanneauListeLits.php'); //on inclut le corps du panneau
						 
						echo ' 
						</div><!--fin panel ? -->
						
   
   
   <!--le modal qui demande confirmation pour la suppression de chambre  -->
   
  <div class="modal fade col-xs-12 col-xs-offset-1" id="supprimer'.$donnees['NumChambre'].'">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 suppre">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
				  Suppression
				  </h4>
				 </div>
				   
				 <div class="panel panel-body text-center">
				 
					 <h3>
					      La suppression de la chambre "'.$donnees['LibelleChambre'].'" entrainera la suppression de tous les lits enregistrés dans cette chambre. Êtes-vous sûr(e) de vouloir poursuivre cette opération ?
					   
					   
					 </h3>
					 
				        
						<br/>
				        
			  
					  <div class="col-xs-6 text-left">
					   <button type="button" class="btn btn-success" data-dismiss="modal">Non</button>
					  </div>
					  
					  <div class="col-xs-6 text-right">
					   <a href="../traitements/supprimerChambrePost.php?libelleChambre='.$donnees['LibelleChambre'].'&idChambre='.$donnees['NumChambre'].'"><button type="submit" class="btn btn-danger">Oui</button></a>
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
   
   
   
  
   
   
   
   
 <!--le modal d\'enregistrement de lit-->
  <div class="modal fade col-xs-12 col-xs-offset-1" id="enregLit'.$donnees['NumChambre'].'">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
		  
		  
		  
		  
					 <div class="col-xs-12 enreg">
			   <div class="panel panel-default">
				 <div class="panel-heading entete">
				  <h4>
                    Enregistrement
				  </h4>
				 </div>
				   
				 <div class="panel panel-body">
				 
				   
					 <h3>
					   <form action="../traitements/nouveauLitPost.php" method="post" id="formEnregLit">
                        <label class="label label-default" for="chambre">
                         Lit
                        </label>
						<input type="hidden" name="libelleChambre" id="libelleChambre" value="'.$donnees['LibelleChambre'].'"/>
						<input type="hidden" name="numChambre" id="numChambre" value="'.$donnees['NumChambre'].'"/>
                        <input class="form-control input-lg nom" type="text" name="lit" id="lit" spellcheck="false" autocomplete="off" placeholder="Numéro ou nom du lit" required="required" maxlength="10"/>
                         <br />
                         <div class="col-xs-6 text-left">
                         <button class="btn btn-danger btn-lg" type="reset">Vider</button>
                         </div>
                         
                         <div class="col-xs-6 text-right">
                         <button class="btn btn-success btn-lg" type="submit">Valider</button>
                         </div>
                         
                         
                       </form>
					 
					 </h3>
					 
				
					  </div>
					
				   
				 </div><!--panel-body -->
			   </div><!--panel -->
			</div><!--enreg -->
		  
		  
		  
		 
		  
          
         
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
 </div>
   
   <!--fin du modal de enreg -->

';
			  }
             ?>
           </tbody>
         </table>
   </div><!--panel-body-->
   
   