<?php
namespace ism\models;
use ism\lib\AbstractModel;
class UserModel extends AbstractModel{

    public function __construct() {
        parent::__construct();
        $this->tableName = "user";
        $this->primaryKey = "id";
    }

// Partie Sécurité : dans la table user qui stock les infos pour la connexion de tous les user du système 

    public function insertUser(array $user):bool{

        extract($user);
        $sql= "INSERT INTO user 
        (nom_complet,login,password,avatar,role)
        VALUES 
        (?,?,?,?,?)";

        $result=$this->persit($sql,[$nom_complet,$login,$password,$avatar,$role]);
        
        return $result["count"]==0?false:true;
    }

// fonction pour générer matricule
    // function generate_matricule(){

    //     $tab = [0,1,2,3,4,5,6,7,8,9,"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    //     $matricule = $tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)];
    //     return $matricule;
    
    // }

    

    public function insertEtu(array $user):int
    {

        extract($user);
        $sql= "INSERT INTO etudiant 
        (matriculeEtu,nomEtu,prenomEtu,dateNaisEtu,sexeEtu,roleEtu,avatarEtu,libelleCl,competenceEtu,parcoursEtu,id)
        VALUES 
        (?,?,?,?,?,?,?,?,?,?,?)";

        $result=$this->persit($sql,[$matriculeEtu,$nomEtu,$prenomEtu,$dateNaisEtu,$sexeEtu,$roleEtu,$avatarEtu,$libelleCl,$competenceEtu,$parcoursEtu,$id]);
        
        return $result;//["count"]==0?false:true;
    }


    public function insertProf(array $user):int
    {

        extract($user);
        $sql= "INSERT INTO professeur
        (matriculeProf,nomProf,prenomProf,dateNaisProf,sexeProf,gradeProf,roleProf,avatarProf,libelleCl,libelleMod,id)
        VALUES 
        (?,?,?,?,?,?,?,?,?,?,?)";

        $result=$this->persit($sql,[$matriculeProf,$nomProf,$prenomProf,$dateNaisProf,$sexeProf,$gradeProf,$roleProf,$avatarProf,$libelleCl,$libelleMod,$id]);
        
        return $result;//["count"]==0?false:true;
    }



    public function selectUserByLoginPassword(string $login):array{
        $sql= "SELECT * FROM user 
        WHERE login=?";
        $result=$this->selectBy($sql,[$login],true);
        return $result["count"]==0?[]:$result["data"];
    }
    

    public function loginExiste(string $login):bool{
        $sql= "SELECT * FROM user WHERE login=:login";
        $result=$this->selectBy($sql,[':login'=>$login],true);
        return $result["count"]==0?false:true;
    }


    // user peut modifier ses propres donnèes de connexion 

    public function updateDataConne(array $user):int{
        extract($user);
        $sql="UPDATE user
        SET 
        login=?, password=?
        WHERE id=?";

        $result=$this->persit($sql,[$login,$password,$id]);
        
        return $result;//["count"];
    }


// Partie Getion AC et RP : Ce sont des utilisateurs et ils ont toutes les donnèes de user 
// et ils n'ont pas de table spécifique : 
// donc on les gère ici dans user

// modifier AC ou RP (admin)
    public function updateAcRp(array $user){
        extract($user);
        $sql="UPDATE user
        SET 
        nom_complet=?, login=?, password=?, avatar=?, role=?
        WHERE id=?";

        $result=$this->persit($sql,[$nom_complet,$login,$password,$avatar,$role,$id]);
        
        return $result;
    }

// Supprimer un AC ou RP (admin)

    public function removeAcRp(int $id){
        //extract($data);
        $sql = "DELETE FROM user WHERE id=?";
        $result = $this->persit($sql,[$id]);
        return $result;
    }

}
