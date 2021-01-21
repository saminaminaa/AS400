<?php 

    require_once '../src/lib/vendor/autoload.php';
    require_once '../src/config/routing.php';
    require_once '../src/controleur/controleur_index.php';
    require_once '../src/controleur/controleur_codeclient_detailscommande.php';
    require_once '../src/controleur/controleur_chariot_batteriesplans.php';
    require_once '../src/controleur/controleur_serie_plan.php';
    require_once '../src/controleur/controleur_serie_dimensionsinfos.php';
    require_once '../src/controleur/controleur_article_commandes.php';
    require_once '../src/controleur/controleur_detailscommande.php';
    require_once '../src/controleur/controleur_infosbatteries2000.php';
    require_once '../src/app/connexion.php';
    require_once '../src/modele/_class.php';

    $loader = new Twig_Loader_Filesystem('../src/vue/');
    $twig = new Twig_Environment($loader, array());

    $db = connect(); 
    $contenu = getPage($db);
    // Exécution de la fonction souhaitée 
    $contenu($twig,$db);




?>