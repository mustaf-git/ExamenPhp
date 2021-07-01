<?php
namespace ism\controllers;

use ism\lib\Role;
use ism\lib\Request;
use ism\lib\Session;
use ism\lib\Response;
use ism\models\UserModel;
use ism\lib\PasswordEncoder;
use ism\lib\AbstractController;
use ism\models\EtudiantModel;

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
    

    public function choixClasse(){
        $this->render("user/choix.classe");
    }

    public function showEtuByClasse(Request $request){
        
        if(Role::estProf() || Role::estRP() || Role::estAC()){
            if($request->isPost()){

                $model= new EtudiantModel();
                $dataCl=$request->getBody();
                $libelleCl = $dataCl["libelleCl"];
                $data = $model->selectEtuByClasse($libelleCl);
                $this->render("user/show.etu", ["etudiants"=>$data]);
                    
            }else{
                $this->render("user/showEtuByClasse");
            }
        }else{
            Response::redirectUrl("error/403");
        }
        
    }


    public function choixMatricule(){
        $this->render("user/choix.matricule");
    }

    public function showEtuByMatricule(Request $request){
        
        if(Role::estProf() || Role::estRP() || Role::estAC()){
            if($request->isPost()){

                $model= new EtudiantModel();
                $dataEt=$request->getBody();
                $matriculeEtu = $dataEt["matriculeEtu"];
                $data = $model->selectEtuByMatricule($matriculeEtu);
                $this->render("user/show.etu", ["etudiants"=>$data]);
                    
            }else{
                $this->render("user/showEtuByMatricule");
            }
        }else{
            Response::redirectUrl("error/403");
        }
        
    }


    public function choixNiveau(){
        $this->render("user/choix.niveau");
    }

    public function showEtuByNiveau(Request $request){
        
        if(Role::estProf() || Role::estRP() || Role::estAC()){
            if($request->isPost()){

                $model= new EtudiantModel();
                $dataEt=$request->getBody();
                $niveauEtu = $dataEt["niveauEtu"];
                $data = $model->selectEtuByNiveau($niveauEtu);
                $this->render("user/show.etu", ["etudiants"=>$data]);
                    
            }else{
                $this->render("user/showEtuByNiveau");
            }
        }else{
            Response::redirectUrl("error/403");
        }
        
    }



    public function choixAcRp(){
        $this->render("user/choix.ac.rp.modif");
    }


    public function supprimerAcRp(Request $request){
     
        if(Role::estAdmin()){
            if($request->isPost()){

                $model= new UserModel();
                $dataAcRp=$request->getBody();
                //dd($dataAcRp);
                $idAcRp = $dataAcRp["idAcRp"];
                //dd($idAcRp);
                $sup = $model->removeAcRp($idAcRp);// le problème c'est ici 
                //dd($sup);//resolue maintenant
                if($sup==0){
                    $this->render("user/suppri.ac.rp.echoue");
                }else{
                    $this->render("user/suppri.ac.rp.succes");
                }
                
                    
            }else{
                $this->render("user/choix.ac.rp.modif");
            }
        }else{
            Response::redirectUrl("error/403");
        }


    }






    public function choixDonesModif(){
        $this->render("user/choix.donnes.modif");
    }

    public function modifConnection(Request $request){

               $id = $request->getParams()[0];
                //dd($id);

                if($request->isPost()){
                    $model= new UserModel();
                    $data=$request->getBody();


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
                        unset($data["confirm_password"]);
                        $data["password"]=PasswordEncoder::encode($data["password"]);
                        //$data["id"] = $request->getParams[0];
                        //dd($data);
                        $data["id"] = $id;
                        //dd($data); cest bon maintenant 
                        $modif=$model->updateDataConne($data);//mise a jours
                        //dd($modif); OKI
                        if($modif==0){
                            $this->render("user/modif.conn.echoue");
                        }else{
                            $this->render("user/modif.conn.succes");
                        }
                          
                        
                    }else{
                        Session::SetSession("array_error",$this->validator->getErrors());
                        Session::SetSession("array_post",$data);
                        Response::redirectUrl("user/modifConnection");  
                    }
                }$this->render("user/choix.donnes.modif");
                
            
        
    }

   


    

    





}



