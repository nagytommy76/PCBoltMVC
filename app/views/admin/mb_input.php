<?php require HEADER; ?>
<div class="container pt-5 pb-5">
    <div class="card card-head bg-dark text-white">
        <h1 class="text-center p-2">Alaplap bevitele/módosítása (Admin/Eladó)</h1>
    </div>
    <div class="card card-body bg-warning">
        <form action="<?php echo URLROOT;?>/admins/mb_input/<?php echo $data['mbcikkszam']?>" method="POST">
            <div class="form-group row">
                <div class="col">
                    <label for="">Cikkszám: <sup>*</sup></label>
                    <input class="form-control" type="text" maxlength="10" name="mbcikkszam" value="<?php echo $data['mbcikkszam']; ?>" <?php if(isset($data['disabled1'])) echo $data['disabled1']; ?> required>
                </div><!-- COL-SM-3 CIKKSZÁM VÉGE -->
                <div class="col">
                    <label for="">Garancia (Hó): <sup>*</sup></label>
                    <select class="form-control" type="number" max="9999" name="garancia" value="<?php //echo $data['garancia']; ?>" required>
                        <?php foreach($data["warr"] as $warr) : ?>
                            <option value="<?php echo $warr->warr_id ?>" <?php echo ($warr->warr_id == $data["garancia"] ? "selected" : '') ?> ><?php echo $warr->warr_months; ?> Hónap</option>
                        <?php endforeach; ?>
                    </select>
                </div><!-- COL-SM-3 GARANCIA VÉGE -->
                <div class="col">
                    <label >Ár: <sup>*</sup></label>
                    <input class="form-control" type="number" name="price" value="<?php echo $data['price']; ?>" required>
                </div><!-- COL-SM-3 ÁR VÉGE -->
                <div class="col">
                    <label >Foglalat (CPU): <sup>*</sup></label>
                    <select class="form-control" type="number" name="cpufoglalat" value="<?php echo $data['cpufoglalat']; ?>">
                    <?php foreach($data['foglalatok'] as $foglalat) : ?>
                        <option <?php if($foglalat->foglalat == $data['cpufoglalat']) echo 'selected'; ?> value="<?php echo $foglalat->foglalatID?>"><?php echo $foglalat->foglalat; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div><!-- COL-SM-3 ÁR VÉGE --> 

            </div><!-- FORM GROUP VÉGE -->
            <div class="form-group row">
                <div class="col">
                    <label for="">Típus: <sup>*</sup></label>
                    <input class="form-control" type="text" name="mbtipus" value="<?php echo $data['mbtipus']; ?>" required>
                </div><!-- COL-SM-3 TÍPUS VÉGE -->
                <div class="col">
                    <label for="gyarto">Gyártó: <sup>*</sup></label>
                    <select class="form-control" name="gyarto">
                        <?php foreach($data["man"] as $man) : ?>
                            <option value="<?php echo $man->man_id; ?>"<?php echo ($man->man_id == $data["gyarto"]) ? 'selected' :'' ?>><?php echo $man->manufacturer ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><!-- COL-SM-3 ALAPLAP GYÁRTÓ VÉGE -->
                <div class="col">
                    <label for="">Chipset: <sup>*</sup></label>
                    <input class="form-control" type="text" name="chipset" value="<?php echo $data['chipset']; ?>" required>
                </div><!-- COL-SM-3 CHIPSET VÉGE -->
            </div><!-- FORM GROUP VÉGE -->

            <div class="form-group row">
                <div class="col">
                    <label for="">Méret: <sup>*</sup></label>
                    <select class="form-control" name="meret" value="<?php echo $data['meret']; ?>" required>                        
                        <?php foreach($data['formats'] as $format) : ?>
                            <option value="<?php echo $format->Id;?>"<?php echo ($format->format == $data['meret']) ? 'selected' : ''; ?>><?php echo $format->format;?> </option>
                        <?php endforeach; ?>
                    </select>
                </div><!-- COL-SM-3 TÍPUS VÉGE -->
                <div class="col">
                    <label for="">Integrált HANG: <sup>*</sup></label>
                    <input class="form-control" type="text" name="inthang" value="<?php echo $data['inthang']; ?>" required>
                </div><!-- COL-SM-3 Integrált HANG VÉGE -->
                <div class="col">
                    <label for="">Integrált LAN: <sup>*</sup></label>
                    <input class="form-control" type="text" name="intlan" value="<?php echo $data['intlan']; ?>" required>
                </div><!-- COL-SM-3 Integrált LAN VÉGE -->
                <div class="col">
                    <label >Foglalat (RAM): <sup>*</sup></label>
                    <select class="form-control" type="number" name="ramtipus" value="<?php echo $data['ramtipus']; ?>">
                    <?php foreach($data['RAM'] as $ram) : ?>
                        <option <?php if($ram->foglalatId == 4 /*|| $ram->tipus == $data['ramtipus']*/) echo 'selected'; ?> value="<?php echo $ram->foglalatId?>"><?php echo $ram->tipus; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div><!-- COL-SM-3 ÁR VÉGE --> 
            </div><!-- FORM GROUP VÉGE -->

            <div class="form-group row">
                <div class="col">
                    <label for="">M.2 Slotok száma: </label>
                    <input class="form-control" type="number" max="10" name="m2" value="<?php echo $data['m2']; ?>" >
                </div><!-- COL-SM-3 M.2 VÉGE -->
                <div class="col">
                    <label >Sata3 Port(ok): </label>
                    <input  class="form-control" type="number" max="10" name="sata3" value="<?php echo $data['sata3']; ?>">
                </div><!-- COL-SM-3 SATA3 VÉGE -->
                <div class="col">
                    <label >USB 3.0 Port(ok): </label>
                    <input class="form-control" type="number" max="20" name="usb30" value="<?php echo $data['usb30']; ?>">
                </div><!-- COL-SM-3 USB VÉGE -->    
                <div class="col">
                    <label >USB 3.1 Port(ok): </label>
                    <input class="form-control" type="number" max="20" name="usb31" value="<?php echo $data['usb31']; ?>">
                </div><!-- COL-SM-3 USB 3.1 VÉGE -->            
            </div><!-- FORM GROUP VÉGE -->

            <div class="form-group row">
                <div class="col">
                    <label for="">Max RAM frenkvencia: </label>
                    <input class="form-control" type="number" max="5500" name="maxMemMHz" value="<?php echo $data['maxMemMHz']; ?>" required>
                </div><!-- COL-SM-3 max memória MHZ VÉGE -->
                <div class="col">
                    <label >Max RAM Méret (GB): </label>
                    <input  class="form-control" type="number" max="512" name="maxRamMeret" value="<?php echo $data['maxRamMeret']; ?>">
                </div><!-- COL-SM-3 MAX RAM GB VÉGE -->
                <div class="col">
                    <label >RAM Slot(ok): </label>
                    <input class="form-control" type="number" max="20" name="memfoglalat" value="<?php echo $data['memfoglalat']; ?>" required>
                </div><!-- COL-SM-3 PCIEx16 VÉGE -->
                <div class="col">
                    <label >PCI-Ex16 Slot(ok): </label>
                    <input class="form-control" type="number" max="10" name="pciex16" value="<?php echo $data['pciex16']; ?>">
                </div><!-- COL-SM-3 PCIEx16 VÉGE -->                      
            </div><!-- FORM GROUP VÉGE --> 
            <div class="form-group row">
                <div class="col">
                    <label for="picUrl">Képek (;)-vel elválasztva! <sup>*</sup></label>
                    <textarea name="picUrl" cols="30" rows="2" class="form-control" required><?php echo $data['picUrl'] ?></textarea>
                </div>
            </div>   
            <div class="form-group row">
                <div class="col">
                    <label for="">Gyártó honlapjához vezető URL: <sup>*</sup></label>
                    <input class="form-control" type="text" name="gyartoUrl" value="<?php echo $data['gyartoUrl'];?>">
                </div>
            </div>       
                <input type="submit" name="input" value="Bevitel" class="btn btn-success btn-lg" <?php echo $data['disabledIN']; ?>>  
                
                <input type="submit" name="modify" value="Módosítás" class="btn btn-warning btn-lg" <?php  echo $data['disabled']; ?>>
        </form>
        <?php flash('mb_input_success'); ?>
        <?php flash('MBModifySuccess'); ?>
    </div>
</div>
<?php require FOOTER; ?>