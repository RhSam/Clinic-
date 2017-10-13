<ul id="navigation" class="nav navbar-nav pull-right">
    <li<?php if ($nav_en_cours == 'acceuil') {echo ' id="en-cours"><a>Accueil</a></li>';} else {echo '><a href="acceuil.php">Acceuil</a></li>';} ?>
   <!-- <li><a>Admission</a></li> 
     <li><a>Rendez-vous</a></li>  
    <li><a>Consultation</a></li>
    <li><a>Hospitalisation</a></li>
    <li><a>Patients</a></li>
    <li><a>Administration</a></li> -->
    
    <li><button data-toggle="modal" href="#connexion" data-backdrop="false" class="navbar-btn btn btn-primary" id="con-decon">Connexion</button></li>
		  
</ul>

   <div class="modal fade" id="connexion">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          <?php
		   include('authentification.php');
		   
		   if($_SESSION['authentification']=="non") 
		   {
			   echo '
			   <script type="text/javascript">
			    document.getElementById("con-decon").click();
			   </script>
			   ';
			   
			  // $_SESSION['authentification']='';
		   }
          ?>
         
         </div>
         
         <div class="modal-footer">
            
         </div>
         
       </div>
     </div>
   </div>
   
   
   






