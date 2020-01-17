<?php require HEADER; ?>

<div class="container pt-5 pb-5">
    <div class="card card-head text-dark">
        
        <h1>RAM bevitele (Eladó/Admin)</h1>
    </div>
    <div class="card card-body text-dark">
        <form action="<?php echo URLROOT;?>/admins/ram_input/<?php echo $data["cikkszam"] ?>" method="POST">
            <div class="form-group row">
                <div class="col">
                    <label for="ram_cikkszam">Cikkszám: <sup>*</sup></label>
                    <input type="text" maxlength="25" name="ram_cikkszam" value="<?php echo $data["cikkszam"]; ?>" class="form-control" required <?php if(!empty($data["cikkszam"])){ echo "disabled";}else{echo ""; } ?>>
                </div> <!-- COL CIKKSZÁM END -->
                <div class="col">
                    <label for="foglalat">Foglalat: <sup>*</sup></label>
                    <select name="foglalat" id="" class="form-control" value="<?php //echo $data["selected_socket"] ?>">
                        <?php foreach($data["socets"] as $soc) : ?>
                        <option value="<?php echo $soc->foglalatId ?>" <?php if(isset($data["selected_socket"]))echo $soc->tipus == $data["selected_socket"] ? 'selected' : '' ?> ><?php echo $soc->tipus ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- FOGLALAT COL END -->
                <div class="col">
                    <label for="warranity">Garancia : <sup>*</sup></label>
                    <select name="warranity" class="form-control" value="<?php //echo $data["warranity"] ;?>">
                        <?php foreach($data["warr"] as $warr) : ?>
                            <option value="<?php echo $warr->warr_id; ?>" <?php echo ($warr->warr_id == $data["warranity"] ? 'selected' : ''); ?>><?php echo $warr->warr_months ?> hónap</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="price">Ár (Ft): <sup>*</sup></label>
                    <input type="number" name="price" value="<?php echo $data["price"]; ?>" class="form-control" min="0" step="1" required>
                </div> <!-- COL TYPE END -->
            </div> <!-- ROW END -->
            <div class="form-group row">
                <div class="col">
                    <label for="manufacturer">Gyártó: <sup>*</sup></label>
                    <select name="manufacturer" class="form-control" value="<?php echo $data["manufacturer"] ?>">
                        <?php foreach($data["manufacts"] as $man) : ?>
                            <option value="<?php echo $man->man_id ?>" <?php if(isset($data["manufacturer"])) echo $man->manufacturer == $data["manufacturer"] ? 'selected' :'' ; ?>><?php echo $man->manufacturer; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div> <!-- COL END -->
                <div class="col">
                    <label for="type">Típus (terméknév): <sup>*</sup></label>
                    <input type="text" name="type" value="<?php echo $data["type"]; ?>" class="form-control" placeholder="PL: HyperX Predator...." required>
                </div> <!-- COL TYPE END -->
                <div class="col">
                    <label for="man_type">Gyártó Típus: <sup>*</sup></label>
                    <input type="text" name="man_type" value="<?php echo $data["man_type"]; ?>" class="form-control" placeholder="PL: HX432C16PB3K2/16...." required>
                </div> <!-- COL MANUFACTURE TYPE END -->
            </div> <!-- ROW END -->
            <div class="form-group row">
                <div class="col">
                    <label for="capacity">Kapacitás: (Gb) <sup>*</sup></label>
                    <select name="capacity" class="form-control" value="<?php echo $data["capacity"]; ?>">
                        <?php
                        $i=2;
                        while($i != 512) : 
                        ?>
                            <option value="<?php echo $i;?>" <?php echo ($i == $data["capacity"] ? 'selected' : '') ?> ><?php echo $i;?></option>
                        <?php $i = $i * 2; endwhile; ?>
                    </select>
                </div> <!-- CAPACITY COL END -->
                <div class="col">
                    <label for="timing">Időzítés: (CL) <sup>*</sup></label>
                    <input class="form-control" type="number" max="20" name="timing" value="<?php echo $data["timing"]; ?>">
                </div> <!-- COL END -->
                <div class="col">
                    <label for="voltage">Feszültség: (V) <sup>*</sup></label>
                    <input class="form-control" step="0.01" min="0.49" max="3.01" type="number" name="voltage" value="<?php echo $data["voltage"]; ?>">
                </div> <!-- COL END -->
                <div class="col">
                    <label for="clock">Órajel: (MHz) <sup>*</sup></label>
                    <input class="form-control" step="1" min="0" max="5500" type="number" name="clock" value="<?php echo $data["clock"]; ?>">
                </div> <!-- COL END -->
                <div class="col">
                    <label for="kit">Darabszám: <sup>*</sup></label>
                    <input class="form-control" step="1" min="0" max="16" type="number" name="kit" value="<?php echo $data["kit"]; ?>">
                </div> <!-- COL END -->
                <div class="col">
                    <label for="xmp">XMP: <sup>*</sup></label>
                    <select class="form-control" name="xmp" value="<?php echo $data["xmp"] ?>">
                        <option value="0" <?php echo ($data["xmp"] == 0? 'selected' : '') ?>>Nem támogatott</option>
                        <option value="1" <?php echo ($data["xmp"] == 1? 'selected' : '') ?>>Támogatott</option>
                    </select>
                </div> <!-- COL END -->
            </div> <!-- ROW END -->
            <div class="form-group row">
                <div class="col">
                    <label for="man_url">Gyártó honlapja/dokumentációja: </label>
                    <input type="text" name="man_url" class="form-control" value="<?php echo $data["man_url"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="picUrl">Csatolt képek <strong>(;)</strong>-vel elválasztva!: </label>
                    <textarea class="form-control" name="picUrl" rows="3" ><?php echo $data["picUrl"] ?></textarea>
                </div>
            </div>
            <input type="submit" name="ram_input" value="Bevitel" class="btn btn-dark btn-group mt-3" <?php echo $data["disabledIn"] ?>>
            <input type="submit" name="ram_modify" value="Módosítás" class="btn btn-success btn-group mt-3" <?php echo $data["disabledMod"] ?>>
        </form>
        <?php flash('ramInputSuccess'); ?>
        <?php flash('ramInputFail'); ?>

        <?php flash('ramModifySuccess'); ?>
        <?php flash('ramModifyFail'); ?>
    </div>
</div>

<?php require FOOTER; ?>