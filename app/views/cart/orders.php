<?php require HEADER; ?>

<div class="container pt-5 pb-5">
    <h1>Korábbi vásárlások</h1>

    <div class="accordion" id="accordionExample">
        <?php foreach($data['allOrders'] as $key => $orders) : ?>
        <div class="card bg-dark">
            <div class="card-header" id="heading<?php echo $key; ?>">
                <h2 class="mb-0">
                    <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapse<?php echo $key; ?>" aria-expanded="<?php echo ($key==0?'true':'false') ?>" aria-controls="collapse<?php echo $key; ?>"><?php echo $orders->orderedAt; ?></button>
                </h2>                
            </div> <!-- CARD HEADER END -->
            <!-- COLLAPSE ONE -->
            <div id="collapse<?php echo $key; ?>" class="collapse show" aria-labelledby="heading<?php echo $key; ?>" data-parent="#accordionExample">
                <div class="card-body">
                    <h1>Ide jönnek az egyéb adatok....</h1>
                    <p>A rendelés száma: <strong><?php echo $orders->orderCode ?></strong></p>
                    <h3>Termékek: </h3>
                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th scope="col">Megnevezés: </th>
                                <th scope="col">Egységár: </th>
                                <th scope="col">Cikkszám: </th>
                                <th scope="col">Garancia: </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //foreach($orders->cartItems as $item) : ?>
                                <tr>
                                    <!-- <a target="_blank" href="<?php //echo URLROOT.'/' ?>"> -->
                                    <td><?php var_dump($item); ?></td>
                                    <td><?php //echo $item->price.' Ft'; ?></td>
                                    <td><?php //var_dump($item); ?></td>
                                    <!-- </a> -->
                                </tr>
                            <?php// endforeach; ?>
                        </tbody>
                    </table>

                    <p>ITT MEG LEHESSEN NYITNI A PDF SZÁMLÁT BLANK/HELYBEN..............</p>
                    <?php //var_dump($orders); ?>
                </div>
            </div>
            <!-- COLLAPSE ONE END -->
        </div> <!-- CARD END -->
        <?php endforeach; ?>
    </div> <!-- accordion END -->
</div>




<?php require FOOTER; ?>