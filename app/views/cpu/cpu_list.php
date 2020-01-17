<?php require HEADER; ?>

<div class="container"> 
<?php flash('delete_success'); ?>
  <div class="row">
      <?php foreach ($data['cpu'] as $cpu) : ?>
        <div class="col-md-4">
            <div class="card mt-4 mb-4">
                <div class="card card-head"> 
                  <img src="<?php echo $cpu->picUrl[0]; ?>" class="card-img-top kepek">
                </div> 
            <div class="card card-body text-white" <?php $szoveg = ($cpu->gyarto == 'Intel')  ? 'style="background-color: #1e88e5 !important;"' :  'style="background-color: #616161  !important;"'; echo $szoveg; ?>>
              <h3 class="card-title"><?php echo $cpu->tipus; ?></h3>
              <div class="row">
                <div class="col">
                  <h6><?php echo 'Gyártó: '. $cpu->gyarto; ?></h6>
                  <p class="mb-0">Alap órajel: <?php echo $cpu->orajel; ?> MHz</p>
                  <p class="mb-0">Turbó órajel: <?php echo $cpu->turbo_orajel; ?> MHz</p>
                  <p class="mb-0">Magok száma: <?php echo $cpu->magok_szama; ?> Mag</p>
                  <p class="mb-0">Szálak száma: <?php echo $cpu->szalak_szama; ?> Szál</p>
                  <p class="mb-0">Fogyasztás: <?php echo $cpu->fogyasztas; ?> W</p>
                  <p class="mb-0">Hűtő: <?php echo $cpu->huto; ?></p>
                  <p class="mb-0">GPU: <?php echo $cpu->gpu; ?></p>
                  <p class="mb-0">GPU órajele: <?php echo $cpu->gpu_orajel; ?> MHz</p>
                  <p class="mb-0">L3Cache: <?php echo $cpu->l3cache; ?> Mb</p>
                  <p class="mb-0">L2cache: <?php echo $cpu->l2cache; ?> Mb</p>
                  <h4 class="mb-1 priceColor">Ár: <?php echo $cpu->ar; ?> Ft</h4>
                  <!-- Ha adminként vagyok belépve, tudjam módosítani a terméket --> 

                  <div class="form-row"> 
                  <form action="<?php echo URLROOT;?>/cpus/details/<?php echo $cpu->cikkszam?>" method="POST">
                      <input type="submit" value="Részletek" name="details" class="btn btn-success mr-1 mt-2" title="Részletek megtekintése">
                  </form>
                    <?php if(isset($_SESSION['jog']) AND bothAdminSeller($_SESSION['jog'])) : ?>
                                     
                        <form method="POST" action="<?php echo URLROOT;?>/admins/cpu_input/<?php echo $cpu->cikkszam;?>">                    
                          <input type="hidden" name="cikkszam" value="<?php echo $cpu->cikkszam;?>"> 
                          <input type="submit" name="modifyBTN" value="Módosítás" class="btn btn-warning mr-1 mt-2" />                    
                        </form>
                        <form action="<?php echo URLROOT;?>/admins/deleteCpu/<?php echo $cpu->cikkszam;?>" method="POST">                    
                          <input type="submit" name="deleteBTN" value="Törlés" class="btn btn-danger mr-2 mt-2" />                      
                        </form>
                    <?php endif; ?>                        
                        <button name="Cart_<?php echo sha1($_SESSION['email']);?>" id="addToCart" class="btn btn-dark mt-2" <?php if(!isset($_SESSION["jog"])){ echo "disabled ";  echo 'title="Kérem jelentkezzen be a vásárláshoz!"';}else{echo 'title="A termék kosárba helyzezése"';} ?>  value=<?php echo 'cpu_'.$cpu->cikkszam; ?> >Kosárba</button> 

                    </div><!-- FORM-ROW END -->
                    

                </div> <!-- COL VÉGE -->                               
              </div><!-- ROW VÉGE -->
            </div>
          </div>
        </div>        
        <?php endforeach; ?> 
    </div>        
</div> 
</div>
<?php require FOOTER; ?>