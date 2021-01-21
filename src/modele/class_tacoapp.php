<?php

class TacoApp{
    
    private $db;

    private $rechercheArticle;

    private $select2000;
    
    public function __construct($db){
        
        $this->db = $db ;

        //requete permettant de trouver les commandes qui correspondent à un article en tapant le code de l'article.
        $this->rechercheArticle = $db->prepare("select ta.id AS tacid, ta.appareil, tm.id, d.planCyclage, d.id, c.id AS idCom, c.date, c.numClient, c.idFacture from tacoapp ta, tacomaster tm, detailcommande d, commande c where ta.id = tm.idApp and tm.id = d.planCyclage and d.idCommande = c.id and ta.id like :rechercheArticle order by ta.id");
    
        //requete pour selectionner les informations sur les batteries à partir de l'année 2000.
        $this->select2000 = $db->prepare("select ta.id AS idTa, ta.constructeur, ta.famille, ta.appareil, tm.id, d.id, c.id, c.date from tacoapp ta, tacomaster tm, detailcommande d, commande c where ta.id=tm.idApp and tm.planCyclage=d.planCyclage and d.idCommande=c.id and c.date >= '2000-00-00' order by c.date");

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

}

