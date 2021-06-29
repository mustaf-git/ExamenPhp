<?php
namespace ism\models;
use ism\lib\AbstractModel;

class ClasseModel extends AbstractModel{
    
    public function __construct() {
        parent::__construct();
        $this->tableName = "classe";
        $this->primaryKey = "libelleCl";
    }

    // model pour toutes les classes
    public  function  selectAllClasse():array{

        $sql="SELECT libelleCl FROM classe";
        return $this->dataBase->executeSelect($sql);   
    }

    //model pour afficher la classe d'un étudiant
    public function selectClasseByEtu(string $matriculeEtu):array{

        $sql= 
        "SELECT et.libelleCl
        FROM etudiant et
        WHERE et.matriculeEtu =?";
        $result=$this->selectBy($sql,[$matriculeEtu],true);
        return $result["count"]==0?[]:$result["data"];

    }

    //model pour afficher les classes d'un prof
    public function selectClasseByProf(string $matriculeProf):array{

        $sql= 
        "SELECT pr.libelleCl
        FROM professeur pr
        WHERE pr.matriculeProf =?";
        $result=$this->selectBy($sql,[$matriculeProf],false);
        return $result["count"]==0?[]:$result["data"];

    }





}