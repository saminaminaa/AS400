<?php

class Tacomaster{
    
    private $db;

    private $selectById;

    private $select;

    private $selectById2;
    
    public function __construct($db){
        
        $this->db = $db ;

        $this->selectById = $db->prepare("select tm.[Plan de cyclage] AS pcycl, tm.[Plan de coffre] AS pcoffre, tc.[Longueur 1] AS l1, tc.[Largeur 1] AS lar1, tc.[Hauteur 1] AS h1, tc.[Longueur 2] AS l2, tc.[Largeur 2] AS lar2, tc.[Hauteur 2] AS h2 from tacomaster tm, tacoCof tc where tm.[Plan de coffre]=tc.PlanCoffre and tm.[Plan de cyclage]=:id");
    
        $this->select = $db->prepare("select tm.[Plan de cyclage] AS pcycl, tm.[Plan de coffre] pcoffre, tc.[Longueur 1] AS l1, tc.[Largeur 1] AS lar1, tc.[Hauteur 1] AS h1, tc.[Longueur 2] AS l2, tc.[Largeur 2] AS lar2, tc.[Hauteur 2] AS h2 from tacomaster tm, tacoCof tc where tm.[Plan de coffre]=tc.PlanCoffre");
    
        $this->selectById2 = $db->prepare("select tm.[Plan de cyclage] AS pcycl, ta.Constructeur, ta.Famille, ta.Appareil, ta.[Numéro d'appareil] AS numApp from tacomaster tm, tacoApp ta where tm.NbrApp=ta.[Numéro d'appareil] and tm.[Plan de cyclage]=:id");
    
    }

    public function selectById($id){
        $this->selectById->execute(array(':id'=>$id));
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();
    }   

    //selectionner
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();     
    }

    public function selectById2($id){
        $this->selectById2->execute(array(':id'=>$id));
        if ($this->selectById2->errorCode()!=0){
            print_r($this->selectById2->errorInfo());
        }
        return $this->selectById2->fetch();
    }   
    
}

