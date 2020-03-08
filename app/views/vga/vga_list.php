<?php include HEADER; ?>
<div class="container">
    <?php flash('delete_success'); ?>
    <div class="row pb-5 pt-5">
        <?php foreach($data['vgas'] as $vga) : ?>
            <div class="col-md-4 mb-5">
                <div class="card">
                <img src="<?php echo $vga->picUrl[0]; ?>" class="card-img-top kepek">
                    <div class="card card-body" id="itemListCardColor">
                        <div class="cardListHead">
                            <a class="titleLink" target="_blank" href="<?php echo URLROOT;?>/vgas/details/<?php echo $vga->cikkszam?>"><h4 class="card-title"><?php echo $vga->type.' '.$vga->typeCode;?></h4></a>
                        </div>                        
                        <hr>
                        <div id="cardBodyText">
                        <p class="mb-0 text-dark">Gyártó: <?php echo $vga->manufacturer; ?></p>
                        <p class="mb-0 text-dark">Típus: <?php echo $vga->type; ?></p>
                        <p class="mb-0 text-dark">Típus kód: <?php echo $vga->typeCode; ?></p>
                        <p class="mb-0 text-dark">GPU Gyártó: <?php echo $vga->vga_man; ?></p>
                        <p class="mb-0 text-dark">PCI-E Típus: <?php echo $vga->pci_type; ?></p>
                        <p class="mb-0 text-dark">GPU órajel: <?php echo $vga->gpu_clock; ?> MHz</p>
                        <p class="mb-0 text-dark">GPU Turbó/Peak: <?php echo $vga->gpu_peak; ?> MHz</p>
                        <p class="mb-0 text-dark">VRAM Menniység: <?php echo $vga->vram_capacity; ?> Gb</p>
                        <p class="mb-0 text-dark">VRAM Órajel: <?php echo $vga->vram_clock; ?> MHz</p>
                        <p class="mb-0 text-dark">VRAM Típus: <?php echo $vga->vram_type; ?></p>
                        <p class="mb-0 text-dark">VRAM BUS: <?php echo $vga->vram_bandwidth; ?> bit</p>
                        <p class="mb-0 text-dark">Fogyasztás: <?php echo $vga->power_consumption; ?> W</p>
                        <p class="mb-0 text-dark">Tápcsatlakozók: <?php echo $vga->power_pin; ?></p>
                        <p class="mb-0 text-dark">directX Verzió: <?php echo $vga->directX; ?></p>
                        <p class="mb-0 text-dark">Garancia: <?php echo $vga->warr_months; ?> Hónap</p>
                        <p class="mb-0 text-dark">displayPort: <?php echo $vga->displayPort; ?> Db</p>
                        <p class="mb-0 text-dark">DVI: <?php echo $vga->DVI; ?> Db</p>
                        <p class="mb-0 text-dark">HDMI: <?php echo $vga->HDMI; ?> Db</p>
                        </div>
                        <hr>
                        <h4 class="priceColor">Ár: <strong><?php echo $vga->price;?></strong> Ft</h4>
                    </div> <!-- CARD BODY END -->
                    <div class="card card-footer" id="itemListCardColor">
                        <div class="form-row">
                            <form action="<?php echo URLROOT;?>/vgas/details/<?php echo $vga->cikkszam?>" method="POST">
                                <input type="submit" value="Részletek" name="details" class="btn btn-success mr-1 mb-1" title="Részletek megtekintése">
                            </form>
                            <?php if(isset($_SESSION['jog'])) : ?>  
                                <?php if(bothAdminSeller($_SESSION['jog'])) : ?>
                                    <!-- VGA MÓDOSÍTÁSA ADMIN/ELADÓ -->
                                    <form action="<?php echo URLROOT;?>/admins/vga_input/<?php echo $vga->cikkszam;?>" method="POST">
                                        <input type="submit" name="editVGA" value="Módosítás" class="btn btn-warning mr-1">
                                    </form>
                                    <!-- VGA TÖRLÉSE ADMIN/ELADÓ -->
                                    <form action="<?php echo URLROOT;?>/admins/deleteVGA/<?php echo $vga->cikkszam;?>" method="POST">
                                        <input type="submit" name="deleteVGA" value="Törlés" class="btn btn-danger">
                                    </form>
                                <?php endif;?>
                            <?php endif;?>

                            <button name="Cart_<?php echo sha1($_SESSION['email']);?>" id="addToCart" class="btn btn-dark mb-1" <?php if(!isset($_SESSION["jog"])){ echo "disabled title='Be kell jelentkezni a vásárláshoz!'"; } ?> value="<?php echo 'vga_'.$vga->cikkszam; ?>" >Kosárba</button> 
                        </div> <!-- FORM ROW END -->
                    </div>
                </div> <!-- CARD END -->
            </div>
        <?php endforeach; ?>
    </div> <!-- ROW END -->
</div>

<?php include FOOTER; ?>