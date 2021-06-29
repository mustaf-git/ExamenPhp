<?php
namespace ism\models;
use ism\lib\AbstractModel;

class CoursModel extends AbstractModel{
    
    public function __construct() {
        parent::__construct();
        $this->tableName = "cours";
        $this->primaryKey = "idCours";
    }

    
    //model pour Lister les cours d’un prof
    public function selectCoursByProf(string $matriculeProf):array{

        $sql= 
        "SELECT cr.idCours, cr.libelleCl
        FROM cours cr
        WHERE cr.matriculeProf =?";
        $result=$this->selectBy($sql,[$matriculeProf],false);
        return $result["count"]==0?[]:$result["data"];

    }

    // Lmodel pour ister les cours d'un etudiant 
    public function selectCoursByEtu(string $matriculeEtu):array{

        $sql= 
        "SELECT cr.idCours, cr.libelleMod, cr.dateCours, cr.heureDeb, cr.heureFin
        FROM cours cr, etudiant et
        WHERE cr.libelleCl=et.libelleCl and et.matriculeEtu=?";
        $result=$this->selectBy($sql,[$matriculeEtu],false);
        return $result["count"]==0?[]:$result["data"];

    }

    //model pour Lister les cours d’une classe
    public function selectCoursByClasse(string $libelleCl):array{

        $sql= 
        "SELECT cr.idCours, cr.libelleMod
        FROM cours cr
        WHERE cr.libelleCl =?";
        $result=$this->selectBy($sql,[$libelleCl],false);
        return $result["count"]==0?[]:$result["data"];

    }




// le bon avec la migration de la clé id de user dans professeur et dans etudiant
    public function selectCoursByEtud($id){
        $sql= 
        "SELECT *
        FROM cours cr, etudiant et
        WHERE cr.libelleCl=et.libelleCl and et.id=?";
        $result=$this->selectBy($sql,[$id],false);
        return $result["count"]==0?[]:$result["data"];
    }

// Planifier cours pour un prof RP








}