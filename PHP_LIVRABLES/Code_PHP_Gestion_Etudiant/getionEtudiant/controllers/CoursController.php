<?php
namespace ism\controllers;
use ism\lib\Role;
use ism\lib\Request;
use ism\lib\Session;
use ism\lib\Response;
use ism\models\CoursModel;
use ism\lib\AbstractController;
class CoursController extends AbstractController {
    public function choixClasse(){
        $this->render("cours/choix.classe");
    }
    public function showCoursByClasse(Request $request){

        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("user/acceuilEtu");
        }
        if(!Role::estEtudiant())Response::redirectUrl("user/acceuilEtu");
        $id = $request->getParams()[0];
        $model = new CoursModel();
        $data = $model->selectCoursByEtud($id);
        $this->render("cours/lister.cours.classe",["cours" => $data] );
    }
    public function showAllCoursByClasse(Request $request){
        
        if(Role::estRP()){
            if($request->isPost()){
                $model= new CoursModel();
                $dataCl=$request->getBody();
                $libelleCl = $dataCl["libelleCl"];
                $data = $model->selectCoursByClasse($libelleCl);
                $this->render("cours/lister.cours.classe", ["cours"=>$data]);
            }else{
                $this->render("cours/choix.classe");
            }
        }else{
            Response::redirectUrl("error/403");
        }
    }
    public function choixProf(){
        $this->render("cours/choix.prof");
    }
    public function showAllCoursByProf(Request $request){
        if(Role::estRP()){
            if($request->isPost()){
                $model= new CoursModel();
                $dataProf=$request->getBody();
                $idProf = $dataProf["idProf"];
                $data = $model->selectCoursByProf($idProf);
                $this->render("cours/lister.cours.classe", ["cours"=>$data]);
            }else{
                $this->render("cours/choix.prof");
            }
        }else{
            Response::redirectUrl("error/403");
        }
    }
    public function showCoursByProf(Request $request){
        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("user/acceuilEtu");
        }
        if(!Role::estProf())Response::redirectUrl("error/403");
        $idProf = $request->getParams()[0];
        $model = new CoursModel();
        $data = $model->selectCoursByProf($idProf);
        $this->render("cours/lister.cours.classe",["cours" => $data] );
    }
    public function choixPlanifierCours(){
        if(Role::estRP()){
            $this->render("cours/choix.planifier.cours");
        }
    }
    public function planifierCours(Request $request){
        if(Role::estRP()){
        if($request->isPost()){
            $model= new CoursModel();
            $data=$request->getBody();
            $this->validator->estVide($data["dateCours"], "dateCours");
            $this->validator->estVide($data["libelleCl"], "libelleCl");
            $this->validator->estVide($data["matriculeProf"], "matriculeProf");
            $this->validator->estVide($data["libelleMod"], "libelleMod");
            $this->validator->estVide($data["semestre"], "semestre");
            $this->validator->estVide($data["volumeHoraire"], "volumeHoraire");
            $this->validator->estVide($data["heureDeb"], "heureDeb");
            $this->validator->estVide($data["heureFin"], "heureFin");
            $this->validator->estVide($data["idProf"], "idProf");
            if($this->validator->formValide()){
                //dd($data);OKI
                $modif=$model->insertCours($data);//mise a jours
                //dd($modif); //OKI
                if($modif==0){
                    $this->render("cours/planifier.cours.echoue");
                }else{
                    $this->render("cours/planifier.cours.succes");
                }
            }else{
                Session::SetSession("array_error",$this->validator->getErrors());
                Session::SetSession("array_post",$data);
                Response::redirectUrl("cours/choix.planifier.cours");  
            }
        }else{
            $this->render("cours/choix.planifier.cours");
        }
    }else{
        Response::redirectUrl("error/403");
        }
    }


    


    
}