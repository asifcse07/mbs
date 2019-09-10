<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Customer Registration</title>

    <!-- Icons font CSS-->
    <link href="/my_app/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="/my_app/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="/my_app/css/select2.min.css" rel="stylesheet" media="all">
    <link href="/my_app/css/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="/my_app/css/registration.css" rel="stylesheet" media="all">
</head>
<!-- p-t-130 p-b-100 -->
<body>
    <div class="page-wrapper bg-gra-01 font-poppins register">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>
                    <form method="POST" class="registerForm">
                        <input type="hidden" name="_csrfToken" autocomplete="off" value="<?php echo $token; ?>">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">First name</label>
                                    <input class="input--style-4 first_name" type="text" name="first_name" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Last name</label>
                                    <input class="input--style-4 last_name" type="text" name="last_name" autocomplete="off">
                                </div>
                                
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" checked="checked" name="gender" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender" value="2">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Birthday</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker birthday" type="text" name="birthday" autocomplete="off">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4 email" type="email" name="email" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Mobile no</label>
                                    <input class="input--style-4 mobile_no" type="text" name="mobile_no">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Passcode</label>
                                    <input class="input--style-4 passcode" type="text" name="passcode" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4 password" type="password" name="password" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue registerBtn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="/my_app/js/jquery-3.2.1.min.js"></script>
    <!-- Vendor JS-->
    <script src="/my_app/js/select2.min.js"></script>
    <script src="/my_app/js/moment.min.js"></script>
    <script src="/my_app/js/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="/my_app/js/global.js"></script>
    <?php
        echo $this->Html->script('custom.js', array('inline' => false));
        echo $this->Html->script('notify.js', array('inline' => false));
    ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->