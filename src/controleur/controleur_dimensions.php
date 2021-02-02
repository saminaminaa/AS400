<?php
function actionDimensions($twig, $db){
/*     $form = array();
    $tacomaster = new Tacomaster($db);
    $liste = $tacomaster->select();
    $form['detailcommandes']=$liste;

    if(isset($_GET['id'])){
        $tacomaster = new Tacomaster($db);
        $unTacomaster = $tacomaster->selectById($_GET['id']);
        if ($unTacomaster!=null){
            $form['tacomaster'] = $unTacomaster;
        }
        else{
            $form['message'] = 'Numéro incorrect';
        }
    }
    else{
    } */


    if(isset($_POST['btRechercherDimension'])){
        $form = array();
        $tacomaster = new Tacomaster($db);

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