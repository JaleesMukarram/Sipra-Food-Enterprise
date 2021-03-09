<link rel="stylesheet" href="<?php echo base_url('includes/css/employees.css') ?>">

<div class="text-center">
    <br>
    <h2><b>Add New Employee</b></h2>
</div>


<form class="form-container enable" method="POST" id="employee-form" name="employee-form">

    <!-- First Row -->
    <div class="row form-single-row">

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="name">Name *</label><b class="form-error" id="name_error">Name required</b>
            <br>
            <input class="form-input" name="name" id="name" type="text" placeholder="Azam Khan">


        </div>

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="phone">Phone *</label><b class="form-error" id="phone_error">Valid phone required</b>
            <br>
            <input class="form-input" name="phone" id="phone" type="tel" pattern="[0-9]{4}=[0-9]{7}" placeholder="03XX-XXXXXXX">
        </div>
    </div>

    <!-- Second Row -->
    <div class="row form-single-row">

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="position">Position *</label><b class="form-error" id="position_error">Valid position required</b>
            <br>
            <input class="form-input" name="position" id="position" type="text" placeholder="Sales Executive">
        </div>

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="salary">Salary Rs *</label><b class="form-error" id="salary_error">Salary (1000=500000) required</b>
            <br>
            <input class="form-input" name="salary" id="salary" type="number" min="1000" max="500000" placeholder="30000">
        </div>
    </div>

    <!-- Third Row -->
    <div class="row form-single-row">

        <div class="col-lg-12 form-single-item">
            <label class="form-label" for="address">Address *</label><b class="form-error" id="address_error">Address required</b>
            <br>
            <input class="form-input" name="address" id="address" type="text" placeholder="Model Town C, Bahawalpur">
        </div>
    </div>

    <!-- Fourth Row -->
    <div class="row form-single-row">

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="joining_date">Joining Date *</label><b class="form-error" id="joining_date_error">Joinig Date required</b>
            <br>
            <input class="form-input" name="joining_date" id="joining_date" type="date" placeholder="15/1/2021">
            <br><br>
            <input class="form-input-radio" name="name" type="radio"> <b>Joined Today</b>
        </div>

        <div class="col-lg-6 col-sm-12 form-single-item">
            <label class="form-label" for="working">Working Status *</label>
            <br>
            <select class="form-input-select" name="working" id="working">
                <option value="1">Working</option>
                <option value="0">Not Working</option>
            </select>

        </div>
    </div>

    <!-- Fifth Row -->
    <div class="row form-single-row text-center">
        <div class="col-lg-12 form-single-item">
            <br><br>
            <input class="btn form-input-button" value="Add Employee" type="submit" name="submit" id="submit">

        </div>
    </div>
</form>

<div class="loader-internal none" id="loader_internal"></div><br>

<br><br>


<script>
    $(document).ready(function() {

        init();

    });

    function init() {

        $('#submit').click(function(event) {
            event.preventDefault();

            resetErrors();
            validateForm()

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
        let phone = $('#phone').val();
        if (phone.length != 12) {

            errorFocus('#phone');
            return false;
        }

        // Position Validation
        let position = $('#position').val();
        if (position.length <= 0) {

            errorFocus('#position');
            return false;
        }


        // Salary Validation
        let salary = $('#salary').val();
        if (salary <= 1000 || salary > 500000) {

            errorFocus('#salary');
            return false;
        }

        // Address Validation
        let address = $('#address').val();
        if (address.length <= 0) {

            errorFocus('#address');
            return false;
        }

        // Joning Date Validation
        let joining_date = $('#joining_date').val();
        if (joining_date.length <= 0) {

            errorFocus('#joining_date');
            return false;
        }

        let working = $('#working').val();


        sendFormViaAJAX(name, phone, position, salary, address, joining_date, working);

        return false;
    }

    function sendFormViaAJAX(name, phone, position, salary, address, joining_date, working) {

        onFormSending();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('employees/addnewemployee') ?>",
            data: {

                name: name,
                phone: phone,
                position: position,
                salary: salary,
                address: address,
                joining_date: joining_date,
                working: working

            },
            success: function(response) {

                if (response == 'done') {

                    onEmployeeAdded(name);
                }

                console.log(response);
                onFormSent();

            },
            error: function(error) {

                console.log(error);
                onFormSent();

            }
        });
    }

    function errorFocus(id) {

        $(id).focus();
        $(id + "_error").show();
    }


    function resetErrors() {

        $('#name_error').hide();
        $('#phone_error').hide();
        $('#position_error').hide();
        $('#salary_error').hide();
        $('#address_error').hide();
        $('#joining_date_error').hide();

    }

    function onFormSending() {

        console.log('onFormSending called');


        $('#loader_internal').removeClass('none');
        $('#loader_internal').addClass('block');

        $('#employee-form').removeClass('enable');
        $('#employee-form').addClass('disable');
    }

    function onFormSent() {

        console.log('onFormSent called');


        $('#loader_internal').removeClass('block');
        $('#loader_internal').addClass('none');

        $('#employee-form').removeClass('disalbe');
        $('#employee-form').addClass('enable');

    }

    function onEmployeeAdded(employeeName) {

        console.log('onEmployeeAdded called');

        $('#name').val('');
        $('#phone').val('');
        $('#position').val('');
        $('#salary').val('');
        $('#address').val('');
        $('#joining_date').val('');

        showModel('Employee ' + employeeName + ' Added', 'A new Employee has been Added');

    }
</script>