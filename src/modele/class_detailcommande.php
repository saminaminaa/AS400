<?php

class Detailcommande{
    
    private $db;
    
    private $select;

    private $recherche;

    private $rechercheChariot;

    private $selectById;
    
    public function __construct($db){
        
        $this->db = $db ;
        //requete pour selectionner
        $this->select = $db->prepare("select d.id, d.nbrArt, d.designation, d.forkilft, d.manu, d.idCommande from detailcommande d order by d.id");
    
        //requete permettant de rechercher un code client pour obtenir les commandes pui le details d'une commande
        $this->recherche = $db->prepare("select d.id, d.nbrArt, d.designation, d.forkilft, d.manu, d.idCommande, c.numClient AS codeclient, c.id AS numCommande, c.date, c.idFacture, f.id, f.nom from detailcommande d, commande c, facture f where d.idCommande = c.id and f.idCommande = c. id and f.nom like :recherche order by d.designation");
    
        //requete permettant de trouver les batteries installées dans un chariot avec les plans de coffre et de cyclages en tapant le modele du chariot.
        $this->rechercheChariot = $db->prepare("select d.id, d.nbrArt, d.designation, d.forkilft, d.manu, d.idCommande, tm.id AS idTm, tm.planCyclage AS plancycl, ta.id AS idTa, ta.constructeur AS constr, ta.famille AS fam, ta.appareil As app, tc.plancoffre AS pcof, tc.longueur1 AS l1, tc.largeur1 AS lar1, tc.hauteur1 AS h1, tc.longueur2 AS l2, tc.largeur2 AS lar2, tc.hauteur2 AS h2 from detailcommande d, tacomaster tm, tacoapp ta, tacocof tc where d.planCyclage = tm.id and tm.idApp = ta.id and tm.planCoffre = tc.plancoffre and d.forkilft like :rechercheChariot order by ta.appareil");
    
        $this->selectById = $db->prepare("select id, nbrArt, designation, forkilft, manu, idFacture, idLivraison, idCommande, planCyclage, planChantier from detailcommande d where id=:id");
    
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
    public function selectById($id){
        $this->selectById->execute(array(':id'=>$id));
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();
    }   

}

