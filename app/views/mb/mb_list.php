<?php require HEADER; ?>

<div class="container">
    <div class="row pt-4 pb-4">
        <?php foreach($data['motherboards'] as $mb) : ?>
        <?php $MBCikkszam = $mb->cikkszam; ?>
            <div class="col-md-4">
                <div id="mbCard" class="card mb-5">                    
                    <img src="<?php echo $mb->picUrl[0]; ?>" class="card-img-top">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $mb->MBName;?></h4>
                        <p class="mb-0">Gyártó: <?php echo $mb->gyarto; ?></p>
                        <p class="mb-0">Chipset: <?php echo $mb->chipset; ?></p>
                        <p class="mb-0">Chipset gyártó: <?php echo $mb->MBGyarto; ?></p>
                        <p class="mb-0">Tokozás: <?php echo $mb->foglalat; ?></p>
                        <p class="mb-0">Méret: <?php echo $mb->Meret; ?></p>       
                        <p class="mb-0">RAM típusa: <?php echo $mb->ramType; ?></p>
                        <p class="mb-0">MAX RAM órajel: <?php echo $mb->maxMemMHz; ?> MHz</p>
                        <p class="mb-0">RAM Slotok: <?php echo $mb->memfoglalat; ?> Db</p>
                        <h4 class="priceColor"><?php echo $mb->price;?> Ft</h4>   
                        <div class="form-row">    
                            <form action="<?php echo URLROOT;?>/mbs/details/<?php echo $MBCikkszam?>" method="POST">
                                <input type="submit" value="Részletek" name="details" class="btn btn-success" title="Részletek megtekintése">
                            </form>


                            <?php if(isset($_SESSION['jog'])) : ?>                          
                                <?php if($_SESSION['jog'] == 'admin' ||  $_SESSION['jog'] ==    'eladó') : ?>
                                <!-- ALAPLAP MÓDOSÍTÁSA ADMIN/ELADÓ -->
                                    <form action="<?php echo URLROOT;?>/admins/mb_input/<?php echo  $MBCikkszam;?>" method="POST">
                                        <input type="submit" name="editMB" value="Módosítás"        class="btn btn-warning">
                                    </form>
                                <!-- ALAPLAP TÖRLÉSE ADMIN/ELADÓ -->
                                    <form action="<?php echo URLROOT;?>/admins/deleteMB/<?php echo  $MBCikkszam;?>" method="POST">
                                        <input type="submit" name="deleteMB" value="Törlés"         class="btn btn-danger">
                                    </form>
                                        <?php endif; ?>                            
                            <?php endif; ?>
                        </div><!-- FORM GROUP END -->
                    </div> <!-- CARD BODY END -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require FOOTER; ?>