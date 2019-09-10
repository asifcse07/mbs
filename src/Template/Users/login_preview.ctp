<!DOCTYPE html>
<html lang="en">
<head>
    <title>MBS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="img/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/my_app/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/my_app/font/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/my_app/css/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="/my_app/css/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/my_app/css/select2.min.css">
<!--===============================================================================================-->
<!--===============================================================================================-->
<?= $this->Html->css('main.css') ?>
<?= $this->Html->css('util.css') ?>
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100 loginDiv">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="/my_app/img/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form loginForm">
                    <input type="hidden" name="_csrfToken" autocomplete="off" value="<?php echo $token; ?>">
                    <span class="login100-form-title">
                        Customer Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100 email" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <!-- <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span> -->
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100 passcode" type="text" name="passcode" placeholder="passcode">
                        <span class="focus-input100"></span>
                        <!-- <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span> -->
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100 password" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                       <!--  <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span> -->
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn lognbtn">
                            Login
                        </button>
                    </div>

                    <!-- <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div> -->

                    <div class="text-center p-t-1">
                        <?php 
                            echo $this->Html->link(
                                'Create your Account',
                                '/users/registration',
                                ['class' => 'txt2']
                            );
                        ?>
                        <!-- <a class="txt2" href="#">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    

    
<!--===============================================================================================-->  
    <script src="/my_app/js/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="/my_app/js/popper.js"></script>
    <script src="/my_app/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="/my_app/js/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="/my_app/js/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<!--===============================================================================================-->
    <script src="/my_app/js/main.js"></script>
     <?php
        echo $this->Html->script('custom.js', array('inline' => false));
        echo $this->Html->script('notify.js', array('inline' => false));
    ?>
</body>
</html>