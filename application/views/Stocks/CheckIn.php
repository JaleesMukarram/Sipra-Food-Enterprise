<link rel="stylesheet" href="<?php echo base_url('includes/css/table.css') ?>">



<div class="container">

    <img class="icon-large" src="<?php echo $product->image_link ?>" alt="">
    <br><br>
    <h3><?php echo $product->name ?></h3>
    <br>
    <h4><?php echo $stock->name ?></h4>


</div>

<br><br>

<div class="text-center">
    <br>
    <h2><b>All CheckIns</b> <img class="icon-small" id="icon-add" src="<?php echo base_url('includes/images/plus.png') ?>" onclick="showAddForm();"> </h2>
</div>

<br><br>


<div class="none" id="add_container">

    <!-- Second Row -->
    <div class="row form-single-row">

        <div class="col-lg-12 form-single-item">
            <label class="form-label" for="amount">Check In Stock Amount *</label><b class="form-error" id="amount_error">Check In amount required</b>
            <br>
            <input class="form-input" name="amount" id="amount" type="number" placeholder="12">
        </div>
    </div>

    <!-- Third Row -->
    <div class="row form-single-row">

        <div class="col-lg-12 form-single-item">
            <label class="form-label" for="detail">Details *</label><b class="form-error" id="detail_error">Details required</b>
            <br>
            <input class="form-input" name="detail" id="detail" type="text" placeholder="This stock was updated on 12 Jan After buying from Cargo From Chima" value="<?php echo isset($employee) ? $employee->address : "" ?>">
        </div>
    </div>

    <div class="row form-single-row">

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="in_date">Check Out Date *</label><b class="form-error" id="in_date_error">Joinig Date required</b>
            <br>
            <input class="form-input" name="in_date" id="in_date" type="date" placeholder="15/1/2021">
            <br><br>
            <input class="form-input-radio" name="today" type="radio"> <b>Checked In Today</b>
        </div>
    </div>





    <!-- Fifth Row -->
    <div class="row form-single-row text-center">
        <div class="col-lg-12 form-single-item">
            <br>
            <input class="btn form-input-button" value="Add New CheckIn" type="submit" name="submit" id="submit">
            <br><br><br>

        </div>
    </div>

</div>


<table class="table">

    <thead>

        <tr>

            <th>CheckIn Amount</th>
            <th>Effect Amount</th>
            <th>In Date</th>
            <th>CheckIn Management</th>

        </tr>
    </thead>


    <tbody>

        <?php foreach ($checkIns as $key => $checkIn) { ?>

            <tr>

                <td><?php echo $checkIn->amount ?></td>
                <td><?php echo $checkIn->stock_after ?></td>
                <td><?php echo $checkIn->in_date ?></td>
                <td class="table-options">

                    <button class="btn btn-danger" onclick="confirmDelete(<?php echo $checkIn->id ?>)">Delete</button>

                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>



</div>


<script>
    addFormShown = false;

    stockID = <?php echo $stock->id ?>;

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
        let amount = $('#amount').val();
        if (amount == '' || amount <= 0) {

            errorFocus('#amount');
            return false;
        }

        // Name Validation
        let detail = $('#detail').val();
        if (detail.length <= 0) {


            errorFocus('#detail');
            return false;
        }

        // Out Date Validation
        let in_date = $('#in_date').val();
        if (in_date.length <= 0) {

            errorFocus('#in_date');
            return false;
        }

        console.log('ready');
        sendFormViaAJAX(amount, detail, in_date);

        return false;
    }

    function confirmDelete(id) {

        if (confirm("Are you sure to delete this check In")) {

            sendDeleteAJAX(id);

        }

    }

    function sendFormViaAJAX(amount, detail, in_date) {


        $.ajax({
            type: "POST",
            url: "<?php echo base_url('stocks/addcheckin') ?>",
            data: {

                amount: amount,
                detail: detail,
                in_date: in_date,
                stock_id: stockID


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

        $('#amount_error').hide();
        $('#detail_error').hide();
        $('#in_date_error').hide();

    }

    function errorFocus(id) {

        $(id).focus();
        $(id + "_error").show();
    }


    function sendDeleteAJAX(id) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('stocks/deletecheckin') ?>",
            data: {
                id: id
            },
            success: function(response) {

                response = JSON.parse(response);

                if (response.status == 'done') {

                    location.reload();
                }

            },
            error: function(error) {

                console.log(error);

            }
        });

    }
</script>