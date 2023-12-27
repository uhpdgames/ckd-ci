<div class="w_1000">
    <div class="affiliate mx-auto wrap ruttien">
        <div class="title-main"><span><?= getLang('ruttien') ?></span></div>
        <hr class="p-0 my-4 f-small"/>
        <?php
        /*$bank = isset($_SESSION[$login_ctv]['bank']) ? $_SESSION[$login_ctv]['bank'] : array();
        $revenue = isset($_SESSION[$login_ctv]['revenue']) ? $_SESSION[$login_ctv]['revenue'] : 0;*/
        $bank = $_Affiliate->getBackAccount();
        $revenue = $_Affiliate->getTotalRevenue();
        ?>

        <div class="wrap-info d-flex justify-content-between wp_form">
            <div class="l">
                <p class="fw-600">Tài khoản rút tiền</p>
                <p class="fw-600 my-2">Chuyển khoản ngân
                    hàng <?php echo !empty($_Affiliate->getSTK()) ? '(' . $_Affiliate->getSTK() . ')' : ''; ?></p>
                <div class="f-small sub-text">Số tiền tối thiệu
                    là: <?= number_format($_Affiliate->getMinWithDraw(), 0, '', '.'); ?> VNĐ
                </div>
                <div class="f-small sub-text">Số tiền rút tối đa
                    là: <?= number_format($_Affiliate->getMaxWithDraw(), 0, '', '.'); ?> VNĐ
                </div>
                <div class="f-small sub-text">Bạn sẽ nhận được tiền sau 3 - 5 ngày làm việc</div>
            </div>
            <div class="r">
                <p class="fw-600">
                    <?= $_Affiliate->link_generators('add_bank'); ?>
                </p>
            </div>
        </div>

        <?php if ($revenue != 0): ?>
            <div class="wrapper-money wp_form">
                <p class="fw-600">Số tiền</p>
                <div class="my-2 f-big fw-600 money">
                    <input type="text" onchange="updateAmount()" onclick="clickRemove()" onkeypress='validate(event)' autofocus id="amount"
                           class="form-control" style="font-size: 2rem; font-weight: bold;"/>
                    <!--<span class="cents">đ</span>-->
                </div>
            </div>
        <?php endif; ?>

        <div class="wrapper-info d-flex justify-content-between wp_form">
            <div class="l">
                <div class="fw-600 money d-flex flex-row">Số dư khả dụng: <span>&nbsp;<?= $revenue; ?></span></div>
                <p class="fw-600 my-2">Số tiền nhận được ước tính</p>
                <p class="f-small d-block">Phí dịch vụ</p>
                <p class="f-small d-block">(VAT)</p>
                <p class="f-small d-block">(CIT)</p>
            </div>
            <div class="r">
                <div class="fw-600">Rút số dư</div>
                <div class="fw-600 money d-flex flex-row justify-content-end my-2">
                    <!--<span class="cent d-block px-0">đ</span>-->
                    <span class="ml-0 my-money" id="currentReceived">0</span>
                </div>
                <div class="f-small money d-flex flex-row  justify-content-end my-2">
                    <span class="ml-0 my-money" id="fee">0</span>
                </div>
                <div class="f-small money d-flex flex-row  justify-content-end my-2">
                    <span class="ml-0 my-money" id="vat">0</span>
                </div>
                <div class="f-small money d-flex flex-row  justify-content-end my-2">
                    <span class="ml-0 my-money" id="cit">0</span>
                </div>
            </div>
        </div>

        <div class="error-log text-center" style="color:red"></div>

        <?php if ($revenue > 0 && $_Affiliate->getSTK() != ''): echo $_Affiliate->link_generators('now_transfer');endif; ?>

    </div>
</div>

<hr class="p-0 my-4 f-small"/>


<script>


    var vat = parseInt("<?=$_Affiliate->getVAT();?>");
    var cit = parseInt("<?=$_Affiliate->getCIT();?>");
    var balance = parseInt("<?=$_Affiliate->getMoney();?>");

    const formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    function clickRemove(){
        $('.btn-primary').addClass("disabled");
        $('#amount').val("");
        $('.btn-primary').removeClass("disabled");
    }
    function updateAmount() {
        $('.btn-primary').addClass("disabled");
        let _amount = $('#amount').val();
        $('#amount').val(formatter.format(_amount));
        $('#currentReceived').text(getCurrentReceived());

        if ($('#amount').val() == 'NaN ₫') {
            $('#amount').val("")
            $('#currentReceived').val("")
        }
        if ($('#currentReceived').val() == 'NaN ₫') {
            $('#currentReceived').val("0")
        }
        $('.btn-primary').removeClass("disabled");
    }

    function amount(old = null) {
        let ole;
        if (old == null) {
            ole = $('#amount').val();
        } else {
            ole = old;
        }
        let test = ole.replace('₫', '');

        return test.replace(/\./gi, "");
    }

    function getCurrentReceived($amount = 0) {
        if ($amount == 0) {
            $amount = $('#amount').val();
        }
        let revenue = amount($amount) - feeReceived();
        return formatter.format(revenue)
    }

    function feeReceived() {
        return (vat + cit)
    }


    $(document).ready(function () {
        $('#fee').text(formatter.format(feeReceived()));
        $('#vat').text(formatter.format(vat));
        $('#cit').text(formatter.format(cit));

        $('.money-btn a').click(function (e) {
            let mess = 'Có lỗi xảy ra!';

            var _amount = amount($('#currentReceived').text());
            var _request = amount($('#amount').val());

            if (_amount > balance) {
                mess = 'Số dư của bạn không khả dụng!';
            } else if (_amount <= 0) {
                mess = 'Số tiền bạn nhận không hợp lệ!';
            } else {
                mess = '';
                sessionStorage.setItem("CurrentReceivedTransfer", _amount);
                sessionStorage.setItem("amountTransfer", _request);

                window.location.href = "<?= $_Affiliate->getLink('now_transfer');?>"
            }

            $('.error-log').html(mess);
        });

    })


</script>
