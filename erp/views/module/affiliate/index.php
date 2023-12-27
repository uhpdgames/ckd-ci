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
							'wallet'=>'Ví CTV',
							'cai-dat'=>'Cấu hình',
						),
						array(
							'wallet'=>'affiliate/wallet',
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
								<th class="align-middle">Tài khoản</th>
								<th class="align-middle">Họ tên</th>
								<th class="align-middle">Email</th>
								<th class="align-middle text-center">Kích hoạt</th>
								<th class="align-middle text-center">Thao tác</th>
							</tr>
							</thead>
							<?php if(empty($items)) { ?>
								<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
							<?php } else { ?>
								<tbody>
								<?php $stt = 1; for($i=0;$i<count($items);$i++) { ?>
									<tr>
										<td><span><?= ++$stt?></span></td>
										<td class="align-middle">
											<?=$items[$i]['username']?>
										</td>
										<td class="align-middle">
											<?=$items[$i]['ten']?>
										</td>
										<td class="align-middle">
											<?=$items[$i]['email']?>
										</td>
										<td class="align-middle text-center">
											<div class="custom-control custom-checkbox my-checkbox">
												<input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="member" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
												<label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
											</div>
										</td>
										<td class="align-middle text-center text-md text-nowrap">
											<a href="affiliate/details/<?=$items[$i]['id']?>">Xem chi tiết</a>
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
<?php $this->view('modal/voucher'); ?>
<!-- ============================================================== -->
<!-- END Modal content  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->


<link rel="stylesheet" href="http://stemselector.org/css/vendor/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="http://stemselector.org/css/vendor/datatables.responsive.bootstrap4.min.css">

 
<style>
	.page-breadcrumb i{
		color:#fff;
		padding: .225rem;
	}
</style>
