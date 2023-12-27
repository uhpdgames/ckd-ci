<?php

global $_Affiliate;
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

$linkAdd = "index.php?com=user&act=add&p=" . $curPage;


?>

<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý cộng tác viên</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content container-fluid affiliate">
    <div class="row my-4">
        <div class="col col-12">
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-primary font-weight-bold text-capitalize text-sm">Total Earning</span>
                            <p class="info-box-text text-sm mb-0"><span
                                        class="text-danger font-weight-bold"><?= $_Affiliate->getTempRevenue();?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-primary font-weight-bold text-capitalize text-sm">Balance</span>
                            <p class="info-box-text text-sm mb-0"><span
                                        class="text-danger font-weight-bold"><?= $_Affiliate->getTotalRevenue(); ?></span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon  bg-success elevation-1">
                            <i class="far fa-money-bill-alt"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-primary font-weight-bold text-capitalize text-sm">Withdrawn</span>
                            <p class="info-box-text text-sm mb-0"><span
                                        class="text-danger font-weight-bold"><?= $_Affiliate->totalWithdrawn(); ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-random"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text text-primary font-weight-bold text-capitalize text-sm">Transfer To Wallet</span>
                            <p class="info-box-text text-sm mb-0"><span
                                        class="text-danger font-weight-bold"><?= $_Affiliate->totalTransferToWallet(); ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-3">
            <div class="card card-primary card-outline text-sm mb-0">
                <div class="card-header">
                    <div class="title">creative affiliate link</div>
                </div>
                <div class="card-body table-responsive p-0">
                    <div class="wp-box h-auto p-4 m-0">
                        <div class="d-flex flex-row">
                            <label for="email">Tên Email : </label>
                            <div class="email name"><?= $info['email']; ?></div>
                        </div>

                        <div class="d-flex flex-row">
                            <label for="sdt">Số điện thoại : </label>
                            <div class="sdt name"><?= $info['dienthoai']; ?></div>
                        </div>
                        <div class="d-flex flex-row">
                            <label for="diachi">Địa chỉ : </label>
                            <div class="diachi name"><?= $info['diachi']; ?></div>
                        </div>

                        <div class="d-flex flex-row">
                            <label for="stk">Số tài khoản : </label>
                            <div class="stk name"><?= $_Affiliate->getSTK(); ?></div>
                        </div>
                        <div class="d-flex flex-row">
                            <label for="stk">Mã giới thiệu : </label>
                            <div class="stk name"><?= $_Affiliate->getRefInfo('code'); ?></div>
                        </div>
                        <div class="d-flex flex-row">
                            <label for="stk">Tổng lượt nhấp : </label>
                            <div class="stk name"><?= $data['visits']; ?></div>
                        </div>
                        <div class="d-flex flex-row">
                            <label for="stk">Tổng đơn hàng : </label>
                            <div class="stk name"><?= $_Affiliate->getAllOrder();?></div>
                        </div>
                        <div class="d-flex flex-row">
                            <label for="stk">Số đơn đã bán : </label>
                            <div class="stk name"><?= $_Affiliate->getAllSeller(); ?></div>
                        </div>
                    <!--    <div class="d-flex flex-row">
                            <label for="stk">Đang chờ xử lý : </label>
                            <div class="stk name"><?php /*= $_Affiliate->getAllOrderPending(); */?></div>
                        </div>-->
                        <div class="d-flex flex-row">
                            <label for="stk">Người mua mới : </label>
                            <div class="stk name"><?= $_Affiliate->getNewBuyer(); ?></div>
                        </div>
                        <div class="d-flex flex-row">
                            <label for="stk">Cấp độ </label>
                            <div class="stk name">LEVEL - <?=$_Affiliate->getCurrentLevel();?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col col-md-9">

            <div class="card card-primary card-outline text-sm mb-0 h-auto">
                <div class="card-header">
                    <div class="title">Order affiliate</div>
                </div>
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover ">
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
                                $purchased = !empty($items[$i]['tinhtrang']) ? '<span class="label label-'.($items[$i]['tinhtrang'] == 4 ? "primary" : "info"). '">'.$statusxx[$items[$i]['tinhtrang']].'</span>' : '';
                                $commissions = !empty($items[$i]['revenue']) ? number_format($items[$i]['revenue'], 0, '', '.') . ' VNĐ' : '';
                                //$registered = $items[$i]['buyer_uid'] != 0 ? '<a href="./index.php?com=user&act=edit&id=' . $items[$i]['buyer_uid'] . '"></a>' : 'guest';
                                $registered = 'guest';

                                $userName = $d->rawQueryOne("select username from #_member where id = ? limit 0,1",array($items[$i]['buyer_uid']));
                                if($userName){
                                    $registered = $items[$i]['buyer_uid'] != 0 ? '<a href="./index.php?com=user&act=edit&id=' . $items[$i]['buyer_uid'] . '">'.$userName['username'].'</a>' : 'guest';
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
            <?php if ($paging) { ?>
                <div class="card-footer text-sm pb-0">
                    <?= $paging ?>
                </div>
            <?php } ?>

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

        function updateProductInfo (product) {
            var html = '';
            let stt = 1;
            for(let p of product){
                let earn = formatter.format((p.gia * p.qty) * (rate / 100)) ;
                let price = formatter.format(p.gia) ;
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

        $('body').on('click', '.product-order-ref', function (){
            var _id = $(this).data('id');
            console.log()
            const product = product_info[_id];
            if(product.length > 0) updateProductInfo (product);
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
        overflow:auto;}

</style>