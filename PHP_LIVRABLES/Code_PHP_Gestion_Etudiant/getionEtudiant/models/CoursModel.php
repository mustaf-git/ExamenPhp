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
    public function selectCoursByProf($idProf){

        $sql= 
        "SELECT cr.idCours, cr.semestre, cr.libelleMod,cr.dateCours, cr.heureDeb, cr.heureFin, pr.nomProf, pr.prenomProf, cr.libelleCl
        FROM cours cr, professeur pr
        WHERE pr.id = cr.idProf AND cr.idProf=?";
        $result=$this->selectBy($sql,[$idProf],false);
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
    public function selectCoursByClasse($libelleCl):array{

        $sql= 
        "SELECT *
        FROM cours cr, professeur pr
        WHERE cr.idProf = pr.id AND cr.libelleCl =?";
        $result=$this->selectBy($sql,[$libelleCl],false);
        return $result["count"]==0?[]:$result["data"];

    }




// le bon avec la migration de la clé id de user dans professeur et dans etudiant
    public function selectCoursByEtud($id){
        $sql= 
        "SELECT *
        FROM cours cr, etudiant et, professeur pr
        WHERE cr.idProf = pr.id AND cr.libelleCl=et.libelleCl AND et.id=?";
        $result=$this->selectBy($sql,[$id],false);
        return $result["count"]==0?[]:$result["data"];
    }

// Planifier cours pour un prof RP

    public function generate_matricule(){

        $tab = [0,1,2,3,4,5,6,7,8,9,"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
        $matricule = $tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)];
        return $matricule;

    }

    public function insertCours(array $cours):int{

        extract($cours);
        $sql= "INSERT INTO cours 
        (dateCours,libelleCl,matriculeProf,libelleMod,semestre,volumeHoraire,heureDeb,heureFin,idProf)
        VALUES 
        (?,?,?,?,?,?,?,?,?)";

        $result=$this->persit($sql,[$dateCours,$libelleCl,$matriculeProf,$libelleMod,$semestre,$volumeHoraire,$heureDeb,$heureFin,$idProf]);
        
        return $result;//["count"]==0?false:true;
    }

// dateCours
        // libelleCl
        // libelleMod
        // semestre
        // volumeHoraire
        // heureDeb
        // heureFin

}