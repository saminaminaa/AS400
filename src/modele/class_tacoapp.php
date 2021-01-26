<?php

class TacoApp{
    
    private $db;

    private $rechercheArticle;

    private $select2000;

    private $rechercheGarant;

    private $rechercheGarantie;
    
    public function __construct($db){
        
        $this->db = $db ;

        //requete permettant de trouver les commandes qui correspondent à un article en tapant le code de l'article (maintenant en tapant la designation)
        //$this->rechercheArticle = $db->prepare("select ta.id AS tacid, ta.appareil, tm.id, d.planCyclage, d.designation, d.id, c.id AS idCom, c.date, c.numClient, c.idFacture from tacoapp ta, tacomaster tm, detailcommande d, commande c where ta.id = tm.idApp and tm.id = d.planCyclage and d.idCommande = c.id and d.designation like :rechercheArticle order by d.designation");
        //requete avec la vraie BD :
        $this->rechercheArticle = $db->prepare("select ta.[Numéro d'appareil] AS tacid, ta.Appareil AS appareil, tm.idTaco , od.PCyclage, od.[Désignation] AS desi, od.id, o.[Order Number] AS idCom, o.[Order date] AS date, o.[Customer number] AS numClient, o.[Invoice number] AS idFacture from tacoApp ta, tacomaster tm, OrderDetail od, [Order] o where ta.[Numéro d'appareil] = tm.NbrApp and tm.[Plan de cyclage] = od.PCyclage and od.OrderNb = o.[Order number] and od.[Désignation] like :rechercheArticle order by od.[Désignation]");



        //requete pour selectionner les informations sur les batteries à partir de l'année 2000.
        //$this->select2000 = $db->prepare("select ta.id AS idTa, ta.constructeur, ta.famille, ta.appareil, tm.id, d.id, c.id, c.date, f.id, f.date AS dateFacture from tacoapp ta, tacomaster tm, detailcommande d, commande c, facture f where ta.id=tm.idApp and tm.planCyclage=d.planCyclage and d.idCommande=c.id and f.idCommande = c.id and f.date >= '2000-00-00' order by c.date");
        //meme requete avec la vraie BD :
        $this->select2000 = $db->prepare("select ta.[Numéro d'appareil] AS idTa, ta.Constructeur, ta.Famille, ta.Appareil, i.[Invoice Date] AS dateFacture from tacoapp ta, tacomaster tm, OrderDetail od, [Order] o, Invoice i where ta.[Numéro d'appareil]=tm.NbrApp and tm.[Plan de cyclage]=od.PCyclage and od.OrderNb=o.[Order number] and i.OrderNumber = o.[Order number] and i.[Invoice Date] >= '20000000'");


        //requete permettant de trouver les plans de cyclages et de coffres correspondant à un numero de garantie
        $this->rechercheGarant = $db->prepare("select ta.id AS tacid, ta.appareil, tm.id, tm.planCyclage, tm.planCoffre, tc.plancoffre, tc.longueur1, tc.largeur1, tc.hauteur1, tc.longueur2, tc.largeur2, tc.hauteur2 from tacoapp ta, tacomaster tm, tacocof tc where ta.id = tm.idApp and tm.planCoffre = tc.plancoffre and ta.id like :rechercheGarant order by ta.id");
    
        //requete permettant d'obtenir le visuel des commandes et des facture en entrant un numéro de garantie
        $this->rechercheGarantie = $db->prepare("select d.id, c.id AS numCommande, c.date AS dateCommande , c.numClient, c.idFacture, f.id AS numFacture, f.date AS dateFacture, f.nom AS nomClient, f.adresse1, f.adresse2, f.adresse3, f.zip, f.idCommande, s.id AS numSerie from detailcommande d, commande c, facture f, seriecommandes s where d.idCommande = c.id and d.idFacture = f.id and f.idCommande = c.id and s.idFacture = f.id and s.idCommande = c.id and s.id like :rechercheGarantie order by s.id");
    
    }

    //rechercher avec code de l'article
    public function rechercheArticle($rechercheArticle){
        $this->rechercheArticle->execute(array('rechercheArticle'=>'%'.$rechercheArticle.'%'));
        if ($this->rechercheArticle->errorCode()!=0){
            print_r($this->rechercheArticle->errorInfo());
        }
        return $this->rechercheArticle->fetchAll();
    }

    //selectionner à partir de l'année 2000  
    public function select2000(){
        $this->select2000->execute();
        if ($this->select2000->errorCode()!=0){
           print_r($this->select2000->errorInfo());
        }
        return $this->select2000->fetchAll();         
    }

    //rechercher avec numero de garantie
    public function rechercheGarant($rechercheGarant){
        $this->rechercheGarant->execute(array('rechercheGarant'=>'%'.$rechercheGarant.'%'));
        if ($this->rechercheGarant->errorCode()!=0){
            print_r($this->rechercheGarant->errorInfo());
        }
        return $this->rechercheGarant->fetchAll();
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

