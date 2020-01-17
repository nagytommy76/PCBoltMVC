<?php require HEADER; ?>

<div class="container-fluid mx-auto">
<div class="row">
    <div class="col-lg-4 pt-4">
        <div class="carousel slide pb-5 mx-auto" data-ride="carousel" id="carouselExampleIndicators">
        <ol class="carousel-indicators">
            <?php for($i=0;$i<count($data['rams']->picUrl);$i++) : ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php echo (($i == 0) ? 'active' : '');?>"></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <?php for($i=0;$i<count($data['rams']->picUrl);$i++) : ?>
            <?php echo '<div class="carousel-item '.(($i==0) ? 'active' : '').'">'; ?>
                <a href="<?php echo $data['rams']->picUrl[$i]; ?>" target="_blank"><img src="<?php echo $data['rams']->picUrl[$i];?>" class="d-block img-fluid"></a>
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
    </div> <!-- COL VÉGE -->

    <!-- Another COL -->
    <div class="col-lg-8 pt-4">
        <h1 class="text-warning"><?php echo $data["rams"]->manufacturer.' '.$data["rams"]->type ?></h1>
        <table class="table table-hover text-white pb-5">
            <thead>
                <tr>
                    <th scope="col">Tulajdonságok: </th>
                    <th scope="col"><a class="text-success" target="_blank" href="<?php echo $data['rams']->Url; ?>">Terék gyártói honlapja</a></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Garancia: </th>
                    <td><?php echo $data["rams"]->WMonth ?> Hónap</td>
                </tr>
                <tr>
                    <th>Foglalat: </th>
                    <td><?php echo $data["rams"]->tipus; ?></td>
                </tr>
                <tr>
                    <th>Gyártó: </th>
                    <td><?php echo $data["rams"]->manufacturer; ?></td>
                </tr>
                <tr>
                    <th>Típus: </th>
                    <td><?php echo $data["rams"]->type; ?></td>
                </tr>
                <tr>
                    <th>Típus (Gyártó): </th>
                    <td><?php echo $data["rams"]->typeCode; ?></td>
                </tr>
                <tr>
                    <th>Időzítés: </th>
                    <td>CL<?php echo $data["rams"]->timing; ?></td>
                </tr>
                <tr>
                    <th>Feszültség: </th>
                    <td><?php echo $data["rams"]->voltage; ?> V</td>
                </tr>
                <tr>
                    <th>Kapacitás: </th>
                    <td><?php echo $data["rams"]->capacity; ?> Gb</td>
                </tr>
                <tr>
                    <th>Órajel: </th>
                    <td><?php echo $data["rams"]->clock; ?> MHz</td>
                </tr>
                <tr>
                    <th>XMP Profil: </th>
                    <td><?php echo ((bool) $data["rams"]->is_xmp ? 'Támogatva' : 'Nem támogatott') ?></td>
                </tr>
                <tr>
                    <th><h4>Ár: </h4></th>
                    <td><h3 class="priceColor"><?php echo $data["rams"]->ramPrice ?> Ft</h3></td>
                </tr>
            </tbody>
        </table>
    </div>  <!-- COL END -->

</div> <!-- ROW END -->
<!-- <div class="row">
    <div class="col pb-5">
        <h1>Ár: <?php //echo $data["rams"]->ramPrice ?> Ft</h1>
    </div>
</div> -->
</div>

<?php require FOOTER; ?>