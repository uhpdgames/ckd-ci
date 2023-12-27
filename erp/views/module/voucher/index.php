<?php

?>


<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">

	<div class="row">
		<div class="col-12">
			<div class="mb-2">
				<h1>Danh sách mã giảm giá</h1>
				<div class="top-right-button-container">

					<?=label_function(
						array(
							'them-moi'=>'Thêm mới',
							'cai-dat'=>'Cấu hình',
						),
						array(
							'them-moi'=>'#',
							'cai-dat'=>'voucher/setting',
						),
						array(
							'them-moi'=>'iconsminds-add',
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
							<a href="voucher"">Mã giảm giá</a>
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
		<div class="col-12 list" data-check-all="checkAll">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?= $title; ?></h4>
					<h6 class="card-subtitle"></h6>
					<div class="table-responsive">


						<table id="demo-foo-addrow"
							   class="m-t-30 no-wrap table-hover contact-list data-table data-voucher">
							<thead>
							<tr>
								<th align="center" valign="center">No</th>
								<th align="center" valign="center">Code</th>
								<th>Người dùng</th>
								<th>Mô tả</th>
								<th>Ngày có hiệu lựu</th>
								<th>Ngày hết hạn</th>
								<th align="center" valign="center">giảm(đ)</th>
								<th align="center" valign="center">giảm(%)</th>
								<th align="center" valign="center">Loại</th>
								<th>Áp dụng chung</th>
								<th>Đã hủy</th>
								<th>Đã Sử dụng</th>
								<th>Hành Động</th>
							</tr>
							</thead>
							<tbody>

							<?php
							//qq($items); die;


							//	$item = json_decode($items);
							if (is_array($items) && count($items)) {
								foreach ($items as $key => $item) {
									$stt = $key; ?>
									<tr>
										<td align="center" valign="center"><?= ++$stt; ?></td>
										<td align="center" valign="center"><span class="badge badge-pill badge-danger mb-1"><?= $item['code'] ?></span></td>
										<td><span class="badge badge-light mb-1"><?= @$users[$item['uid']??0] ?></span></td>
										<td><?= $item['description'] ?></td>
										<td><?= (@$item['start_date']) ?></td>
										<td><?= (@$item['end_date']) ?></td>
										<!--<td></td>
										<td></td>-->
										<td><?= 0 != $item['discount_amount'] ?$item['discount_amount']:'' ?></td>
										<td align="center" valign="center"><span class="badge badge-success mb-1"><?= ($item['discount_percentage']) ?></span></td>
										<td align="center" valign="center"><span class="badge badge-pill badge-outline-secondary mb-1"><?= ($item['type']) ?></span></td>
										<td align="center" valign="center"><?= label_html($item['is_combinable']) ?></td>
										<td><?= label_html($item['is_combinable']) ?></td>
										<td><?= label_html($item['deleted']) ?></td>
										<td><?= label_action() ?></td>
									</tr>
									<?php
								}
							}
							?>

							</tbody>
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
