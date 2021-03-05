<?php
// ez a fő controller, ezt fogja örökölni minden kontroller, ez az ŐS
// Base Controller
// Loads models an views

class Controller{
    // load model
    public function model($model){
        // Require model file
        require_once '../app/models/'.$model.'.php';

        // Instatiate model
        return new $model();
    }
    // Load view
    public function view($view, $data = []){
        // Check for the view file
        if (file_exists('../app/views/'.$view.'.php')) {
            require_once '../app/views/'.$view.'.php';
        }else {
            // View does not exist
            die('View does not exist');
        }
    }

    /**
     * @param $viewName mb/mb_list
     * @param $modelName $this->mbModel->allMB()
     * @param $transferName example: motherboards
     * @param $mainTitle display title in tab
     */
    protected function getAllProducts($viewName, $modelName, $transferName, $mainTitle = "Összes Termék"){ 
        foreach ($modelName  as $mb) {
            pictureSplitting($mb,';');
        }           
        $data = [
            'main_title' => $mainTitle,
            $transferName => $modelName 
        ]; 
        $this->view($viewName,$data); 
    }
}





