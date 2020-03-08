<?php include HEADER; ?>

<div class="container ">
    <div class="card bg-dark mb-5 mt-5" style="width: 100%;">
    <div class="card-header bg-primary">
        <h1 class="card-title"><?php echo $_SESSION['username'] ?> összesített kosártartalma!</h1>
    </div>

    <div id="summaryItems">
    <form action="<?php echo URLROOT;?>/carts/confirmOrders" method="POST">
    <div class="row"> 
    <div class="col">          
        <div class="card-body" id="summaryCartItems">        
            <h5 class="text-center">A kosár tartalma: </h5>            
            <?php foreach ($data['cartItems'] as $item) :  ?>
                <div class="media pb-4 border border-success m-3" id="<?php echo $item->cikkszam;?>">
                <a href="<?php echo URLROOT.'/'.$item->product_type.'s/details/'.$item->cikkszam; ?>" class="titleLink" target="_blank">
                    <img src="<?php echo $item->picUrl[0]; ?>" class="mr-3" id="mediaPicture">
                    <div class="media-body">
                    <h4 class="mt-0 text-white"><?php echo $item->manufacturer.' '.$item->product_name; ?></h4>
                    <h5 class="priceColor">
                        Ár: <span id="itemPrices"><?php echo (int)$item->price*(int)$item->quantity ?></span> Ft
                    </h5>
                </a>
                <input type="hidden" name="itemPricesHidden[]" id="itemPricesHidden" value="<?php echo (int)$item->price*(int)$item->quantity ?>">
                <input type="number" min="1" max="20" step="1" value="<?php echo $item->quantity ?>"name="numberOfItemsInSummary" id="numberOfItemsInSummary"class="form-control">
                <input type="hidden" name="itemPriceHidden" id="itemPriceHidden"value="<?php echo $item->price; ?>">
                <input type="hidden" name="itemType" id="itemType" value="<?php echo $item->product_type.'_'.$item->cikkszam ?>">
                <button type="button" class="btn btn-danger btn-sm mt-1" name="deleteFromCart" id="<?php echo $item->cikkszam;?>" value="<?php echo $item->product_type;?>">Törlés</button>
                </div>           
        </div>
            <?php endforeach; ?>
        
    </div> <!-- COL END!-->
    </div> <!--  ROW END  -->
    <!-- CART ITEMS OVER !!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
    <div class="col">
        <div class="card-body">
            <h5 class="text-center">Számlázási cím</h5>
                <div class="row">
                    <div class="col">
                        <label for="veznev">Vezetéknév:</label>
                        <input class="form-control" type="text" name="veznev" value="<?php echo $data['userDetails']->vezeteknev; ?>">
                    </div>
                    <div class="col">
                        <label for="kernev">Keresztnév:</label>
                        <input class="form-control" type="text" name="kernev" value="<?php echo $data['userDetails']->keresztnev; ?>">
                    </div>
                    <div class="col">
                        <label for="varos">Város:</label>
                        <input class="form-control" type="text" name="varos" value="<?php echo $data['userDetails']->varos; ?>">
                    </div>
                </div> <!-- ROW END -->
                <div class="row">
                    <div class="col">
                        <label for="irszam">IR. szám:</label>
                        <input class="form-control" type="number" name="irszam" value="<?php echo $data['userDetails']->irszam; ?>">
                    </div>
                    <div class="col">
                        <label for="utca">Utca:</label>
                        <input class="form-control" type="text" name="utca" value="<?php echo $data['userDetails']->utca; ?>">
                    </div>
                    <div class="col">
                        <label for="hazszam">Házszám:</label>
                        <input class="form-control" type="text" name="hazszam" value="<?php echo $data['userDetails']->hazszam; ?>">
                    </div>
                </div> <!-- ROW END -->
                <div class="row">
                    <div class="col">
                        <label for="emeletajto">Emelet/ajtó:</label>
                        <input class="form-control" type="text" name="emeletajto" value="<?php echo $data['userDetails']->emeletajto; ?>">
                    </div>
                    <div class="col">
                        <label for="szulido">Születési idő:</label>
                        <input class="form-control" type="date" name="szulido" value="<?php echo $data  ['userDetails']->szulido; ?>">
                    </div>
                </div> <!-- ROW END -->

            <div class="row">
                <div class="col pt-2">
                    <input type="checkbox" name="deliveryAddress"id="deliveryAddress" checked> A szállítási cím megegyezik a számlázásicímmel?
                </div>
            </div> <!-- ROW END -->
            <div class="row">
                <div class="col pt-2">
                    <input type="checkbox" name="anyMessage"id="anyMessage"> Megjegyzés a szállítással kapcsolatban:
                </div>
            </div> <!-- ROW END -->
            <div class="deliveryAdressOutput">

            </div> 

        </div>  <!-- CARD BODY END -->
    </div>  <!-- COL END  -->
    </div>  <!-- CARD END -->

    <div class="card-footer">  
        <h3 class="priceColor" id="finalPrice">Fizetendő végösszeg: <span id="finalPriceValue"><?php echo $data['finalPrice']; ?></span> Ft</h3>
        <input type="hidden" id="finalPriceValueHidden" name="finalPriceValue" value="<?php echo $data['finalPrice']; ?>">
        <input type="submit" name="confirmOrder" value="A rendelés leadása" class="btn btn-success btn-block btn-lg">                
    </div>  <!-- FOOTER END -->

    </form>
    </div> <!-- SUMMARYITEMS END  -->
    </div> <!-- CARD END  -->
</div> <!-- CONTAINER END -->   
       



<?php include FOOTER; ?>