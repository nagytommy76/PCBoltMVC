<?php require HEADER; ?>

<div class="container-fluid pt-5 pb-5">
    <div class="row">
        <div class="col">
            <?php
            flash('pdfNotExists'); 
            flash('order_success');
            flash('mailer_exception');
            ?>

    <h1><?php echo $data['page_title'] ?></h1>
    <div class="accordion" id="accordionExample">
        <?php foreach($data['allOrders'] as $key => $orders) : ?>
        <div class="card bg-dark">
            <div class="card-header" id="heading<?php echo $key; ?>">
                <h2 class="mb-0">
                    <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapse<?php echo $key; ?>" <?php echo ($key==0?'aria-expanded="true"':'aria-expanded="false"'); ?> aria-controls="collapse<?php echo $key; ?>"><?php echo $orders->orderedAt; ?></button>
                </h2>                
            </div> <!-- CARD HEADER END -->
            <!-- COLLAPSE ONE -->
            <div id="collapse<?php echo $key; ?>" class="collapse show" aria-labelledby="heading<?php echo $key; ?>" data-parent="#accordionExample">
                <div class="card-body">
                    <h2>Rendelés dátuma: <?php echo $orders->orderedAt; ?></h2>
                    <h4>A rendelés száma: <strong><?php echo $orders->orderCode ?></strong></h4>
                    <h5>Termékek: </h5>
                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th scope="col"># </th>
                                <th scope="col">Megnevezés: </th>
                                <th scope="col">Ár: </th>
                                <th scope="col">Egységár: </th>
                                <th scope="col">Mennyiség: </th>
                                <th scope="col">Cikkszám: </th>
                                <th scope="col">Garancia: </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders->cartItems as $item) : ?>
                                <tr>
                                    <td><img src="<?php echo $item->picUrl[0]; ?>" id="mediaPicture"></td>
                                    <td><a target="_blank" href="<?php echo URLROOT.'/'.$item->productType.'s/details/'.$item->cikkszam; ?>" class="titleLink"><?php echo $item->manufacturer.' '.$item->product_name ?></a></td>
                                    <td><?php echo (int)$item->price.' Ft'; ?></td>
                                    <td><?php echo ((int)$item->price*(int)$item->quantity).' Ft'; ?></td>
                                    <td><?php echo $item->quantity.' Db'; ?></td>
                                    <td><?php echo $item->cikkszam; ?></td>
                                    <td><?php echo $item->warr_months.' Hónap'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <h3>A rendelés összértéke: <strong class="priceColor"><?php echo ($orders->orderPrice); ?></strong> Ft</h3>
                    <form action="<?php echo URLROOT?>/carts/showAnOrderPDF" method="POST">
                        <input type="hidden" name="billCode" value="<?php echo $orders->orderCode; ?>">
                        <input type="hidden" name="userName" value="<?php echo $data['username']; ?>">
                        <input type="submit" name="getPdf" value="Számla megtekintése és letöltése" class="btn btn-lg btn-warning">
                    </form>
                </div> <!-- CARD BODY END -->
            </div>
            <!-- COLLAPSE ONE END -->
        </div> <!-- CARD END -->
        <?php endforeach; ?>
    </div> <!-- accordion END -->
    </div> <!-- COL END -->
    </div> <!-- ROW END -->
</div>




<?php require FOOTER; ?>