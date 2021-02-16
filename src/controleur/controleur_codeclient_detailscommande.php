<?php

//------------------------------------------Page pour voir le details d'une commande via un code client-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir le details d'une commande via un code client
    function actionCodeClientDetailsCommande($twig,$db){
        if(isset($_POST['btRechercher'])){ //click sur rechercher
            $form = array();
            $orderdetail = new OrderDetail($db);//Table OrderDetail

            $recherche = $_POST['recherche']; //Valeur form
            $form['recherche'] = $recherche;

            $_SESSION['recherche'] = $recherche;//Stock de la valeur dans la session

            $listeRecherche = $orderdetail->recherche($recherche); //Liste des resultats
                    
        }else
        if(isset($_SESSION['recherche'])){ //Si on trouve la valeur recherché dans la session
            $form = array();
            $orderdetail = new OrderDetail($db);

            $recherche = $_SESSION['recherche'];
            $form['recherche'] = $recherche;
            $_SESSION['recherche'] = $recherche;
            $listeRecherche = $orderdetail->recherche($recherche);
                    
        }


        echo $twig->render('codeclient-detailscommande.html.twig', array('form'=>$form, 'listeRecherche'=>$listeRecherche));
    }   //html

?>