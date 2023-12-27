<?php

///qq($items);
?>

<?php
$linkMan = '#';
$linkEdit = '#';
$linkDelete = '#';
$linkExcel = '#';
$linkWord = '#';
$arrStatus = array("text-primary", "text-info", "text-warning", "text-success", "text-danger");
?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">

	<div class="row">
		<div class="col-12">
			<div class="mb-2">
				<h1>Danh sách <?=$module?></h1>
				<div class="top-right-button-container">



					<?=label_function(
						array(
							'add'=>'THÊM MỚI BÌNH LUẬN',

						),
						array(
							'add'=>'binhluan/update?id_photo=' . getRequest('id'),

						),
						array(
							'add'=>'iconsminds-edit',

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
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-12 list">
			<div class=" ">
				<div class="card-body">

					<h6 class="card-subtitle"></h6>
					<div class="table-responsive">


						<table
							class="m-t-30 no-wrap table-hover contact-list data-table data-voucher">
							<thead>
							<tr>

								<th class="align-middle text-center" width="10%">STT</th>
								<th class="align-middle text-center" width="8%">Hình</th>
								<th class="align-middle" style="width:30%">Tên khách hàng</th>
								<th class="align-middle" style="width:30%">Đánh giá</th>
								<th class="align-middle">Số sao</th>
								<th class="align-middle text-center">Hiển thị</th>
								<th class="align-middle text-center">Chức năng</th>
							</tr>
							</thead>
							<?php if(empty($items)) { ?>
								<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
							<?php } else { ?>
								<tbody>
								<?php $stt = 0; for($i=0;$i<count($items);$i++) {

									$tennguoi = @$items[$i]['tenvi'];
									if(!empty($items[$i]['id_member']) && $items[$i]['id_member'] == 1){

									}else{
										$get_member = $d->rawQueryOne("select ten from #_member where id='" . $items[$i]['id_member'] . "'");
										$tennguoi = $get_member['ten'] ?? "";
									}

									?>
									<tr>
										<td><span><?= ++$stt?></span></td>
										<td class="align-middle">
											<img WIDTH="50" src="<?=MYSITE. UPLOAD_PRODUCT_L. $items[$i]['photo']?>"  >
										</td>

										<td>
											<span><?=$tennguoi?></span>
										</td>
										<td class="align-middle">
											<?=$items[$i]['motavi']?>
										</td>
										<td class="align-middle">
											<?=$items[$i]['link_video']?>
										</td>
										<td class="align-middle text-center">
											<div class="custom-control custom-checkbox my-checkbox">
												<input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="gallery" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
												<label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
											</div>
										</td>

										<td>
											<a onclick="dels(this)" data-id="<?=$items[$i]['id']?>" href="javascript:void(0)">XÓA BÌNH LUẬN</a>
										</td>

									</tr>
								<?php } ?>
								</tbody>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
			<!-- Column -->

		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End PAge Content -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Right sidebar -->
	<!-- ============================================================== -->
	<!-- .right-sidebar -->
	<!-- ============================================================== -->
	<!-- End Right sidebar -->
	<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Modal content  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- END Modal content  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->


<link rel="stylesheet" href="http://stemselector.org/css/vendor/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="http://stemselector.org/css/vendor/datatables.responsive.bootstrap4.min.css">

<script>
	var id_details = "<?=getRequest('id')?>";
	var table_name = 'table__gallery';

	function dels(_this){


		var id = $(_this).data('id') || 0;

		$.ajax({
			url: "binhluan/dels",
			type: 'POST',
			data: { id: id },
			dataType: 'json',
			success: function () {
				location.reload();
			}
		}).done(function() {
			$( this ).addClass( "done" );
		});


	}
</script>

<style>
	.page-breadcrumb i{
		color:#fff;
		padding: .225rem;
	}
</style>
