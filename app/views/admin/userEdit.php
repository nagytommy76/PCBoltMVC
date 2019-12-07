<?php require HEADER; ?>    
        <div class="col-md-6 mx-auto pt-3 pb-5">
        <?php //flash('modosit_siker'); ?>
            <div class="card card-head bg-info pl-3 pt-3">                                               
                <h1 class="h1 pt-3 pb-3"><?php echo $data['veznev'].' '.$data['kernev']; ?> felhasználó adatainak szerkesztése</h1>
                
            </div>
            <div class="card card-body bg-secondary">
            <form method="POST" action="<?php echo URLROOT;?>/admins/adminEditUser/<?php echo $data['email'];?>">
                <div class="row">
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="username">Felhasználónév: </label>
                            <input class="form-control form-control-lg" name="username" type="text"       value="<?php echo $data['username']; ?>" disabled >          
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="email">Email cím:</label>
                            <input class="form-control form-control-lg" name="email" type="text" value="<?php echo $data['email']; ?>" disabled>
                        </div>
                    </div>                        
                </div> <!-- 1. ROW vége itt van -->
                <div class="row">
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="veznev">Vezetéknév: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="veznev" type="text" value="<?php echo $data['veznev']; ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="kernev">Keresztnév: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="kernev" type="text" value="<?php echo $data['kernev']; ?>" required>
                        </div>
                    </div>
                </div> <!-- 2. ROW vége itt van -->
                <div class="row">
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="irszam">Irányítószám: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="irszam" type="number" value="<?php echo $data['irszam']; ?>" min="1000" max="9999" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="varos">Város: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="varos" type="text" value="<?php echo $data['varos']; ?>" required>
                        </div>
                    </div>
                </div> <!-- 3. ROW vége itt van -->
                <div class="row">
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="utca">Utca: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="utca" type="text" value="<?php echo $data['utca']; ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="hazszam">Házszám: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="hazszam" type="number" value="<?php echo $data['hazszam']; ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="emeletajto">Emelet / Ajtó:</label>
                            <input class="form-control form-control-lg" name="emeletajto" type="text" value="<?php echo $data['emeletajto']; ?>">
                        </div>
                    </div>
                </div> <!-- 4. ROW vége itt van -->
                <div class="row">
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="telszam">Telefonszám: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="telszam" type="number" value="<?php echo $data['telszam']; ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="jogosultsag">Jogosultság: </label>
                            <select class="form-control form-control-lg" name="jogosultsag" type="text" >   
                            <?php if(isAdmin($_SESSION["jog"])) : ?>
                                <!-- Ha admin a jogosultság : -->                                
                                <option <?php if(isset($data['jogosultsag']) && $data['jogosultsag'] == 'felhasználó') echo 'selected';  ?> value="felhasználó">Felhasználó</option>
                                <option <?php if(isset($data['jogosultsag']) && $data['jogosultsag'] == 'eladó') echo 'selected';  ?> value="eladó">Eladó</option>
                                <option <?php if(isset($data['jogosultsag']) && $data['jogosultsag'] == 'admin') echo 'selected';  ?> value="admin">Admin</option>
                            <?php else : ?>
                                <option value=<?php $data["jogosultsag"] ?>><?php echo $data["jogosultsag"] ?></option>
                            <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="szulido">Születési idő: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="szulido" type="date" value="<?php echo $data['szulido']; ?>" required>
                        </div>
                    </div>
                </div> <!-- 5. ROW vége itt van -->                

                <input type="submit" name="modosit2" class="btn btn-lg btn-success"  value="Módosítás!" <?php if(isset($data['disabled1'])) echo $data['disabled1']; ?>> 
            </form>                      
            </div> <!-- card card-body bg-secondary VÉGE -->
            <?php flash('adatbevitel_siker'); ?>
        </div>
        
    </div>
    

<?php require FOOTER; ?>