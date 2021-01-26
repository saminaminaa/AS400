<?php
function actionInfos($twig, $db){
    $form = array();
    $tacomaster = new Tacomaster($db);
    $liste = $tacomaster->select();
    $form['detailcommandes']=$liste;

    if(isset($_GET['id'])){
        $tacomaster = new Tacomaster($db);
        $unTacomaster = $tacomaster->selectById2($_GET['id']);
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
    }
?>