<?php
    class Users extends Controller{
        public function __construct()
        {
            // Load model. Be kell tölteni mindig a model-t
            $this->userModel = $this->model('User');
        }
        // Belépés
        public function login(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data = [
                    'main_title' => 'Belépés',                    
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'pass_err' => ''                   
                ];   
                // Megnézem, mhogy van-e email cím regisztrálva                            
                if (!$this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "Az email cím még nincs regisztrálva!";
                }

                if (empty($data['email_err'])) {
                    if (!$this->userModel->kiVanEToltve($data['email'])) {
                        // Ha nincs kitöltve a userinfo mező akkor nem kérem le a jogosultságot
                        $loggedInUser = $this->userModel->loginTwo($data['email'],$data['password']);                        
                        if ($loggedInUser) {
                            $this->createUserSession($loggedInUser);
                            flash('kitolteni','Kérem töltse ki az alábbi adatokat a vásárláshoz!');
                            redirect('users/data');
                        }                        
                    }else{
                        // Ha ki van töltve akkor le kérhetem a jogosutlságot is!
                        $loggedInUser = $this->userModel->login($data['email'],$data['password']);

                        if ($loggedInUser) {
                            $this->createUserSession($loggedInUser); 
                                                       
                        }
                    }
                                                        
                }else{
                    $data['pass_err'] = "A jelszó helytelen!";
                    $this->view('users/login',$data);
                }
                
                //$this->view('users/login',$data);
                
            }else{
                $data = [
                    'main_title' => 'Belépés',                    
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'pass_err' => ''                                  
                ];
                $this->view('users/login',$data);
            }
        }

        // Regisztráció
        public function register(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'main_title' => 'Regisztráció',
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['password2']),
                    'passwords' => '',
                    'email_err' => ''
                ];
                if ($data['password'] != $data['confirm_password']) {
                    $data['passwords'] = "A két jelszó nem egyezik meg!";
                }
                if (!empty($data['email'])) {
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = "Az email cím már regisztrálva van!";
                    }
                }                
                
                if (empty($data['passwords']) && empty($data['email_err'])) {
                    // Hash password, visszafele password-verify
                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
                    // Register user, Call model function                
                if($this->userModel->register($data)){
                    // Ha regisztrálás sikeres
                    flash('register_success','A regisztráció sikeres volt! És be tud jelentkezni!');
                    redirect('users/login');
                }else{
                    die('A regisztráció sikerteleln');
                }
                }              
                $this->view('users/register',$data);
                
            }else{
                $data = [
                    'main_title' => 'Regisztráció',
                    'username' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'passwords' => '',
                    'email_err' => ''
                ];
                $this->view('users/register',$data);
            }           
            
        }
        
        public function createUserSession($user){
            $_SESSION['email'] = $user->email;
            $_SESSION['username'] = $user->username;
            if ($user->jogosultsag == '') {
                $_SESSION['jog'] = 'felhasználó';
            }else{
                $_SESSION['jog'] = $user->jogosultsag; 
            }
                       
            
            redirect('pages/index');
        }
            // Adatok beírása
        public function data(){
            // A felhasználó további adatai
            //$data = [];                        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'main_title' => 'Adatok bevitele',
                    'email' => $_SESSION['email'],
                    'veznev' => trim($_POST['veznev']),
                    'kernev' => trim($_POST['kernev']),
                    'irszam' => trim($_POST['irszam']),
                    'varos' => trim($_POST['varos']),
                    'utca' => trim($_POST['utca']),
                    'hazszam' => trim($_POST['hazszam']),
                    'emeletajto' => (trim($_POST['emeletajto']) == '') ? 'Nincs' :trim  ($_POST['emeletajto']),
                    'telszam' => trim($_POST['telszam']) ,
                    'szulido' => trim($_POST['szulido']),
                    'jogosultsag' => $_SESSION['jog']              
                ];
                if (isset($_POST['bevitel'])) {   
                    if($this->userModel->data($data)){
                        // Ha regisztrálás sikeres
                        flash('adatbevitel_siker','Az adatok bevitele sikeres volt!');
                        redirect('users/data');
                    }else{
                        flash('adatbevitel_siker','Az adatok bevitele sikertelen volt! :(');
                        redirect('users/data');
                    }
                } // Ha a módosítás gombot nyomod meg ez fut le
                elseif(isset($_POST['modosit'])){
                    if ($this->userModel->update($data)) {
                        flash('adatbevitel_siker','A módosítás sikeres volt!');
                        redirect('users/data');
                    }else{
                        flash('adatbevitel_siker','Az adatok módosítása sikertelen volt! :(');
                        redirect('users/data');
                    }
                }               
            }else{ 
                if ($this->userModel->kiVanEToltve($_SESSION['email'])) {
                    $adatok = $this->userModel->adatok();                                 
                $data = [
                    'main_title' => 'Adatok bevitele',
                    /*'email' => '',*/
                    'veznev' => $adatok->vezeteknev,
                    'kernev' => $adatok->keresztnev,
                    'irszam' => $adatok->irszam,
                    'varos' => $adatok->varos,
                    'utca' => $adatok->utca,
                    'hazszam' => $adatok->hazszam,
                    'emeletajto' => $adatok->emeletajto,
                    'telszam' => $adatok->telefon,
                    'szulido' => $adatok->szulido,
                    'disabled' => 'disabled',
                    'disabled1' => ''                    
                ];    
                $this->view('users/data',$data);    
                }else{
                    
                    // Ha az adatok ki vannak töltve ne lehessen az adatokat elküldeni megint
                    $data = [
                    'main_title' => 'Adatok bevitele',
                    'email' => '',
                    'veznev' => '',
                    'kernev' => '',
                    'irszam' => '',
                    'varos' => '',
                    'utca' => '',
                    'hazszam' => '',
                    'emeletajto' => '',
                    'telszam' => '',
                    'szulido' => '',
                    'disabled' => '',
                    'disabled1' => 'disabled'
                    ];
                    $this->view('users/data',$data);
                }                
                $this->view('users/data',$data);
            
            }
        }

        public function update(){
            if ($this->userModel->update($_SESSION['email'])) {
                flash('modositas_siker','Az adatok módosítása sikeres volt!');
                redirect('users/data');
            }else{
                die('A módosítás közben valami rosszul sült el...');
            }
            
        }

        public function logout(){
            unset($_SESSION['email']);
            unset($_SESSION['username']);
            unset($_SESSION['jog']);
            session_destroy();
            redirect('pages/index');
        }

        
    }

