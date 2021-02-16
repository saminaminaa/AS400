<?php

//fonction pour la page qui affiche les dimensions du coffre
function actionDimensions($twig, $db){
    if(isset($_POST['btRechercherDimension'])){ //click sur le bouton rechercher
        $form = array();
        $tacomaster = new Tacomaster($db);//Table tacomaster

        $rechercheDimension = $_POST['rechercheDimension'];
        $form['rechercheDimension'] = $rechercheDimension;
        $_SESSION['rechercheDimension'] = $rechercheDimension;
        $listeRechercheDimension = $tacomaster->rechercheDimension($rechercheDimension);
                
    }else
    if(isset($_SESSION['rechercheDimension'])){
        $form = array();
        $tacomaster = new Tacomaster($db);

        $rechercheDimension = $_SESSION['rechercheDimension'];
        $form['rechercheDimension'] = $rechercheDimension;
        $_SESSION['rechercheDimension'] = $rechercheDimension;
    
        $listeRechercheDimension = $tacomaster->rechercheDimension($rechercheDimension);
                
    }



    echo $twig->render('dimensions.html.twig', array('form'=>$form,'listeRechercheDimension'=>$listeRechercheDimension/* , "unTacomaster"=>$unTacomaster */));
    }
?>