<div class="main_fix">
<div class="w_1000">
    <div class="affiliate text-center mx-auto wrap pt-5 pb-5">
        <div class="wp_form bank m-auto p-0 chinhsach">
            <div class="h5 wap_form_title"><?= getLang('dieukhoanchinhsach ')?></div>
            <div class="info d-flex flex-column justify-content-center text-center flex-wrap align-items-center">
                <div class="wrap-text p-4">
                    <div class="text content mCustomScrollbar" data-mcs-theme="dark">
                        <div class="h4 text-uppercase m-0 p-0 mb-2">
                            Thông tin chính sách
                        </div>
						Trên thị trường hiện nay có rất nhiều loại mỹ phẩm, thương hiệu với khác nhau, điều này khiến cho quý khách hàng và đại lý hoang mang, không biết chọn lựa sao cho đúng một thương hiệu, một địa chỉ uy tín để nhập hàng. Với mục tiêu phát triển lâu dài, bền vững, mong muốn đưa sản phẩm CKD đến một giải pháp phù hợp với làn da người dùng tại VIỆT NAM nhiều hơn một thương hiệu đình đám top 3 tại HÀN QUỐC. Hiện nay có nhiều chính sách tuyển đại lý hấp dẫn, các chính sách được đưa ra minh bạch, rõ ràng, tạo điều kiện tối đa nhất cho các đại lý muốn kinh doanh dòng sản phẩm an toàn, chất lượng này.
						Dưới đây là chính sách cụ thể cho Đại lý, Tổng đại lý phân phối mỹ phẩm CKD
                        <div class="my-2"></div>
                        Dưới đây là chính sách cụ thể cho Đại lý, Tổng đại lý phân phối sản phẩm &nbsp;&nbsp;&nbsp;
                        <div class="my-4"></div>
                        <div class="h4 text-uppercase m-0 p-0 mb-2">
                            Quyền lợi đại lý
                        </div>
                        <div class="my-2"></div>
						1. Nhận chứng nhận Đại lí cấp cao, tổng đại lí, nhà phân phối. Công ty cam kết chuyển thông tin khách hàng trong khu vực cho hệ thống Đại lý cấp cao, tổng đại lí, nhà phân phối tương ứng theo địa phương.
                        <div class="my-2"></div>
						2. Hỗ trợ mở Showroom theo đúng tiêu chuẩn cho nhà phân phối có nhu cầu.
                        <div class="my-2"></div>
						3. Công ty cho phép đổi, trả, hoàn tiền bất kì sản phẩm theo điều lệ của công ty.
                        <div class="my-2"></div>
						4. Được đào tạo kinh doanh từ những chuyên gia uy tín hàng đầu Việt Nam và Hàn Quốc.
                        <div class="my-2"></div>
						5. Sử dụng hình ảnh của Đại Sứ Thương Hiệu để bảo chứng uy tín đại lý.
                        <div class="my-2"></div>
						6. Hỗ trợ công nghệ quản lý bán hàng
                        <div class="my-2"></div>
						7. Cơ hội tham quan và du lịch Hàn Quốc, khi trở thành đối tác kinh doanh của chính sách CKD.
                        <div class="my-2"></div>
						8. Nội dung hình ảnh quảng cáo sẽ được đội ngũ thiết kế chuyên nghiệp của CKD thực hiện. Công ty hỗ trợ thiết kế logo riêng để nhận diện thương hiệu.
                        <div class="my-2"></div>
						9. Tỷ lệ chiết khấu hấp dẫn. Bảo đảm quyền lợi công bằng, minh bạch, đồng nhất cho các đối tác trên toàn thị trường.
                        <div class="my-4"></div>
                        <div class="h4 text-uppercase m-0 p-0 mb-2">
							ĐẠI LÝ CẦN LÀM
						</div>
                        <div class="my-2"></div>
						Quảng cáo, thực hiện các giao dịch thương mại liên quan đến sản phẩm của CKD. Các hội viên có thể trích dẫn, khai thác thông tin sản phẩm, giá cả, đánh giá chất lượng từ website, Facebook của CKD .
                        <div class="my-2"></div>
						“Hành trình vạn dặm khởi đầu từ bước chân đầu tiên” chính vì thế bạn hãy thận trọng trong việc chọn lựa thương hiệu, sản phẩm kinh doanh. Thương hiệu mỹ phẩm CKD sẽ sát cánh cùng bạn trong bước khởi đầu khó khăn nhất!
                        <div class="my-2"></div>
                    </div>
                    <div class="action mt-4">
                        <input type="radio" id="agree" name="agree" class="check-agree" value="ok"/>
                        <label for="agree" class="label-agree"> ĐỒNG Ý VỚI CHÍNH SÁCH CỦA CKD </label>

                        <div class="feedback f-small" style="display: none">
                            Bạn chưa đồng ý với chính sách của CKD
                        </div>
                        <br>
                    </div>
                    <div class="my-2 col-xs-12 text-lg-right text-center"><a id="btn-check" href="javascript:void(0)" data-href="<?=MYSITE_AFFILIATE?>/account/dangky"
                  
                           class="btn btn-primary btn-ctv"><span 
                           style="color: white !important;"
                           ><?= getLang('xacnhandieukhoan') ?></span></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= MYSITE ?>assets/mCustomScrollbar/mCustomScrollbar.min.css">
<script src="<?= MYSITE ?>assets/mCustomScrollbar/mCustomScrollbar.min.js"></script>
<script>
    (function ($) {
        $(window).on("load", function () {
            $(".content").mCustomScrollbar();
        });
    })(jQuery);
    $( document ).ready(function() {
       $('#btn-check').on('click', function (){
           if ($('input[name=agree]:checked').length > 0) {
               $('.feedback').hide();
               window.location.href =' <?=MYSITE_AFFILIATE?>' + 'account/dangky';
           }else{
               $('.feedback').show();
           }
       })

        $('input[type=radio][name=agree]').change(function() {
            if (this.value == 'ok') {
                $('.feedback').hide();
            }
        });

    });
</script>
</div>
