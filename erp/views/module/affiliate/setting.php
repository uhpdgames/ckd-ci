
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">

	<div class="row">
		<div class="col-12">
			<div class="mb-2">
				<h1>Cấu hình <?=$module?></h1>
				<div class="top-right-button-container">

					<?=label_function(
						array(
							'wallet'=>'Ví CTV',
							'cai-dat'=>'Cấu hình',
						),
						array(
							'wallet'=>'affiliate/withdrawal',
							'cai-dat'=>'affiliate/setting',
						),
						array(
							'wallet'=>'iconsminds-edit',
							'cai-dat'=>'simple-icon-settings',
						),
					)?>

				</div>

				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a href=".">Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href=<?=strtolower($module)?>><?=$module?></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Danh sách</li>
					</ol>
				</nav>
			</div>

		</div>
	</div>

	<div class="row">

		<div class="col-12">
			<div id="results" style=" display: none;width: 100%" class="alert alert-success rounded" role="alert">

			</div>
		</div>
	</div>
</div>

<!-- Main content -->
<section class="content">
    <form novalidate id="form-ajax" action="ajax/update_data" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $item['id']; ?>">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-warning rounded-pill submit-check"><i class="far fa-save mr-2"></i>Lưu
            </button>
        </div>
        <?php if (isset($config['website']['debug-developer']) && $config['website']['debug-developer'] == true) { ?>
            <div class="card card-primary card-outline text-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="rate">Tỉ lệ: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="rate" id="rate"
                                       value="<?= !empty($item['rate']) ? $item['rate'] : '' ?>"
                                       placeholder="Phần trăm hoa hồng" required>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="vat">VAT </label>
                                <input type="text" class="form-control money-format" name="vat" id="vat"
                                       value="<?php if ($item['vat']) {
                                           $price = $item['vat'];
                                           echo $price;
                                       }//number_format($price, 0, '', '.');}?>"
                                       placeholder="VAT" required>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="cit">CIT </label>
                                <input type="text" class="form-control money-format" name="cit" id="cit"
                                       value="<?php if ($item['cit']) {
                                           $price = $item['cit'];
                                           echo $price;
                                       }//number_format($price, 0, '', '.');}?>"
                                       placeholder="CIT" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="min_withdraw">Số tiền tối thiểu rút của cộng tác viên </label>
                                <input type="text" class="form-control money-format" name="min_withdraw" id="min_withdraw"
                                       value="<?php if ($item['min_withdraw']) {
                                           $price = $item['min_withdraw'];
                                           echo $price;
                                       }// number_format($price, 0, '', '.');}?>"
                                       placeholder="Số tiền rút tối thiểu" required>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="max_withdraw">Số tiền tối đa rút của cộng tác viên </label>
                                <input type="text" class="form-control money-format" name="max_withdraw" id="max_withdraw"
                                       value="<?php if ($item['max_withdraw']) {
                                           $price = $item['max_withdraw'];
                                           echo $price;
                                       }// number_format($price, 0, '', '.');}?>"
                                       placeholder="Số tiền rút tối thiểu" required>
                            </div>
                        </div>
                    </div>

					<p class="small">Điều kiện tăng cấp độ</p>
					<div class="row">
						<div class="col col-md-4">
							<div class="form-group">
								<label for="rate">LV-1: <span class="text-danger">*</span></label>
								<input type="text" class="form-control money-format" name="lv1" id="lv1"
									   value="<?= !empty($item['lv1']) ? $item['lv1'] : '' ?>"
									   placeholder="Số thu nhập cần để thăng cấp" required>
							</div>
						</div>
						<div class="col col-md-4">
							<div class="form-group">
								<label for="rate">LV-2: <span class="text-danger">*</span></label>
								<input type="text" class="form-control money-format" name="lv2" id="lv2"
									   value="<?= !empty($item['lv2']) ? $item['lv2'] : '' ?>"
									   placeholder="Số thu nhập cần để thăng cấp" required>
							</div>
						</div>
						<div class="col col-md-4">
							<div class="form-group">
								<label for="rate">LV-3: <span class="text-danger">*</span></label>
								<input type="text" class="form-control money-format" name="lv3" id="lv3"
									   value="<?= !empty($item['lv3']) ? $item['lv3'] : '' ?>"
									   placeholder="Số thu nhập cần để thăng cấp" required>
							</div>
						</div>
					</div>
                </div>
            </div>


        <?php } ?>
	</form>
</section>

<!-- Setting js -->
<script type="text/javascript">
    $(document).ready(function () {

    })
</script>

<script>
	var id_details = 1;
	var table_name = 'table_ref_config';
</script>
