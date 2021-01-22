<?php

class Seriecommandes{
    
    private $db;

    private $rechercheSerie;

    private $rechercheSer;

    private $rechercheGarantie;
    
    public function __construct($db){
        
        $this->db = $db ;

        //requete permettant d'obtenir le plan de cyclage et de coffre via un numéro de série
        $this->rechercheSerie = $db->prepare("select s.id AS idSerie, c.id AS idCom, d.id AS idDet, d.planCyclage AS pCycl, tm.id, tm.planCyclage, tc.plancoffre, tc.longueur1 AS l1, tc.largeur1 AS lar1, tc.hauteur1 AS h1, tc.longueur2 AS l2, tc.largeur2 AS lar2, tc.hauteur2 AS h2 from seriecommandes s, commande c, detailcommande d, tacomaster tm, tacocof tc where c.id = s.idCommande and s.id = d.idCommande and d.planCyclage = tm.id and tm.planCoffre = tc.plancoffre and s.id like :rechercheSerie order by s.id");
    
        // requete permettant d'obtenir les dimensions et les informations sur les batteries à partir du numéro de série.
        $this->rechercheSer = $db->prepare("select s.id AS idSerie , c.id AS idCom, d.id AS idDet, d.planCyclage AS pCycl, tm.id, tm.planCyclage, tc.plancoffre, tc.longueur1 AS l1, tc.largeur1 AS lar1, tc.hauteur1 AS h1, tc.longueur2 AS l2, tc.largeur2 AS lar2, tc.hauteur2 AS h2, ta.id AS idApp, ta.constructeur AS constr, ta.famille AS fam, ta.appareil AS app from seriecommandes s, commande c, detailcommande d, tacomaster tm, tacocof tc, tacoapp ta where c.id = s.idCommande and s.id = d.idCommande and d.planCyclage = tm.id and tm.planCoffre = tc.plancoffre and tm.planCyclage = ta.id and s.id like :rechercheSer order by s.id");
    
        //requete permettant d'obtenir le visuel des commandes et des facture en entrant un numéro de garantie(maintenant appelé numero de série)
        //$this->rechercheGarantie = $db->prepare("select d.id, c.id AS numCommande, c.date AS dateCommande , c.numClient, c.idFacture, f.id AS numFacture, f.date AS dateFacture, f.nom AS nomClient, f.adresse1, f.adresse2, f.adresse3, f.zip, f.idCommande, s.id AS numSerie from detailcommande d, commande c, facture f, seriecommandes s where d.idCommande = c.id and d.idFacture = f.id and f.idCommande = c.id and s.idFacture = f.id and s.idCommande = c.id and s.id like :rechercheGarantie order by s.id");
        $this->rechercheGarantie = $db->prepare("select s.id AS numSerie, c.id AS numCommande, c.date AS dateCommande, c.numClient, f.id AS numFacture, f.date AS dateFacture, f.nom AS nomClient, f.adresse1, f.adresse2, f.adresse3, f.zip from seriecommandes s, commande c, facture f where s.idFacture=f.id and s.idCommande=c.id and s.id like :rechercheGarantie order by s.id");
    
    }

    //rechercher avec un numero de serie
    public function rechercheSerie($rechercheSerie){
        $this->rechercheSerie->execute(array('rechercheSerie'=>'%'.$rechercheSerie.'%'));
        if ($this->rechercheSerie->errorCode()!=0){
            print_r($this->rechercheSerie->errorInfo());
        }
        return $this->rechercheSerie->fetchAll();
    }

    //rechercher avec un numero de serie pour 2eme requete
    public function rechercheSer($rechercheSer){
        $this->rechercheSer->execute(array('rechercheSer'=>'%'.$rechercheSer.'%'));
        if ($this->rechercheSer->errorCode()!=0){
            print_r($this->rechercheSer->errorInfo());
        }
        return $this->rechercheSer->fetchAll();
    }

    //rechercher avec numero de garantie pour obtenir commandes et factures
    public function rechercheGarantie($rechercheGarantie){
        $this->rechercheGarantie->execute(array('rechercheGarantie'=>'%'.$rechercheGarantie.'%'));
        if ($this->rechercheGarantie->errorCode()!=0){
            print_r($this->rechercheGarantie->errorInfo());
        }
        return $this->rechercheGarantie->fetchAll();
    }

}

