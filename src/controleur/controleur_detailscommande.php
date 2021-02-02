<?php
function actionDetailCommande($twig, $db){
    $form = array();
    $detailcommande = new OrderDetail($db);
 /*    $liste = $detailcommande->select();
    $form['detailcommandes']=$liste; */

    if(isset($_GET['idFacture'])){
        $detailcommande = new OrderDetail($db);
        $liste = $detailcommande->selectById($_GET['idFacture']);
        //$form['detailcommande'] = $liste;
        $unDetailcommande = $detailcommande->selectById($_GET['idFacture']);
        if ($liste!=null){
            $form['detailcommande'] = $liste;
        }
        else{
            $form['message'] = 'Produit incorrect';
        }
        if ($unDetailcommande!=null){
            $form['detailcommande'] = $unDetailcommande;
        }
        else{
            $form['message'] = 'Produit incorrect';
        }
    }
    echo $twig->render('detailscommande.html.twig', array('form'=>$form, 'liste'=>$liste, "unDetailcommande"=>$unDetailcommande));
    }
?>