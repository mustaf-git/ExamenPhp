<?php
namespace ism\models;
use ism\lib\AbstractModel;

class ModuleModel extends AbstractModel{
    

    public function __construct() {
        parent::__construct();
        $this->tableName = "module";
        $this->primaryKey = "libelleMod";
    }

    //model pour Lister tous les modules
    public  function  selectAllMod():array{

        $sql="SELECT * FROM module";
        return $this->dataBase->executeSelect($sql);   
    }


    //model pour lister le module d'cours
    public function selectModuleByCours(int $idCours):array{

        $sql= 
        "SELECT libelleMod
        FROM cours cr
        WHERE cr.idCours=?";
        $result=$this->selectBy($sql,[$idCours],true);
        return $result["count"]==0?[]:$result["data"];

    }

    //model pour lister les modules d'un professeur
    public function selectModuleByProf(string $matriculeProf):array{

        $sql= 
        "SELECT DISTINCT libelleMod
        FROM cours cr
        WHERE cr.matriculeProf=?";
        $result=$this->selectBy($sql,[ $matriculeProf],false);
        return $result["count"]==0?[]:$result["data"];

    }

    
    // Lmodel pour lister les module d'une classe
    public function selectModByClasse(string $libelleCl):array{

        $sql= 
        "SELECT DISTINCT cr.libelleMod 
        FROM classe cl, cours cr
        WHERE cl.libelleCl=cr.libelleCl AND cl.libelleCl=?";
        $result=$this->selectBy($sql,[ $libelleCl],false);
        return $result["count"]==0?[]:$result["data"];

    }











}