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
                
                
                if($user["role"]=="ROLE_ADMIN"){
                    Response::redirectUrl("user/acceuilAdmin");
                }
                elseif($user["role"]=="ROLE_RP"){
                    Response::redirectUrl("user/acceuilRP");
                }
                elseif($user["role"]=="ROLE_AC"){
                    Response::redirectUrl("user/acceuilAC");//acceuilProf
                }
                elseif($user["role"]=="ROLE_PROF"){
                    Response::redirectUrl("user/acceuilProf");
                }
                elseif($user["role"]=="ROLE_ETUDIANT"){
                    Response::redirectUrl("user/acceuilEtu");
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
        Response::redirectUrl("security/login");
    }




    



}