<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('includes/bootstrap/css/bootstrap.css'); ?>">

    <!-- Bootstrap JS -->
    <script src="<?php echo base_url('includes/bootstrap/js/bootstrap.js'); ?>"></script>

    <!-- JQuery JS -->
    <script src="<?php echo base_url('includes/jquery/jquery-3.5.1.js'); ?>"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('includes/css/globals.css'); ?>">

    <script>
        $(document).ready(function() {

            setTimeout(function() {

            }, 1000);

            $('#loader').hide();
            $('#right').show();


        });

        function showModel(header, message) {

            $('#model-header-text').text(header);
            $('#model-message-text').html(message);
            $('.message-model').css('display', 'block')

            $('#message_model_close').click(function() {

                $('.message-model').css('display', 'none')


            });

        }
    </script>



</head>

<body>

    <div class="row root-container">


        <div class="col-lg-3 col-md-4 col-sm-12 left-container">

            <div class="title-container">

                <img class="main-logo-icon" src="<?php echo base_url('includes/images/logo.svg') ?>" alt=""><br><br>
                <h5 class="main-logo-text inline text-center"><?php echo APP_NAME ?></h5>

                <br><br>
                <hr>


                <nav class="navbar">

                    <ul class="navbar-nav nav-single">

                        <li class="nav-single-item">

                            <img src="<?php echo base_url('includes/images/home.png') ?>" alt="">
                            <a class="nav-single-link <?php if ($title == 'Home') echo 'nav-selected'  ?>" href="<?php echo base_url('home'); ?>">Home</a>

                        </li>

                        <li class="nav-single-item">

                            <img src="<?php echo base_url('includes/images/stock.png') ?>" alt="">
                            <a class="nav-single-link  <?php if ($title == 'Stock') echo 'nav-selected'  ?>" href="<?php echo base_url('stocks'); ?>">Stock</a>

                        </li>

                        <li class="nav-single-item">

                            <img src="<?php echo base_url('includes/images/employees.png') ?>" alt="">
                            <a class="nav-single-link  <?php if ($title == 'Employees') echo 'nav-selected'  ?>" href="<?php echo base_url('employees'); ?>">Employees</a>

                        </li>

                        <br>
                        <hr>

                        <li class="nav-single-item">

                            <img src="<?php echo base_url('includes/images/my-account.png') ?>" alt="">
                            <a class="nav-single-link  <?php if ($title == 'My Account') echo 'nav-selected'  ?>" href="<?php echo base_url('account'); ?>">My Account</a>

                        </li>

                        <li class="nav-single-item">

                            <img src="<?php echo base_url('includes/images/info.png') ?>" alt="">
                            <a class="nav-single-link  <?php if ($title == 'Info') echo 'nav-selected'  ?>" href="<?php echo base_url('about'); ?>">About Us</a>

                        </li>


                    </ul>
                </nav>
            </div>

        </div>

        <div class="col-lg-9 col-md-8 col-sm-12 right-container">


            <div class="message-model">
                <div class="message-model-content">

                    <span id="message_model_close" style="padding: 12px;" class="close">&times;</span>

                    <div class="model-header">
                        <h4 id="model-header-text">
                        </h4>

                    </div>
                    <div class="model-message">
                        <h5 id="model-message-text">
                        </h5>
                    </div>
                </div>
            </div>


            <div style="text-align: center;" id="loader" class="loader"></div>

            <div id="right" style="display: none;" class="row">


                <div class="col-lg-6 col=md-6 col-sm-12 top-pager flex">

                    <h4 class="color-text-primary">Home</h4>
                    <img style="padding:10px; max-width:50px;max-height:40px" src="<?php echo base_url('includes/images/arrow-down.png') ?>" alt="">

                </div>

                <div class="col-lg-6 col=md-6 col-sm-12"">

                    <div class=" account-container">

                    <img src="<?php echo base_url('includes/images/account.png') ?>" alt="">
                    <b>Asif Sipra</b>


                </div>

            </div>

            <br><br>
            <br><br>


            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div style="background-color: #186485;" class="performance-container table">

                        <h4 class="performance-text text-center table-cell">Total Stocks: 54</h4>

                    </div>


                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div style="background-color: #851818;" class="performance-container table">

                        <h4 class="performance-text text-center table-cell">Total Stocks: 54</h4>

                    </div>



                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">

                    <div style="background-color: #558518;" class="performance-container table">

                        <h4 class="performance-text text-center table-cell">Total Stocks: 54</h4>


                    </div>
                </div>

            </div>

            <br><br>
            <br><br>

            <div class="main-container">