<?php
    // Load config
    require_once 'config/config.php';
    require_once 'helpers/url_helper.php';

    require_once 'helpers/session_helper.php';

    require_once 'helpers/string_split.php';
    // betöltjük a könyvtárakat
    /*require_once 'libraries/Core.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Database.php';*/
    
    // Autoload Core Libraries
    // Ami a libraries könyvtárban van azt betölti autómatikusan, így nem
    // kell mindig require-elni mindent
    spl_autoload_register(function($className){
        require_once 'libraries/'.$className.'.php';
    });


