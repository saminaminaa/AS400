<?php
//------------------------------------------Page pour voir les batteries installées dans un chariot ainsi que les plans de cyclages et de coffres-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les batteries installées dans un chariot ainsi que les plans de cyclages et de coffres
    function actionChariotBatteriesPlans($twig,$db){
        if(isset($_POST['btRechercherChariot'])){//Click sur rechercher
            $form = array();
            $detailcommande = new OrderDetail($db); //Table OrderDetail

            $rechercheChariot = $_POST['rechercheChariot']; //recup valeur form
            $form['rechercheChariot'] = $rechercheChariot;

            $_SESSION['rechercheChariot'] = $rechercheChariot; //Stock valeur dans $_session

            $listeRechercheChariot = $detailcommande->rechercheChariot($rechercheChariot); //Liste liée à la recherche (resultat)
        }else
        if(isset($_SESSION['rechercheChariot'])){//Si la valeur recherché a été stocké
            $form = array();
            $detailcommande = new OrderDetail($db);//Table OrderDetail

            $rechercheChariot = $_SESSION['rechercheChariot'];
            $form['rechercheChariot'] = $rechercheChariot;
            $_SESSION['rechercheChariot'] = $rechercheChariot;

            $listeRechercheChariot = $detailcommande->rechercheChariot($rechercheChariot);
                    
        }

        echo $twig->render('chariot-batteriesplans.html.twig', array('form'=>$form, 'listeRechercheChariot'=>$listeRechercheChariot));
    }   //vue (html)

?>