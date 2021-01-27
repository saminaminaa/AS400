<?php

//------------------------------------------Page pour voir le details d'une commande via un code client-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir le details d'une commande via un code client
    function actionCodeClientDetailsCommande($twig,$db){
        if(isset($_POST['btRechercher'])){
            $form = array();
            $orderdetail = new OrderDetail($db);

            $recherche = $_POST['recherche'];
            $form['recherche'] = $recherche;

            $_SESSION['recherche'] = $recherche;

            $listeRecherche = $orderdetail->recherche($recherche); //Liste des types de produits
                    
        }else
        if(isset($_SESSION['recherche'])){
            $form = array();
            $orderdetail = new OrderDetail($db);

            $recherche = $_SESSION['recherche'];
            $form['recherche'] = $recherche;
            $_SESSION['recherche'] = $recherche;
            $listeRecherche = $orderdetail->recherche($recherche); //Liste des types de produits
                    
        }


        echo $twig->render('codeclient-detailscommande.html.twig', array('form'=>$form, 'listeRecherche'=>$listeRecherche));
    }

?>