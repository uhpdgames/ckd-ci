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


								<th class="align-middle text-center" width="2%">STT</th>

								<th class="align-middle text-center" width="2%">hình ảnh</th>
								<th class="align-middle text-center" width="2%">mã sản phẩm</th>
								<th class="align-middle text-center" width="2%">sản phẩm</th>
								<th class="align-middle text-center" width="2%">THÊM BÌNH LUẬN</th>


							</tr>
							</thead>
							<?php if(empty($items)) { ?>
								<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
							<?php } else { ?>
								<tbody>
								<?php $stt = 0; for($i=0;$i<count($items);$i++) { ?>
									<tr>
										<td><span><?= ++$stt?></span></td>
										<td class="align-middle">
											<img WIDTH="50" src="<?=MYSITE. UPLOAD_PRODUCT_L. $items[$i]['photo']?>"  >
										</td>
										<td>
											<?=$items[$i]['masp']??''?>
										</td>
										<td>
											<?=$items[$i]['tenvi']??''?>
										</td>

										<td>
											<a href="<?=MYADMIN . 'binhluan?id=' . $items[$i]['id']?>" target="_blank">THÊM BÌNH LUẬN</a>
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
</script>

<style>
	.page-breadcrumb i{
		color:#fff;
		padding: .225rem;
	}
</style>
