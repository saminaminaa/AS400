<?php
//fonction pour la page infos (pour avoir des informations sur l'appareil)
function actionInfos($twig, $db){
    $form = array();
    $tacomaster = new Tacomaster($db);//Table TacoMaster
    $liste = $tacomaster->select();
    $form['detailcommandes']=$liste;

    if(isset($_GET['id'])){ //On recupere l'id contenu dans l'url
        $tacomaster = new Tacomaster($db);
        $unTacomaster = $tacomaster->selectById2($_GET['id']); //requete pour selectionner qu'un seul grace à l'id
        if ($unTacomaster!=null){
            $form['tacomaster'] = $unTacomaster;
        }
        else{
            $form['message'] = 'Numéro incorrect';
        }
    }
    else{
    }
    echo $twig->render('infos.html.twig', array('form'=>$form,'liste'=>$liste, "unTacomaster"=>$unTacomaster));
    } //vue
?>