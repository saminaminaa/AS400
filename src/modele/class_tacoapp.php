<?php

class TacoApp{
    
    private $db;

    private $rechercheArticle;
    
    public function __construct($db){
        
        $this->db = $db ;

        //requete permettant de trouver les commandes qui correspondent à un article en tapant le code de l'article.
        $this->rechercheArticle = $db->prepare("select ta.id AS tacid, ta.appareil, tm.id, d.planCyclage, d.id, c.id AS idCom, c.date, c.numClient, c.idFacture from tacoapp ta, tacomaster tm, detailcommande d, commande c where ta.id = tm.idApp and tm.id = d.planCyclage and d.idCommande = c.id and ta.id like :rechercheArticle order by ta.id");
    }

    //rechercher avec code de l'article
    public function rechercheArticle($rechercheArticle){
        $this->rechercheArticle->execute(array('rechercheArticle'=>'%'.$rechercheArticle.'%'));
        if ($this->rechercheArticle->errorCode()!=0){
            print_r($this->rechercheArticle->errorInfo());
        }
        return $this->rechercheArticle->fetchAll();
    }

}

