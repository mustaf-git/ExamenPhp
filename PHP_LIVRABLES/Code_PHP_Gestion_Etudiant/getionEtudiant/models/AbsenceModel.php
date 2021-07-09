<?php
namespace ism\models;
use ism\lib\AbstractModel;
use ism\lib\FormatDate;

class AbsenceModel extends AbstractModel{

    
    public function __construct() {
        parent::__construct();
        $this->tableName = "absence";
        $this->primaryKey = "idAbsence";
    }



    // model pour afficher toutes les absences d'un etudiant
    // public function selectAbsenceByEtu(string $matriculeEtu):array{
    //     $sql= 
    //     "SELECT ab.dateAbsence,cr.libelleMod
    //     FROM absence ab, cours cr
    //     WHERE cr.idCours = ab.idCours 
    //     AND ab.matriculeEtu=?";
    //     $result=$this->selectBy($sql,[$matriculeEtu],false);
    //     return $result["count"]==0?[]:$result["data"];
    
    // }


    //model pour afficher toutes mes absences d'un module
    public function selectAbsenceByModule($idEtu, $libelleMod):array{
        $sql = 
        "SELECT * 
        FROM absence ab, etudiant et, cours cr
        WHERE ab.idEtu = et.id AND cr.idCours = ab.idCours AND ab.idEtu = ? AND cr.libelleMod=?";
        $result=$this->selectBy($sql,[$idEtu, $libelleMod],false);
        return $result["count"]==0?[]:$result["data"];

    }




    //model pour afficher toutes les absences d'un semestre
    public function selectAbsenceBySemestre($idEtu, $semestre):array{
        $sql = 
        "SELECT * 
        FROM absence ab, etudiant et, cours cr
        WHERE ab.idEtu = et.id AND cr.idCours = ab.idCours AND ab.idEtu = ? AND cr.semestre=?;";
        $result=$this->selectBy($sql,[$idEtu, $semestre],false);
        return $result["count"]==0?[]:$result["data"];
    }

    //model pour afficher les absences d'un cours
    public function selectAbsenceByCours($idCours){

        $sql = 
        "SELECT *
        FROM absence ab, etudiant et, cours cr
        WHERE ab.idEtu = et.id AND ab.idCours = cr.idCours AND cr.idCours = ?";
        $result=$this->selectBy($sql,[$idCours],false);
        return $result["count"]==0?[]:$result["data"];
    }


    //model pour afficher les absences d'un etudiant
    public function selectAbsenceByEtu($idEtu){

        $sql = 
        "SELECT *
        FROM absence ab, etudiant et, cours cr
        WHERE ab.idEtu = et.id AND ab.idCours = cr.idCours AND ab.idEtu = ?";
        $result=$this->selectBy($sql,[$idEtu],false);
        return $result["count"]==0?[]:$result["data"];
        
    }


    public function absenceExiste($idCours, $idEtu):bool{
        $sql= "SELECT * FROM absence ab WHERE idCours=:idCours AND idEtu=:idEtu";
        $result=$this->selectBy($sql,[':idCours'=>$idCours, ':idEtu'=>$idEtu],true);
        return $result["count"]==0?false:true;
    }



       

    







    // model marquer absence : inser etudiant dans absence
    public function insertAbs(array $absence)//:bool
    {

        extract($absence);
        $sql= "INSERT INTO absence
        (dateAbsence,idEtu,idCours)
        VALUES 
        (?,?,?)";
    
        $result=$this->persit($sql,[FormatDate::createDateEn(),$idEtu ,$idCours]);
        
        return $result;//["count"]==0?false:true;
    }

}