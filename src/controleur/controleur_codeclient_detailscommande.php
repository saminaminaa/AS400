<?php
//------------------------------------------Page pour voir le details d'une commande via un code client-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir le details d'une commande via un code client
    function actionCodeClientDetailsCommande($twig,$db){
        if(isset($_POST['btRechercher'])){
            $form = array();
            $detailcommande = new Detailcommande($db);

            $recherche = $_POST['recherche'];
            $form['recherche'] = $recherche;
        
            $listeRecherche = $detailcommande->recherche($recherche); //Liste des types de produits
                    
                }

        echo $twig->render('codeclient-detailscommande.html.twig', array('form'=>$form, 'listeRecherche'=>$listeRecherche));
    }

?>