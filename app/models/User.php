<?php
    class User{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }
        // A felhasználó bevitele
        public function register($email,$hashedPass,$username){
            $this->db->query('INSERT INTO users (email,pass,username) VALUES (:email,:pass,:username)');
            $this->db->bind(':email',$email);
            $this->db->bind(':pass',$hashedPass);
            $this->db->bind(':username',$username);

            if ($this->db->execute()) {
                return true;
            }else{
                return false;
            }
        }

        // Login user ha van jogosultság
        public function login($email,$pass){
            $this->db->query('SELECT email,pass,username,jogosultsag FROM users INNER JOIN userinfo ON users.email = userinfo.email1 WHERE email = :email');
            $this->db->bind(':email',$email);
            $row = $this->db->single();
            $hashed_pass = $row->pass;

            if (password_verify($pass,$hashed_pass)) {
                return $row;
            }else{
                return false;
            }
        }
        // Ha nincs még jogosultág kitötlve

        public function loginTwo($email,$pass){
            $this->db->query('SELECT email,pass,username FROM users WHERE email = :email');
            $this->db->bind(':email',$email);
            $row = $this->db->single();
            $hashed_pass = $row->pass;

            if (password_verify($pass,$hashed_pass)) {
                return $row;
            }else{
                return false;
            }
        }

        // Beviszem a felhasználó adatait (Saját adatok)
        public function data($data = []){
            $this->db->query('INSERT INTO userinfo (email1,emeletajto,hazszam,irszam,jogosultsag,keresztnev,vezeteknev,szulido,telefon,utca,varos) VALUES (:email,:emelet,:hazszam,:irszam,:jog,:kernev,:veznev,:szulido,:telefon,:utca,:varos)');
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':emelet',$data['emeletajto']);
            $this->db->bind(':hazszam',$data['hazszam']);
            $this->db->bind(':irszam',$data['irszam']);
            $this->db->bind(':jog',$data['jogosultsag']);
            $this->db->bind(':kernev',$data['kernev']);
            $this->db->bind(':veznev',$data['veznev']);
            $this->db->bind(':szulido',$data['szulido']);
            $this->db->bind(':telefon',$data['telszam']);
            $this->db->bind(':utca',$data['utca']);
            $this->db->bind(':varos',$data['varos']);

            if ($this->db->execute()) {
                return true;
            }else{
                return false;
            }
        }

        // Lekérdezem a felhasználó adatait, hogy meg tudjam őket jeleníteni az adatok mezőben
        public function adatok(){
            $this->db->query('SELECT * FROM userinfo WHERE email1 = :email');
            $this->db->bind(':email',$_SESSION['email']);
            return $this->db->single();              
        }

        // Az adatok módosítása:
        public function update($data){
            $this->db->query('UPDATE userinfo SET vezeteknev = :veznev, keresztnev = :kernev, telefon = :telefon, szulido = :szulido, varos = :varos, irszam = :irszam, utca = :utca, emeletajto = :emeletajto, hazszam = :hazszam, jogosultsag = :jogosultsag WHERE email1 = :email');
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':emeletajto',$data['emeletajto']);
            $this->db->bind(':hazszam',$data['hazszam']);
            $this->db->bind(':irszam',$data['irszam']);    
            $this->db->bind(':kernev',$data['kernev']);
            $this->db->bind(':veznev',$data['veznev']);
            $this->db->bind(':szulido',$data['szulido']);
            $this->db->bind(':telefon',$data['telszam']);
            $this->db->bind(':utca',$data['utca']);
            $this->db->bind(':varos',$data['varos']);
            $this->db->bind(':jogosultsag',$data['jogosultsag']);
            if ($this->db->execute()) {
                return true;
            }else{
                return false;
            }
        }

        // Megnézem, hogy ki van-e töltve az adat mező
        public function kiVanEToltve($email){
            $this->db->query('SELECT * FROM userinfo WHERE email1 = :email');
            if (isset($_SESSION['email'])) {
                $this->db->bind(':email',$_SESSION['email']);
            }else{
                $this->db->bind(':email',$email);
            }
            
            // Nem elég önmagában csak a rowCount, le kell futtatni előbb
            $row = $this->db->single();            
            if ($row == true) {
                return true;
            }else{
                return false;
            }
        }

        // létezik-e az email cím?
        public function findUserByEmail($email){
            $this->db->query('SELECT email FROM users WHERE email LIKE :email');
            $this->db->bind(':email',$email);

            return $this->db->single();
        }

        public function findUserByPassword($email, $pass = ''){
            $this->db->query('SELECT pass FROM users WHERE email LIKE :email');
            $this->db->bind(':email',$email);
            $row = $this->db->single();

            if ($row) {
                return password_verify($pass, $row->pass);
            }   
        }




        // ESETLEGES ADMIN FUKCIÓK!!! ------------------------------------------------------------------------------------------------
        // Táblában megjeleníteni:
        public function showUserInfo(){
            $this->db->query('SELECT email1, jogosultsag, username, telefon FROM userinfo INNER JOIN users ON userinfo.email1 = users.email');
            $result = $this->db->resultSet();

            return $result;
        }

        // Check if a user not filled his data
        public function checkUserData($email){
            $this->db->query("SELECT email1 FROM userinfo WHERE email1 LIKE :email");
            $this->db->bind(":email",$email);
            return $this->db->single();

        }

        public function showUsers(){
            $this->db->query("SELECT email, username FROM users");
            return $this->db->resultSet();
        }

        // Felhasználók adatai, az ADMIN módosításhoz!
        public function getDataByEmail($email){
            $this->db->query('SELECT email1, emeletajto, hazszam, irszam, jogosultsag, keresztnev, vezeteknev, szulido, telefon, utca, varos FROM userinfo WHERE email1 LIKE :email');
            $this->db->bind(':email',$email);
            $row = $this->db->single();

            return $row;
        }

        // AZ ADATOK MÓDOSÍTÁSA AZ ADMIN RÉSZÉRŐL-------
        public function adminUpdate($data){       
            $this->db->query('UPDATE userinfo SET jogosultsag = :jogosultsag, vezeteknev = :veznev, keresztnev = :kernev, telefon = :telefon, szulido = :szulido, varos = :varos, irszam = :irszam, utca = :utca, emeletajto = :emeletajto, hazszam = :hazszam WHERE email1 = :email');
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':emeletajto',$data['emeletajto']);
            $this->db->bind(':hazszam',$data['hazszam']);
            $this->db->bind(':irszam',$data['irszam']);    
            $this->db->bind(':kernev',$data['kernev']);
            $this->db->bind(':veznev',$data['veznev']);
            $this->db->bind(':szulido',$data['szulido']);
            $this->db->bind(':telefon',$data['telszam']);
            $this->db->bind(':utca',$data['utca']);
            $this->db->bind(':varos',$data['varos']);
            $this->db->bind(':jogosultsag',$data['jogosultsag']);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        // Törlés a users táblából
        public function deleteUserByAdmin0($email){            
            $this->db->query('DELETE FROM users WHERE email LIKE :email');
            $this->db->bind(':email',$email);
            return $this->db->execute();
        }

        public function deleteUserByAdmin($telefon){
            $this->db->query('DELETE FROM userinfo WHERE telefon = :telefon');            
            $this->db->bind(':telefon',$telefon);            
            
            return $this->db->execute();
        }

        public function deleteFromUserCartItems($email){
            $this->db->query('DELETE FROM user_cart_item WHERE user_email LIKE :email');
            $this->db->bind(':email',$email);
            return $this->db->execute();
        }

    }

