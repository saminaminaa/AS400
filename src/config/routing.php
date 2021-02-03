<?php 
    function getPage($db){
        $lesPages['accueil'] = "actionAccueil";
        $lesPages['codeclient-detailscommande'] = "actionCodeClientDetailsCommande";
        $lesPages['chariot-batteriesplans'] = "actionChariotBatteriesPlans";
        $lesPages['serie-plan'] = "actionSeriePlan";
        $lesPages['serie-dimensionsinfos'] = "actionSerieDimensionsInfos";
        $lesPages['article-commandes'] = "actionArticleCommandes";
        $lesPages['detailscommande'] = "actionDetailCommande";
        $lesPages['infosbatteries2000'] = "actionInfosBatteries2000";
        $lesPages['garantie-plans'] = "actionGarantiePlans";
        $lesPages['garantie-commandesfactures'] = "actionGarantieCommandesFactures";
        $lesPages['dimensions'] = "actionDimensions";
        $lesPages['infos'] = "actionInfos";
        $lesPages['maintenance'] = "actionMaintenance";
        $lesPages['NbrArt-commande'] = "actionNbrArtCommande";

          /*   if ($db == NULL) {
            return "nous ne trouvons pas de bd";
        } else { */

        if ($db != NULL) {
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 'accueil';
            }

            if (!isset($lesPages[$page])) {
                $page = 'accueil';
            }
            $contenu = $lesPages[$page];
        } else{
            $contenu = 'actionMaintenance';
        }
        return $contenu;
    }

     /*    if(isset($_GET['page'])){
            $page = $_GET['page']; 
        } else{
            $page = 'accueil'; 
        }
        if (!isset($lesPages[$page])){
            $page = 'accueil'; 
        }
        $contenu = $lesPages[$page];
        return $contenu; 
    } */



?>
