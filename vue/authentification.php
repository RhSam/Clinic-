
<div class="col-xs-12 authentification">
   <div class="panel panel-default">
     <div class="panel-heading entete">
     <h4>
      Authentification
      </h4>
     </div><!--panel-heading -->
     
       
     <div class="panel panel-body">
     
       <form class="form" method="post" action="../traitements/authentification_post.php">
       
          
                 
          <div class="col-xs-12">
            
           <input type="text" class="form-control input-lg" name="login" id="login" placeholder="nom d'utilisateur" required="required" spellcheck="false" autocomplete="off"/>
         </div><!--col-xs-12-1 -->
           <br />
           <br />
           <br />
           <br />
           
         <div class="col-xs-12 form-group">
          <div class="input-group">
           
           
           <input type="password" class="form-control input-lg" name="password" id="password" placeholder="mot de passe" autocomplete="off" required="required" spellcheck="false" type="reset"/>
               <span class="input-group-addon">
                 <span class="glyphicon glyphicon-eye-close">
               </span>
               <input type="checkbox" id="reveal" />
               </span>
          </div><!--input-group --> 
         </div><!--col-xs-12-2 -->
         
           <br />
           <br />
           <br />
           <br />
         
         <div class="col-xs-6 text-left">
           <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">
            Annuler
           </button>
         </div>
          
         <div class="col-xs-6 text-right"> 
           <button type="submit" class="btn btn-success btn-lg">
            Se connecter
           </button>
         </div><!--col-xs-" -->
         
       <?php 
	    if(isset($_SESSION['authentification']) && $_SESSION['authentification']=="non") //si l'authentification est erronnée on renvoie un 
		{                                           // label danger.
          echo '<div class="col-xs-12 text-center"><br /> <h4><div class="alert alert-danger">Nom d\'utilisateur ou mot de passe incorrect, veuillez recommencer.
           </div></h4>
              
           </div>';
		   
		   
		  
		}
	
		?>
		
		  
       </form>
     </div><!--panel-body -->
   </div><!--panel -->
</div><!--authentification -->


