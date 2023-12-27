<?php

$linkMan = "";
$linkAdd = "";
$linkEdit = "";
$linkDelete = "";
$linkDetails = "";

$info = $_Affiliate->getInfoRef();
$data = $_Affiliate->product_details();

$product_info = array();

/**
 *
 * $link=1;
 * $visits=1;
 * $registered=1;
 * $purchased=1;
 * $commissions=1;
 */


$link = '';//$_Affiliate->share( );
$visits = 0;
$commissions = 0;

$linkAdd = "index.php?com=user&act=add&p=0";


?>


<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">

	<div class="row">
		<div class="col-12">
			<div class="mb-2">
				<h1>Quản lý cộng tác viên</h1>
				<div class="top-right-button-container">

				</div>


				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a href=".">Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="/">Quản lý cộng tác viên</a>
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

<!-- Main content -->
<section class="content container-fluid affiliate">


		<div class="row w-100">
			<div class="col-md-12 col-xl-6">
				<div class="icon-cards-row">
					<div class="glide dashboard-numbers">
						<div class="glide__track" data-glide-el="track">
							<ul class="glide__slides">
								<li class="glide__slide">
									<a href="#" class="card">
										<div class="card-body text-center">
											<i class="iconsminds-clock"></i>
											<p class="card-text mb-0">Tổng tiền kiếm được</p>
											<p class="lead text-center"><?= $_Affiliate->getTempRevenue(); ?></p>
										</div>
									</a>
								</li>
								<li class="glide__slide">
									<a href="#" class="card">
										<div class="card-body text-center">
											<i class="iconsminds-basket-coins"></i>
											<p class="card-text mb-0">Tổng tiền trong ví</p>
											<p class="lead text-center"><?= $_Affiliate->getTotalRevenue(); ?></p>
										</div>
									</a>
								</li>
								<li class="glide__slide">
									<a href="#" class="card">
										<div class="card-body text-center">
											<i class="iconsminds-arrow-refresh"></i>
											<p class="card-text mb-0">Tổng tiền đã rút</p>
											<p class="lead text-center"><?= $_Affiliate->totalWithdrawn(); ?></p>
										</div>
									</a>
								</li>
								<li class="glide__slide">
									<a href="#" class="card">
										<div class="card-body text-center">
											<i class="iconsminds-mail-read"></i>
											<p class="card-text mb-0">Tổng tiền đã gửi</p>
											<p class="lead text-center"><?= $_Affiliate->totalTransferToWallet(); ?></p>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>


		</div>


	<div class="row">
		<div class="col col-md-3">
			<div class="card card-primary card-outline text-sm mb-0">
				<div class="card-header">
					<div class="title mt-3"><h2>Thông tin cộng tác viên</h2></div>
				</div>
				<div class="card-body table-responsive p-0">
					<div class="wp-box h-auto p-4 m-0">
						<div class="d-flex flex-row">
							<label for="email">Tên Email : </label>
							<div class="email name"><?= $info['email']??''; ?></div>
						</div>

						<div class="d-flex flex-row">
							<label for="sdt">Số điện thoại : </label>
							<div class="sdt name"><?= $info['dienthoai']??''; ?></div>
						</div>
						<div class="d-flex flex-row">
							<label for="diachi">Địa chỉ : </label>
							<div class="diachi name"><?= $info['diachi']??''; ?></div>
						</div>

						<div class="d-flex flex-row">
							<label for="stk">Số tài khoản : </label>
							<div class="stk name"><?= $_Affiliate->getSTK()??''; ?></div>
						</div>
						<div class="d-flex flex-row">
							<label for="stk">Mã giới thiệu : </label>
							<div class="stk name"><?= $_Affiliate->getRefInfo('code')??''; ?></div>
						</div>
						<div class="d-flex flex-row">
							<label for="stk">Tổng lượt nhấp : </label>
							<div class="stk name"><?= $data['visits']??''; ?></div>
						</div>
						<div class="d-flex flex-row">
							<label for="stk">Tổng đơn hàng : </label>
							<div class="stk name"><?= $_Affiliate->getAllOrder()??''; ?></div>
						</div>
						<div class="d-flex flex-row">
							<label for="stk">Số đơn đã bán : </label>
							<div class="stk name"><?= $_Affiliate->getAllSeller()??''; ?></div>
						</div>
						<!--    <div class="d-flex flex-row">
                            <label for="stk">Đang chờ xử lý : </label>
                            <div class="stk name"><?php /*= $_Affiliate->getAllOrderPending(); */ ?></div>
                        </div>-->
						<div class="d-flex flex-row">
							<label for="stk">Người mua mới : </label>
							<div class="stk name"><?= $_Affiliate->getNewBuyer()??''; ?></div>
						</div>
						<div class="d-flex flex-row">
							<label for="stk">Cấp độ </label>
							<div class="stk name">LEVEL - <?= $_Affiliate->getCurrentLevel()??''; ?></div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col col-md-9">

			<div class="card card-primary card-outline text-sm mb-0 h-auto">
				<div class="card-header">
					<div class="title mt-3"><h2>Chi tiết</h2></div>
				</div>
				<div class="card-body table-responsive p-0 ">

						<table id="demo-foo-addrow"
							   class="ml-3 m-t-30 no-wrap table-hover contact-list data-table data-voucher">
						<thead>
						<tr>
							<!--<th class="align-middle" width="5%">
								<div class="custom-control custom-checkbox my-checkbox">
									<input type="checkbox" class="custom-control-input" id="selectall-checkbox">
									<label for="selectall-checkbox" class="custom-control-label"></label>
								</div>
							</th>-->
							<th class="align-middle" width="10%">Order ID</th>
							<!--<th class="align-middle" width="10%">Visits</th>-->
							<th class="align-middle" width="10%">Buyer By</th>
							<th class="align-middle" width="10%">Order status</th>
							<th class="align-middle" width="10%">Commissions</th>
							<th class="align-middle" width="10%">Date Created</th>
							<th class="align-middle" width="10%">Status</th>
						</tr>
						</thead>
						<?php if (empty($items)) { ?>
							<tbody>
							<tr>
								<td colspan="100" class="text-center"><span
										class="no-content">Không có dữ liệu</span></td>
							</tr>
							</tbody>
						<?php } else {


							?>
							<tbody>
							<?php

							$statusxx = array(
								'Đang chờ xử lý',
								'Đã xác nhận đơn',
								'Đang xử lý',
								'Đang vận chuyển',
								'Đã hoàn thành',
								'Đã hủy',
							);

							for ($i = 0; $i < count($items); $i++) { ?>
								<?php
								$ref_id = $items[$i]['id'];
								//$visits = !empty($items[$i]['visits']) ? $items[$i]['visits'] : 0;
								$product_info[$ref_id] = !empty($items[$i]['product_list']) ? json_decode($items[$i]['product_list']) : '';

								$link = !empty($items[$i]['madonhang']) ? $items[$i]['madonhang'] : '';
								$purchased = !empty($items[$i]['tinhtrang']) ? '<span class="label label-' . ($items[$i]['tinhtrang'] == 4 ? "primary" : "info") . '">' . $statusxx[$items[$i]['tinhtrang']] . '</span>' : '';
								$commissions = !empty($items[$i]['revenue']) ? number_format($items[$i]['revenue'], 0, '', '.') . ' VNĐ' : '';
								//$registered = $items[$i]['buyer_uid'] != 0 ? '<a href="./index.php?com=user&act=edit&id=' . $items[$i]['buyer_uid'] . '"></a>' : 'guest';
								$registered = 'guest';

								$userName = $d->rawQueryOne("select username from #_member where id = ? limit 0,1", array($items[$i]['buyer_uid']));
								if ($userName) {
									$registered = $items[$i]['buyer_uid'] != 0 ? '<a href="./index.php?com=user&act=edit&id=' . $items[$i]['buyer_uid'] . '">' . $userName['username'] . '</a>' : 'guest';
								}

								$status = '<span class="label label-warning">Pending</span>';
								if ($items[$i]['hienthi'] == 1) $status = '<span class="label label-primary">Complete</span>';
								?>
								<tr>
									<td class="align-middle">
                                        <span>
                                            <a
												class="product-order-ref"
												data-id="<?= $ref_id; ?>"
												data-order_id="<?= $items[$i]['orderid'] ?>"
												data-toggle="modal" data-target=".order-details"
												href="javascript:void(0)"><?= $link; ?></a>
                                        </span>
									</td>

									<td class="align-middle">
										<span><?= $registered; ?></span>
									</td>
									<td class="align-middle">
										<span><?= $purchased; ?></span>
									</td>
									<td class="align-middle">
										<span class="text-danger font-weight-bold"><?= $commissions; ?></span>
									</td>

									<td class="align-middle">
										<span><?= date('d-m-Y H:i:s', strtotime($items[$i]['date_create'])); ?></span>
									</td>

									<td class="align-middle">
										<?= $status; ?>
									</td>

								</tr>
							<?php } ?>
							</tbody>
						<?php } ?>
					</table>
				</div>
			</div>


		</div>
	</div>


</section>

<!-- Large modal -->

<div class="modal fade order-details" tabindex="-1" role="dialog" aria-hidden="true" id="exampleModal">
	<div class="modal-dialog modal-lg" style=" max-width: 70%;">
		<div class="modal-content" style="width:auto">
			<div class="card card-primary card-outline text-sm mb-0 h-auto">
				<div class="card-header">
					<div class="title-modal">Product List</div>
				</div>
				<div class="card-body table-responsive p-0 ">
					<table class="table table-hover ">
						<thead>
						<tr>
							<th class="align-center align-middle" width="1%">Num.</th>
							<!--<th class="align-left align-middle" width="10%">Code</th>-->
							<th class="align-left align-middle" width="10%">Image</th>
							<th class="align-left align-middle" width="30%">Name</th>
							<th class="align-left align-middle" width="10%">Price</th>
							<th class="align-left align-middle" width="2%">Qty</th>
							<th class="align-left align-middle" width="2%">Earn</th>
						</tr>
						</thead>
						<tbody id="tbody_product" style="height: auto;">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		const formatter = new Intl.NumberFormat('vi-VN', {
			style: 'currency',
			currency: 'VND',

		});

		var base_url = '<?=$config_base;?>';
		var rate = '<?=$_Affiliate->getRate();?>';
		var product_info = JSON.parse('<?= json_encode($product_info); ?>');

		function updateProductInfo(product) {
			var html = '';
			let stt = 1;
			for (let p of product) {
				let earn = formatter.format((p.gia * p.qty) * (rate / 100));
				let price = formatter.format(p.gia);
				let image = `<img width="60" src="${base_url}/upload/product/${p.photo}" />`;

				html += `<tr>`;
				html += `<td class="align-center align-middle" width="1%"><span>${stt++}</span></td>`;
				/*html += `<td class="align-left align-middle" width="10%"><span style="font-weight: bolder;color:red">${p.masp || "222"}</span></td>`;*/
				html += `<td class="align-left align-middle" width="10%"><span>${image}</span></td>`;
				html += `<td class="align-left align-middle" width="30%"><span>${p.ten}</span></td>`;
				html += `<td class="align-left align-middle" width="10%"><span>${price}</span></td>`;
				html += `<td class="align-left align-middle" width="2%"><span>${p.qty}</span></td>`;
				html += `<td class="align-left align-middle" width="2%"><span>${earn}</span></td>`;
				html += `</tr>`;

			}
			$('#tbody_product').html(html);
		}

		$('body').on('click', '.product-order-ref', function () {
			var _id = $(this).data('id');
			console.log()
			const product = product_info[_id];
			if (product.length > 0) updateProductInfo(product);
		})

		$('#exampleModal').on('show.bs.modal', function (e) {

		})

	});


</script>

<style>
	.modal-content {
		position: relative;
		padding: 0;
		margin: 0;
		max-height: 90vh;
		overflow: auto;
	}

</style>
