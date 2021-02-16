<?php
//------------------------------------------Page pour voir les commandes et factures qui correspondent à un numéro de serie-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les commandes et factures qui correspondent à un numéro de serie (qui etait avant appeler garantie)
    function actionGarantieCommandesFactures($twig,$db){
        if(isset($_POST['btRechercherGarantie'])){ //click sur le bouton rechercher
            $form = array();
            $orderserial = new OrderSerial($db);//Table OrderSerial

            $rechercheGarantie = $_POST['rechercheGarantie'];
            $form['rechercheGarantie'] = $rechercheGarantie;
            $_SESSION['rechercheGarantie'] = $rechercheGarantie;
            $listeRechercheGarantie = $orderserial->rechercheGarantie($rechercheGarantie); //requete rechercheGarantie
                    
        }else
        if(isset($_SESSION['rechercheGarantie'])){ //recuperation de la valeur stockée dans la session 
            $form = array();
            $orderserial = new OrderSerial($db);

            $rechercheGarantie = $_SESSION['rechercheGarantie'];
            $form['rechercheGarantie'] = $rechercheGarantie;
            $_SESSION['rechercheGarantie'] = $rechercheGarantie;
            $listeRechercheGarantie = $orderserial->rechercheGarantie($rechercheGarantie);
                    
        }

        echo $twig->render('garantie-commandesfactures.html.twig', array('form'=>$form, 'listeRechercheGarantie'=>$listeRechercheGarantie));
    }

?>