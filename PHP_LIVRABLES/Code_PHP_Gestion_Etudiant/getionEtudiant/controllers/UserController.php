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

    // public function register(Request $request){
    //     if(Role::estAdmin() || Role::estRP() || Role::estAC()){
    //         if($request->isPost()){
    //             $model= new UserModel();
    //             $data=$request->getBody();
    //             $this->validator->estVide($data["nom"], "nom");
    //             $this->validator->estVide($data["prenom"], "prenom");
    //             if(!$this->validator->estVide($data["login"], "login")){
    //                 if($this->validator->estMail($data["login"], "login")){
    //                     if($model->loginExiste($data["login"])){
    //                         $this->validator->setErrors("login","ce login existe deja dans le systeme");
    //                     }
    //                 }
    //             }
    //             $this->validator->estVide($data["password"], "password");
    //             $this->validator->estVide($data["avatar"], "avatar");
    //             if($data["password"]!=$data["confirm_password"]){
    //                 $this->validator->setErrors("confirm_password","les mots de passe ne correspondent pas");
    //             }
    //             if($this->validator->formValide()){
    //                 $data["nom_complet"] = $data["prenom"]." ".$data["nom"];
    //                 unset($data["nom"]);
    //                 unset($data["prenom"]);
    //                 unset($data["confirm_password"]);
    //                 $data["password"]=PasswordEncoder::encode($data["password"]);
    //                 $model->insertUser($data);
    //                     if(Role::estAC()){
    //                         Response::redirectUrl("user/inscrireEtu"); // *******
    //                     }elseif(Role::estRP()){// *******
    //                         Response::redirectUrl("user/inscrireProf");
    //                     }elseif(Role::estAdmin()){
    //                         Response::redirectUrl("user/acceuilAdmin");
    //                     }
    //             }else{
    //                 Session::SetSession("array_error",$this->validator->getErrors());
    //                 Session::SetSession("array_post",$data);
    //                 Response::redirectUrl("user/register");  
    //             }
    //         }$this->render("user/register");
    //     }elseif(Role::estProf()){
    //         Response::redirectUrl("user/acceuilProf");
    //     }elseif(Role::estEtudiant()){
    //         Response::redirectUrl("user/acceuilEtu");
    //     }
    // }

    public function inscrireEtu(){
        $this->render("user/inscrire.etudiant");
    }
    public function registerEtu(Request $request){
            if($request->isPost()){
                $model= new UserModel();
                $data=$request->getBody();
                $this->validator->estVide($data["nomEtu"], "nomEtu");
                $this->validator->estVide($data["prenomEtu"], "prenomEtu");
                $this->validator->estVide($data["dateNaisEtu"], "dateNaisEtu");
                $this->validator->estVide($data["sexeEtu"], "sexeEtu");
                $this->validator->estVide($data["roleEtu"], "roleEtu");
                $this->validator->estVide($data["avatarEtu"], "avatarEtu");
                $this->validator->estVide($data["libelleCl"], "libelleCl");
                $this->validator->estVide($data["competenceEtu"], "competenceEtu");
                $this->validator->estVide($data["id"], "id");
        // fonction pour générer matricule
        function generate_matricule(){
            $tab = [0,1,2,3,4,5,6,7,8,9,"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
            $matricule = $tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)];
            return $matricule;
        }
        $data["matriculeEtu"]=generate_matricule();
                if($this->validator->formValide()){
                    //dd($data);
                    $modif = $model->insertEtu($data);
                    //dd($modif);
                    if($modif==0){
                        $this->render("user/inscrire.echoue");
                    }else{
                        $this->render("user/inscrire.succes");
                    }
                }else{
                    Session::SetSession("array_error",$this->validator->getErrors());
                    Session::SetSession("array_post",$data);
                    Response::redirectUrl("user/register");  
                }
            }$this->render("user/inscrire.etudiant");
            
        
    }
    public function inscrireProf(){
        $this->render("user/inscrire.prof");
    }
    public function registerProf(Request $request){
        if($request->isPost()){
            $model= new UserModel();
            $data=$request->getBody();
            $this->validator->estVide($data["nomProf"], "nomProf");
            $this->validator->estVide($data["prenomProf"], "prenomProf");
            $this->validator->estVide($data["dateNaisProf"], "dateNaisProf");
            $this->validator->estVide($data["gradeProf"], "gradeProf");
            $this->validator->estVide($data["sexeProf"], "sexeProf");
            $this->validator->estVide($data["roleProf"], "roleProf");
            $this->validator->estVide($data["avatarProf"], "avatarProf");
            $this->validator->estVide($data["libelleCl"], "libelleCl");
            $this->validator->estVide($data["libelleCl"], "libelleMod");
            $this->validator->estVide($data["id"], "id");
            // fonction pour générer matricule
            function generate_matricule(){

                $tab = [0,1,2,3,4,5,6,7,8,9,"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
                $matricule = $tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)]."-".$tab[random_int(0,35)].$tab[random_int(0,35)].$tab[random_int(0,35)];
                return $matricule;
            }
            $data["matriculeProf"]=generate_matricule();
            if($this->validator->formValide()){
                //dd($data);
                $modif = $model->insertProf($data);
                //dd($modif);
                if($modif==0){
                    $this->render("user/inscrire.echoue");
                }else{
                    $this->render("user/inscrire.succes");
                }
            }else{
                Session::SetSession("array_error",$this->validator->getErrors());
                Session::SetSession("array_post",$data);
                Response::redirectUrl("user/register");  
            }
        }$this->render("user/inscrire.prof");
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
    

   

}



