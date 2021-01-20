<?php
//------------------------------------------Page pour voir les commandes qui correspondent à un article-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les commandes qui correspondent à un article
    function actionArticleCommandes($twig,$db){
        if(isset($_POST['btRechercherArticle'])){
            $form = array();
            $tacoapp = new Tacoapp($db);

            $rechercheArticle = $_POST['rechercheArticle'];
            $form['rechercheArticle'] = $rechercheArticle;
        
            $listeRechercheArticle = $tacoapp->rechercheArticle($rechercheArticle);
                    
                }

        echo $twig->render('article-commandes.html.twig', array('form'=>$form, 'listeRechercheArticle'=>$listeRechercheArticle));
    }

?>