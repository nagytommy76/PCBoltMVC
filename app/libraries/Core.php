<?php
 /* Ez lesz a fő App Core Class
    Elkészíti a URL-t és betölti a főbb (Core) controllert
    URL FORMAT - /controller/method/params

    App Core class
    creates URL $ loads core controller
    URL Format - /controller/method/params
 */

    class Core{
        // ez a 2 változik amint a URL megváltozik
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';

        protected $params = [];

        public function __construct()
        {   
            //print_r($this->getUrl());
            $url = $this->getUrl();
            // megnézzük a controllerben, mi az első érték
            // ucwords: Az első karaktert negy betűsség teszi
            
            if (file_exists('../app/controllers/' .ucwords($url[0]). '.php')) {
                // ha létezik a file, beállítjuk kontrollerként
                $this->currentController = ucwords($url[0]);
                // Unset zero index
                unset($url[0]);
            }
            // Require the file (controller)
            require_once '../app/controllers/'.$this->currentController.'.php';
            // Példányosítjuk
            $this->currentController = new $this->currentController;
            
            // Check for second part of url. This is the method
            if (isset($url[1])) {
                // Check to see if method exists in controller
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // unset 1 index
                    unset($url[1]);
                }
            }           
            // Get params
            $this->params = $url ? array_values($url) : [];
            // Call a callback withz array of params
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
        }
        
        public function getUrl(){
           // echo $_GET['url'];
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }
    }




