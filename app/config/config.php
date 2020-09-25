<?php
    // DB Params
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','pcbolt');

    // App Root
    define('APPROOT',dirname(dirname(__FILE__)));

    // URL Root
    define('URLROOT', 'http://localhost/PCBoltMVC');
    //define('URLROOT', 'https://nagytamasweboldal.000webhostapp.com');

    // Site name
    define('SITENAME', 'Computer Store |');

    // Ikonok elérési útvonala:
    /***
     * http://localhost/PCBoltMVC/img....
     */
    define('ICONROOT', URLROOT.'/img');

    /**
     * Define a character chain to salt the passwords
     * 25 character long
     */
    define('SALT', 'QknflYb3oxSQInHy7moxTXSF0');

    // FOOTER
    define('FOOTER', APPROOT . '/views/inc/footer.php');

    // HEADER
    define('HEADER', APPROOT . '/views/inc/header.php');

    // SIDEBAR (ORDER)
    define('SIDEBAR', APPROOT.'/views/inc/sidebar.php');
    

    // Define the cookies expire days
    define('COOKIESEXPIRE', 2);
    



