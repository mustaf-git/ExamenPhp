<?php
namespace ism\controllers;

use ism\lib\AbstractController;
use ism\lib\Role;
use ism\lib\Response;
use ism\lib\Request;
use ism\models\AbsenceModel;


class AbsenceController extends AbstractController {


// Etudiant
    public function choixSemestre(){

        $this->render("absence/lister.absence.choix.semestre");

    }

    public function choixModule(){

        $this->render("absence/lister.absence.choix.module");

    }


    public function showAbsenceBySemestre(Request $request){

        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("user/acceuilEtu");
        }
        if(!Role::estEtudiant())Response::redirectUrl("user/acceuilEtu");
        $id = $request->getParams()[0];
        $model = new AbsenceModel();
        $dataSem=$request->getBody();
        $data = $model->selectAbsenceBySemestre($id, $dataSem["semestre"]);
        $this->render("absence/lister.absence.semestre",["absences" => $data]);

    }

    public function showAbsenceByModule(Request $request){

        if(!isset($request->getParams()[0]) || !is_numeric($request->getParams()[0])){
            Response::redirectUrl("user/acceuilEtu");
        }
        if(!Role::estEtudiant())Response::redirectUrl("user/acceuilEtu");
        $id = $request->getParams()[0];
        $model = new AbsenceModel();
        $dataMod=$request->getBody();
        $data = $model->selectAbsenceByModule($id, $dataMod["libelleMod"]);
        $this->render("absence/lister.absence.semestre",["absences" => $data]);

    }



// AC
    public function choixCours(){

        $this->render("absence/lister.absence.choix.cours");

    }

    public function choixEtu(){

        $this->render("absence/lister.absence.choix.etud");

    }


    public function showAbsenceByCours(Request $request){
        if(!Role::estAC())Response::redirectUrl("erreur/pageForbidden");
        $model = new AbsenceModel();
        $dataCours=$request->getBody();
        $data = $model->selectAbsenceByCours($dataCours["idCours"]);
        $this->render("absence/lister.absence.semestre",["absences" => $data]);


    }


    public function showAbsenceByEtu(Request $request){

        if(!Role::estAC())Response::redirectUrl("erreur/pageForbidden");
        $model = new AbsenceModel();
        $dataEtu=$request->getBody();
        $data = $model->selectAbsenceByEtu($dataEtu["idEtu"]);
        $this->render("absence/lister.absence.semestre",["absences" => $data]);

    }

    // marquer absence par le professeur ou AC


    
    public function enregistrerAbsence(){

        if(!Role::estAC() && !Role::estProf())Response::redirectUrl("erreur/pageForbidden");
        $this->render("absence/enregistrer.absence");

    }

    public function saveAbsence(Request $request){

        if(!Role::estAC() && !Role::estProf())Response::redirectUrl("erreur/pageForbidden");
        if($request->isPost()){
            $data=$request->getBody();
            $idCours = $data["idCours"];
            $idEtu = $data["idEtu"];
            $model= new absenceModel();
            if(empty($idCours) || empty($idEtu)){
            
                Response::redirectUrl("absence/enregistrerAbsence");
                
            }else{
                
                if($model->absenceExiste($idCours, $idEtu)){
                    //Response::redirectUrl("absence/enregistrerAbsence");
                    $this->render("absence/absence.echoue");
                }else{
                    $model->insertAbs(["idEtu"=>$idEtu, "idCours"=>$idCours]);
                    $this->render("absence/absence.succes");
                }

            }

            
           
        }else{
            $this->render("absence/enregistrer.absence");
        }
        
    }

    


   
    


}
















