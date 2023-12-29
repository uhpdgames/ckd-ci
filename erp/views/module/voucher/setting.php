<?php
/*
qq($item);

*/ ?>
<div id="results" style=" display: none;width: 100%" class="alert alert-success rounded" role="alert">

</div>

<div class="page-breadcrumb">

	<div class="row">
		<div class="col-12">
			<div class="mb-2">

				<h1>Setting - Voucher</h1>

				<div class="top-right-button-container">
					<a type="button" data-toggle="modal" data-id="0" data-target="#ModalContent"
					   data-whatever="@getbootstrap"
					   class="btn btn-primary btn-lg top-right-button mr-1" href="#"><i class="iconsminds-add"></i>Thêm
						mới</a>
				</div>

				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a href=".">Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="voucher"">Mã giảm giá</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Danh sách</li>
					</ol>
				</nav>
			</div>

		</div>
	</div>


</div>



<div class="container-fluid">
	<div class="dashboard-wrapper">


		<div class="row">

			<div class="col-6">
				<div id="result" style="display: none;width: 100%" class="alert alert-success rounded" role="alert">

				</div>
			</div>
		</div>

		<div class="d-flex flex-row justify-content-start flex-wrap w-100">

			<?php
			foreach ($items as $key => $item) {
				?>

				<div class="ml-5 row">
					<div class="card mb-4">
						<div class="card-body">
							<h5 class="mb-4">LOẠI MÃ GIẢM GIÁ: <?= @$item['ten'] ?></h5>
							<form method="post" action="ajax/update_data"
								  class="form-ajax-cate needs-validation tooltip-label-right"
								  novalidate>
								<div class="form-group position-relative error-l-50">
									<label>Name</label>
									<input type="text" class="form-control" required name="name"
										   value="<?= @$item['name'] ?? 'dang-ky' ?>" disabled>
									<div class="invalid-tooltip">
										Name is required!
									</div>
								</div>
								<div class="form-group position-relative error-l-50">
									<label>Code</label>
									<input type="text" class="form-control" required name="code"
										   value="<?= @$item['code'] ?? 'register' ?>" disabled>
									<div class="invalid-tooltip">
										Code is required!
									</div>
								</div>
								<div class="form-group position-relative error-l-50">
									<label>Tỷ lệ giảm (%)</label>
									<input type="number" class="form-control" name="rate"
										   value="<?= @$item['rate'] ?? '10' ?>" required>
									<div class="invalid-tooltip">
										Nhập giá trị muốn giảm (%)
									</div>
								</div>

								<div class="form-group position-relative error-l-50">
									<div class="input-daterange input-group" id="datepicker">
										<input type="text" class="datetimepicker input-sm form-control" name="start"
											   value="<?= @timetodate($item['start']) ?? '' ?>" placeholder="Start">
										<span class="input-group-addon"></span>
										<input type="text" class="datetimepicker input-sm form-control" name="end"
											   value="<?= @timetodate($item['end']) ?? '' ?>" placeholder="End">
									</div>
								</div>


								<div class="form-group position-relative">

									<div class="custom-control custom-checkbox">
										<input type="hidden" name="once" class="check_once-<?=@$item['id']?>"
											   value="<?= @$item['once'] ?? '1'
									?>">
										<input  onclick="updateCheckBox(this)" type="checkbox" class="custom-control-input check_once" data-id="<?=@$item['id']?>" id="check_once-<?=@$item['id']?>"
											   value="<?= @$item['once'] ?? '1'
									?>"
											   required <?= @$item['once'] == '1' ? 'checked' : ''
									?>>
										<label class="custom-control-label" for="check_once-<?=@$item['id']?>">Sử dụng một lần</label>
									</div>

								</div>

								<button type="submit" class="btn btn-primary mb-0">Lưu lại</button>

								<input type="hidden" value="<?= @$ajax['table'] ?>" id="table" name="table">
								<input type="hidden" value="<?= @$item['id'] ?>" id="id" name="id">

							</form>
						</div>
					</div>
				</div>
				<?php
			}

			?>


		</div>
	</div>

</div>

<?php $this->view('modal/voucher_cate'); ?>

<script>
	var table_name = '';
	var id_details = '';

	$(".form-ajax-cate").submit(function (event) {
		event.preventDefault();

		var $form = $(this),
			url = $form.attr('action');

		$data = $.param($(this).serializeArray());


		var posting = $.post(url, $data);

		posting.done(function (data) {
			$('#result').fadeIn(500);
			$('#result').text('Cập nhật thành công!');
			setTimeout(function () {
				$('#result').fadeOut(500);
			}, 3000)
		});
		posting.fail(function () {
			$('#result').fadeIn(500);
			$('#result').text('Cập nhật thất bại');
			setTimeout(function () {
				$('#result').fadeOut(500);
			}, 3000)
		});


	});



	$('.datetimepicker').datepicker({
		format: 'dd/mm/yyyy'
	});


	function updateCheckBox(_this){
		var id = $(_this).data('id') || 0;

		if ($(_this).prop('checked')) {
			$('.check_once-' + id).val(1);
		} else {
			$('.check_once-' + id).val(0);
		}
	}

</script>

