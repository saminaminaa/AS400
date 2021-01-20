<?php
function actionDetailCommande($twig, $db){
    $form = array();
    $detailcommande = new Detailcommande($db);
    $liste = $detailcommande->select();
    $form['detailcommandes']=$liste;

    if(isset($_GET['id'])){
        $detailcommande = new Detailcommande($db);
        $unDetailcommande = $detailcommande->selectById($_GET['id']);
        if ($unDetailcommande!=null){
            $form['detailcommande'] = $unDetailcommande;
        }
        else{
            $form['message'] = 'Produit incorrect';
        }
    }
    else{
                     
    }
    echo $twig->render('detailscommande.html.twig', array('form'=>$form,'liste'=>$liste, "unDetailcommande"=>$unDetailcommande));
    }
?>