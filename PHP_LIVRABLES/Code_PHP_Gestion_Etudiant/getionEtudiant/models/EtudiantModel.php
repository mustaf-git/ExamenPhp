<?php
namespace ism\models;
use ism\lib\AbstractModel;

class EtudiantModel extends AbstractModel{
    

    public function __construct() {
        parent::__construct();
        $this->tableName = "etudiant";
        $this->primaryKey = "matriculeEtu";
    }

    //model pour Lister tous les etudiant
    public  function  selectAllEtu():array{

        $sql="SELECT * FROM etudiant";
        return $this->dataBase->executeSelect($sql);   
    }

    // Lmodel pour lister les etudiant d'une classe
    public function selectEtuByClasse($libelleCl):array{

        $sql= 
        "SELECT * 
        FROM etudiant et
        WHERE et.libelleCl=?";
        $result=$this->selectBy($sql,[ $libelleCl],false);
        return $result["count"]==0?[]:$result["data"];

    }


    public function selectEtuByMatricule($matriculeEtu):array{

        $sql= 
        "SELECT * 
        FROM etudiant et
        WHERE et.matriculeEtu=?";
        $result=$this->selectBy($sql,[ $matriculeEtu],false);
        return $result["count"]==0?[]:$result["data"];

    }


    public function selectEtuByNiveau($niveauCl):array{

        $sql= 
        "SELECT *
        FROM 
        classe cl, etudiant et 
        WHERE cl.libelleCl = et.libelleCl and cl.niveauCl=?";
        $result=$this->selectBy($sql,[$niveauCl],false);
        return $result["count"]==0?[]:$result["data"];

    }



// inscrire un etudiant

    public function insertEtu(array $etudiant):bool{

        extract($etudiant);
        $sql= "INSERT INTO etudiant 
        (matriculeEtu,nomEtu,prenomEtu,dateNaisEtu,sexeEtu,roleEtu,avatarEtu,libelleCl,competenceEtu,parcoursEtu)
        VALUES 
        (?,?,?,?,?,?,?,?,?,?)";

        $result=$this->persit($sql,[$matriculeEtu,$nomEtu,$prenomEtu,$dateNaisEtu,$sexeEtu,$roleEtu,$avatarEtu,$libelleCl,$competenceEtu,$parcoursEtu]);
        
        return $result["count"]==0?false:true;
    }








}