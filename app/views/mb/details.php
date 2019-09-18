<?php require HEADER; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 pt-5">   
            <div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
        <ol class="carousel-indicators">
            <?php for($i=0;$i<count($data['motherboard']->picUrl);$i++) : ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php echo (($i == 0) ? 'active' : '');?>"></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <?php for($i=0;$i<count($data['motherboard']->picUrl);$i++) : ?>
            <?php echo '<div class="carousel-item '.(($i==0) ? 'active' : '').'">'; ?>
                
                    <a href="<?php echo $data['motherboard']->picUrl[$i]; ?>" target="_blank"><img src="<?php echo $data['motherboard']->picUrl[$i];?>" class="d-block img-fluid"></a>
            <?php echo '</div>';?>
            <?php endfor; ?>
            
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
        </div>
        <h1 class="pt-5">Ár: <?php echo $data['motherboard']->price; ?> Ft</h1>
    </div> <!-- COL VÉGE -->
        <div class="col pt-5">
            <h1 class="text-warning"><?php echo $data['motherboard']->gyarto.' '.$data['motherboard']->MBName;?></h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tulajdonságok: </th>
                        <th scope="col"><a class="text-success" target="_blank" href="<?php echo $data['motherboard']->GyartoURL; ?>">Terék gyártói honlapja</a></th>                        
                    </tr>
                </thead>
                <tbody>
                <tr>
                        <th scope="row">Garancia: </th>
                        <td><?php echo $data['motherboard']->garancia; ?> Hónap</td>
                    </tr>
                    <tr>
                        <th scope="row">Gyártó: </th>
                        <td><?php echo $data['motherboard']->gyarto; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Típus: </th>
                        <td><?php echo $data['motherboard']->MBName; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">CPU Foglalat: </th>
                        <td><?php echo $data['motherboard']->foglalat; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Chipset: </th>
                        <td><?php echo $data['motherboard']->chipset; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Formátum: </th>
                        <td><?php echo $data['motherboard']->Meret; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">RAM Típusa: </th>
                        <td><?php echo $data['motherboard']->ramType; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">RAM Foglalatok: </th>
                        <td><?php echo $data['motherboard']->memfoglalat; ?> Db.</td>
                    </tr>
                    <tr>
                        <th scope="row">RAM Max. Órajel: </th>
                        <td><?php echo $data['motherboard']->maxMemMHz; ?> MHz.</td>
                    </tr>
                    <tr>
                        <th scope="row">RAM Max. Mennyiség: </th>
                        <td><?php echo $data['motherboard']->memMeret; ?> Gb.</td>
                    </tr>
                    <tr>
                        <th scope="row">Integrált LAN: </th>
                        <td><?php echo $data['motherboard']->intLAN; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Integrált HANG: </th>
                        <td><?php echo $data['motherboard']->intHang; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">M.2 Foglalat: </th>
                        <td><?php echo $data['motherboard']->m2; ?> Db.</td>
                    </tr>
                    <tr>
                        <th scope="row">SATA3 Foglalat: </th>
                        <td><?php echo $data['motherboard']->sata3; ?> Db.</td>
                    </tr>
                    <tr>
                        <th scope="row">PCI-E x16 Foglalat: </th>
                        <td><?php echo $data['motherboard']->pcie16; ?> Db.</td>
                    </tr>
                    <tr>
                        <th scope="row">USB 3.0 Foglalat: </th>
                        <td><?php echo $data['motherboard']->usb30; ?> Db.</td>
                    </tr>
                    <tr>
                        <th scope="row">USB 3.1 Foglalat: </th>
                        <td><?php echo $data['motherboard']->usb31; ?> Db.</td>
                    </tr>
                </tbody>                
            </table>             
        </div><!-- COL VÉGE --> 
    </div><!-- ROW VÉGE -->
</div> <!-- CONTAINER -->

<?php require FOOTER; ?>