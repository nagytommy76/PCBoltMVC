<?php require HEADER; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col pt-5 pb-5">
            <div class="carousel slide" data-ride="carousel" id="carouselExampleIndicators">
            <ol class="carousel-indicators">
                <?php for($i=0;$i<count($data['result']->picUrl);$i++) : ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php  echo (($i == 0) ? 'active' : '');?>"></li>
                <?php endfor; ?>
            </ol>
            <div class="carousel-inner">
                <?php for($i=0;$i<count($data['result']->picUrl);$i++) : ?>
                <?php echo '<div class="carousel-item '.(($i==0) ? 'active' : '').'">'; ?> 
                    <a href="<?php echo $data['result']->picUrl[$i]; ?>" target="_blank"><img src="<?php   echo $data['result']->picUrl[$i];?>" class="d-block img-fluid"></a>
                <?php echo '</div>';?>
                <?php endfor; ?>
                
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
            </div> <!-- CAROUSEL SLIDE END -->
            <h1 class="pt-5">Ár: <?php echo $data['result']->ar ?> Ft</h1>
        </div> <!-- COL END -->
        <div class="col pt-5 pb-5">
            <h1 class="text-warning"><?php echo $data['result']->gyarto.' '.$data['result']->tipus; ?></h1>
            <table class="table table-hover text-white">
                <thead>
                    <tr>
                        <th scope="col">Tulajdonságok: </th>
                        <th scope="col"><a href="<?php echo $data['result']->Url?>" class="text-success" target="_blank">A termék gyártói honlapja</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Garancia: </th>
                        <td><?php echo $data['result']->warr_months; ?> Hónap</td>
                    </tr>
                    <tr>
                        <th>Gyártó: </th>
                        <td><?php echo $data['result']->gyarto; ?></td>
                    </tr>
                    <tr>
                        <th>Típus: </th>
                        <td><?php echo $data['result']->tipus; ?></td>
                    </tr>
                    <tr>
                        <th>Foglalat: </th>
                        <td><?php echo $data['result']->foglalat; ?></td>
                    </tr>
                    <tr>
                        <th>Órajel: </th>
                        <td><?php echo $data['result']->orajel; ?> MHz</td>
                    </tr>
                    <tr>
                        <th>Turbó órajel: </th>
                        <td><?php echo $data['result']->turbo_orajel; ?> MHz</td>
                    </tr>
                    <tr>
                        <th>Magok száma: </th>
                        <td><?php echo $data['result']->magok_szama; ?> Db</td>
                    </tr>
                    <tr>
                        <th>Szálak száma: </th>
                        <td><?php echo $data['result']->szalak_szama; ?> Db</td>
                    </tr>
                    <tr>
                        <th>Hűtő: </th>
                        <td><?php echo $data['result']->huto; ?></td>
                    </tr>
                    <tr>
                        <th>GPU: </th>
                        <td><?php echo $data['result']->gpu; ?></td>
                    </tr>
                    <tr>
                        <th>GPU Órajel: </th>
                        <td><?php echo $data['result']->gpu_orajel; ?> MHz</td>
                    </tr>
                    <tr>
                        <th>L3 Cache: </th>
                        <td><?php echo $data['result']->l3cache; ?> Mb</td>
                    </tr>
                    <tr>
                        <th>L2 Cache: </th>
                        <td><?php echo $data['result']->l2cache; ?> Mb</td>
                    </tr>
                </tbody>
            </table>
            <button name="Cart_<?php echo sha1($_SESSION['email']);?>" id="addToCart" class="btn btn-dark btn-block" <?php if(!isset($_SESSION["jog"])){ echo "disabled ";  echo 'title="Kérem jelentkezzen be a vásárláshoz!"';}else{echo 'title="A termék kosárba helyzezése"';} ?>  value=<?php echo 'cpu_'.$data['result']->cikkszam; ?> >Kosárba</button>
        </div>
    </div> <!-- ROW END -->
</div>


<?php require FOOTER; ?>