<?php
class Admin_AjaxController extends Zend_Controller_Action {

function init() {
        /* je desactive le layout pour ï¿½viter les doublons dans le #error du design du site */
        $layout = Zend_Layout::getMvcInstance();
        $layout->disableLayout();
}

function evenementAction() {
        $heure_debut = $this->_request->getParam('d');
        $heure_fin = $this->_request->getParam('f');
        $id = $this->_request->getParam('id');

        $lesEvents = new Admin_Model_Db_Evenement();
        $row = $lesEvents->fetchRow('evenement_id='.$id);

        $debut = mktime(date('H', $heure_debut), date('i', $heure_debut), 0, date('m', $row->evenement_debut), date('d', $row->evenement_debut), date('Y', $row->evenement_debut));

        $fin = mktime(date('H', $heure_fin), date('i', $heure_fin), 0, date('m', $row->evenement_fin), date('d', $row->evenement_fin), date('Y', $row->evenement_fin));

        $row->evenement_debut = $debut;
        $row->evenement_fin = $fin;
        $row->save();

        $this->view->info = "Modifications enregistrées.";
}

function evenementresizeAction() {
        $duree = $this->_request->getParam('dur');
        $id = $this->_request->getParam('id');


        $lesEvents = new Admin_Model_Db_Evenement();
        $row = $lesEvents->fetchRow('evenement_id='.$id);
        $row->evenement_fin = $row->evenement_debut + $duree;
        $row->save();

        $this->view->info = "Horaire de fin modifiée.";
}

function evenementcreationAction() {
        $evenement = new Admin_Model_Db_Evenement();
        $row = $evenement->createRow();
        $start = $this->_request->getParam('ds');
        $end = $this->_request->getParam('de');

        $row->evenement_titre = "(Sans titre)";
        $row->evenement_contenu = "";
        $row->evenement_lieu = "(Inconnu)";
        $row->evenement_debut = $start;
        $row->evenement_fin = $end;
        $idEve = $row->save();

        $this->view->info = $idEve;
}

function supprimereventAction() {
        $id = $this->_request->getParam('id');
        $evenement = new Admin_Model_Db_Evenement();
        $evenement->delete('evenement_id='.$id);
        $this->view->info = "événement supprimé.";
}

function specifyeventAction() {
        $titre = $this->_request->getParam('titre');
        $lieu = $this->_request->getParam('lieu');
        $id = $this->_request->getParam('id');

        $lesEvents = new Admin_Model_Db_Evenement();
        $row = $lesEvents->fetchRow('evenement_id='.$id);
        if (! empty($titre))
                $row->evenement_titre = $titre;
        if (! empty($lieu))
                $row->evenement_lieu = $lieu;
        $row->save();
        $this->view->info = "événement enregistré.";
}

}
?>
