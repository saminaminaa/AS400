<?php

class Tacomaster{
    
    private $db;

    private $selectById;

    private $select;
    
    public function __construct($db){
        
        $this->db = $db ;

        $this->selectById = $db->prepare("select tm.[Plan de cyclage], tm.[Plan de coffre], tc.[Longueur 1] AS l1, tc.[Largeur 1] AS lar1, tc.[Hauteur 1] AS h1, tc.[Longueur 2] AS l2, tc.[Largeur 2] AS lar2, tc.[Hauteur 2] AS h2 from tacomaster tm, tacoCof tc where tm.[Plan de coffre]=tc.PlanCoffre and tm.[Plan de cyclage]=:id");
    
        $this->select = $db->prepare("select tm.[Plan de cyclage], tm.[Plan de coffre], tc.[Longueur 1] AS l1, tc.[Largeur 1] AS lar1, tc.[Hauteur 1] AS h1, tc.[Longueur 2] AS l2, tc.[Largeur 2] AS lar2, tc.[Hauteur 2] AS h2 from tacomaster tm, tacoCof tc where tm.[Plan de coffre]=tc.PlanCoffre");

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
    
}

