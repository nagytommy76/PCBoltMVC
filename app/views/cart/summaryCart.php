<?php include HEADER; ?>

<div class="container ">
    <div class="row pt-5 pb-4">        
        <?php  ?>
        <div class="card bg-dark mb-5" style="width: 100%;">
        <form action="<?php echo URLROOT;?>/carts/checkOrder" method="POST">
            <div class="card-header bg-primary">
                <h1 class="card-title"><?php echo $_SESSION['username'] ?> összesített kosár tartalma!</h1>
            </div>
            <div class="card-body">
                <?php foreach ($data['cartItems'] as $item) :  ?>
                    <h1><?php //echo $item->quantity,' : '.$item->cikkszam; ?></h1>
                    <div class="media pb-4 border border-success m-3">
                    <a href="<?php echo URLROOT.'/'.$item->product_type.'s/details/'.$item->cikkszam; ?>" class="titleLink" target="_blank">
                      <img src="<?php echo $item->picUrl[0]; ?>" class="mr-3" id="mediaPicture">
                      <div class="media-body">
                        <h4 class="mt-0 text-white"><?php echo $item->manufacturer.' '.$item->product_name; ?></h4>
                        <h5 class="priceColor" id="itemPrices">
                            Ár: <?php echo (int)$item->price*(int)$item->quantity ?> Ft
                        </h5>
                        </a>
                        
                        <input type="number" value="<?php echo $item->quantity ?>" name="numberOfItemsInSummary" id="numberOfItemsInSummary" class="form-control">
                        <input type="hidden" name="itemPriceHidden" id="itemPriceHidden" value="<?php echo $item->price; ?>">
                      </div>
                    </div>
                
                <?php endforeach; ?>
                <h3 class="priceColor" id="finalPrice">Fizetendő végösszeg: <span id="finalPriceValue"><?php echo $data['finalPrice']; ?></span> Ft</h3>
            </div> <!-- CARD BODY END!-->
            <div class="card-footer">                
                <input type="submit" value="Tovább az adatok megadásához" class="btn btn-success btn-block btn-lg">                
            </div>
        </form>
        </div> <!-- CARD END-->         
    </div> <!-- ROW END-->    
</div> <!-- CONTAINER END -->


<?php include FOOTER; ?>