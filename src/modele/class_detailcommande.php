<?php

class OrderDetail{
    
    private $db;
    
    private $select;

    private $recherche;

    private $rechercheChariot;

    private $selectById;

    private $rechercheNbrArt;

    public function __construct($db){

        $this->db = $db ;
        //requete pour selectionner
        //$this->select = $db->prepare("select d.id, d.nbrArt, d.designation, d.forkilft, d.manu, d.idCommande from detailcommande d order by d.id");
        //Requete avc vraie BD :
        $this->select = $db->prepare("select top 9000 NbrArt, [Désignation] AS desi, Forklift, Manu, InvNbr AS idFacture, ShpNbr AS idLivraison, OrderNb AS idCommande, PCyclage AS planCyclage, PlanChantier planChantier from OrderDetail od");
        
        //requete permettant de rechercher un code client pour obtenir les commandes pui le details d'une commande
        //$this->recherche = $db->prepare("select d.id, d.nbrArt, d.designation, d.forkilft, d.manu, d.idCommande, c.numClient AS codeclient, c.id AS numCommande, c.date, c.idFacture, f.id, f.nom from detailcommande d, commande c, facture f where d.idCommande = c.id and f.idCommande = c. id and f.nom like :recherche order by d.designation");
        //meme requete avec la vraie BD :
        //$this->recherche = $db->prepare("select od.Id, od.NbrArt, od.Désignation, od.Forklift, od.Manu, od.OrderNb, o.Customer number, o.Order number, o.Order date, o.Invoice number, i.idInvoice, i.Invoice Name from OrderDetail od, Order o, Invoice i where od.OrderNb = o.idOrder and i.OrderNumber = o.idOrder and i.Invoice Name like :recherche order by od.Désignation");
        $this->recherche = $db->prepare("select top 9000 od.OrderNb AS numCommande, od.id, o.[Customer number] AS numClient, LEFT(o.[Order date],4) AS année, RIGHT(o.[Order date],2) AS jour, SUBSTRING(o.[Order date], 5, 2) AS mois, o.[Invoice number] AS numFacture, i.[Invoice Name] AS nomClient from OrderDetail od, [Order] o, Invoice i where od.OrderNb = o.[Order number] and i.OrderNumber = o.[Order number] and i.[Invoice Name] like :recherche");

        //requete permettant de trouver les batteries installées dans un chariot avec les plans de coffre et de cyclages en tapant le modele du chariot.
        //$this->rechercheChariot = $db->prepare("select d.id, d.nbrArt, d.designation, d.forkilft, d.manu, d.idCommande, tm.id AS idTm, tm.planCyclage AS plancycl, ta.id AS idTa, ta.constructeur AS constr, ta.famille AS fam, ta.appareil As app, tc.plancoffre AS pcof, tc.longueur1 AS l1, tc.largeur1 AS lar1, tc.hauteur1 AS h1, tc.longueur2 AS l2, tc.largeur2 AS lar2, tc.hauteur2 AS h2 from detailcommande d, tacomaster tm, tacoapp ta, tacocof tc where d.planCyclage = tm.id and tm.idApp = ta.id and tm.planCoffre = tc.plancoffre and d.forkilft like :rechercheChariot order by ta.appareil");
        //requete pour la vraie BD :
        $this->rechercheChariot = $db->prepare("select top 9000 od.Id, od.[Désignation] AS desi, od.Forklift, od.Manu, od.OrderNb, tm.idTaco AS idTm, tm.[Plan de cyclage] AS plancycl, ta.[Numéro d'appareil] AS idTa, ta.Constructeur AS constr, ta.Famille AS fam, ta.Appareil As app, tc.PlanCoffre AS pcof, tc.[Longueur 1] AS l1, tc.[Largeur 1] AS lar1, tc.[Hauteur 1] AS h1, tc.[Longueur 2] AS l2, tc.[Largeur 2] AS lar2, tc.[Hauteur 2] AS h2 from OrderDetail od, Tacomaster tm, TacoApp ta, TacoCof tc where od.Pcyclage = tm.[Plan de cyclage] and tm.NbrApp = ta.[Numéro d'appareil] and tm.[Plan de coffre] = tc.PlanCoffre and od.forklift like :rechercheChariot order by ta.Appareil");

        //$this->selectById = $db->prepare("select id, nbrArt, designation, forkilft, manu, idFacture, idLivraison, idCommande, planCyclage, planChantier from detailcommande d where id=:id");
        //Requete pour la vrai BD :
        $this->selectById = $db->prepare("select top 9000 NbrArt,SUBSTRING(NbrArt, 3, 5) AS pcof, id, [Désignation] AS desi, Forklift, Manu, InvNbr AS idFacture, ShpNbr AS idLivraison, OrderNb AS idCommande, PCyclage AS planCyclage, PlanChantier planChantier from OrderDetail od where InvNbr=:idFacture order by id");

        $this->rechercheOD = $db ->prepare("select top 9000 NbrArt,SUBSTRING(NbrArt, 3, 5) AS pcof, [Désignation] AS desi, Forklift, Manu, InvNbr AS idFacture, ShpNbr AS idLivraison, OrderNb AS idCommande, PCyclage AS planCyclage, PlanChantier planChantier from OrderDetail od where InvNbr like :idFacture");
    
        $this->rechercheNbrArt = $db->prepare("select top 9000 od.NbrArt, od.[Désignation], o.[Order number] AS numCommande, o.[Customer number] AS numClient, o.[Order date], LEFT(o.[Order date],4) AS année, RIGHT(o.[Order date],2) AS jour, SUBSTRING(o.[Order date], 5, 2) AS mois, o.[Invoice number] AS numFacture from OrderDetail od, [Order] o where od.InvNbr=o.[Invoice number] and od.NbrArt like :rechercheNbrArt");
    
    }
    
    //selectionner
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
           print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();     
    }

    //rechercher
    public function recherche($recherche){
        $this->recherche->execute(array('recherche'=>'%'.$recherche.'%'));
        if ($this->recherche->errorCode()!=0){
            print_r($this->recherche->errorInfo());
        }
        return $this->recherche->fetchAll();
    }

    //rechercher avec modele chariot
    public function rechercheChariot($rechercheChariot){
        $this->rechercheChariot->execute(array('rechercheChariot'=>'%'.$rechercheChariot.'%'));
        if ($this->rechercheChariot->errorCode()!=0){
            print_r($this->rechercheChariot->errorInfo());
        }
        return $this->rechercheChariot->fetchAll();
    }

    //selectionner par l'id
    public function selectById($idFacture){
        $this->selectById->execute(array(':idFacture'=>$idFacture));
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetchAll();
    }

    //rechercher le detail d'une commande
    public function rechercheOD($recherche){
        $this->rechercheOD->execute(array('recherche'=>'%'.$recherche.'%'));
        if ($this->rechercheOD->errorCode()!=0){
            print_r($this->rechercheOD->errorInfo());
        }
        return $this->rechercheOD->fetchAll();
    }

    //rechercher un numéro d'article
    public function rechercheNbrArt($rechercheNbrArt){
        $this->rechercheNbrArt->execute(array('rechercheNbrArt'=>'%'.$rechercheNbrArt.'%'));
        if ($this->rechercheNbrArt->errorCode()!=0){
            print_r($this->rechercheNbrArt->errorInfo());
        }
        return $this->rechercheNbrArt->fetchAll();
    }

}

