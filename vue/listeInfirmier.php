<ul id="navigation" class="nav navbar-nav pull-right">
    <li<?php if ($nav_en_cours == 'acceuil') {echo ' id="en-cours"><a>Accueil</a></li>';} else {echo '><a href="acceuil.php">Accueil</a></li>';} ?>
    <li<?php if ($nav_en_cours == 'admission') {echo ' id="en-cours"><a>Admission</a></li>';} else {echo '><a href="admission.php">Admission</a></li>';} ?>
  <!--  <li><a>Rendez-vous</a></li>  --> 
    <li<?php if ($nav_en_cours == 'consultation') {echo ' id="en-cours"><a>Consultation</a></li>';} else {echo '><a href="consultation.php">Consultation</a></li>';} ?>
    <li<?php if ($nav_en_cours == 'hospitalisation') {echo ' id="en-cours"><a>Hospitalisation</a></li>';} else {echo '><a href="hospitalisation.php">Hospitalisation</a></li>';} ?>
    <li><a>Patients</a></li>
    <li><a>Administration</a></li>
    <li><button data-toggle="modal" href="#deconnexion" data-backdrop="false" class="navbar-btn btn btn-primary" id="con-decon">Déconnexion</button></li>
</ul>


  <div class="modal fade col-xs-12 col-xs-offset-1" id="deconnexion">
     <div class="modal-dialog">
       <div class="modal-content">
       
         <div class="modal-header text-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">x</button>
         </div>
         
         <div class="modal-body">
          
          <?php
		   include('deconnexion.php');
          ?>
         </div>
         
         <div class="modal-footer">
        
         </div>
         
       </div>
     </div>
   </div>
