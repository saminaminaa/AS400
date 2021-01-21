<?php
//------------------------------------------Page pour voir les batteries installées dans un chariot ainsi que les plans de cyclages et de coffres-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les batteries installées dans un chariot ainsi que les plans de cyclages et de coffres
    function actionChariotBatteriesPlans($twig,$db){
        if(isset($_POST['btRechercherChariot'])){
            $form = array();
            $detailcommande = new Detailcommande($db);

            $rechercheChariot = $_POST['rechercheChariot'];
            $form['rechercheChariot'] = $rechercheChariot;
            /* function escape($valeur)
            {
                // Convertit les caractères spéciaux en entités HTML
                return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
            }
            echo 'Vous avez recherché : ' .escape($rechercheChariot) .' !'; */

            $listeRechercheChariot = $detailcommande->rechercheChariot($rechercheChariot); //Liste des types de produits
                    
                }

        echo $twig->render('chariot-batteriesplans.html.twig', array('form'=>$form, 'listeRechercheChariot'=>$listeRechercheChariot));
    }

?>