<?php
// Ez lesz az alapértelmezett oldal, ha nem létezik a keresett...
    class Pages extends Controller{
        public function __construct()
        {
            //echo 'Betöltve! az oldalak class';           
        }
        // ennek mindenképpen léteznie kell mert a kiinduló oldal ez
        public function index(){
            $data = [
                'main_title' => 'Főoldal',
                'title' => 'Üdvözöljük a Computer Store weboldalán'            
            ];
            $this->view('pages/index', $data);
            
        }
        
    }