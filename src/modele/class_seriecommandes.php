<?php

class Seriecommandes{
    
    private $db;

    private $rechercheSerie;

    private $rechercheSer;
    
    public function __construct($db){
        
        $this->db = $db ;

        //requete permettant d'obtenir le plan de cyclage et de coffre via un numéro de série
        $this->rechercheSerie = $db->prepare("select s.id, c.id AS idCom, d.id AS idDet, d.planCyclage AS pCycl, tm.id, tm.planCyclage, tc.plancoffre, tc.longueur1 AS l1, tc.largeur1 AS lar1, tc.hauteur1 AS h1, tc.longueur2 AS l2, tc.largeur2 AS lar2, tc.hauteur2 AS h2 from seriecommandes s, commande c, detailcommande d, tacomaster tm, tacocof tc where c.id = s.idCommande and s.id = d.idCommande and d.planCyclage = tm.id and tm.planCoffre = tc.plancoffre and s.id like :rechercheSerie order by s.id");
    
        // requete permettant d'obtenir les dimensions et les informations sur les batteries à partir du numéro de série.
        $this->rechercheSer = $db->prepare("select s.id, c.id AS idCom, d.id AS idDet, d.planCyclage AS pCycl, tm.id, tm.planCyclage, tc.plancoffre, tc.longueur1 AS l1, tc.largeur1 AS lar1, tc.hauteur1 AS h1, tc.longueur2 AS l2, tc.largeur2 AS lar2, tc.hauteur2 AS h2, ta.id AS idApp, ta.constructeur AS constr, ta.famille AS fam, ta.appareil AS app from seriecommandes s, commande c, detailcommande d, tacomaster tm, tacocof tc, tacoapp ta where c.id = s.idCommande and s.id = d.idCommande and d.planCyclage = tm.id and tm.planCoffre = tc.plancoffre and tm.planCyclage = ta.id and s.id like :rechercheSer order by s.id");
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

}

