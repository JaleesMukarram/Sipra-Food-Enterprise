<link rel="stylesheet" href="<?php echo base_url('includes/css/employees.css'); ?>">

<div class="text-center">
    <br>
    <h2><b>All Employees</b> <img class="icon-small" src="<?php echo base_url('includes/images/plus.png') ?>" onclick="location.href = '<?php echo base_url("employees/addemployee") ?>' "> </h2>
</div>

<br><br>

<table class="table">

    <thead>

        <tr>

            <th>S. No</th>
            <th>Name</th>
            <th>Position</th>
            <th>Salary Rs</th>
            <th>Phone</th>
            <th>Manage</th>

        </tr>
    </thead>


    <tbody>

        <?php foreach ($employees as $key => $employee) { ?>

            <tr class="<?php echo $employee->working? 'available' : 'unavailable' ?>">

                <td><?php echo $employee->id ?></td>
                <td><?php echo $employee->name ?></td>
                <td><?php echo $employee->position ?></td>
                <td><?php echo $employee->salary ?></td>
                <td><?php echo $employee->phone ?></td>
                <td>

                <button class="btn btn-secondary" onclick="location.href='<?php echo base_url("employees/employee/?id=$employee->id") ?>'">Manage</button>
                
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>