<div class="w_1000">
    <div class="affiliate text-center mx-auto wrap ctv">
        <div class="title-main"><span><?= getLang('thongtinchitiet') ?></span></div>
        <hr class="p-0 my-4 f-small w_1000"/>
        <div class="container text-center mx-auto">
            <div class="info d-flex flex-wrap">
                <div class="count">
                    <div class="label f-small sub-text">Số lượt nhập chuột</div>
                    <div class="order-count fw-900"><?= !empty($data['visits']) ? $data['visits'] :'0'; ?></div>
                </div>
                <div class="order">
                    <div class="label f-small sub-text">Đơn hàng</div>
                    <div class="order-count fw-900"><?= !empty($data['item']) ? $data['item'] :'0'; ?></div>
                </div>
                <div class="hoahong">
                    <div class="label f-small sub-text">Ước tính hoa hồng</div>
                    <div class="order-count fw-900"><?= !empty($data['commission']) ? $data['commission'] :'0'; ?>%</div>
                </div>
                <div class="sell">
                    <div class="label f-small sub-text">Số lượng đã bán</div>
                    <div class="order-count fw-900"><?= !empty($data['sell']) ? $data['sell'] :'0'; ?></div>
                </div>
                <div class="total">
                    <div class="label f-small sub-text">Tổng hóa đơn</div>
                    <div class="order-count fw-900"><?= !empty($data['total_item']) ? $data['total_item'] :'0'; ?></div>
                </div>
                <div class="new">
                    <div class="label f-small sub-text">Người mua mới</div>
                    <div class="order-count fw-900"><?= !empty($data['new_buy']) ? $data['new_buy'] :'0'; ?></div>
                </div>
            </div>
        </div>
    </div>
    <hr class="p-0 my-4 f-small"/>
    <div class="affiliate text-center mx-auto my-4 wrap ctv">
        <div class="container text-center mx-auto">
            <div class="title-main"><span>Sản phẩm của tôi</span></div>

            <div class="container">
                <?=$product;?>
            </div>

        </div>
    </div>
</div>

<hr class="p-0 my-4 f-small"/>
