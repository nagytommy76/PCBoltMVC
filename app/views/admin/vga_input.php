<?php require HEADER; ?>
<div class="container">
    <div class="card mt-5 mb-5">
        <div class="card card-head p-3 text-center" id="cardHeadColor">
            <h1>VGA Termékek bevitele</h1>
            <?php flash('input_success'); ?>
            <?php flash('input_fail'); ?>
            <?php flash('modify_success'); ?>
            <?php flash('modify_fail'); ?>
        </div>
        <div class="card card-body" id="cardBodyColor">
            <form action="<?php echo URLROOT;?>/admins/vga_input/<?php echo $data["cikkszam"] ?>" method="POST">
                <div class="form-group row">
                    <div class="col">
                        <label for="cikkszam">Cikkszám <sup>*</sup></label>
                        <input class="form-control" type="text" name="cikkszam" minlength="10" maxlength="25" value="<?php echo $data['cikkszam']; ?>" required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="selected_man">Gyártó <sup>*</sup></label>
                        <select name="selected_man" class="form-control" required>
                            <?php foreach($data['manufacturers'] as $man) : ?>
                                <option <?php if ($data['selected_man'] === $man->man_id) echo 'selected' ?> value="<?php echo $man->man_id ?>"><?php echo $man->manufacturer ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="selected_warr">Garancia <sup>*</sup></label>
                        <select name="selected_warr" class="form-control" required>
                            <?php foreach($data['warranity'] as $warr) : ?>
                                <option <?php if($data['selected_warr'] === $warr->warr_id) echo 'selected' ?> value="<?php echo $warr->warr_id ?>"><?php echo $warr->warr_months ?> Hónap</option>
                            <?php endforeach; ?>
                        </select>
                    </div> <!-- COL END -->
                </div> <!-- ROW END -->
                <div class="form-group row">
                    <div class="col">
                        <label for="type">Termék típus <sup>*</sup></label>
                        <input class="form-control" type="text" name="type" value="<?php echo $data['type']; ?>" required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="typeCode">Termék kód (Ha van) <sup></sup></label>
                        <input class="form-control" placeholder="Ha van termékkód..." type="text" name="typeCode" value="<?php echo $data['typeCode']; ?>">
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="pci_type">PCI-E Típusa <sup>*</sup></label>
                        <select name="pci_type" class="form-control" required>
                            <?php foreach($data['pciSlots'] as $pci) : ?>
                                <option <?php if($pci == $data['pci_type']) echo 'selected' ?> value="<?php echo $pci ?>"><?php echo $pci; ?></option>
                            <?php endforeach; ?>
                            <!-- MEGOLDANI, HOGY KI LEGYEN JELÖLVE -->
                        </select>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="vga_man">GPU gyártó <sup>*</sup></label>
                        <input class="form-control" type="text" name="vga_man" value="<?php echo $data['vga_man']; ?>" required>
                    </div> <!-- COL END -->
                </div> <!-- ROW END -->
                <div class="form-group row">
                    <div class="col">
                        <label for="gpu_clock">GPU frekvencia (Alap) <sup>*</sup></label>
                        <input class="form-control" type="number" name="gpu_clock" value="<?php echo $data['gpu_clock']; ?>" placeholder="GPU Mag órajele..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="gpu_peak">GPU frekvencia (Peak/Turbó) <sup>*</sup></label>
                        <input class="form-control" type="number" name="gpu_peak" value="<?php echo $data['gpu_peak']; ?>" placeholder="GPU Peak/Turbó órajele..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="vram_capacity">GPU VRAM mennyisége (GB) <sup>*</sup></label>
                        <select class="form-control" name="vram_capacity" value="<?php echo $data['vram_capacity']; ?>" required>
                            <?php foreach ($data['vramCap'] as $vram) : ?>
                                <option <?php if($vram == $data['vram_capacity']) echo 'selected' ?> value="<?php echo $vram ?>"><?php echo $vram ?> GB</option>
                            <?php endforeach; ?>
                        </select>
                    </div> <!-- COL END -->
                </div> <!-- ROW END -->
                <div class="form-group row">
                    <div class="col">
                        <label for="vram_clock">VRAM órajele (MHz) <sup>*</sup></label>
                        <input class="form-control" type="number" name="vram_clock" value="<?php echo $data['vram_clock']; ?>" placeholder="VRAM órajele..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="vram_type">VRAM órajele (MHz) <sup>*</sup></label>
                        <select class="form-control" name="vram_type" value="<?php echo $data['vram_type']; ?>" required>
                            <option value="GDDR5">GDDR5</option>
                            <option value="GDDR6">GDDR6</option>
                            <option value="HBM">HBM</option>
                            <option value="HBM2">HBM2</option>
                        </select>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="vram_bandwidth">VRAM adatátvitele (bit) <sup>*</sup></label>
                        <input class="form-control" type="number" name="vram_bandwidth" value="<?php echo $data['vram_bandwidth']; ?>" placeholder="VRAM adatátvitele (bit)..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="power_consumption">Fogyasztás (W)<sup>*</sup></label>
                        <input class="form-control" type="number" name="power_consumption" value="<?php echo $data['power_consumption']; ?>" placeholder="fogyasztás..." required>
                    </div> <!-- COL END -->
                </div> <!-- ROW END -->
                <div class="form-group row">
                    <div class="col">
                        <label for="power_pin">Tápcsatlakozó <sup>*</sup></label>
                        <input class="form-control" type="text" name="power_pin" value="<?php echo $data['power_pin']; ?>" placeholder="Tápcsatlakozó..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="directX">directX Verzió <sup>*</sup></label>
                        <input class="form-control" type="text" name="directX" value="<?php echo $data['directX']; ?>" placeholder="directX verzió..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="displayPort">displayPort <sup>*</sup></label>
                        <input class="form-control" type="number" max="5" name="displayPort" value="<?php echo $data['displayPort']; ?>" placeholder="displayPort..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="DVI">DVI <sup>*</sup></label>
                        <input class="form-control" type="number" max="5" name="DVI" value="<?php echo $data['DVI']; ?>" placeholder="displayPort..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="HDMI">HDMI <sup>*</sup></label>
                        <input class="form-control" type="number" max="5" name="HDMI" value="<?php echo $data['HDMI']; ?>" placeholder="HDMI..." required>
                    </div> <!-- COL END -->
                </div> <!-- ROW END -->
                <div class="form-group row">
                    <div class="col">
                        <label for="vga_stock">Raktárkészlet: <sup>*</sup></label>
                        <input class="form-control" type="number"  name="vga_stock" value="<?php echo $data['vga_stock']; ?>" placeholder="Raktárkészlet..." required>
                    </div> <!-- COL END -->
                    <div class="col">
                        <label for="price">Termék ÁR: <sup>*</sup></label>
                        <input class="form-control" type="number"  name="price" value="<?php echo $data['price']; ?>" placeholder="Ár..." required>
                    </div> <!-- COL END -->
                </div> <!-- ROW END -->
                    <div class="form-group row">
                        <div class="col">
                            <label for="man_url">Gyártó honlapja <sup>*</sup></label>
                            <textarea class="form-control" name="man_url" rows="2"><?php echo $data['man_url'] ?></textarea>
                        </div> <!-- COL END -->
                    </div> <!-- ROW END -->
                    <div class="form-group row">
                        <div class="col">
                            <label for="picUrl">Kép URL (;)-vel elválasztva <sup>*</sup></label>
                            <textarea class="form-control" name="picUrl" rows="5"><?php echo $data['picUrl'] ?></textarea>
                        </div> <!-- COL END -->
                    </div>
                <div class="form-group row">
                    <div class="col">
                        <input class="btn btn-success mr-2 pb-2" value="Bevitel" type="submit" name="vgaInput" <?php echo $data['disabledIn'] ?>>
                        <input class="btn btn-warning" value="Módosítás" type="submit" name="vgaModify" <?php echo $data['disabledModify'] ?>>
                    </div> <!-- COL END -->
                </div> <!-- ROW END -->
            </form> 
        </div> <!-- CARD BODY END -->
    </div> <!-- CARD END -->
    
</div>

<?php require FOOTER; ?>