<?php

class Admin_EvenementsController extends Zend_Controller_Action {


    function find_first_day_of_week($timestamp) {
        $target_week=$timestamp;
        $day=date('D',$target_week);
        switch(strtoupper($day)) {
            case "MON":$day_left=0;
                break;
            case "TUE":$day_left=1;
                break;
            case "WED":$day_left=2;
                break;
            case "THU":$day_left=3;
                break;
            case "FRI":$day_left=4;
                break;
            case "SAT":$day_left=5;
                break;
            case "SUN":$day_left=6;
                break;
            default:$day_left=0;
                break;
        }
        $one_day=24*60*60;
        $first_day = $target_week - ($one_day * $day_left);
        return $first_day;
    }



    function indexAction() {
        $sept_jours=(7*24*60*60)-1;

        if(!$this->_request->getParam('d')) {
            $jour=date("d",time());
            $mois=date("m",time());
            $an=date("Y",time());
        }else {
            $jour=$this->_request->getParam('d');
            $mois=$this->_request->getParam('m');
            $an=$this->_request->getParam('y');
        }

        $timestamp_concerne=mktime(0, 0, 0, $mois, $jour, $an);
        $semaine_debut = $this->find_first_day_of_week($timestamp_concerne);
        $semaine_fin = $semaine_debut + $sept_jours;
        $this->view->next_week=$semaine_debut+(7*24*60*60);
        $this->view->next_week_start=date("d/m/Y",$semaine_debut+(7*24*60*60));
        $this->view->next_week_end=date("d/m/Y",$semaine_debut+(7*24*60*60)+(7*24*60*60)-1);

        $this->view->bef_week=$semaine_debut-(7*24*60*60);
        $this->view->bef_week_start=date("d/m/Y",$semaine_debut-(7*24*60*60));
        $this->view->bef_week_end=date("d/m/Y",$semaine_debut-1);
        $this->view->semaine_debut=$semaine_debut;
        $this->view->semaine_fin=$semaine_fin;




    /* Construction de la requete pour recuperer les evenements dans la zone Ã  couvrir*/

        $table_evenement = new Admin_Model_Db_Evenement();
        $select = $table_evenement->select()
            ->where('evenement_debut BETWEEN '.$semaine_debut.' AND '.$semaine_fin)
            ->order('evenement_debut');

        $row = $table_evenement->fetchAll($select);



    /* Construction des informations pour mettre en place le rendu sous
     * forme de calendrier
     */
        $thead=array(
            "1" => array("1" => "Lu. ".date("j/m",$semaine_debut),
            "2" => $semaine_debut
            ),
            "2" => array("1" => "Ma. ".date("j/m",$semaine_debut+(1*24*60*60)),
            "2" => $semaine_debut+(1*24*60*60)
            ),
            "3" => array("1" => "Me. ".date("j/m",$semaine_debut+(2*24*60*60)),
            "2" => $semaine_debut+(2*24*60*60)
            ),
            "4" => array("1" => "Je. ".date("j/m",$semaine_debut+(3*24*60*60)),
            "2" => $semaine_debut+(3*24*60*60)
            ),
            "5" => array("1" => "Ve. ".date("j/m",$semaine_debut+(4*24*60*60)),
            "2" => $semaine_debut+(4*24*60*60)
            ),
            "6" => array("1" => "Sa. ".date("j/m",$semaine_debut+(5*24*60*60)),
            "2" => $semaine_debut+(5*24*60*60)
            ),
            "7" => array("1" => "Di. ".date("j/m",$semaine_fin),
            "2" => $semaine_fin
            )
        );

        $this->view->thead=$thead;

     /* construction des informations de remplissage
      * du tableau
      */
        $jour_actuel_debut=mktime(0,0,0,date("m",time()),date("d",time()),date("Y",time()));


        $horaires=array();
        for($i=0;$i<24;$i++) {
            if($i<10)
                $horaire="0".$i."h00";
            else
                $horaire=$i."h00";

            $horaires[$i]=$horaire;
        }

        $this->view->horaires=$horaires;


        $table_content=array();
        for($i=0;$i<7;$i++) {
            $debut_jour=$semaine_debut+($i*24*60*60);
            $fin_jour=$debut_jour+((1*24*60*60)-1);

            if($debut_jour==$jour_actuel_debut)
                $class="current_day";
            else
                $class="other_day";

            $table_content[$i]['class']=$class;
            $table_content[$i]['day_start']=$debut_jour;

            $count=0;
            $total_size_used=0;
            foreach($row as $event) {
                if(($event->evenement_debut >= $debut_jour)
                    &&($event->evenement_fin <= $fin_jour)) {

        /*je remplis les informations */
                    $table_content[$i]['events'][$count]['id']=$event->evenement_id;
                    $table_content[$i]['events'][$count]['titre']=$event->evenement_titre;
                    $table_content[$i]['events'][$count]['lieu']=$event->evenement_lieu;
                    $table_content[$i]['events'][$count]['debut']=$event->evenement_debut;
                    $table_content[$i]['events'][$count]['fin']=$event->evenement_fin;

        /* je stocke le nombre de quart d'heure */
                    $duree_secondes=$event->evenement_fin - $event->evenement_debut;
                    $duree_heure=$duree_secondes/60/60;
                    $duree_quart_heure=$duree_heure*4;
                    $table_content[$i]['events'][$count]['qhoccured']=ceil($duree_quart_heure);

        /* ceil() -> arrondir entier supÃ©rieur*/
                    $size=ceil($duree_quart_heure)*10;//10px par quart d'heure pour l'affichage
        /*je stocke la taille en pixel de l'Ã©vÃ©nement */
                    $table_content[$i]['events'][$count]['size']=$size;

        /*je recupere le quart d'heure de la journÃ©e correspondant
         * au dÃ©part de l'evenement */
                    $quart_heure_journee=(date('H',$event->evenement_debut)*4)+(date('i',$event->evenement_debut)/15);
                    $table_content[$i]['events'][$count]['qhstart']=ceil($quart_heure_journee);

        /* j'incrÃ©mente mes compteurs*/
                    $count+=1;
                    $total_size_used+=$size;
                }
            }

            $table_content[$i]["nb"]=$count;
            $table_content[$i]["tsu"]=$total_size_used;


        }


        $this->view->table_content=$table_content;

    }





}
?>
