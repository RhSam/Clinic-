<ul id="navigation" class="nav navbar-nav pull-right">
    <li<?php if ($nav_en_cours == 'acceuil') {echo ' id="en-cours"><a>Accueil</a></li>';} else {echo '><a href="acceuil.php">Accueil</a></li>';} ?>
    <li<?php if ($nav_en_cours == 'admission') {echo ' id="en-cours"><a>Admission</a></li>';} else {echo '><a href="admission.php">Admission</a></li>';} ?>
   <!--  <li<?php if ($nav_en_cours == 'rendez-vous') {echo ' id="en-cours"><a>Rendez-vous</a></li>';} else {echo '><a href="rendez-vous.php">Rendez-vous</a></li>';} ?>  -->
    <li><a>Consultation</a></li>
    <li><a>Hospitalisation</a></li>
    <li><a>Patients</a></li>
    <li><a>Administration</a>
    <li><button data-toggle="modal" href="#deconnexion" data-backdrop="false" class="navbar-btn btn btn-default" id="con-decon">Déconnexion</button></li>
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

