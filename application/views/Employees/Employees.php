<link rel="stylesheet" href="<?php echo base_url('includes/css/employees.css'); ?>">

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

        <?php foreach ($employees as $key => $value) { ?>

            <tr class="available">

                <td><?php echo $value->id ?></td>
                <td><?php echo $value->name ?></td>
                <td><?php echo $value->position ?></td>
                <td><?php echo $value->salary ?></td>
                <td><?php echo $value->phone ?></td>
                <td><?php echo $value->name ?></td>

            </tr>
        <?php } ?>

    </tbody>





</table>