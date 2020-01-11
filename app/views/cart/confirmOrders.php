<?php include HEADER; ?>
<?php //var_dump($data['cartItems']) ;?>
<h1>Jkéfhskdalfgdsahg kgja klghl jdsafg kjlk</h1>

<div class="container">
    <!-- <h1 class="text-center pb-4 pt-5">Adatok helyességének ellenőrzése</h1>
    <div class="card bg-dark mb-5" style="width: 100%;">
    <div class="row text-center pt-4 pb-5">
        <section class="col">
            <h3 class="card-title">A kosár tartalma</h3>
            <?php foreach ($data['cartItems'] as $item) :  ?>
                <div class="media pb-4 border border-success m-3">
                    <a href="<?php echo URLROOT.'/'.$item->product_type.'s/details'.$item->cikkszam; ?>" class="titleLink" target="_blank">
                    <img src="<?php echo $item->picUrl[0]; ?>" class="mr-3" id="mediaPicture">
                    <div class="media-body">
                    <h4 class="mt-0 text-white"><?php echo $item->manufacturer.''.$item->product_name; ?></h4>
                    <h5 class="priceColor" id="itemPrices">
                        Ár: <?php echo (int)$item->price*(int)$item->quantity ?> Ft
                    </h5>
                    </a>
                    
                    <input type="number" value="<?php echo $item->quantity ?>"name="numberOfItemsInSummary" id="numberOfItemsInSummary"class="form-control">
                    <input type="hidden" name="itemPriceHidden" id="itemPriceHidden" value="<?php echo $item->price; ?>">
                </div>
                </div>                
            <?php endforeach; ?>        
        </section>
        <section class="col">
            <h3 class="card-title">Az adatok helyességének ellenőrzése</h3>
        </section>
    </div>
    </div> -->
        

</div>


<?php include FOOTER; ?>