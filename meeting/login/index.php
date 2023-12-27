<?php $config_base = 'https://ckdvietnam.com/';?>
<link rel="icon" type="image/png" href="<?php echo $config_base . '/meeting/login/'; ?>images/icons/favicon.ico"/>

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>vendor/bootstrap/css/bootstrap.min.css?v=<?= rand(10, 10000); ?>">

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css?v=<?= rand(10, 10000); ?>">

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>fonts/iconic/css/material-design-iconic-font.min.css?v=<?= rand(10, 10000); ?>">

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>vendor/animate/animate.css?v=<?= rand(10, 10000); ?>">

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>vendor/css-hamburgers/hamburgers.min.css?v=<?= rand(10, 10000); ?>">

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>vendor/animsition/css/animsition.min.css?v=<?= rand(10, 10000); ?>">

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>vendor/select2/select2.min.css?v=<?= rand(10, 10000); ?>">

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>vendor/daterangepicker/daterangepicker.css?v=<?= rand(10, 10000); ?>">

<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>css/util.css?v=<?= rand(10, 10000); ?>">
<link rel="stylesheet" type="text/css"
      href="<?php echo $config_base . '/meeting/login/'; ?>css/main.css?v=<?= rand(10, 10000); ?>">

<div class="limiter">
    <div class="container-login100"
         style="background-image: url('<?php echo $config_base . '/meeting/login/'; ?>images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <div  enctype="multipart/form-data" class="login100-form validate-form" method="dialog" action="<?=$config_base . '/meeting/ajax_login.php'; ?>">
					<span class="login100-form-title p-b-49">
						Login
					</span>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                    <!--<span class="label-input100">Username</span>-->
                    <input class="input100" type="text" name="username" id="username" placeholder="Type your username" />
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
<!--                    <span class="label-input100">Password</span>-->
                    <input class="input100" type="password" name="password" id="password" placeholder="Type your password" />
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="text-center p-t-8 p-b-31">
                    <span class="error-log" style="color:indianred"></span>
                  <!--  <a href="#">
                        Change your password
                    </a>-->
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <a class="btn-login login100-form-btn" href="javascript:void(0)" onclick="login();">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/jquery/jquery-3.2.1.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/animsition/js/animsition.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/bootstrap/js/popper.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/bootstrap/js/bootstrap.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/select2/select2.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/daterangepicker/moment.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/daterangepicker/daterangepicker.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/countdowntime/countdowntime.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>js/main.js?v=<?= rand(10, 10000); ?>"></script>
