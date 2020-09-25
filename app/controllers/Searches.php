<?php

class Searches extends Controller{
    public function __construct()
    {
        $this->searchModel = $this->model('Search'); 
    }

    public function modalSearches(){
        $category = $_GET["category"];
        $manufact = $_GET["manufacture"];
        $input = $_GET['modalInput'];

        $input = htmlspecialchars(trim($input),ENT_IGNORE);

        $temp = array();
        switch ($category) {
            case 'cpu':
                $res = $this->searchModel->cpuSearch($input, $manufact);             
                $this->pushType($temp,$res,'cpu');   
                echo json_encode($temp);       
                break;
            case 'motherboard':
                $res = $this->searchModel->motherboardSearch($input,$manufact);
                $this->pushType($temp,$res,'mb');
                echo json_encode($temp);
                break;
            case 'ram':
                $res = $this->searchModel->ramSearch($input,$manufact);
                $this->pushType($temp,$res,'ram');
                echo json_encode($temp);
                break;
            case 'vga':
                $res = $this->searchModel->vgaSearch($input,$manufact);
                $this->pushType($temp,$res,'vga');
                echo json_encode($temp);
                break;
        }      
    }

    // -------------------------------------- PRIVATE FUNCTIONS ------------------------------------------

    private function pushType(&$tempArray, $resultArray, $productType){
        foreach ($resultArray as $re) {
            if ($re != 'Not Found') {
                $re = $this->createMerge($productType,$re);
                array_push($tempArray, $re);
            }else{
                array_push($tempArray, $resultArray);
            }     
        }
    }

    private function createMerge($productType, &$resultArray){
        $merged = $this->createMergedObjects($resultArray, ['productType' => $productType]);
        return $merged;
    }

    /**
     * @param array array1
     * @param array array2
     */
    private function createMergedObjects($array1, $array2){
        return (object) array_merge((array) $array1, (array) $array2);
    }

}
