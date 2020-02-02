<?php require HEADER; ?>    
        <div class="col-md-6 mx-auto pt-3 pb-5">       
            <div class="card card-head bg-info pl-3 pt-3">                                               <?php flash('kitolteni'); ?>
                <h1 class="h1">Saját adatok bevitele</h1>
                <p>Megadhatja a szállításhoz szükséges adatokat</p>
            </div>
            <div class="card card-body bg-secondary">
                <form action="<?php echo URLROOT;?>/users/data" method="POST">
                <div class="row">
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="username">Felhasználónév: </label>
                            <input class="form-control form-control-lg" name="username" type="text"       value="<?php echo $_SESSION['username']; ?>" 
                            disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="email">Email cím:</label>
                            <input class="form-control form-control-lg" name="email" type="text" value="<?php echo $_SESSION['email'];?>" disabled>
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
                            <input type="text" value="<?php echo $_SESSION['jog']; ?>" class="form-control form-control-lg" name="jogosultsag" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row p-3 text-white">
                            <label for="szulido">Születési idő: <sup>*</sup></label>
                            <input class="form-control form-control-lg" name="szulido" type="date" value="<?php echo $data['szulido']; ?>" required>
                        </div>
                    </div>
                </div> <!-- 5. ROW vége itt van -->
                <!-- Bevitel gomb -->
                
                        
                <input class="btn btn-lg btn-success" name="bevitel" type="submit" value="Bevitel!" <?php if(isset($data['disabled'])) echo $data['disabled'];?>> 
           
                <input type="submit" name="modosit" class="btn btn-lg btn-warning"  value="Módosítás!" <?php if(isset($data['disabled1'])) echo $data['disabled1']; ?>>   
            </form>
                                                
            </div>
            <?php flash('adatbevitel_siker'); ?>
        </div>
        
    </div>
    

<?php require FOOTER; ?>