<form class="form-container enable" method="POST" id="product-form" name="product-form">

    <!-- First Row -->
    <div class="row form-single-row">

        <div class="col-lg-12 form-single-item">
            <label class="form-label" for="name">Product Name *</label><b class="form-error" id="name_error">Name required</b>
            <br>
            <input class="form-input" name="name" id="name" type="text" placeholder="Pepsi">


        </div>
    </div>

    <!-- Second Row -->
    <div class="row form-single-row">

        <div class="col-lg-12 form-single-item">
            <label class="form-label" for="name">Product Description *</label><b class="form-error" id="description_error">Description required</b>
            <br>
            <textarea class="form-text-area" name="description" id="description" cols="30" rows="3" placeholder="Pepsi products including crate, bottles and tin cans"></textarea>

        </div>
    </div>

    <!-- Third Row -->
    <div class="row form-single-row">

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="position">Product Image *</label><b class="form-error" id="position_error">Product Image required</b><br>
            <img class="form-upload-image-container" id="image_preview" src="<?php echo base_url('includes/images/default.png') ?>"><br><br>
            <input type="file" name="product_image_file" id="product_image_file" onchange="readURL(this);" accept="image/">

        </div>

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="salary">Unit Price Rs *</label>
            <input class="form-input" name="price" id="price" type="number" min="1000" max="500000" placeholder="30000">
            <b class="form-error" id="price_error">Unit Price (1000=500000) required</b>
            <br>
        </div>
    </div>


    <!-- Fourth Row -->
    <div class="row form-single-row text-center">
        <div class="col-lg-12 form-single-item">
            <br><br>
            <input class="btn form-input-button" value="Add Product" type="submit" name="submit" id="submit">

        </div>
    </div>
</form>

<script>
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

        // Phone Validation
        let description = $('#description').val();
        if (description.length <= 0) {

            errorFocus('#description');
            return false;
        }

        // Position Validation
        let price = $('#price').val();
        if (price.length <= 0) {

            errorFocus('#price');
            return false;
        }

        sendProductToServer();

        return false;
    }

    function sendProductToServer() {

        var data = new FormData(document.getElementById('product-form'));

        $.ajax({

            type: 'POST',
            url: 'addNewProduct',
            processData: false,
            contentType: false,
            cache: false,
            data: data,

            success: function(data) {

                console.log(data);
            },

            error: function(error) {

                console.log(error);

            }

        });

    }

    function errorFocus(id) {

        $(id).focus();
        $(id + "_error").show();
    }


    function resetErrors() {

        $('#name_error').hide();
        $('#description_error').hide();
        $('#price_error').hide();

    }

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {

                $('#image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>