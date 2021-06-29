<?php
namespace ism\controllers;

use ism\lib\Role;
use ism\lib\Request;
use ism\lib\Session;
use ism\lib\Response;
use ism\models\UserModel;
use ism\lib\PasswordEncoder;
use ism\lib\AbstractController;
use ism\models\ReservationModel;

class UserController extends AbstractController {

    public function acceuilAdmin(){

        $this->render("acceuil/accueil.admin");
    }

    public function acceuilRP(){

        $this->render("acceuil/accueil.rp");
    }

    public function acceuilAC(){

        $this->render("acceuil/accueil.ac");
    }
    public function acceuilProf(){

        $this->render("acceuil/accueil.prof");
    }
    public function acceuilEtu(){

        $this->render("acceuil/accueil.etudiant");
    }







    // UserController : toutes les ressources humaines : 
    //etudiant : inscrire etudiant , lister etudiant
    //ajouter prof 
    //ajouter AC et RP 
    //modifier AC et RP
    //supprimer AC et RP




    public function crerCompte(){
        $this->render("user/crerCompte");
    }







    public function register(Request $request){
        if(Role::estAdmin() || Role::estRP() || Role::estAC()){
            if($request->isPost()){
                $model= new UserModel();
                
                $data=$request->getBody();
                $this->validator->estVide($data["nom"], "nom");
                $this->validator->estVide($data["prenom"], "prenom");
                if(!$this->validator->estVide($data["login"], "login")){
                    if($this->validator->estMail($data["login"], "login")){
                        
                        if($model->loginExiste($data["login"])){
                            $this->validator->setErrors("login","ce login existe deja dans le systeme");
                        }
                    }
                }
            
                $this->validator->estVide($data["password"], "password");
                $this->validator->estVide($data["avatar"], "avatar");
                if($data["password"]!=$data["confirm_password"]){
                    $this->validator->setErrors("confirm_password","les mots de passe ne correspondent pas");
                    
                }
                if($this->validator->formValide()){
                    $data["nom_complet"] = $data["prenom"]." ".$data["nom"];
                    unset($data["nom"]);
                    unset($data["prenom"]);
                    unset($data["confirm_password"]);
                    $data["password"]=PasswordEncoder::encode($data["password"]);
                    $model->insertUser($data);
                        if(Role::estAC()){
                            Response::redirectUrl("user/inscrireEtu");
                        }elseif(Role::estRP()){
                            Response::redirectUrl("user/inscrireProf");
                        }elseif(Role::estAdmin()){
                            Response::redirectUrl("user/acceuilAdmin");
                        }
                    
                }else{
                    Session::SetSession("array_error",$this->validator->getErrors());
                    Session::SetSession("array_post",$data);
                    Response::redirectUrl("user/register");  
                }
            }$this->render("user/register");
            
        }elseif(Role::estProf()){
            Response::redirectUrl("user/acceuilProf");
        }elseif(Role::estEtudiant()){
            Response::redirectUrl("user/acceuilEtu");
        }
    }

    public function inscrireEtu(){
        $this->render("user/inscrire.etudiant");
    }

    public function inscrireProf(){
        $this->render("user/inscrire.prof");
    }
    
    



}



