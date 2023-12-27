<div class="w_1000">
    <div class="affiliate text-center mx-auto wrap">
        <div class="title-main"><span><?= getLang('tongthunhap') ?></span></div>
        <hr class="p-0 my-4 f-small w_1000"/>
        <?php
        @ini_set('display_errors', '0');
        @ini_set('display_startup_errors', 0);
        @error_reporting(0);

        $bank = $_Affiliate->getBackAccount();
        $revenue = $_Affiliate->getTotalRevenue();
        ?>

        <div class="text-center">
            <div class="f-big revenue p-0 m-0">
                <div class="money">
                    <?= $revenue ?><span class="cent-top"></span>
                </div>

            </div>
            <div class="my-3 fw-600">Số dư khả dụng</div>
            <div class="mt-4">
                <?php if ($revenue > 0): echo $_Affiliate->link_generators('transfer');endif; ?>
            </div>
        </div>
    </div>
</div>

<hr class="p-0 my-4 f-small"/>

<div class="container">
    <table class="table table-hover" width="100%">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Số tiền yêu cầu rút</th>
            <th scope="col">Ngày rút</th>
            <th scope="col">Trạng thái</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $request = $_Affiliate->getAllRequestWithDrawal();

        if (is_array($request) && count($request)) {
            $stt = 1;
            foreach ($request as $item) {
                $Pending = '<span class="badge bg-primary text-dark">Đã thanh toán</span>';
                if ($item['status'] == 0) {
                    $Pending = '<span class="badge bg-dark text-dark">Đang chờ xử lý</span>';

                }
                ?>

                <tr>
                    <th scope="row"><?= $stt; ?></th>
                    <th scope="row"><?= $_Affiliate->formatMoney($item['amount']); ?> VNĐ</th>
                    <th scope="row"><?= $item['withdrawal_date'] ?></th>

                    <th scope="row">
                        <?= $Pending; ?>
                    </th>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>

<style>
    span.badge {
        display: inline;
        padding: 0.2em 0.6em 0.3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff !important;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25em;

    }


    .modal-confirm .modal-content {
        padding: 1rem;
        border-radius: 15px;
        border: none;
        width: 25rem;
    }

    .modal .title {
        text-transform: uppercase;
        color: #89c941;
        font-weight: bolder;
        padding: .25rem 0;
        margin: 0;
    }

    .modal.fail .title {
        color: #f34336;
    }

    .modal .modal-header {
        margin-top: 0;
        margin-bottom: 0;
        padding-bottom: 0;
        padding-top: 0;
    }

    .modal .modal-body {
        width: 20rem;
        margin: auto;
    }

    .modal .modal-body span {
        font-style: normal;
        font-weight: normal;
        font-size: 1rem;
        line-height: 1;
    }

    .modal-confirm .modal-footer {

    }

    .modal-confirm .btn {
        background-color: #89c941;
        color: #fff;
        font-size: 1rem;
        font-weight: bolder;
        width: 13rem;
        border-radius: 15px;
        margin: auto;
    }

    .modal.fail .modal-confirm .btn {
        background-color: #f34336;
    }
</style>


<script>
    $(document).ready(function () {

        $('#requestTransfer').click(function (e) {
            e.preventDefault();

            checkIsset();

        })


        function checkIsset() {
            $.ajax({
                url: site_url() + 'ajax/ajax_affiliate_isset.php',
                type: 'POST',
                dataType: 'json',
                data: {amount: true},
                success: function (data) {
                    if (data.status) {
                        $("#myModalSucc").modal("show");
                    } else {
                        window.location.href = site_url() + 'account/thong-tin-chuyen-khoan';
                    }

                },
                error: function (e) {
                    $("#myModalError").modal("show");
                }
            });
        }
    })

</script>


<div id="myModalError" class="modal fail fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img style="width: 4rem;" src="<?= site_url() ?>assets/icon/fail.jpg">
                    <div class="title w-300">
                        THẤT BẠI
                    </div>
                    <span>Gửi yêu cầu thất bại, vui lòng thử lại sau. Hoặc liên hệ với chúng tôi</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">Thử lại</button>
            </div>
        </div>
    </div>
</div>
<div id="myModalSucc" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img style="width: 4rem;" src="<?= site_url() ?>assets/icon/ok.jpg">
                    <div class="title w-300">
                        YÊU CẦU RÚT TIỀN ĐANG XỬ LÝ
                    </div>
                    <span>Chúng tôi sẽ xử lý yêu cầu của bạn trong thời gian sớm nhất</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
