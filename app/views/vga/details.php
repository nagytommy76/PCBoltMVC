<?php require HEADER; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 pt-5">
            <div class="carousel slide pb-5 mx-auto" data-ride="carousel" id="carouselExampleIndicators">
            <ol class="carousel-indicators">
                <?php for($i=0;$i<count($data['vgas']->picUrl);$i++) : ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php echo (($i == 0) ? 'active' : '');?>"></li>
                <?php endfor; ?>
            </ol>
            <div class="carousel-inner">
                <?php for($i=0;$i<count($data['vgas']->picUrl);$i++) : ?>
                <?php echo '<div class="carousel-item '.(($i==0) ? 'active' : '').'">'; ?>
                    <a href="<?php echo $data['vgas']->picUrl[$i]; ?>" target="_blank"><img src="<?php echo $data['vgas']->picUrl[$i];?>" class="d-block img-fluid"></a>
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
            </div> <!-- carousel END -->
            <button name="Cart_<?php echo sha1($_SESSION['email']);?>" id="addToCart" class="btn btn-warning btn-block" <?php if(!isset($_SESSION["jog"])){ echo "disabled ";  echo 'title="Kérem jelentkezzen be a vásárláshoz!"';}else{echo 'title="A termék kosárba helyzezése"';} ?>  value=<?php echo 'vga_'.$data['vgas']->cikkszam; ?> >Kosárba</button>

            <?php if(isset($_SESSION['jog'])) :?>
                <?php if(bothAdminSeller($_SESSION['jog'])) :?>
                <form action="<?php echo URLROOT;?>/admins/vga_input/<?php echo $data['vgas']->cikkszam;?>" method="POST">
                    <input type="submit" name="editVGA" value="Módosítás" class="btn btn-block mt-2"
                    id="buttonColor">
                </form>
                <?php endif; ?>
            <?php endif; ?>
            
        </div> <!-- COL END -->
        <div class="col-md-8 pt-5">
            <h1 class="text-center"><?php echo $data['vgas']->manufacturer.' '.$data['vgas']->type; ?></h1>
            <table class="table table-hover text-white pb-5">
                <thead>
                    <tr>
                        <th scope="col">Tulajdonságok</th>
                        <th scope="col"><a class="text-success" target="_blank" href="<?php echo $data['vgas']->Url; ?>">Terék gyártói honlapja</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Garancia:</td>
                        <td><?php echo $data['vgas']->warr_months; ?> Hónap</td>
                    </tr>
                    <tr>
                        <td>Gyártó:</td>
                        <td><?php echo $data['vgas']->manufacturer; ?></td>
                    </tr>
                    <tr>
                        <td>Terméknév:</td>
                        <td><?php echo $data['vgas']->type; ?></td>
                    </tr>
                    <tr>
                        <td>Termékkód:</td>
                        <td><?php echo ($data['vgas']->typeCode == '' ? 'Nincs' : $data['vgas']->typeCode); ?></td>
                    </tr>
                    <tr>
                        <td>GPU Frekvencia:</td>
                        <td><?php echo $data['vgas']->gpu_clock; ?> MHz</td>
                    </tr>
                    <tr>
                        <td>GPU Peak/Turbó frekvencia:</td>
                        <td><?php echo $data['vgas']->gpu_peak; ?> MHz</td>
                    </tr>
                    <tr>
                        <td>VRAM Mennyiség:</td>
                        <td><?php echo $data['vgas']->vram_capacity; ?> Gb</td>
                    </tr>
                    <tr>
                        <td>VRAM adatátvitel:</td>
                        <td><?php echo $data['vgas']->vram_bandwidth; ?> bit</td>
                    </tr>
                    <tr>
                        <td>VRAM Frekvencia:</td>
                        <td><?php echo $data['vgas']->vram_clock; ?> MHz</td>
                    </tr>
                    <tr>
                        <td>VRAM Típusa:</td>
                        <td><?php echo $data['vgas']->vram_type; ?></td>
                    </tr>
                    <tr>
                        <td>Tápcsatlakozók:</td>
                        <td><?php echo $data['vgas']->power_pin; ?></td>
                    </tr>
                    <tr>
                        <td>Fogyasztás:</td>
                        <td><?php echo $data['vgas']->power_consumption; ?> W</td>
                    </tr>
                    <tr>
                        <td>PCI-Expressz típusa:</td>
                        <td><?php echo $data['vgas']->pci_type; ?></td>
                    </tr>
                    <tr>
                        <td>DirectX verzió:</td>
                        <td><?php echo $data['vgas']->directX; ?></td>
                    </tr>
                    <tr>
                        <td>DiplayPort:</td>
                        <td><?php echo $data['vgas']->displayPort; ?> db</td>
                    </tr>
                    <tr>
                        <td>HDMI:</td>
                        <td><?php echo $data['vgas']->HDMI; ?> db</td>
                    </tr>
                    <tr>
                        <td>DVI:</td>
                        <td><?php echo $data['vgas']->DVI; ?> db</td>
                    </tr>
                    <?php if(isset($_SESSION['jog'])) : ?>
                        <?php if(bothAdminSeller($_SESSION['jog'])) : ?>
                            <tr>
                                <td>Raktáron lévő termékek:</td>
                                <td><?php echo $data['vgas']->vga_stock; ?> db</td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                    <tr>
                        <td><h3>Ár:</h3></td>
                        <td class="priceColor"><h3><?php echo $data['vgas']->price; ?> Ft</h3></td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- COL END -->
    </div> <!-- ROW END -->
</div>

<?php require FOOTER; ?>