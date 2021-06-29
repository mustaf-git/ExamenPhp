<?php
namespace ism\controllers;

use ism\lib\AbstractController;
use ism\lib\Role;
use ism\lib\Response;
use ism\lib\Request;
use ism\models\CoursModel;

class CoursController extends AbstractController {



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




}