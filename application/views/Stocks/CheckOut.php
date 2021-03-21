<link rel="stylesheet" href="<?php echo base_url('includes/css/table.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('includes/css/check-out.css') ?>">




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
    <h2><b>All CheckOuts</b> <img class="icon-small" id="icon-add" src="<?php echo base_url('includes/images/plus.png') ?>" onclick="showAddForm();"> </h2>
</div>


<br><br>


<div class="none" id="add_container">

    <!-- First Row -->
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

    <!-- Fourth Row -->
    <div class="row form-single-row">

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="out_date">Check Out Date *</label><b class="form-error" id="out_date_error">Joinig Date required</b>
            <br>
            <input class="form-input" name="out_date" id="out_date" type="date" placeholder="15/1/2021" value="<?php echo isset($employee) ? $employee->joining_date : "" ?>">
            <br><br>
            <input class="form-input-radio" name="today" type="radio"> <b>Checked Out Today</b>
        </div>

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="employee_id">Given Employee *</label>
            <br>
            <select class="form-input-select" name="employee_id" id="employee_id">

                <?php foreach ($employees as $employee) : ?>
                    <option value="<?php echo $employee->id ?>"> <?php echo $employee->name ?> </option>
                <?php endforeach ?>
            </select>

        </div>
    </div>

    <!-- Fifth Row -->
    <div class="row form-single-row text-center">
        <div class="col-lg-12 form-single-item">

            <input class="btn form-input-button" value="Add New CheckOut" type="submit" name="submit" id="submit">
            <br><br><br>

        </div>
    </div>

</div>



<table class="table">

    <thead>

        <tr>

            <th>CheckOut Amount</th>
            <th>Effect Amount</th>
            <th>Out Date</th>
            <th>Employee</th>
            <th>CheckOut Management</th>

        </tr>
    </thead>


    <tbody>

        <?php foreach ($checkOuts as $key => $checkout) { ?>

            <tr>

                <td><?php echo $checkout->amount ?></td>
                <td><?php echo $checkout->stock_after ?></td>
                <td><?php echo $checkout->out_date ?></td>
                <td><?php echo $checkout->name ?></td>

                <td class="table-options">

                    <?php if (isset($checkout->status)) : ?>

                        <?php echo $checkout->status; ?>
                        
                    <?php else : ?>

                        <button class="btn btn-primary" onclick="showCheckOutReturn(<?php echo $checkout->id ?>)">Add Return</button>

                    <?php endif ?>


                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>


<br><br>

<div class="none" id="return_container">

    <!-- First Row -->
    <div class="row form-single-row">

        <div class="col-lg-12 form-single-item">
            <label class="form-label" for="r_amount">Return Amount *</label><b class="form-error" id="r_amount_error">Return amount required</b>
            <br>
            <input class="form-input" name="r_amount" id="r_amount" type="number" placeholder="12">
        </div>
    </div>

    <!-- Third Row -->
    <div class="row form-single-row">

        <div class="col-lg-12 form-single-item">
            <label class="form-label" for="r_detail">Details *</label><b class="form-error" id="r_detail_error">Details required</b>
            <br>
            <input class="form-input" name="r_detail" id="r_detail" type="text" placeholder="This stock was returned on 12 Jan After buying sale">
        </div>
    </div>

    <!-- Fourth Row -->
    <div class="row form-single-row">

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="return_date">Return Date *</label><b class="form-error" id="return_date_error">Return Date required</b>
            <br>
            <input class="form-input" name="return_date" id="return_date" type="date" placeholder="15/1/2021">
            <br><br>
            <input class="form-input-radio" name="today" type="radio"> <b>Returned Today</b>
        </div>

    </div>

    <!-- Fifth Row -->
    <div class="row form-single-row text-center">
        <div class="col-lg-12 form-single-item">

            <input class="btn form-input-button" value="Add Return" type="submit" name="r_submit" id="r_submit">
            <br><br><br>

            <input id="stock_out_id" type="hidden">

        </div>
    </div>

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

        $('#r_submit').click(function(event) {
            event.preventDefault();

            resetErrors();
            validateReturnForm();

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
        let out_date = $('#out_date').val();
        if (out_date.length <= 0) {

            errorFocus('#out_date');
            return false;
        }

        let employee_id = $('#employee_id').val();


        console.log('ready');
        sendFormViaAJAX(amount, detail, out_date, employee_id);

        return false;
    }

    function validateReturnForm() {

        // Name Validation
        let r_amount = $('#r_amount').val();
        if (r_amount == '' || r_amount < 0) {

            errorFocus('#r_amount');
            return false;
        }

        // Name Validation
        let r_detail = $('#r_detail').val();
        if (r_detail.length <= 0) {


            errorFocus('#r_detail');
            return false;
        }

        // Out Date Validation
        let return_date = $('#return_date').val();
        if (return_date.length <= 0) {

            errorFocus('#return_date');
            return false;
        }

        // Name Validation
        let stock_out_id = $('#stock_out_id').val();
        if (stock_out_id == '' || r_amount < 0) {

            errorFocus('#stock_out_id');
            return false;
        }

        sendReturnFormViaAJAX(r_amount, r_detail, return_date, $('#stock_out_id').val())

    }

    function sendReturnFormViaAJAX(r_amount, r_detail, return_date, stock_out_id) {


        $.ajax({
            type: "POST",
            url: "<?php echo base_url('stocks/addcheckoutreturn') ?>",
            data: {

                amount: r_amount,
                detail: r_detail,
                return_date: return_date,
                stock_out_id: stock_out_id


            },
            success: function(response) {

                // response = JSON.parse(response);

                // if (response.status == 'done') {

                //     location.reload();
                // }

                console.log(response);

            },
            error: function(error) {

                console.log(error);

            }
        });
    }

    function sendFormViaAJAX(amount, detail, out_date, employee_id) {


        $.ajax({
            type: "POST",
            url: "<?php echo base_url('stocks/addcheckout') ?>",
            data: {

                amount: amount,
                detail: detail,
                out_date: out_date,
                employee_id: employee_id,
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

    function confirmDelete(id) {

        if (confirm("Are you sure to delete this check out")) {

            sendDeleteAJAX(id);

        }

    }


    function sendDeleteAJAX(id) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('stocks/deletecheckout') ?>",
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
        $('#out_date_error').hide();

        $('#r_amount_error').hide();
        $('#r_detail_error').hide();
        $('#return_date_error').hide();

    }

    function errorFocus(id) {

        $(id).focus();
        $(id + "_error").show();
    }

    function showCheckOutReturn(stock_out_id) {

        $('#stock_out_id').val(stock_out_id);
        $('#return_container').show();

    }
</script>