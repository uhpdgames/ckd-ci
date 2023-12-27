<div class="main_fix my-5">
	<div class="wrap-user">
		<div class="title-user">
			<span><?= getLang('dangky')?></span>
		</div>
		<form class="form-user validation-user" novalidate method="post" enctype="multipart/form-data">
			<label for="basic-url"><?= getLang('hoten')?></label>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-user"></i></div>
				</div>
				<input type="text" class="form-control" id="ten" name="ten" placeholder="<?= getLang('nhaphoten')?>" required>
				<div class="invalid-feedback"><?= getLang('vuilongnhaphoten')?></div>
			</div>
			<label for="basic-url"><?= getLang('taikhoan')?></label>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-user"></i></div>
				</div>
				<input type="text" class="form-control" id="username" name="username" placeholder="<?= getLang('nhaptaikhoan')?>"
					   required>
				<div class="invalid-feedback"><?= getLang('vuilongnhaptaikhoan')?></div>
			</div>
			<label for="basic-url"><?= getLang('matkhau')?></label>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-lock"></i></div>
				</div>
				<input type="password" class="form-control" id="password" name="password" placeholder="<?= getLang('nhapmatkhau')?>"
					   required>
				<div class="input-group-prepend password">
					<div class="input-group-text"><i class="fa fa-eye-slash togglePassword" aria-hidden="true"  id="togglePassword"></i></div>
				</div>
				<div class="invalid-feedback"><?= getLang('vuilongnhapmatkhau')?></div>
			</div>
			<label for="basic-url"><?= getLang('nhaplaimatkhau')?></label>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-lock"></i></div>
				</div>
				<input type="password" class="form-control" id="repassword" name="repassword"
					   placeholder="<?= getLang('nhaplaimatkhau')?>" required>
				<div class="input-group-prepend password">
					<div class="input-group-text"><i class="fa fa-eye-slash togglePassword" aria-hidden="true"   id="togglePassword2"></i></div>
				</div>
				<div class="invalid-feedback repassword"><?= getLang('vuilongnhaplaimatkhau')?></div>
			</div>
			<label for="basic-url"><?= getLang('gioitinh')?></label>
			<div class="input-group input-user">
				<div class="radio-user custom-control custom-radio">
					<input type="radio" id="nam" name="gioitinh" class="custom-control-input" value="1" required>
					<label class="custom-control-label" for="nam"><?= getLang('nam')?></label>
				</div>
				<div class="radio-user custom-control custom-radio">
					<input type="radio" id="nu" name="gioitinh" class="custom-control-input" value="2" required>
					<label class="custom-control-label" for="nu"><?= getLang('nu')?></label>
				</div>
			</div>
			<label for="basic-url"><?= getLang('ngaysinh')?></label>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-lock"></i></div>
				</div>

				<input type="text" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="<?= getLang('nhapngaysinh')?>"
					   required>
				<div class="invalid-feedback ngaysinh"><?= getLang('vuilongnhapsodienthoai')?></div>
			</div>
			<label for="basic-url">Email</label>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-envelope"></i></div>
				</div>
				<input type="email" class="form-control" id="email" name="email" placeholder="<?= getLang('nhapemail')?>" required>
				<div class="invalid-feedback email"><?= getLang('vuilongnhapdiachiemail')?></div>
			</div>
			<label for="basic-url"><?= getLang('dienthoai')?></label>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-phone-square"></i></div>
				</div>
				<input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?= getLang('nhapdienthoai')?>"
					   required>
				<div class="invalid-feedback"><?= getLang('vuilongnhapsodienthoai')?></div>
			</div>
			<label for="basic-url"><?= getLang('diachi')?></label>
			<div class="input-group input-user">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fa fa-map"></i></div>
				</div>
				<input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?= getLang('nhapdiachi')?>" required>
				<div class="invalid-feedback"><?= getLang('vuilongnhapdiachi')?></div>
			</div>
			<div class="button-user">
				<input type="submit" class="btn btn-primary btn-block" onclick="check_validate()" name="dangky"
					   value="<?= getLang('dangky')?>" disabled>
			</div>

			<input type="hidden" value="<?=!empty($aff) ? $aff : 0?>" name="affiliate">
		</form>
	</div>
</div>
<link rel="stylesheet" href="<?=MYSITE?>/assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<script src="<?=MYSITE?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js">

</script>
<style>
    .input-group-prepend.password, .password .input-group-text{
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

    $("body").on('click', '.togglePassword', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
    });

    function check_validate() {

        const password = $('#password').val();
        const repassword = $('#repassword').val();


        if(password !=repassword){
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
</script>
