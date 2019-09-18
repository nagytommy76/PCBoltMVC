<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container"> 
<?php flash('delete_success'); ?>
  <div class="row">
      <?php foreach ($data['cpu'] as $cpu) : ?>
        <div class="col-md-4">
            <div class="card mt-4 mb-3">
                <div class="card card-head"> 
                  <img src="<?php echo $cpu->kepurl; ?>" class="card-img-top kepek">
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
                  <?php if(isset($_SESSION['jog'])) : ?> 
                    <?php if($_SESSION['jog'] == 'admin' || $_SESSION['jog'] == 'eladó') : ?>
                      <div class="form-row">                
                        <form method="POST" action="<?php echo URLROOT;?>/admins/cpu_input/<?php echo $cpu->cikkszam;?>">                    
                          <input type="hidden" name="cikkszam" value="<?php echo $cpu->cikkszam;?>"> 
                          <input type="submit" name="modifyBTN" value="Módosítás" class="btn btn-md btn-warning mt-2 mr-2" />                    
                        </form>
                        <form action="<?php echo URLROOT;?>/admins/deleteCpu/<?php echo $cpu->cikkszam;?>" method="POST">                    
                          <input type="submit" name="deleteBTN" value="Törlés" class="btn btn-md btn-danger mt-2" />                      
                        </form>
                        
                    </div><!-- FORM-ROW END -->
                    <?php endif; ?>  
                  <?php endif; ?> 

                </div> <!-- COL VÉGE -->                               
              </div><!-- ROW VÉGE -->
            </div>
          </div>
        </div>        
        <?php endforeach; ?> 
    </div>        
</div> 
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>