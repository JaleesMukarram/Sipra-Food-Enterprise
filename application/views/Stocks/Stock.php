<link rel="stylesheet" href="<?php echo base_url('includes/css/stock.css') ?>">

<div class="text-center">
    <br>
    <h2><b>All Products</b> <img class="icon-small" src="<?php echo base_url('includes/images/plus.png') ?>" onclick="location.href = '<?php echo base_url("stocks/addproduct") ?>' "> </h2>
</div>

<br><br>



<div class="row">

    <?php foreach ($products as $key => $product) {
    ?>

        <a class="col-lg-4 col-md-6 col-sm-12 single-product-container" href='<?php echo base_url("stocks/product/?id=$product->id") ?>'>

            <div class="text-center single-product">

                <div>
                    <img class="single-product-image" src="<?php echo $product->image_link ? $product->image_link : base_url('includes/default.png') ?>" alt="">

                </div>

                <br><br>

                <h4><?php echo $product->name ?></h4>
                <br>

            </div>

        </a>

    <?php } ?>

</div>