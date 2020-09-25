<?php require HEADER; ?>

<div class="container pt-3 pb-5">         
    <div class="card card-head" style="background-color: #7cb342;"> 
        <?php 
            flash('modify_success'); 
            flash('input_success'); 
            flash('input_fail');
        ?>    
        <h2 class="h2 p-3">Processzorok bevitele / módosítása:</h2>
    </div>
    <div class="card card-body" style="background-color: #cfd8dc;">
        <form action="<?php echo URLROOT; ?>/admins/cpu_input" method="POST">
        <!-- Cikkszám, ÁR foglalat -->
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="cikkszam"><h5>Cikkszám: <sup>*</sup></h5></label>
                    <input class="form-control" type="text" id="cikkszam" name="cikkszamID" placeholder="Termék cikkszáma (max 25 karakter)..." value="<?php echo $data['cikkszam']; ?>" maxlength="25" minlength="5" required >                    
                </div> <!-- .COL VÉGE -->   
                <div class="col">
                    <label for="cpuar"><h5>Ár: <sup>*</sup></h5></label>
                    <input class="form-control" type="number" id="ar" name="cpuar" placeholder="Termék ára..." value="<?php echo $data['cpuar']; ?>" max="9999999999" required >      
                </div> <!-- .COL VÉGE -->   
                <div class="col">
                    <label for="garancia"><h5>Garancia <sup>*</sup></h5></label>
                    <select class="form-control" type="text" name="garancia" value="<?php echo $data['garancia'] ?>" required>
                        <?php foreach($data['garancia'] as $warr) : ?>
                            <option value="<?php echo $warr->warr_id ?>" <?php if(isset($_POST['modifyBTN']) && $warr->warr_id == $data['warr_id']) echo 'selected' ?> ><?php echo $warr->warr_months ?> Hónap</option>
                        <?php endforeach;?>
                    </select>     
                </div> <!-- .COL VÉGE -->              
                <div class="col">
                    <label for="foglalat"><h5>Foglalat: <sup>*</sup></h5></label>
                    <select class="form-control" id="foglalat" name="foglalat" required>
                        <?php if(!isset($_POST['cikkszam'])) : ?> 
                        <?php foreach ($data['foglalatok'] as $fog) {
                            echo '<option value="'.$fog->foglalatID.'">'.$fog->foglalat.'</option>';
                        } ?>
                        <?php else : ?>
                            <?php echo '<option>'.$data['foglalat'].'</option>'; ?>
                        <?php endif; ?>
                    </select>
                </div> <!-- .COL VÉGE -->            
            </div> <!-- .ROW VÉGE --> 

            <!-- TÍPUS, GPU ----------------------------------------- -->
            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="tipus"><h5>Típus: <sup>*</sup></h5></label>
                    <input class="form-control" type="text" id="tipus" name="tipus" placeholder="Típus..." value="<?php echo $data['tipus']; ?>" required>
                </div> <!-- .COL VÉGE -->
                <div class="col">
                    <label for="gpu"><h5>GPU: <sup>*</sup></h5></label>
                    <input class="form-control" type="text" id="gpu" name="gpu" value="<?php if(isset($_POST['cikkszam'])) echo $data['gpu']; else echo 'Nincs' ?>" required>
                </div> <!-- .COL VÉGE -->
                <div class="col">
                    <label for="gpu_orajel"><h5>GPU órajele: <sup>*</sup></h5></label>
                    <input class="form-control" type="number" min="0" max="3500" id="gpu_orajel" name="gpu_orajel" value="<?php echo $data['gpu_orajel']; ?>" >
                </div> <!-- .COL VÉGE -->
            </div> <!-- .ROW VÉGE --> 

                    <!-- MAGOK SZÁMA ----------------------------------------- -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="magok_szama"><h5>Magok száma: <sup>*</sup></h5></label>
                    <input class="form-control" type="number" id="magok_szama" name="magok_szama" min="1" max="64" placeholder="Magok száma..." value="<?php echo $data['magok_szama']; ?>" required>
                </div> <!-- .COL VÉGE -->
                <div class="col-sm-6">
                    <label for="szalak_szama"><h5>Szálak száma: <sup>*</sup></h5></label>
                    <input class="form-control" type="number" id="szalak_szama" name="szalak_szama" value="<?php echo $data['szalak_szama']; ?>" min="1" max="128" placeholder="Szálak száma..." required>
                </div> <!-- .COL VÉGE -->
            </div> <!-- .ROW VÉGE --> 

                <!-- ÓRAJELEK L3 L2 cache ----------------------------------------- -->
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="orajel"><h5>Alap órajel: <sup>*</sup></h5></label>
                    <input class="form-control" type="number" id="orajel" name="orajel" min="1" max="7000" value="<?php echo $data['orajel']; ?>" placeholder="Alap órajel..."required>
                </div> <!-- .COL VÉGE -->
                <div class="col-sm-3">
                    <label for="turbo_orajel"><h5>Turbo órajel: <sup>*</sup></h5></label>
                    <input class="form-control" type="number" id="turbo_orajel" name="turbo_orajel" min="1" value="<?php echo $data['turbo_orajel']; ?>" max="7000" placeholder="Turbó órajel..." required>
                </div> <!-- .COL VÉGE -->
                <div class="col">
                    <label for="l3cache"><h5>l3Cache: </h5></label>
                    <input class="form-control" type="number" id="l3cache" name="l3cache" min="0" max="450" value="<?php echo $data['l3cache']; ?>" placeholder="l3Cache..." >
                </div> <!-- .COL VÉGE -->
                <div class="col">
                    <label for="l2cache"><h5>l2Cache: <sup>*</sup></h5></label>
                    <input class="form-control" type="number" id="l2cache" name="l2cache" min="0" max="450" placeholder="l2Cache..." value="<?php echo $data['l2cache']; ?>" required>
                </div> <!-- .COL VÉGE -->

                <!-- HUTO GPU ÓRAJEL -->
            </div> <!-- .ROW VÉGE --> 
            <div class="form-group row">
                <div class="col">
                    <label for="huto"><h5>Hűtés: <sup>*</sup></h5></label>
                    <input class="form-control" type="text" id="huto" name="huto" value="Nincs" value="<?php echo $data['huto']; ?>" required>
                </div> <!-- .COL VÉGE -->
                <div class="col">
                    <label for="fogyasztas"><h5>Fogyasztás: <sup>*</sup></h5></label>
                    <input class="form-control" type="number" id="fogyasztas" name="fogyasztas" min="1" max="250" value="<?php echo $data['fogyasztas']; ?>" placeholder="Fogyasztás..." required>
                </div> <!-- .COL VÉGE -->
            </div> <!-- .ROW VÉGE -->
            <!-- KÉPURL -->
            <div class="form-group row">
                <div class="col">
                    <label for="kepurl"><h5>KépURL: <sup>*</sup></h5></label>
                    <textarea class="form-control" name="kepurl" cols="20" rows="2" required><?php if(isset($_POST['cikkszam'])) echo $data['kepurl']; ?> </textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="manufacturerUrl"><h5>Gyártó Url: <sup>*</sup></h5></label>
                    <textarea class="form-control" name="manufacturerUrl" cols="20" rows="1" required><?php if(isset($_POST['cikkszam'])) echo $data['manufacturerUrl']; ?> </textarea>
                </div>
            </div>

            <input type="submit" name="input" class="btn btn-success btn-lg" value="Bevitel!" <?php if(isset($_POST['cikkszam'])) echo 'disabled' ?>>
            <input type="submit" name="modify" class="btn btn-warning btn-lg" value="Módosítás!" <?php if(!isset($_POST['cikkszam'])) echo 'disabled' ?>>
        </form>
        
    </div><!-- CARD VÉGE -->    
</div><!-- CONTAINER -->

<?php require FOOTER; ?>