<?php
function actionDimensions($twig, $db){
    $form = array();
    $tacomaster = new Tacomaster($db);
    $liste = $tacomaster->select();
    $form['detailcommandes']=$liste;

    if(isset($_GET['id'])){
        $tacomaster = new Tacomaster($db);
        $unTacomaster = $tacomaster->selectById($_GET['id']);
        if ($unTacomaster!=null){
            $form['tacomaster'] = $unTacomaster;
        }
        else{
            $form['message'] = 'Numéro incorrect';
        }
    }
    else{
    }
    echo $twig->render('dimensions.html.twig', array('form'=>$form,'liste'=>$liste, "unTacomaster"=>$unTacomaster));
    }
?>