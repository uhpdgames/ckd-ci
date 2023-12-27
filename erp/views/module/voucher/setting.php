<?php
/*
qq($item);

*/?>



<div class="container-fluid">
	<div class="dashboard-wrapper">

		<div class="row">
			<div class="col-12">

				<h1>Setting - Voucher</h1>
				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a href=".">Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="voucher">Voucher</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Setting</li>
					</ol>
				</nav>
				<div class="separator mb-5"></div>


			</div>
		</div>

			<div class="row">

				<div class="col-6">
					<div id="result" style="display: none;width: 100%" class="alert alert-success rounded" role="alert">

					</div>
				</div>
			</div>

		<div class="d-flex flex-row justify-content-start">
			<div class="row">
				<div class="card mb-4">
					<div class="card-body">
						<h5 class="mb-4">Người dùng đăng ký</h5>
						<form id="form-ajax" action="ajax/update_data" class="needs-validation tooltip-label-right"
							  novalidate>
							<div class="form-group position-relative error-l-50">
								<label>Name</label>
								<input type="text" class="form-control" required name="name" value="<?=@$item['name']?? 'dang-ky'?>" disabled>
								<div class="invalid-tooltip">
									Name is required!
								</div>
							</div>
							<div class="form-group position-relative error-l-50">
								<label>Code</label>
								<input type="text" class="form-control" required name="code" value="<?=@$item['code']?? 'register'?>" disabled>
								<div class="invalid-tooltip">
									Code is required!
								</div>
							</div>
							<div class="form-group position-relative error-l-50">
								<label>Tỷ lệ giảm (%)</label>
								<input type="number" class="form-control" name="rate" value="<?=@$item['rate']?? '10'?>" required>
								<div class="invalid-tooltip">
									Nhập giá trị muốn giảm (%)
								</div>
							</div>

							<div class="form-group position-relative error-l-50">
								<div class="input-daterange input-group" id="datepicker">
									<input type="text" class="input-sm form-control" name="start" value="<?=@$item['start'] ?? ''?>" placeholder="Start">
									<span class="input-group-addon"></span>
									<input type="text" class="input-sm form-control" name="end" value="<?=@$item['end'] ?? ''?>" placeholder="End">
								</div>
							</div>


							<div class="form-group position-relative">

								<div class="custom-control custom-checkbox">
									<input disabled type="hidden" name="once" class="check_once" value="<?=@$item['once']??'1'?>">
									<input disabled type="checkbox" class="custom-control-input" id="check_once" value="<?=@$item['once']??'1'?>"
										   required <?=@$item['once']? 'checked': ''?>>
									<label class="custom-control-label" for="check_once">Sử dụng một lần</label>
								</div>

							</div>

							<button type="submit" class="btn btn-primary mb-0">Lưu lại</button>

							<input type="hidden" value="<?=@$ajax['table']?>" id="table" name="table">
							<input type="hidden" value="<?=@$ajax['id']?>" id="id" name="id">

						</form>
					</div>
				</div>
			</div>

			<div class="ml-5 row">
				<div class="card mb-4">
					<div class="card-body">
						<h5 class="mb-4">Loại chiến dịch</h5>
						<form class="needs-validation tooltip-label-right" novalidate>
							<div class="form-group position-relative error-l-50">
								<label>Name</label>
								<input type="text" class="form-control" required value="flash-sale" disabled>
								<div class="invalid-tooltip">
									Name is required!
								</div>
							</div>
							<div class="form-group position-relative error-l-50">
								<label>Code</label>
								<input type="text" class="form-control" required value="flashsale" disabled>
								<div class="invalid-tooltip">
									Code is required!
								</div>
							</div>
							<div class="form-group position-relative error-l-50">
								<label>Tỷ lệ giảm (%)</label>
								<input type="number" class="form-control" required disabled>
								<div class="invalid-tooltip">
									Nhập giá trị muốn giảm (%)
								</div>
							</div>


							<div class="form-group position-relative">


								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_once"
										   name="jQueryCheckbox" required>
									<label class="custom-control-label" for="check_once">Sử dụng một lần</label>
								</div>

							</div>

							<button type="submit" class="btn btn-primary mb-0" disabled>Lưu lại</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


<script>
	$("#form-ajax").submit(function (event) {
		event.preventDefault();

		var $form = $(this),
			url = $form.attr('action');

		$data = $.param($(this).serializeArray()) ;


		var posting = $.post(url, $data);

		posting.done(function (data) {
			$('#result').fadeIn(500);
			$('#result').text('Cập nhật thành công!');
			setTimeout(function (){
				$('#result').fadeOut(500);
			}, 3000)
		});
		posting.fail(function () {
			$('#result').fadeIn(500);
			$('#result').text('Cập nhật thất bại');
			setTimeout(function (){
				$('#result').fadeOut(500);
			}, 3000)
		});



	});

	$('#datepicker').datepicker({ format: 'dd/mm/yyyy' });

	$('#check_once').click(function() {
		if($('#check_once').prop('checked')){
			$('.check_once').val(1);
		}else{
			$('.check_once').val(0);
		}
	});
</script>
