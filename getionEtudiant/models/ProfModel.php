<?php
namespace ism\models;
use ism\lib\AbstractModel;
class ProfModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "professeur";
        $this->primaryKey = "matriculeProf";
    }

    // inserer prof
    public function insertProf(array $professeur):bool{

        extract($professeur);
        $sql= "INSERT INTO professeur 
        (matriculeProf,nomProf,prenomProf,dateNaisProf,sexeProf,gradeProf,roleProf,avatarProf,libelleCl,libelleMod)
        VALUES 
        (?,?,?,?,?,?,?,?,?,?)";

        $result=$this->persit($sql,[$matriculeProf,$nomProf,$prenomProf,$dateNaisProf,$sexeProf,$gradeProf,$roleProf,$avatarProf,$libelleCl,$libelleMod]);
        
        return $result["count"]==0?false:true;
    }

    

}
