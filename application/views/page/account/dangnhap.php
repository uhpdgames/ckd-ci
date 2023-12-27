<div class="main_fix my-5">
	<div class="wrap-user">
		<div class="title-user d-flex align-items-end justify-content-between">
			<span><?= getLang('dangnhap')?></span>
			<a href="account/quen-mat-khau" title="<?= getLang('quenmatkhau')?>"><?= getLang('quenmatkhau')?></a>
		</div>
		<form class="form-user validation-user" novalidate method="post" action="account/dang-nhap"
			  enctype="multipart/form-data">
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-user"></i></div>
				</div>
				<input type="text" class="form-control" id="username" name="username" placeholder="<?= getLang('taikhoan')?>"
					   required>
				<div class="invalid-feedback"><?= getLang('vuilongnhaptaikhoan')?></div>
			</div>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-lock"></i></div>
				</div>
				<input type="password" class="form-control" id="password" name="password" placeholder="<?= getLang('matkhau')?>"
					   required>
				<div class="input-group-prepend password">
					<div class="input-group-text"><i class="fa fa-eye-slash togglePassword" aria-hidden="true"
													 id="togglePassword"></i></div>
				</div>
				<div class="invalid-feedback"><?= getLang('vuilongnhapmatkhau')?></div>
			</div>
			<div class="button-user d-flex align-items-center justify-content-between">
				<input type="submit" class="btn btn-primary" name="dangnhap" value="<?= getLang('dangnhap')?>" disabled>
				<div class="checkbox-user custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="remember-user" id="remember-user" value="1">
					<label class="custom-control-label" for="remember-user"><?= getLang('nhomatkhau')?></label>
				</div>
			</div>
			<div class="note-user">
				<span><?= getLang('banchuacotaikhoan')?> ! </span>
				<a href="account/dang-ky" title="<?= getLang('dangkytaiday')?>"><?= getLang('dangkytaiday')?></a>
			</div>
		</form>
	</div>
</div>
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
    const password = document.querySelector('#password');


    togglePassword.addEventListener("click", function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        //this.classList.toggle("fa-eye");
    });
    $("body").on('click', '.togglePassword', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
    });
</script>
