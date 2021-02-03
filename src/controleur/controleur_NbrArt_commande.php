<?php

//------------------------------------------Page pour voir la liste des commandes via un numéro d'article-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir la liste des commandes via un numéro d'article
    function actionNbrArtCommande($twig,$db){
        if(isset($_POST['btRechercherNbrArt'])){
            $form = array();
            $orderdetail = new OrderDetail($db);

            $rechercheNbrArt = $_POST['rechercheNbrArt'];
            $form['rechercheNbrArt'] = $rechercheNbrArt;

            $_SESSION['rechercheNbrArt'] = $rechercheNbrArt;

            $listeRechercheNbrArt = $orderdetail->rechercheNbrArt($rechercheNbrArt);
                    
        }else
        if(isset($_SESSION['rechercheNbrArt'])){
            $form = array();
            $orderdetail = new OrderDetail($db);

            $rechercheNbrArt = $_SESSION['rechercheNbrArt'];
            $form['rechercheNbrArt'] = $rechercheNbrArt;
            $_SESSION['rechercheNbrArt'] = $rechercheNbrArt;
            $listeRechercheNbrArt = $orderdetail->rechercheNbrArt($rechercheNbrArt);
                    
        }


        echo $twig->render('NbrArt-commande.html.twig', array('form'=>$form, 'listeRechercheNbrArt'=>$listeRechercheNbrArt));
    }

?>