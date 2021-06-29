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
        $sql="UPDATE user us
        SET 
        us.login=?, us.password=?
        WHERE us.id=?";

        $result=$this->persit($sql,[$login,$password,$id]);
        
        return $result["count"];
    }


// Partie Getion AC et RP : Ce sont des utilisateurs et ils ont toutes les donnèes de user 
// et ils n'ont pas de table spécifique : 
// donc on les gère ici dans user

// modifier AC ou RP (admin)
    public function updateAcRp(array $user):int{
        extract($user);
        $sql="UPDATE user us
        SET 
        us.nom=?, us.login=?, us.password=?, us.avatar=?, us.role=?
        WHERE us.id=?";

        $result=$this->persit($sql,[$nom,$login,$password,$avatar,$role,$id]);
        
        return $result["count"];
    }

// Supprimer un AC ou RP (admin)

    public function removeAcRp(int $id):int{

        return $this->dataBase->executeUpdate("DELETE FROM user WHERE id = ?",[$id]);

    }

}
