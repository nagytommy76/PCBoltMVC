<?php
    /**
     * PDO Database Class
     * Connect to database
     * Create prepared statements
     * Bind values
     * Return rows and results
     */
    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;
        // Prepare
        private $dbhandler;
        private $stmt;
        private $error;

        public function __construct()
        {
            // set DSN
            $dsn = 'mysql:host='.$this->host. ';dbname='.$this->dbname.';charset=utf8';
            $options = array(
                PDO::ATTR_PERSISTENT =>true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            // create PDO instance
            try {
                $this->dbhandler = new PDO($dsn, $this->user,$this->pass,$options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }
        // prepare statement with query
        // ez a függvény felkészíti, biztonságossá teszi a Query-t, eltávolítja.
        public function query($sql){
            $this->stmt = $this->dbhandler->prepare($sql);
        }
        // Bind values
        // Eldöntjük egy értékről, hogy mi a típusa
        public function bind($param,$value,$type = null){
            if (is_null($type)) {
                switch (true) {
                    case is_int($value): 
                        $type = PDO::PARAM_INT;                       
                        break;
                    case is_bool($value): 
                        $type = PDO::PARAM_BOOL;                       
                        break;
                    case is_null($value): 
                        $type = PDO::PARAM_NULL;                       
                        break;
                    default:
                        $type = PDO::PARAM_STR;                        
                }
            }
            $this->stmt->bindValue($param,$value,$type);
        }
        
        // Execute the prepared statement
        // Lefuttatja az előkészített lekérdezést
        public function execute(){
            return $this->stmt->execute();
        }
        // Get result set as array of objects        
        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        // Ha csak egy sort ad vissza
        // Get single record as object
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }
        // FETCH ASSOC
        public function singleAssoc(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        // Megszámolja a sorok számát
        public function rowCount(){
            return $this->stmt->rowCount();
        }
    }


