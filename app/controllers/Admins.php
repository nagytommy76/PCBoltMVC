<?php

    class Admins extends Controller{
        public function __construct()
        {
            $this->adminModel = $this->model('Admin');
            $this->cpuModel = $this->model('Cpu');
            $this->userModel = $this->model('User');
            $this->mbModel = $this->model('Mb');
            $this->ramModel = $this->model('Ram');
        }
        // CPU műveletek-----------------------------------------------------------------------------
        // Proci bevitlel:
        public function cpu_input($cikksz = ''){ 
            if (bothAdminSeller($_SESSION["jog"])) {                                
                $result = $this->adminModel->foglalatok();
                $data = [
                    'main_title' => 'Processzor bevitele',
                    'foglalatok' => $result,                        
                    'cikkszam' => '',  
                    'cpuar' => '',              
                    'foglalat' => '',
                    'tipus' => '',
                    'gpu' => '',
                    'gpu_orajel' => '',
                    'magok_szama' => '',
                    'szalak_szama' => '',
                    'orajel' => '',
                    'turbo_orajel' => '',
                    'l3cache' => '',
                    'l2cache' => '',
                    'huto' => '',
                    'fogyasztas' => '',
                    'kepurl' => ''
                ];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);      
                    if (isset($_POST['input'])) {                       
                        $data = [
                             'main_title' => 'Processzor bevitele',
                             'foglalatok' => $result,
                             'cikkszam' => trim($_POST['cikkszamID']), 
                             'cpuar' => trim($_POST['cpuar']),               
                             'foglalat' => trim($_POST['foglalat']),
                             'tipus' => trim($_POST['tipus']),
                             'gpu' => trim($_POST['gpu']),
                             'gpu_orajel' => trim($_POST['gpu_orajel']),
                             'magok_szama' => trim($_POST['magok_szama']),
                             'szalak_szama' => trim($_POST['szalak_szama']),
                             'orajel' => trim($_POST['orajel']),
                             'turbo_orajel' => trim($_POST['turbo_orajel']),
                             'l3cache' => trim($_POST['l3cache']),
                             'l2cache' => trim($_POST['l2cache']),
                             'huto' => trim($_POST['huto']),
                             'fogyasztas' => trim($_POST['fogyasztas']),
                             'kepurl' => trim($_POST['kepurl'])
                        ];
                        if ($this->adminModel->cpuBevitel($data) && $this->adminModel->cpuArBevitel($data['cikkszam'],$data['cpuar'])) {
                            flash('input_success','A bevitel sikeres volt!');
                            redirect('admins/cpu_input');
                        }else{
                            die('Hoppá ez nem sikerült :(');
                        }
                        //$this->view('admin/cpu_input',$data);
                    }else{ // ha egy termék módosítása gombja lett megnyomva
                        if (isset($_POST['cikkszam'])) {                           
                            $cikkszam = $_POST['cikkszam'];
                            $product = $this->cpuModel->getCpuByID($cikkszam);                          
                            $data = [
                                'main_title' => $product->tipus.' módosítása',
                                'foglalatok' => $result,                        
                                'cikkszam' => $cikkszam,
                                'cpuar' => $product->ar,                
                                'foglalat' => $product->foglalat,
                                'tipus' => $product->tipus,
                                'gpu' => $product->gpu,
                                'gpu_orajel' => $product->gpu_orajel,
                                'magok_szama' => $product->magok_szama,
                                'szalak_szama' => $product->szalak_szama,
                                'orajel' => $product->orajel,
                                'turbo_orajel' => $product->turbo_orajel,
                                'l3cache' => $product->l3cache,
                                'l2cache' => $product->l2cache,
                                'huto' => $product->huto,
                                'fogyasztas' => $product->fogyasztas,
                                'kepurl' => $product->kepurl
                            ];
                        $this->view('admin/cpu_input',$data);
                        }
                        if (isset($_POST['modify'])) {
                                                      
                            $inputs = [                                      
                                'cikkszam' => trim($_POST['cikkszamID']), 
                                'cpuar' => trim($_POST['cpuar']),               
                                'foglalat' => trim($_POST['foglalat']),
                                'tipus' => trim($_POST['tipus']),
                                'gpu' => trim($_POST['gpu']),
                                'gpu_orajel' => trim($_POST['gpu_orajel']),
                                'magok_szama' => trim($_POST['magok_szama']),
                                'szalak_szama' => trim($_POST['szalak_szama']),
                                'orajel' => trim($_POST['orajel']),
                                'turbo_orajel' => trim($_POST['turbo_orajel']),
                                'l3cache' => trim($_POST['l3cache']),
                                'l2cache' => trim($_POST['l2cache']),
                                'huto' => trim($_POST['huto']),
                                'fogyasztas' => trim($_POST['fogyasztas']),
                                'kepurl' => trim($_POST['kepurl'])
                            ];                              
                            if ($this->adminModel->cpuModositas($inputs) && $this->adminModel->cpuModAr($inputs['cikkszam'],$inputs['cpuar'])) {
                                flash('modify_success','Sikeres volt a(z) '.$inputs['tipus'].' processzor módosítása!' );                                
                                redirect('admins/cpu_input');                                
                            }else{
                                //die('valami nem sikerült a cpu módosítás közben');
                                flash('modify_success','Sikertelen volt a(z) '.$inputs['tipus'].' processzor módosítása!','alert alert-danger');       
                                redirect('admins/cpu_input'); 
                            }
                        }
                    }
                }
                else{                    
                    $this->view('admin/cpu_input',$data);
                }
            }else{
               redirect("pages/index");
            }
        }

        // Processzor törlése
        public function deleteCpu($cikkszam){
            if ($_SESSION['jog'] == 'admin') {
                if (isset($_POST['deleteBTN']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($this->adminModel->deleteCPU($cikkszam)) {
                        flash('delete_success','A ('.$cikkszam.') cikkszám szerint törölve lett a termék!');
                        header('Location: '.$_SERVER['HTTP_REFERER']);
                    }
                }
            }else{
                redirect("pages/index");
            }
        }

        // Felhasználók kezelése------------------------------------------------------------------------
        public function userHandler(){
            $data = [
                'main_title' => 'Felhasználók kezelése'
            ];
            if (bothAdminSeller($_SESSION["jog"])) {
                $userInfo = $this->userModel->showUserInfo();
                $users = $this->userModel->showUsers();
                $checkedUsers = [];
                foreach($users as $user){
                    if ($this->userModel->checkUserData($user->email) == null) {
                       array_push($checkedUsers,$user);
                    }
                }
                $data = [
                    'main_title' => 'Felhasználók kezelése',
                    'userinfo' => $userInfo,
                    'noDataUsers' => $checkedUsers
                ];
                $this->view('admin/userHandling', $data); 
            }else{
                redirect("pages/index");
            }      
        }        

        // Felhasználó módosítása
        public function editUser($email,$username){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);            
                if (bothAdminSeller($_SESSION["jog"])) {
                    $userinfo = $this->userModel->getDataByEmail($email);
                    $data = [
                        'main_title' => 'Felhasználó módosítása',
                        'email' => $email,
                        'username' => $username,
                        'disabled' => 'disabled',
                        'jogosultsag' => $userinfo->jogosultsag,
                        'veznev' => $userinfo->vezeteknev,
                        'kernev' => $userinfo->keresztnev,
                        'irszam' => $userinfo->irszam,
                        'varos' => $userinfo->varos,
                        'utca' => $userinfo->utca,
                        'hazszam' => $userinfo->hazszam,
                        'emeletajto' => $userinfo->emeletajto,
                        'telszam' => $userinfo->telefon,
                        'szulido' => $userinfo->szulido
                    ];
                    $this->view('admin/userEdit',$data);                 
                }else{
                    redirect("pages/index");
                }
            
            }
        }
        // ADMIN OLDALI FELHASZNÁLÓI ADATOK MÓDOSÍTÁSA!!!
        public function adminEditUser($email){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if (isAdmin($_SESSION["jog"])) {                      
                    $finalData = [
                        'email' => $email,                    
                        'veznev' => trim($_POST['veznev']),
                        'kernev' => trim($_POST['kernev']),
                        'irszam' => trim($_POST['irszam']),
                        'varos' => trim($_POST['varos']),
                        'utca' => trim($_POST['utca']),
                        'hazszam' => trim($_POST['hazszam']),
                        'emeletajto' => trim($_POST['emeletajto']),
                        'telszam' => trim($_POST['telszam']) ,
                        'szulido' => trim($_POST['szulido']),
                        'jogosultsag' => trim($_POST['jogosultsag'])
                    ];                   
                        if ($this->userModel->adminUpdate($finalData)) {
                            flash('modosit_siker','Az adatok módosítása sikeres volt!');
                            redirect('admins/userHandler');
                        }else{
                            flash('modosit_siker','Az adatok módosítása sikertelen volt sajnos!');
                            redirect('admins/userHandler');
                        }
                }
            }
        }

        // Felhasználó törlése!
        public function deleteUser($email,$username,$telefon=''){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if (isAdmin($_SESSION["jog"])) {
                    if ($this->userModel->deleteUserByAdmin($email,$telefon) && $this->userModel->deleteUserByAdmin0($email)) {           
                        flash('deleted','A '.$username.' felhasználó törlése sikeres volt!','alert alert-danger');
                        redirect('admins/userHandler');
                    }else{
                        flash('deleted','A '.$username.' felhasználó törlése sikertelen volt sajnos!','alert alert-danger');
                        redirect('admins/userHandler');
                    }
                }
            }
        } 
        // ALAPLAP MŰVELETEK ADMIN-------------------------------------------------------------------
        public function mb_input($cikkszam = ''){
            $finalCikkszam = $cikkszam;
            if (bothAdminSeller($_SESSION["jog"])) {
                $ramtipus = $this->adminModel->RAMtipus();
                $foglalatok = $this->adminModel->foglalatok();
                $mbMeret = $this->mbModel->MBFormat();
                $warranity = $this->adminModel->getWarranity();
                $manufact = $this->mbModel->mbMan();
                $data = [
                    'main_title' => 'Alaplap bevitele (Admin)',
                    'foglalatok' => $foglalatok,
                    'RAM' => $ramtipus,
                    'formats' => $mbMeret,
                    'price' => 0,
                    'warr' => $warranity,
                    'mbcikkszam' => $cikkszam,
                    'mbtipus' => '',
                    'garancia' => '',
                    'chipset' => '',
                    'man' => $manufact,
                    'gyarto' => '',
                    'cpufoglalat' => '',
                    'ramfoglalat' => '',
                    'memfoglalat' => '',
                    'meret' => '',
                    'inthang' => '',
                    'intlan' => '',
                    'm2' => 0,
                    'sata3' => 0,
                    'usb30' => 0,
                    'usb31' => 0,
                    'maxMemMHz' => '',
                    'maxRamMeret' => '',
                    'pciex16' => 0,
                    'picUrl' => '',
                    'gyartoUrl' => '',
                    'disabledIN' => '',
                    'disabled' => 'disabled',
                    'disabled1' => ''
                ];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    if (isset($_POST['input'])) {
                        $data = [
                            'main_title' => 'Alaplap bevitele (Admin)',
                            'foglalatok' => $foglalatok,
                            'RAM' => $ramtipus,
                            'formats' => $mbMeret,
                            'price' => trim($_POST['price']),
                            'garancia' => trim($_POST['garancia']),
                            'mbcikkszam' => trim($_POST['mbcikkszam']),
                            'ramtipus' => trim($_POST['ramtipus']),
                            'mbtipus' => trim($_POST['mbtipus']),
                            'chipset' => trim($_POST['chipset']),
                            'man' => $manufact,
                            'gyarto' => trim($_POST['gyarto']),
                            'cpufoglalat' => trim($_POST['cpufoglalat']),
                            'ramfoglalat' => trim($_POST['ramtipus']),
                            'memfoglalat' => trim($_POST['memfoglalat']),
                            'meret' => trim($_POST['meret']),
                            'inthang' => trim($_POST['inthang']),
                            'intlan' => trim($_POST['intlan']),
                            'm2' => trim($_POST['m2']),
                            'sata3' => trim($_POST['sata3']),
                            'usb30' => trim($_POST['usb30']),
                            'usb31' => trim($_POST['usb31']),
                            'maxMemMHz' => trim($_POST['maxMemMHz']),
                            'maxRamMeret' => trim($_POST['maxRamMeret']),
                            'pciex16' => trim($_POST['pciex16']),
                            'picUrl' => trim($_POST['picUrl']),
                            'gyartoUrl' => trim($_POST['gyartoUrl']),
                            'disabledIN' => '',
                            'disabled' => 'disabled',
                            'disabled1' => ''
                        ];
                        if ($this->adminModel->MBInput($data) && $this->adminModel->MBPriceInput($data['mbcikkszam'], $data['price']) && $this->adminModel->MBMPageURL($data['mbcikkszam'],$data['gyartoUrl'])) {
                            flash('mb_input_success','A '.$data['mbtipus'].' bevitele sikeres volt!');
                            redirect('admins/mb_input');
                        }else{
                            flash('mb_input_success','A '.$data['mbtipus'].' bevitele sikeres volt!','alert alert-danger');
                            redirect('admins/mb_input');
                        }
                    }else{      
                        if(isset($_POST['editMB'])){                  
                            $result = $this->mbModel->getItemByCikkszam($cikkszam);
                            $data = [
                                'main_title' => $result->MBName.' Alaplap Módosítása (Admin)',
                                'price' => $result->price,
                                'RAM' => $ramtipus,
                                'foglalatok' => $foglalatok,
                                'warr' => $warranity,
                                'garancia' => $result->garancia,
                                'formats' => $mbMeret,
                                'mbcikkszam' => $finalCikkszam,
                                'mbtipus' => $result->MBName,
                                'intlan' => $result->intLAN,
                                'inthang' => $result->intHang,
                                'chipset' => $result->chipset,
                                'man' => $manufact,
                                'gyarto' => $result->gyarto,
                                'cpufoglalat' => $result->foglalat,
                                'ramtipus' => $result->ramType,
                                'meret' => $result->Meret,
                                'm2' => $result->m2,
                                'sata3' => $result->sata3,
                                'usb30' => $result->usb30,
                                'usb31' => $result->usb31,
                                'maxMemMHz' => $result->maxMemMHz,
                                'maxRamMeret' => $result->memMeret,
                                'memfoglalat' => $result->memfoglalat,
                                'pciex16' => $result->pcie16,
                                'picUrl' => $result->picUrl,
                                'gyartoUrl' => $result->GyartoURL,
                                'disabledIN' => 'disabled',
                                'disabled' => '',
                                'disabled1' => 'disabled'
                            ];
                            $this->view('admin/mb_input',$data);
                        }                             
                        elseif (isset($_POST['modify'])) {  
                            $data = [
                                'price' => trim($_POST['price']),
                                'mbtipus' => trim($_POST['mbtipus']),
                                'intlan' => trim($_POST['intlan']),
                                'inthang' => trim($_POST['inthang']),
                                'chipset' => trim($_POST['chipset']),
                                'gyarto' => trim($_POST['gyarto']),
                                'cpufoglalat' => trim($_POST['cpufoglalat']),
                                'ramfoglalat' => trim($_POST['ramtipus']),
                                'memfoglalat' => trim($_POST['memfoglalat']),
                                'meret' => trim($_POST['meret']),
                                'm2' => trim($_POST['m2']),
                                'sata3' => trim($_POST['sata3']),
                                'usb30' => trim($_POST['usb30']),
                                'usb31' => trim($_POST['usb31']),
                                'maxMemMHz' => trim($_POST['maxMemMHz']),
                                'maxRamMeret' => trim($_POST['maxRamMeret']),
                                'pciex16' => trim($_POST['pciex16']),
                                'picUrl' => trim($_POST['picUrl']),
                                'gyartoUrl' => trim($_POST['gyartoUrl']),
                                'garancia' => trim($_POST['garancia']),
                                'disabledIN' => 'disabled',
                                'disabled' => '',
                                'disabled1' => 'disabled'
                            ];
                            
                            if ($this->mbModel->modifyMB($data,$finalCikkszam) &&   $this->mbModel->PriceUpdate($finalCikkszam,$data['price']) &&  $this->mbModel->MBManURL($finalCikkszam, $data['gyartoUrl'])) {
                                flash('MBModifySuccess','A(z) '.$data['mbtipus'].' alaplap módosítása sikeres volt!');
                                redirect('admins/mb_input');
                            }else {
                                flash('MBModifySuccess','A(z) '.$data['mbtipus'].' alaplap módosítása sikertelen volt!','alert alert-danger');
                                redirect('admins/mb_input');
                            }
                        } 
                    }
                }else{
                    $this->view('admin/mb_input',$data);
                }
            
        }else{
            redirect("pages/index");
        }
    }

    // RAM INPUT 
    public function ram_input($cikk =''){
        if (bothAdminSeller($_SESSION["jog"])) {
            $warranity = $this->adminModel->getWarranity();
            $data = [
                'main_title' => 'RAM-ok bevitele',
                'cikkszam' => $cikk,
                'ram_cikkszam' => '',
                'socets' => $this->ramModel->ramSocets(),
                'warr' => $warranity,
                'manufacts' => $this->ramModel->manufacturers(),
                'manufacturer' => '',
                'warranity' => '',
                'price' => '',
                'type' => '',
                'man_type' => '',
                'capacity' => '',
                'timing' => '',
                'voltage' => '',
                'clock' => '',
                'kit' => '',
                'xmp' => 0,
                'man_url' => '',
                'picUrl' => '',
                'disabledIn' => '',
                'disabledMod' => 'disabled'
            ];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if (isset($_POST['ram_input'])) {
                    $data = [
                        'main_title' => 'RAM-ok bevitele',
                        'cikkszam' => $cikk,
                        'ram_cikkszam' => trim($_POST["ram_cikkszam"]),
                        'socets' => $this->ramModel->ramSocets(),
                        'selected_socket' => trim($_POST["foglalat"]),
                        'warr' => $warranity,
                        'warranity' => trim($_POST["warranity"]),
                        'price' => trim($_POST["price"]),
                        'manufacts' => $this->ramModel->manufacturers(),
                        'manufacturer' =>trim($_POST["manufacturer"]),
                        'type' => trim($_POST["type"]),
                        'man_type' => trim($_POST["man_type"]),
                        'capacity' => trim($_POST["capacity"]),
                        'timing' => trim($_POST["timing"]),
                        'voltage' => trim($_POST["voltage"]),
                        'clock' => trim($_POST["clock"]),
                        'kit' => trim($_POST["kit"]),
                        'xmp' => trim($_POST["xmp"]),
                        'man_url' => trim($_POST["man_url"]),
                        'picUrl' => trim($_POST["picUrl"]),
                        'disabledIn' => '',
                        'disabledMod' => 'disabled'
                    ];
                    if ($this->ramModel->ramProductInput($data) && $this->ramModel->manUrl($data["ram_cikkszam"],$data["man_url"]) && $this->ramModel->picUrl($data["ram_cikkszam"],$data["picUrl"]) && $this->ramModel->priceInput($data["ram_cikkszam"],$data["price"])) {
                        flash("ramInputSuccess","A (".$data["type"].") típusú RAM bevitele sikeres volt");
                        redirect("admins/ram_input");
                    }else{
                        flash("ramInputFail","A (".$data["type"].") típusú RAM bevitele sikertelen volt", "alert alert-danger");
                        redirect("admins/ram_input");
                    }
                }elseif(isset($_POST["editRAM"])){
                    $item = $this->ramModel->ramByCikkszam($cikk);
                    $data = [
                        'main_title' => $cikk.' Módosítása',
                        'cikkszam' => $cikk,
                        'ram_cikkszam' => $item->cikkszam,
                        'socets' => $this->ramModel->ramSocets(),
                        'selected_socket' => $item->tipus,
                        'warr' => $warranity,
                        'warranity' => $item->WMonth,
                        'price' => $item->ramPrice,
                        'manufacts' => $this->ramModel->manufacturers(),
                        'manufacturer' => $item->manufacturer,
                        'type' => $item->type,
                        'man_type' => $item->typeCode,
                        'capacity' => $item->capacity,
                        'timing' => $item->timing,
                        'voltage' => $item->voltage,
                        'clock' => $item->clock,
                        'kit' => $item->kit,
                        'xmp' => $item->is_xmp,
                        'man_url' => $item->Url,
                        'picUrl' => $item->picUrl,
                        'disabledIn' => 'disabled',
                        'disabledMod' => ''
                    ];
                }
                elseif (isset($_POST["ram_modify"])) {
                    $data = [
                        'cikkszam' => $cikk,
                        'selected_socket' => trim($_POST["foglalat"]),
                        'warranity' => trim($_POST["warranity"]),
                        'price' => trim($_POST["price"]),
                        'manufacturer' =>trim($_POST["manufacturer"]),
                        'type' => trim($_POST["type"]),
                        'man_type' => trim($_POST["man_type"]),
                        'capacity' => trim($_POST["capacity"]),
                        'timing' => trim($_POST["timing"]),
                        'voltage' => trim($_POST["voltage"]),
                        'clock' => trim($_POST["clock"]),
                        'kit' => trim($_POST["kit"]),
                        'xmp' => trim($_POST["xmp"]),
                        'man_url' => trim($_POST["man_url"]),
                        'picUrl' => trim($_POST["picUrl"]),
                    ];
                    if ($this->ramModel->ramProductModify($data) &&$this->ramModel->picUrlModify($data["cikkszam"], $data["picUrl"]) && $this->ramModel->manUrlModify($data["cikkszam"],$data["man_url"]) && $this->ramModel->ramPriceModify($data["cikkszam"], $data["price"]))
                {
                    flash('ramModifySuccess','A ('.$data["type"].' '.$data["typeCode"].') Módosítása sikeres volt!');
                    redirect("admins/ram_input");
                }else{
                    flash("ramModifyFail", 'A ('.$data["type"].' '.$data["typeCode"].') Módosítása sikertelen volt!', 'alert alert-danger');
                    redirect("admins/ram_input");
                }
                } 
            
            }
            $this->view('admin/ram_input',$data);
        }else{
            redirect('pages/index');
        }
        
    }
}