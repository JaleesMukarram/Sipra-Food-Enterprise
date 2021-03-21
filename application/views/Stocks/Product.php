<link rel="stylesheet" href="<?php echo base_url('includes/css/table.css') ?>">


<div class="container">

    <img class="icon-large" src="<?php echo $product->image_link ?>" alt="">
    <br><br>
    <h3><?php echo $product->name ?></h3>

</div>



<br>

<div class="text-center">
    <br>
    <h2><b>All Stock</b> <img class="icon-small" id="icon-add" src="<?php echo base_url('includes/images/plus.png') ?>" onclick="showAddForm();"> </h2>
</div>

<br><br>


<div class="none" id="add_container">

    <div class="row form-single-row">
        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="name">Name *</label><b class="form-error" id="name_error">Name required</b>
            <br>
            <input class="form-input" name="name" id="name" type="text" placeholder="Pepsi 1.5ltr crate stock" </div>
        </div>
    </div>


    <div class="row form-single-row">

        <div class="col-lg-12 form-single-item text-left">
            <input class="btn form-input-button" value="Add Stock" type="submit" name="submit" id="submit">
        </div>

        <br><br>
    </div>
    <br><br><br>

</div>



<table class="table">

    <thead>

        <tr>

            <th>Stock Name</th>
            <th>Stock Amount</th>
            <th>Stock Management</th>

        </tr>
    </thead>


    <tbody>

        <?php foreach ($stocks as $key => $stock) { ?>

            <tr>

                <td><?php echo $stock->name ?></td>
                <td><?php echo $stock->amount ?></td>
                <td class="table-options">

                    <button class="btn btn-primary" onclick="location.href='<?php echo base_url("stocks/checkout?id=$stock->id") ?>'">Checkout</button>
                    <button class="btn btn-success" onclick="location.href='<?php echo base_url("stocks/checkin?id=$stock->id") ?>'">Checkin</button>
                    <button class="btn btn-danger" onclick="location.href='<?php echo base_url("stocks/checkout?id=$stock->id") ?>'">Delete</button>

                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>




<script>
    addFormShown = false;
    productID = <?php echo $product->id; ?>


    $(document).ready(function() {

        init();

    });

    function init() {

        $('#submit').click(function(event) {
            event.preventDefault();

            resetErrors();
            validateForm();

        });

    }

    function validateForm() {

        // Name Validation
        let name = $('#name').val();
        if (name.length <= 0) {

            errorFocus('#name');
            return false;
        }

        sendFormViaAJAX(name);

        return false;
    }


    function sendFormViaAJAX(name) {


        $.ajax({
            type: "POST",
            url: "<?php echo base_url('stocks/addnewstock') ?>",
            data: {

                product_id: productID,
                name: name


            },
            success: function(response) {

                response = JSON.parse(response);

                if (response.status == 'done') {

                    location.reload();
                }

                console.log(response);

            },
            error: function(error) {

                console.log(error);

            }
        });
    }


    function showAddForm() {

        if (addFormShown) {

            $('#add_container').hide();
            $('#icon-add').attr('src', '<?php echo base_url('includes/images/plus.png') ?>');

            addFormShown = false;

        } else {

            $('#add_container').show();
            $('#icon-add').attr('src', '<?php echo base_url('includes/images/up-arrow.png') ?>');

            addFormShown = true;

        }

    }

    function resetErrors() {

        $('#name_error').hide();

    }

    function errorFocus(id) {

        $(id).focus();
        $(id + "_error").show();
    }
</script>