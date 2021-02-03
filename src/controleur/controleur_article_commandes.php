<?php

//------------------------------------------Page pour voir les commandes qui correspondent à un article-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les commandes qui correspondent à un article
    function actionArticleCommandes($twig,$db){
        if(isset($_POST['btRechercherArticle'])){
            $form = array();
            $detailcommande = new OrderDetail($db);

            $rechercheArticle = $_POST['rechercheArticle'];
            $form['rechercheArticle'] = $rechercheArticle;
            $_SESSION['rechercheArticle'] = $rechercheArticle;
            $listeRechercheArticle = $detailcommande->rechercheArticle($rechercheArticle);
                    
        }else
        if(isset($_SESSION['rechercheArticle'])){
            $form = array();
            $detailcommande = new OrderDetail($db);

            $rechercheArticle = $_SESSION['rechercheArticle'];
            $form['rechercheArticle'] = $rechercheArticle;
            $_SESSION['rechercheArticle'] = $rechercheArticle;
        
            $listeRechercheArticle = $detailcommande->rechercheArticle($rechercheArticle);
                    
        }

        echo $twig->render('article-commandes.html.twig', array('form'=>$form, 'listeRechercheArticle'=>$listeRechercheArticle));
    }

?>