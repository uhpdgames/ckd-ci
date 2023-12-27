<?php
global $_Affiliate;
$linkMan = "#";
$linkEdit = "#";
$linkDelete = "#";
?>

<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý liên hệ</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content affiliate ">

<!--    <div class="card-footer text-sm sticky-top">
        <a class="btn btn-danger rounded-pill" id="delete-all" data-url="<?php /*=$linkDelete*/?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <div class="form-inline form-search d-inline-block align-middle ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?php /*=(isset($_GET['keyword'])) ? $_GET['keyword'] : ''*/?>" onkeypress="doEnter(event,'keyword','<?php /*=$linkMan*/?>')">
                <div class="input-group-append bg-primary rounded-right">
                    <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','<?php /*=$linkMan*/?>')">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>-->

    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách chờ lệnh thanh toán</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
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
    <?php if($paging) { ?>
        <div class="card-footer text-sm pb-0">
            <?=$paging?>
        </div>
    <?php } ?>
</section>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Xác nhận chuyển khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="font-size: x-large;color:red;font-weight: bolder; font-size: 1rem; color: #808080;  ">
                    Bạn có chắc chắn thanh toán cho cộng tác viên với số tiền: <span class="amount"></span>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Bỏ qua</button>
                <button type="button" class="btn btn-primary" onclick="send_process();">Chấp nhận</button>
            </div>
        </div>
    </div>
</div>
<script>
    let rawData = {};
    function send_process(){
        $rs =  $.ajax({
            dataType: 'json',
            async: false,
            url: 'ajax/ajax_affiliate.php',
            type: 'POST',
            cache: false,
            data: rawData ,
            success: function(data) {

                if(data == 1){
                    location.reload();
                }
            },
            error: function(e) {

            }
        });
    }

    $('#confirmModal').on('hidden.bs.modal', function (e) {

    });

    $('.click_withdrawal').on('click', function (e) {
        const id = $(this).data('id');
        const amount = $(this).data('amount');
        const uid = $(this).data('uid');

        $('.amount').text(amount);
        rawData = {
            id: id,
            uid:uid,
            amount:amount,
        };
    })
</script>

<style>
    a.disabled {
        pointer-events: none;
        cursor: default;
        color: #dee2e6 !important;

    }
</style>