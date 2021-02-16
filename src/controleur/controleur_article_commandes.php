<?php

//------------------------------------------Page pour voir les commandes qui correspondent à un article-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les commandes qui correspondent à un article (à son nom)
    function actionArticleCommandes($twig,$db){
        if(isset($_POST['btRechercherArticle'])){ //Si le bouton rechercher est cliqué
            $form = array();//formulaire
            $detailcommande = new OrderDetail($db); //Table OrderDetail (class_detailcommande)

            $rechercheArticle = $_POST['rechercheArticle']; //On recupere la valeur recherché
            $form['rechercheArticle'] = $rechercheArticle;
            $_SESSION['rechercheArticle'] = $rechercheArticle; //On stocke la valeur recherché en session
            $listeRechercheArticle = $detailcommande->rechercheArticle($rechercheArticle);
            //requete permettant de rechercher un article
                    
        }else
        if(isset($_SESSION['rechercheArticle'])){ //Si en session la valeur "rechercheArticle est stockée"
            $form = array();
            $detailcommande = new OrderDetail($db);

            $rechercheArticle = $_SESSION['rechercheArticle']; //$rechercheArticle devient alors la valeur stockée
            $form['rechercheArticle'] = $rechercheArticle;
            $_SESSION['rechercheArticle'] = $rechercheArticle;
        
            $listeRechercheArticle = $detailcommande->rechercheArticle($rechercheArticle);
            //On crée alors une liste grace à la requete à partir de la valeur recherché
                    
        }

        echo $twig->render('article-commandes.html.twig', array('form'=>$form, 'listeRechercheArticle'=>$listeRechercheArticle));
    }   //On affiche la vue

?>