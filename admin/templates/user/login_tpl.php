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
            <form enctype="multipart/form-data">
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
                    <div class="alert my-alert alert-login d-none text-center text-sm p-2 mb-0 mt-2" role="alert"></div>
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

<?php /*<div class="login-copyright text-sm">Powered by <a href="//nina.vn" target="_blank" title="Thiết Kế Website Nina">Thiết Kế Website Nina</a></div>*/?>

<!-- Login js -->
<script type="text/javascript">
	function login()
	{
		var username = $("#username").val();
		var password = $("#password").val();

		if($(".alert-login").hasClass("alert-danger") || $(".alert-login").hasClass("alert-success"))
		{
			$(".alert-login").removeClass("alert-danger alert-success");
			$(".alert-login").addClass("d-none");
			$(".alert-login").html("");
		}
		if($(".show-password").hasClass("active"))
		{
			$(".show-password").removeClass("active");
			$("#password").attr("type","password");
			$(".show-password").find("span").toggleClass("fas fa-eye fas fa-eye-slash");
		}
		$(".show-password").addClass("disabled");
		$(".btn-login .sk-chase").removeClass("d-none");
		$(".btn-login span").addClass("d-none");
		$(".btn-login").attr("disabled",true);
		$("#username").attr("disabled",true);
		$("#password").attr("disabled",true);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'ajax/ajax_login.php',
			async: false,
			data: {username:username,password:password},
			success: function(result)
			{
				if(result.success)
				{
					window.location = "index.php";
				}
				else if(result.error)
				{
					$(".alert-login").removeClass("d-none");
					$(".show-password").removeClass("disabled");
					$(".btn-login .sk-chase").addClass("d-none");
					$(".btn-login span").removeClass("d-none");
					$(".btn-login").attr("disabled",false);
					$("#username").attr("disabled",false);
					$("#password").attr("disabled",false);
					$(".alert-login").removeClass("alert-success");
					$(".alert-login").addClass("alert-danger");
					$(".alert-login").html(result.error);
				}
			}
		});
	}
	$(document).ready(function(){
		$("#username, #password").keypress(function(event){
			if(event.keyCode == 13 || event.which == 13) login();
		})
		$(".btn-login").click(function(){
			login();
		})
		$(".show-password").click(function(){
			if($("#password").val())
			{
				if($(this).hasClass("active"))
				{
					$(this).removeClass("active");
					$("#password").attr("type","password");
				}
				else
				{
					$(this).addClass("active");
					$("#password").attr("type","text");
				}
				$(this).find("span").toggleClass("fas fa-eye fas fa-eye-slash");
			}
		})
	})
</script>


<div id="dropDownSelect1"></div>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/jquery/jquery-3.2.1.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/animsition/js/animsition.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/bootstrap/js/popper.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/bootstrap/js/bootstrap.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/select2/select2.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/daterangepicker/moment.min.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/daterangepicker/daterangepicker.js?v=<?= rand(10, 10000); ?>"></script>
<script src="<?php echo $config_base . '/meeting/login/'; ?>vendor/countdowntime/countdowntime.js?v=<?= rand(10, 10000); ?>"></script>
