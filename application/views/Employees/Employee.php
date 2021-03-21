<link rel="stylesheet" href="<?php echo base_url('includes/css/employees.css'); ?>">

<div>

    <div class="single-info-container row">

        <div class="col-lg-4 col-md-6 single-info-label">
            <h5>ID</h5>
        </div>
        <div class="col-lg-8 col-md-6 single-info-text">
            <h5><?php echo $employee->id ?></h5>
        </div>
    </div>

    <div class="single-info-container row">

        <div class="col-lg-4 col-md-6 single-info-label">
            <h5>Name</h5>
        </div>
        <div class="col-lg-8 col-md-6 single-info-text">
            <h5><?php echo $employee->name ?></h5>
        </div>
    </div>


    <div class="single-info-container row">

        <div class="col-lg-4 col-md-6 single-info-label">
            <h5>Phone</h5>
        </div>
        <div class="col-lg-8 col-md-6 single-info-text">
            <h5><?php echo $employee->phone ?></h5>
        </div>
    </div>


    <div class="single-info-container row">

        <div class="col-lg-4 col-md-6 single-info-label">
            <h5>Address</h5>
        </div>
        <div class="col-lg-8 col-md-6 single-info-text">
            <h5><?php echo $employee->address ?></h5>
        </div>
    </div>

    <div class="single-info-container row">

        <div class="col-lg-4 col-md-6 single-info-label">
            <h5>Position</h5>
        </div>
        <div class="col-lg-8 col-md-6 single-info-text">
            <h5><?php echo $employee->position ?></h5>
        </div>
    </div>

    <div class="single-info-container row">

        <div class="col-lg-4 col-md-6 single-info-label">
            <h5>Joining Date</h5>
        </div>
        <div class="col-lg-8 col-md-6 single-info-text">
            <h5><?php echo $employee->joining_date ?></h5>
        </div>
    </div>

    <div class="single-info-container row">

        <div class="col-lg-4 col-md-6 single-info-label">
            <h5>Working Status</h5>
        </div>
        <div class="col-lg-8 col-md-6 single-info-text">
            <?php $imageURL =  $employee->working ? 'tick.png' : 'cross.png' ?>
            <img class="icon-small" src="<?php echo  base_url("includes/images/" . $imageURL) ?>">
        </div>
    </div>

    <br><br>

    <div class="text-center">
        <button class="btn form-input-button" onclick="location.href='<?php echo base_url("employees/addemployee/?id=$employee->id") ?>'">Edit Employee</button>
    </div>


    <br>

</div>