<?php
    require HEADER;
?>

<div class="container">
    <div class="row pb-5 pt-5">
        <?php foreach($data["ddr4Rams"] as $ram) : ?>
            <div class="col-md-4 mb-5">
                <div class="card">
                    <img src="<?php echo $ram->picUrl[0]; ?>" class="card-img-top kepek">
                    <div class="card card-body">
                        <a class="titleLink" target="_blank" href="<?php echo URLROOT;?>/rams/details/<?php echo $ram->cikkszam?>"><h4 class="card-title"><?php echo $ram->type.' '.$ram->typeCode;?></h4></a>
                        <hr>
                        <p class="mb-0 text-dark">Gyártó: <?php echo $ram->manufacturer; ?></p>
                        <p class="mb-0 text-dark">Típus: <?php echo $ram->tipus; ?></p>
                        <p class="mb-0 text-dark">Termék: <?php echo $ram->type; ?></p>
                        <p class="mb-0 text-dark notLink">Termék típus: <a target="_blank" href="<?php echo $ram->Url;?>"> <?php echo $ram->typeCode; ?></a></p>
                        <!-- FOLYTAT... UNDEFINED URL...?????!!!??!?! -->
                        <p class="mb-0 text-dark">Kapacitás: <?php echo $ram->capacity; ?> Gb</p>
                        <p class="mb-0 text-dark">Kiszerelés (kit): <?php echo $ram->kit; ?> Db</p>
                        <p class="mb-0 text-dark">Feszültség (V): <?php echo $ram->voltage; ?> V</p>
                        <p class="mb-0 text-dark">Órajel: <?php echo $ram->clock;?> MHz</p>
                        <p class="mb-0 text-dark">XMP: <?php echo (bool) $ram->is_xmp ? 'Igen' : 'Nem'; ?></p>
                        <hr>
                        <h4 class="priceColor">Ár: <strong><?php echo $ram->ramPrice;?></strong> Ft</h4>
                        <hr>
                        <div class="form-row">
                            <form action="<?php echo URLROOT;?>/rams/details/<?php echo $ram->cikkszam?>" method="POST">
                                <input type="submit" value="Részletek" name="details" class="btn btn-success mr-1" title="Részletek megtekintése">
                            </form>
                            <!-- Ha  -->

                            <?php if(isset($_SESSION['jog'])) : ?>                          
                                <?php if(bothAdminSeller($_SESSION["jog"])) : ?>
                                <!-- RAM MÓDOSÍTÁSA ADMIN/ELADÓ -->
                                    <form action="<?php echo URLROOT;?>/admins/ram_input/<?php echo $ram->cikkszam;?>" method="POST">
                                        <input type="submit" name="editRAM" value="Módosítás" class="btn btn-warning mr-1">
                                    </form>
                                <!-- RAM TÖRLÉSE ADMIN/ELADÓ -->
                                    <form action="<?php echo URLROOT;?>/admins/deleteRAM/<?php echo  $ram->cikkszam;?>" method="POST">
                                        <input type="submit" name="deleteRAM" value="Törlés" class="btn btn-danger">
                                    </form>
                                        <?php endif; ?>       
                            <?php endif; ?>

                            <button name="Cart_<?php echo sha1($_SESSION['email']);?>" id="addToCart" class="btn btn-dark" <?php if(!isset($_SESSION["jog"])){ echo "disabled"; } ?> title="Be kell jelentkezni a vásárláshoz!" value="<?php echo 'ram_'.$ram->cikkszam; ?>" >Kosárba</button> 
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<?php require FOOTER; ?>