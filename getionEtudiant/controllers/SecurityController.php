<?php

namespace ism\controllers;
use ism\lib\Role;
use ism\lib\Request;
use ism\lib\Session;
use ism\lib\Response;
use ism\models\UserModel;
use ism\lib\AbstractController;
use ism\lib\PasswordEncoder;

/**
 * Undocumented class
 */
class SecurityController extends AbstractController{
public function login(Request $request){
    if($request->isPost()){

        //dd($this->validator->getErrors());
        $data= $request->getBody();
    if(!$this->validator->estVide($data["login"], "login")){
        $this->validator->estMail($data["login"], "login");
    }
    $this->validator->estVide($data["password"], "password");
    if($this->validator->formValide()){
        // login et mot de passe correct
        $model= new UserModel;
        $user = $model->selectUserByLoginPassword($data["login"] );

        if(empty($user)){
           $this->validator->setErrors("error_login","login ou mot de passe incorrect");
          Session::setSession("array_error",$this->validator->getErrors());
        
           Response::redirectUrl("security/login");
           
        }else{
            // login et password correct et existe
           // set_session("user_connect",$user);
            Session::setSession("user_connect",$user);
            if(PasswordEncoder::decode($data["password"], $user["password"])){
                
                if(Session::keyExist("action") && Session::getSession("action")== "reservation"){
                    Response::redirectUrl("reservation/addReservation");
                }
                if($user["role"]=="ROLE_ADMIN"){
                    Response::redirectUrl("security/showUser");
                }
                elseif($user["role"]=="ROLE_VISITEUR"){
                    //redirect_url("accueil.visiteur");
                    Response::redirectUrl("bien/showCatalogue");
                }
            }else{
                $this->validator->setErrors("error_login","login ou mot de passe incorrect");
                Session::setSession("array_error",$this->validator->getErrors());
                Response::redirectUrl("security/login");
            }
        }
    }else {
        //Erreur de validation donc redirection vers page de connexion
        //dd($this->validator->getErrors());
        Session::SetSession("array_error",$this->validator->getErrors());
        Response::redirectUrl("security/login");
    }
    }
    $this->render("security/login");
}

public function register(Request $request){
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
        if($data["password"]!=$data["confirm_password"]){
            $this->validator->setErrors("confirm_password","les mots de passe ne correspondent pas");
            
        }
       if($this->validator->formValide()){
           $data["nom_complet"] = $data["nom"]." ".$data["prenom"];
           unset($data["nom"]);
           unset($data["prenom"]);
           unset($data["confirm_password"]);
           $data["password"]=PasswordEncoder::encode($data["password"]);
           $model->insert($data);
           Response::redirectUrl("security/login");
       }else{
        Session::SetSession("array_error",$this->validator->getErrors());
        Session::SetSession("array_post",$data);
        Response::redirectUrl("security/register");  
       }
    }
    $this->render("security/register");
    
}

public function logout(){
    Session::destroySession();
    Response::redirectUrl("bien/showCatalogue");
}

public function showUser(){
    if(!Role::estAdmin())Response::redirectUrl("bien/showCatalogue");
    $model=new UserModel();
    $data=$model->selectAll();
    //dd($data);
    $this->render("security/show.user",["users"=> $data]);

}

}