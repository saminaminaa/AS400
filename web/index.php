<?php 
    session_cache_limiter('private_no_expire, must-revalidate'); //Pour que lorsqu'on fasse retour le navigateur se souvienne de la page precedente
    session_start(); //Demarrer la session
    //Appel de tous les fichiers requis
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
    require_once '../src/controleur/controleur_garantie_plans.php';
    require_once '../src/controleur/controleur_garantie_commandesfactures.php';
    require_once '../src/controleur/controleur_dimensions.php';
    require_once '../src/controleur/controleur_infos.php';
    require_once '../src/controleur/controleur_NbrArt_commande.php';
    require_once '../src/app/connexion.php';
    require_once '../src/modele/_class.php';

    $loader = new Twig_Loader_Filesystem('../src/vue/'); //librairies
    $twig = new Twig_Environment($loader, array());

    $db = connect(); //connection à la bd
    $contenu = getPage($db); //pages
    // Exécution de la fonction souhaitée 
    $contenu($twig,$db);




?>