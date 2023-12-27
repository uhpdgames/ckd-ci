<div class="w_1000">
    <div class="affiliate text-center mx-auto wrap ctv thanh-toan">
        <div class="title-main"><span><?= getLang('xacnhanruttien') ?></span></div>
        <hr class="p-0 my-4 f-small"/>
        <?php
        $bank = $_Affiliate->getBackAccount();
        $revenue = $_Affiliate->getTotalRevenue();
        ?>


        <div class="row justify-content-around">
            <div class="col-12 col-lg-6 wp_form col col-m-6">
                <div class="wrap-text">
                    <div class="fw-600">Chuyển đến</div>
                    <p class="my-2 f-small sub-text">Chuyển khoản ngân
                        hàng <?php echo !empty($_Affiliate->getSTK()) ? '(' . $_Affiliate->getSTK() . ')' : ''; ?></p>
                </div>

                <div class="wrap-text my-5">
                    <div class="fw-600">Số tiền rút</div>
                    <div class="f-small sub-text d-flex flex-row">
                        <!--<span class="cent d-block px-0">đ</span>-->
                        <span class="ml-0" id="amountTransfer"><?= $revenue; ?></span>

                    </div>
                </div>

                <div class="wrap-text my-5">
                    <div class="fw-600">Phí dịch vụ</div>
                    <div class="f-small sub-text d-flex flex-row"><span
                                class="cent d-block px-0">đ</span>
                        <span class="ml-0" id="fee">
                          0
                        </span>
                    </div>
                </div>

                <div class="wrap-text my-5">
                    <div class="fw-600">(VAT)</div>
                    <div class="f-small sub-text d-flex flex-row"><span
                                class="cent d-block px-0">đ</span><span
                                class="ml-0"><?= $_Affiliate->getVAT(); ?></span></div>
                </div>

                <div class="wrap-text my-5">
                    <div class="fw-600">(CIT)</div>
                    <div class="f-small sub-text d-flex flex-row"><span
                                class="cent d-block px-0">đ</span><span
                                class="ml-0"><?= $_Affiliate->getCIT(); ?></span></div>
                </div>

                <div class="wrap-text my-5 mb-5">
                    <div class="fw-600">Nhận tiền</div>
                    <div class="f-small sub-text d-flex flex-row">
                        <!-- <span class="cent d-block px-0">đ</span>-->
                        <span class="ml-0" id="CurrentReceivedTransfer"></span></div>
                </div>


            </div>
            <div class="col-12 col-lg-6 col col-m-6 h-fit-auto">
                <div class="wp_form p-2">
                    <div class="wrap-text my-2 mb-2">
                        <div class="fw-600">Lưu ý</div>
                        <div class="f-small sub-text mt-2 mb-4">
                            Việc nhập thông tin không chính xác sẽ khiến giao dịch bị từ chối, và bạn sẽ chịu mọi
                            chi
                            phí liên quan đến quá trình xử lý yêu cầu của mình.
                        </div>
                    </div>
                </div>
                <?php if ($revenue > 0 && $_Affiliate->getSTK() != ''): ?>


                    <div class="text-center money-btn f"><a href="javascript:void(0)" class="btn btn-primary"
                                                            id="Confirm">Xác nhận rút tiền</a></div>

                <?php endif; //echo $_Affiliate->link_generators('confirm_transfer');?>
            </div>
        </div>
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
                                THÀNH CÔNG
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
    </div>
</div>
<hr class="p-0 my-4 f-small"/>

<style>
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
    var vat = parseInt("<?=$_Affiliate->getVAT();?>");
    var cit = parseInt("<?=$_Affiliate->getCIT();?>");
    var balance = parseInt("<?=$_Affiliate->getMoney();?>");

    const formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    $(document).ready(function () {
        $('#fee').text(formatter.format(feeReceived()));
        $('#vat').text(formatter.format(vat));
        $('#cit').text(formatter.format(cit));

        var amountTransfer = parseInt(sessionStorage.getItem("amountTransfer"))
        var CurrentReceivedTransfer = parseInt(sessionStorage.getItem("CurrentReceivedTransfer"))

        $('#amountTransfer').text(formatter.format(amountTransfer));
        $('#CurrentReceivedTransfer').text(formatter.format(CurrentReceivedTransfer));


        $('#Confirm').click(function () {
            $('#Confirm').prop('disabled', true)

            $("#myModalError").modal("hide");
            $("#myModalSucc").modal("hide");

            $.ajax({
                url: site_url() + 'ajax/ajax_affiliate.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    amount: amountTransfer,
                    received: CurrentReceivedTransfer,
                },
                success: function (data) {
                    console.log(data);

                    $('#Confirm').prop('disabled', false);

                    if (data.status == 'update' || data.status == "insert") {
                        $("#myModalSucc").modal("show");
                    } else {
                        $("#myModalError").modal("show");
                    }

                },
                error: function (e) {
                    $('#Confirm').prop('disabled', false);

                    $("#myModalError").modal("show");
                }
            });
        })

    })

    function feeReceived() {
        return (vat + cit)
    }

    $('#myModalSucc').on('hide.bs.modal', function () {
        window.location.href = site_url() + 'account/thong-tin-thu-nhap';
    })


</script>


