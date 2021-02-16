<?php
//fonction pour la page pour voir les details d'une commande
function actionDetailCommande($twig, $db){
    $form = array();
    $detailcommande = new OrderDetail($db);//Table OrderDetail

    if(isset($_GET['idFacture'])){//On recupere l'id de la facture qui est contenu dans le lien
        $detailcommande = new OrderDetail($db);
        $liste = $detailcommande->selectById($_GET['idFacture']);//On crée une liste grace à cet id
        //$form['detailcommande'] = $liste;
        $unDetailcommande = $detailcommande->selectById($_GET['idFacture']);//Pour n'en selectionner qu'un
        if ($liste!=null){//Si la liste est nulle
            $form['detailcommande'] = $liste; //liste grace au form
        }
        else{
            $form['message'] = 'recherche incorrect'; //msg d'erreur
        }
        if ($unDetailcommande!=null){
            $form['detailcommande'] = $unDetailcommande;
        }
        else{
            $form['message'] = 'recherche incorrect'; //msg d'erreur
        }
    }
    echo $twig->render('detailscommande.html.twig', array('form'=>$form, 'liste'=>$liste, "unDetailcommande"=>$unDetailcommande));
    }//vue html
?>