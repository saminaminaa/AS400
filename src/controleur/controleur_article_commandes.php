<?php

//------------------------------------------Page pour voir les commandes qui correspondent à un article-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les commandes qui correspondent à un article
    function actionArticleCommandes($twig,$db){
        if(isset($_POST['btRechercherArticle'])){
            $form = array();
            $tacoapp = new Tacoapp($db);

            $rechercheArticle = $_POST['rechercheArticle'];
            $form['rechercheArticle'] = $rechercheArticle;
            $_SESSION['rechercheArticle'] = $rechercheArticle;
            $listeRechercheArticle = $tacoapp->rechercheArticle($rechercheArticle);
                    
        }else
        if(isset($_SESSION['rechercheArticle'])){
            $form = array();
            $tacoapp = new Tacoapp($db);

            $rechercheArticle = $_SESSION['rechercheArticle'];
            $form['rechercheArticle'] = $rechercheArticle;
            $_SESSION['rechercheArticle'] = $rechercheArticle;
        
            $listeRechercheArticle = $tacoapp->rechercheArticle($rechercheArticle);
                    
        }

        echo $twig->render('article-commandes.html.twig', array('form'=>$form, 'listeRechercheArticle'=>$listeRechercheArticle));
    }

?>