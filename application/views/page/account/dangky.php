<?php
$city = $d->rawQuery("select ten, id from #_city order by id asc");

?>
<div class="main_fix my-0 my-md-5">
	<div class="inner-dang-ky">
		<div class="image-holder">
			<img class="img-fluid h-100 w-100" src="<?=MYSITE?>assets/images/dang-ky.png" alt="CKD COS VIỆT NAM">
		</div>
		<form class="form-user validation-user" novalidate method="post" action="account/dang-ky"
			  enctype="multipart/form-data">

			<div class="text-center flex-row w-50 m-auto">
				<h3>
					<span><?= getLang('dangky') ?></span>
				</h3>
			</div>

			<div class="form-holder active">
				<div class="input-group input-user">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-user"></i></div>
					</div>
					<input type="text" class="form-control" id="ten" name="ten" placeholder="<?= getLang('nhaphoten') ?>"
						   required>
					<div class="invalid-feedback"><?= getLang('vuilongnhaphoten') ?></div>
				</div>
			</div>
			<div class="form-holder">
				<div class="input-group input-user">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-user"></i></div>
					</div>
					<input onblur="checkAccount()" type="text" class="form-control" id="username" name="username"
						   placeholder="<?= getLang('nhaptaikhoan') ?>"
						   required>
					<div class="invalid-feedback username"><?= getLang('vuilongnhaptaikhoan') ?></div>
				</div>
			</div>
			<div class="form-holder">
				<div class="input-group input-user">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-lock"></i></div>
					</div>
					<input type="password" class="form-control" id="password" name="password"
						   placeholder="<?= getLang('nhapmatkhau') ?>"
						   required>
					<div class="input-group-prepend password">
						<div class="input-group-text"><i class="fa fa-eye-slash togglePassword" aria-hidden="true"
														 id="togglePassword"></i></div>
					</div>
					<div class="invalid-feedback"><?= getLang('vuilongnhapmatkhau') ?></div>
				</div>
			</div>

			<div class="form-holder">
				<div class="input-group input-user">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-lock"></i></div>
					</div>
					<input type="password" class="form-control" id="repassword" name="repassword"
						   placeholder="<?= getLang('nhaplaimatkhau') ?>" required>
					<div class="input-group-prepend password">
						<div class="input-group-text"><i class="fa fa-eye-slash togglePassword" aria-hidden="true"
														 id="togglePassword2"></i></div>
					</div>
					<div class="invalid-feedback repassword"><?= getLang('vuilongnhaplaimatkhau') ?></div>
				</div>
			</div>

			<div class="form-holder">
				<div class="input-group input-user">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-envelope"></i></div>
					</div>
					<input type="email" class="form-control" id="email" name="email" onblur="checkEmail()"
						   placeholder="<?= getLang('nhapemail') ?>" required>
					<div class="invalid-feedback email"><?= getLang('vuilongnhapdiachiemail') ?></div>
				</div>
			</div>

			<div class="form-holder">
				<div class="input-group input-user">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-phone-square"></i></div>
					</div>
					<input type="number" class="form-control" id="dienthoai" name="dienthoai"
						   placeholder="<?= getLang('nhapdienthoai') ?>"
						   required>
					<div class="invalid-feedback"><?= getLang('vuilongnhapsodienthoai') ?></div>
				</div>
			</div>

			<div class="form-holder">
				<div class="row gx-0">
					<div class="col-12 col-md-4">

						<div class="input-group input-user">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fa fa-address-book" aria-hidden="true"></i></div>
							</div>
							<select class="custom-select" required id="city-dangky" name="city">
								<option value=""><?= getLang('tinhthanh') ?></option>
								<?php for ($i = 0; $i < count($city); $i++) { ?>
									<option value="<?= $city[$i]['id'] ?>"><?= $city[$i]['ten'] ?></option>
								<?php } ?>
							</select>
							<div class="invalid-feedback"><?= getLang('vuilongchontinhthanh') ?></div>
						</div>

					</div>
					<div class="col-12 col-md-4 px-0 px-md-2">

						<div class="input-group input-user">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fa fa-address-book" aria-hidden="true"></i></div>
							</div>
							<select class="select-district custom-select" required
									id="district-dangky" name="district">
								<option value=""><?= getLang('quanhuyen') ?></option>
							</select>
							<div class="invalid-feedback"><?= getLang('vuilongchonquanhuyen') ?></div>
						</div>

					</div>
					<div class="col-12 col-md-4">

						<div class="input-group input-user">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fa fa-address-book" aria-hidden="true"></i></div>
							</div>
							<select class="select-wards custom-select" required id="wards"
									name="wards">
								<option value=""><?= getLang('phuongxa') ?></option>
							</select>
							<div class="invalid-feedback"><?= getLang('vuilongchonphuongxa') ?></div>
						</div>


					</div>
				</div>
			</div>

			<div class="wp-action w-100 vw-100 my-2">
				<div class="button-user">
					<input type="submit" class="btn btn-action btn-primary btn-block" onclick="check_validate()" name="dangky"
						   value="<?= getLang('dangky') ?>" disabled>
				</div>
			</div>

		</form>
	</div>
</div>

<style>

	.wp-action{
		width: 50%;
		align-items: center;
		display: inline-flex;
		text-align: center;
		justify-content: center;
		vertical-align: middle;
	}

	.row.gx-0{
		margin:0;
		gap: 0;
	}

	.row.gx-0 [class*="col-"]{
		margin:0;
		padding:0;
	}

	.inner-dang-ky {

		margin: auto;
		background: #fff;
		display: flex;
		box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
		-webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
		-moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
		-ms-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
		-o-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
	}

	.image-holder {
		width: 50%;
		padding-right: 15px;
	}

	form {
		width: 100%;
		padding-top: 77px;
		padding-right: 60px;
		padding-left: 15px;
	}



	.form-holder {
		padding-left: 24px;
		position: relative;
	}

	.form-holder:before {

	}

	.form-holder.active:before {

	}

	.form-control {
		display: block;
		width: 100%;
		border-radius: 23.5px;
		height: 47px;
		padding: 0 24px;
		color: #808080;
		font-size: 1rem;
		border: none;
		background: #f7f7f7;
		margin-bottom: 25px;
	}

	.form-control::-webkit-input-placeholder {
		font-size: 1rem;
		color: #808080;
		text-transform: uppercase;

	}

	.form-control::-moz-placeholder {
		font-size: 1rem;
		color: #808080;
		text-transform: uppercase;

	}

	.form-control:-ms-input-placeholder {
		font-size: 1rem;
		color: #808080;
		text-transform: uppercase;

	}

	.form-control:-moz-placeholder {
		font-size: 1rem;
		color: #808080;
		text-transform: uppercase;

	}

	@-webkit-keyframes hvr-wobble-horizontal {
		16.65% {
			-webkit-transform: translateX(8px);
			transform: translateX(8px);
		}
		33.3% {
			-webkit-transform: translateX(-6px);
			transform: translateX(-6px);
		}
		49.95% {
			-webkit-transform: translateX(4px);
			transform: translateX(4px);
		}
		66.6% {
			-webkit-transform: translateX(-2px);
			transform: translateX(-2px);
		}
		83.25% {
			-webkit-transform: translateX(1px);
			transform: translateX(1px);
		}
		100% {
			-webkit-transform: translateX(0);
			transform: translateX(0);
		}
	}

	@keyframes hvr-wobble-horizontal {
		16.65% {
			-webkit-transform: translateX(8px);
			transform: translateX(8px);
		}
		33.3% {
			-webkit-transform: translateX(-6px);
			transform: translateX(-6px);
		}
		49.95% {
			-webkit-transform: translateX(4px);
			transform: translateX(4px);
		}
		66.6% {
			-webkit-transform: translateX(-2px);
			transform: translateX(-2px);
		}
		83.25% {
			-webkit-transform: translateX(1px);
			transform: translateX(1px);
		}
		100% {
			-webkit-transform: translateX(0);
			transform: translateX(0);
		}
	}

	.btn-action {
		letter-spacing: 2px;
		border: none;
		width: 133px;
		height: 47px;
		margin-right: 19px;
		border-radius: 23.5px;
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 0;
		background: #ff9a9c;
		font-size: 15px;
		color: #fff;
		text-transform: uppercase;

		-webkit-transform: perspective(1px) translateZ(0);
		transform: perspective(1px) translateZ(0);
		box-shadow: 0 0 1px rgba(0, 0, 0, 0);
	}

	.btn-action:hover {
		-webkit-animation-name: hvr-wobble-horizontal;
		animation-name: hvr-wobble-horizontal;
		-webkit-animation-duration: 1s;
		animation-duration: 1s;
		-webkit-animation-timing-function: ease-in-out;
		animation-timing-function: ease-in-out;
		-webkit-animation-iteration-count: 1;
		animation-iteration-count: 1;
	}

	.checkbox {
		position: relative;
		padding-left: 19px;
		margin-bottom: 37px;
		margin-left: 26px;
	}

	.checkbox label {
		cursor: pointer;
		color: #999;
	}

	.checkbox input {
		position: absolute;
		opacity: 0;
		cursor: pointer;
	}

	.checkbox input:checked ~ .checkmark:after {
		display: block;
	}

	.checkmark {
		position: absolute;
		top: 2px;
		left: 0;
		height: 10px;
		width: 10px;
		border-radius: 50%;
		border: 1px solid #e7e7e7;
	}

	.checkmark:after {
		content: "";
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 4px;
		height: 4px;
		border-radius: 50%;
		background: #ff9a9c;
		position: absolute;
		display: none;
	}

	.form-login {
		display: flex;
		align-items: center;
		margin-left: 23px;
	}

	@media (max-width: 767px) {
		.inner-dang-ky {
			display: block;
		}

		.image-holder {
			width: 100%;
			padding-right: 0;
		}

		form {
			width: 100%;
			padding: 0px 15px 70px;
		}

		.wrapper {
			background: none;
		}
	}

</style>

<script>


	$(function () {
		$('.form-holder').delegate("input", "focus", function () {
			$('.form-holder').removeClass("active");
			$(this).parent().addClass("active");
		})
	})
</script>


<link rel="stylesheet" href="<?= site_url() ?>/assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<script src="<?= site_url() ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js">

</script>
<style>
	.input-group-prepend.password, .password .input-group-text {
		width: 34px;
		cursor: pointer
	}

	.togglePassword {
		/* margin-left: -30px; */
		cursor: pointer;
		/* height: 2rem; */
		position: absolute;
		right: 0;
		top: 13px;
		width: 34px;
		font-size: 14px;
		height: 100%;
		padding: 0 .25rem;
		justify-content: center;

		align-items: center;
		text-align: center;
		vertical-align: middle;
	}
</style>
<script>
	const togglePassword = document.querySelector('#togglePassword');
	const togglePassword_repassword = document.querySelector('#togglePassword2');
	const password = document.querySelector('#password');
	const repassword = document.querySelector('#repassword');


	togglePassword.addEventListener("click", function () {
		const type = password.getAttribute("type") === "password" ? "text" : "password";
		password.setAttribute("type", type);
		// this.classList.toggle("fa-eye");
	});
	togglePassword_repassword.addEventListener("click", function () {
		const typex = repassword.getAttribute("type") === "password" ? "text" : "password";
		repassword.setAttribute("type", typex);
		//  this.classList.toggle("fa-eye");
	})

	$("body").on('click', '.togglePassword', function () {
		$(this).toggleClass("fa-eye fa-eye-slash");
	});

	function checkEmail() {
		$email = $('#email').val();

		$.ajax({
			type: "POST",
			url: site_url() + `ajax/checkEmail`,

			data: {email: $email},
			success: function (result) {
				if (result == 'true') {

					$('#email').val(" ");
					$('.invalid-feedback.email').text("Email đã tồn tại, vui lòng thử lại.").show();

				}else{
					$('.invalid-feedback.email').text("").hide();
				}


			},

		});
	}
	function checkAccount() {
		$username = $('#username').val();

		$.ajax({
			type: "POST",
			url: site_url() + `ajax/checkAccount`,

			data: {username: $username},
			success: function (result) {
				if (result == 'true') {

					$('#username').val(" ");
					$('.invalid-feedback.username').text("Tài khoản đã tồn tại, vui lòng thử lại.").show();

				}else{
					$('.invalid-feedback.username').text("").hide();
				}


			},

		});
	}

	function check_validate() {


		const password = $('#password').val();
		const repassword = $('#repassword').val();


		if (password != repassword) {
			$('#repassword').val("");
			$('.invalid-feedback.repassword').text("Mật khẩu không khớp nhau, vui lòng thử lại!");
		}
		const email = $('#email').val();
		if (/@gmail\.com$/.test(email)) {
			$('.invalid-feedback.email').val(" ");

		} else {
			$('#email').val(" ");
			$('.invalid-feedback.email').text("Vui lòng nhập email hợp lệ");
		}
	}


	$('#ngaysinh').datepicker({
		format: 'dd/mm/yyyy',
		endDate: '0y',
		datesDisabled: '0y',
	});

	$("#city-dangky").change(function() {
		var id = $(this).val();
		load_district(id);

	});
	$("#district-dangky").change(function() {
		var id = $(this).val();
		load_wards(id);
	});
</script>



