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
				<h1>Danh sách ví CTV</h1>
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
		<div class="col-12 list" data-check-all="checkAll">
			<div class=" ">
				<div class="card-body">

					<h6 class="card-subtitle"></h6>
					<div class="table-responsive">

						<table id="demo-foo-addrow"
							   class="m-t-30 no-wrap table-hover contact-list data-table data-voucher">
							<thead>
							<tr>
								<!--<th class="align-middle" width="5%">
									<div class="custom-control custom-checkbox my-checkbox">
										<input type="checkbox" class="custom-control-input" id="selectall-checkbox">
										<label for="selectall-checkbox" class="custom-control-label"></label>
									</div>
								</th>-->
								<!--<th class="align-middle text-center" width="10%">STT</th>-->
								<th class="align-middle">Cộng tác viên</th>
								<th class="align-middle">Số điện thoại</th>
								<th class="align-middle">Email</th>
								<th class="align-middle">Số tiền yêu cầu rút</th>
								<th class="align-middle">Số tiền thực nhận</th>
								<th class="align-middle">Ngày rút</th>
								<th class="align-middle">Trạng thái</th>
								<!--<th class="align-middle">Loại giao dịch</th>-->
								<!--<th class="align-middle text-center">Xác nhận</th>-->
								<th class="align-middle text-center">Thao tác</th>
							</tr>
							</thead>
							<?php if(empty($items)) { ?>
								<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
							<?php } else { ?>
								<tbody>
								<?php for($i=0;$i<count($items);$i++) {
									$isComplete = $items[$i]['status'] != 0;
									$status = '<span class="label label-warning">Pending</span>';
									if ($isComplete) $status = '<span class="label label-primary">Complete</span>';

									?>
									<tr>
										<!-- <td class="align-middle">
                                <div class="custom-control custom-checkbox my-checkbox">
                                    <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?php /*=$items[$i]['withdrawal_id']*/?>" value="<?php /*=$items[$i]['withdrawal_id']*/?>">
                                    <label for="select-checkbox-<?php /*=$items[$i]['withdrawal_id']*/?>" class="custom-control-label"></label>
                                </div>
                            </td>-->
										<!--<td class="align-middle">
                                <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?php /*=$items[$i]['stt']*/?>" data-id="<?php /*=$items[$i]['withdrawal_id']*/?>" data-table="ref_withdrawal">
                            </td>-->
										<td class="align-middle">
											<?=$items[$i]['ten']?>
										</td>
										<td class="align-middle">
											<?=$items[$i]['dienthoai']?>
										</td>
										<td class="align-middle">
											<?=$items[$i]['email']?>
										</td>

										<td class="align-middle">
											<?= $_Affiliate->formatMoney($items[$i]['amount']); ?> VNĐ
										</td>
										<td class="align-middle">
											<?=$_Affiliate->formatMoney($items[$i]['received']);?> VNĐ
										</td>
										<td class="align-middle">
											<?=$items[$i]['withdrawal_date']?>
										</td>
										<td class="align-middle">
											<?=$status;?>
										</td>
										<!--todo fixed loadl via db-->
										<td class="align-middle text-center text-md text-nowrap">
											<a
												data-uid="<?=$items[$i]['user_id']?>"
												data-amount="<?=$items[$i]['amount']?>"
												data-id="<?=$items[$i]['withdrawal_id']?>"
												data-toggle="modal"
												data-target="#confirmModal"
												class="text-primary mr-2 click_withdrawal <?=($isComplete?'disabled' :'')?>"
												href="javascript:void(0);"
												title="Thanh toán cho công tác viên"
											>
												<i class="fas fa-random"></i>
											</a>

											<!--<a class="text-danger" id="delete-item" data-url="<?php /*=$linkDelete*/?>&id=<?php /*=$items[$i]['withdrawal_id']*/?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>-->
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



<style>
	.page-breadcrumb i{
		color:#fff;
		padding: .225rem;
	}
</style>


