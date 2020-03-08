<?php require HEADER; ?>
<div class="container">
    <div class="row pt-4 pb-4">
    <?php require SIDEBAR; ?>
    <main class="col-md-10 ml-sm-auto col-lg-10 px-4">
    <div class="row">
        <?php foreach($data['motherboards'] as $mb) : ?>
        <?php $MBCikkszam = $mb->cikkszam; ?>
            <div class="col-md-4">                
                <div id="mbCard" class="card mb-5">                    
                    <img src="<?php echo $mb->picUrl[0]; ?>" class="card-img-top kepek">
                    <div class="card-body" id="itemListCardColor">
                        <div class="cardListHead">
                        <a class="titleLink" target="_blank" href="<?php echo URLROOT;?>/mbs/details/<?php echo $MBCikkszam?>"><h4 class="card-title"><?php echo $mb->MBName;?></h4></a>
                        </div>
                        <hr>
                        <p class="mb-0">Gyártó: <?php echo $mb->manufacturer; ?></p>
                        <p class="mb-0">Chipset: <?php echo $mb->chipset; ?></p>
                        <p class="mb-0">Chipset gyártó: <?php echo $mb->MBGyarto; ?></p>
                        <p class="mb-0">Tokozás: <?php echo $mb->foglalat; ?></p>
                        <p class="mb-0">Méret: <?php echo $mb->Meret; ?></p>       
                        <p class="mb-0">RAM típusa: <?php echo $mb->ramType; ?></p>
                        <p class="mb-0">MAX RAM órajel: <?php echo $mb->maxMemMHz; ?> MHz</p>
                        <p class="mb-0">RAM Slotok: <?php echo $mb->memfoglalat; ?> Db</p>
                        <hr>
                        <h4 class="priceColor"><?php echo $mb->price;?> Ft</h4> 
                        <hr>  
                        <div class="form-row">    
                            <form action="<?php echo URLROOT;?>/mbs/details/<?php echo $MBCikkszam?>" method="POST">
                                <input type="submit" value="Részletek" name="details" class="btn mr-1" title="Részletek megtekintése" id="detailsButtonColor">
                            </form>

                            <?php if(isset($_SESSION['jog'])) : ?>                          
                                <?php if(bothAdminSeller($_SESSION["jog"])) : ?>
                                <!-- ALAPLAP MÓDOSÍTÁSA ADMIN/ELADÓ -->
                                    <form action="<?php echo URLROOT;?>/admins/mb_input/<?php echo  $MBCikkszam;?>" method="POST">
                                        <input type="submit" name="editMB" value="Módosítás" class="btn btn-warning mr-1">
                                    </form>
                                <!-- ALAPLAP TÖRLÉSE ADMIN/ELADÓ -->
                                    <form action="<?php echo URLROOT;?>/admins/deleteMB/<?php echo  $MBCikkszam;?>" method="POST">
                                        <input type="submit" name="deleteMB" value="Törlés" class="btn btn-danger">
                                    </form>
                                <?php endif; ?>       
                            <?php endif; ?>
                            
                                <button name="Cart_<?php echo sha1($_SESSION['email']);?>" id="addToCart" class="btn cartButtonColor" <?php if(!isset($_SESSION["jog"])){ echo "disabled ";  echo 'title="Kérem jelentkezzen be a vásárláshoz!"';}else{echo 'title="A termék kosárba helyzezése"';} ?>  value=<?php echo 'mb_'.$MBCikkszam; ?> >Kosárba</button> 
                                <input type="hidden" name="CartBTN" value="<?php echo $MBCikkszam; ?>">
                                <input type="hidden" name="mbCartQuantity" id="mbCartQuantity" value="">
                        </div><!-- FORM GROUP END -->
                    </div> <!-- CARD BODY END -->
                </div>
             </div>  <!--  COL MD END -->
        <?php endforeach; ?>
        </div>    <!-- INNER ROW END  -->
        </main>
    </div>
</div>

<?php require FOOTER; ?>