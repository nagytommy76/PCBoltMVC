<?php 

class Searches extends Controller{
    public function __construct()
    {
        $this->searchModel = $this->model('search'); 
    }

    public function modalSearches(){
        $category = $_GET["category"];
        $manufact = $_GET["manufacture"];
        $input = $_GET['modalInput'];
        
        if (!empty($this->searchModel->searchResult($input,$manufact,$category))) {
            $res = $this->searchModel->searchResult($input,$manufact,$category);
            echo json_encode($res);
        }       
    }

}
