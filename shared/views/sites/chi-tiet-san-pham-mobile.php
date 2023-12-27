<!-- Demo styles -->
<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper {
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-button-prev {
        background-image: none !important;
        color: #3c5b2d !important;
    }
    .swiper-button-next {
        background-image: none !important;
        color: #3c5b2d !important;
        width: 50px !important;
    }
    .swiper-pagination-bullet-active {
        border-radius: 11px;
        background: #3c5b2d !important;
        padding-left: 26px !important;
        padding-right: 5px !important;
    }

    .brand {
        padding-top: 17px !important;
        padding-left: 150px !important;
        padding-bottom: 10px !important;
        position: relative;
    }
</style>

<style>
    .action a {
        display: inline-block;
        padding: 5px 10px;
        background: #f30;
        color: #ccc;
        text-decoration: none;
    }
    .action a:hover {
        background: #000;
    }

    .round-slide {
        margin: 10px;
        /* border: 2px solid #3498db; */
        border-radius: 50%;
        overflow: hidden;
        /* width: 100px;
  height: 100px; */
    }
    .custom-slide {
        width: 100%;
        height: 100%;
    }

    .slider-thumnails {
        padding-right: 10%;
        padding-left: 10%;
    }

    .slick-dots {
        display: none !important;
    }
    .slick-next {
        display: none !important;
    }
    .slick-prev {
        display: none !important;
    }
</style>
<div class="wapper">
    <div class="main-container">
        <div id="header" class="container-fluid p-0 m-0">
            <div id="sub_menu"></div>
            <div id="main_menu"></div>
        </div>

        <div class="clear mypage" data-view="page/product/product_detail" id="page">
            <div class="container-fluid p-0 p-lg-2 mb-4" style="max-height: 2.5rem; background-color: #e9ecef;">
                <nav class="main_fix h-25" aria-label="breadcrumb">
                    <ol class="breadcrumb h-25 p-0 m-0">
                        <ol class="breadcrumb h-25 p-0 m-0">
                            <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="http://localhost/san-pham">Sản phẩm</a></li>
                            <li class="breadcrumb-item"><a href="http://localhost/san-pham/cham-soc-da">Chăm sóc da </a></li>
                            <li class="breadcrumb-item active"><a href="http://localhost/san-pham/mat-na-kem-duong-am-ckd-retino-collagen-tieu-phan-tu-300">Mặt Nạ Kem Dưỡng Ẩm CKD Retino Collagen Tiểu Phân Tử 300 </a></li>
                        </ol>
                        <script type="application/ld+json">
                            {
                                "@context": "https://schema.org",
                                "@type": "BreadcrumbList",
                                "itemListElement": [
                                    { "@type": "ListItem", "position": 1, "name": "S\u1ea3n ph\u1ea9m", "item": "http:\/\/localhost\/san-pham" },
                                    { "@type": "ListItem", "position": 2, "name": "Ch\u0103m s\u00f3c da ", "item": "http:\/\/localhost\/san-pham\/cham-soc-da" },
                                    {
                                        "@type": "ListItem",
                                        "position": 3,
                                        "name": "M\u1eb7t N\u1ea1 Kem D\u01b0\u1ee1ng \u1ea8m CKD Retino Collagen Ti\u1ec3u Ph\u00e2n T\u1eed 300 ",
                                        "item": "http:\/\/localhost\/san-pham\/mat-na-kem-duong-am-ckd-retino-collagen-tieu-phan-tu-300"
                                    }
                                ]
                            }
                        </script>
                    </ol>
                </nav>
            </div>
            <div class="main_fix section" id="details">
                <div class="row m-0 p-0">
                    <!-- code tại đây -->
                    <div class="container pt-5">
                        <div class="slider slider-for">
                            <div class="p-2">
                                <img class="custom-slide" src="https://ckdvietnam.com/upload/product/ckd-retino-collagen-small-molecule-300-guasha-lifting-serum-9626.webp" alt="" />
                            </div>

                            <div class="p-2">
                                <img class="custom-slide" src=" https://ckdvietnam.com/upload/product/kem-lan-co-ngan-ngua-nep-nhan-retino-collagen-9085.webp" alt="" />
                            </div>
                            <div class="p-2">
                                <img class="custom-slide" src="https://ckdvietnam.com/upload/product/ckd-retino-collagen-small-molecule-300-guasha-lifting-serum-9626.webp" alt="" />
                            </div>

                            <div class="p-2">
                                <img class="custom-slide" src=" https://ckdvietnam.com/upload/product/kem-lan-co-ngan-ngua-nep-nhan-retino-collagen-9085.webp" alt="" />
                            </div>
                            <div class="p-2">
                                <img class="custom-slide" src="https://ckdvietnam.com/upload/product/ckd-retino-collagen-small-molecule-300-guasha-lifting-serum-9626.webp" alt="" />
                            </div>
                        </div>
                        <div class="slider slider-nav slider-thumnails">
                            <div class="round-slide">
                                <img class="custom-slide" src="https://ckdvietnam.com/upload/product/ckd-retino-collagen-small-molecule-300-guasha-lifting-serum-9626.webp" alt="" />
                            </div>
                            <div class="round-slide">
                                <img class="custom-slide" src="https://ckdvietnam.com/upload/product/ckd-retino-collagen-small-molecule-300-guasha-lifting-serum-9626.webp" alt="" />
                            </div>
                            <div class="round-slide">
                                <img class="custom-slide" src="https://ckdvietnam.com/upload/product/ckd-retino-collagen-small-molecule-300-guasha-lifting-serum-9626.webp" alt="" />
                            </div>

                            <div class="round-slide">
                                <img class="custom-slide" src="https://ckdvietnam.com/upload/product/ckd-retino-collagen-small-molecule-300-guasha-lifting-serum-9626.webp" alt="" />
                            </div>
                            <div class="round-slide">
                                <img class="custom-slide" src="https://ckdvietnam.com/upload/product/ckd-retino-collagen-small-molecule-300-guasha-lifting-serum-9626.webp" alt="" />
                            </div>
                        </div>
                    </div>
                    <!-- end -->
                    <div class="col-12 col-lg-6 right-pro-detail infoArea">
                        <div class="brand">
                            CKD
                        </div>

                        <p class="headingArea title--detail catchuoi2">Kem Lăn Cổ Ngăn Ngừa Nếp Nhăn Retino Collagen Tiểu Phân Tử 300</p>
                        <div class="row">
                            <div class="col-4 detail-title cover--detail pb-3">Mã sản phẩm</div>
                            <div class="col-8 cover--detail">D22119</div>
                        </div>
                        <div class="row">
                            <div class="col-4 detail-title cover--detail pb-3">Thể tích</div>
                            <div class="col-8 cover--detail">50</div>
                        </div>
                        <div class="row">
                            <div class="col-4 detail-title cover--detail pb-3">Giá</div>
                            <div class="col-8 cover--detail">
                                <span class="price-new-pro-detail" data-gia="696150">696.150đ</span>
                                <span class="price-old-pro-detail">819.000đ</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 detail-title cover--detail">Số lượng</div>
                            <div class="col-4">
                                <div class="attr-content-pro-detail d-block">
                                    <div class="quantity-pro-detail">
                                        <span class="quantity-minus-pro-detail_2">-</span>
                                        <input type="number" class="qty-pro" min="1" value="1" readonly="" />
                                        <span class="quantity-plus-pro-detail_2">+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 pc">
                                <div class="attr-content-pro-detail-2">
                                    <input type="checkbox" name="themtui" class="themtui" id="radio-themtui" />
                                    <label for="radio-themtui" class="w-100 attr-label-pro-detail-3">Có thêm túi giấy</label>
                                </div>
                            </div>
                            <div class="col-4 mb">
                                <div class="attr-content-pro-detail-2">
                                    <input type="checkbox" name="themtui" class="themtui" id="radio-themtui" />
                                    <label for="radio-themtui" class="attr-label-pro-detail-3">Có thêm túi giấy</label>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row pt-5 cover-mb-combo-button" style="padding-left: 2%;">
                            <div class="col-12">
                                <!-- <div class="col-6"></div> -->
                            </div>
                            <div class="wp-btn d-flex flex-row justify-content-start cover-mb-combo-button">
                                <div class="mr-1">
                                    <!--wp-muangay-->
                                    <a
                                        class="btn btn-primary buynow addcart text-decoration-none left"
                                        data-id="270"
                                        data-action="buynow"
                                        style="height: 100%;width: 100%;font-weight: bold;padding: 10px 20px;color: white;background-color: #3C5B2D;display: inline-block;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border: none;"
                                    >
                                        <span>Đặt hàng</span>
                                    </a>
                                </div>
                                <div class="mr-1">
                                    <a
                                        class="btn btn-primary transition addnow addcart addcart2 text-decoration-none"
                                        target="_blank"
                                        data-id="270"
                                        data-action="addnow"
                                        style="width: 4rem; height: auto; border: 1px solid #3c5b2d; background-color: #fff; color: white; padding: 10px 10px; text-decoration: none;"
                                    >
                                        <img src="https://ckdvietnam.com/assets/icon/cart.png" width="25px" height="25px" alt="CKD VIỆT NAM" />
                                    </a>
                                </div>

                                <div>
                                    <a
                                        class="btn btn-primary transition addnow addcart addcart2 text-decoration-none"
                                        target="_blank"
                                        href="https://zalo.me/2669716930482025207"
                                        style="font-weight: bold; background-color: #118acb; color: white; padding: 10px 20px; text-decoration: none;"
                                    >
                                        Zalo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>








<!--					BỎ CODE-->
                    <div class="main_fix d-block mb-2">
                        <div class="wp-box" style="height: 100%; width: 100%;">
                            <div class="row" style="height: 100%; width: 100%;">
                                <div class="col-12 col-lg-6">
                                    <!--wp-review-->
                                    <div class="wp-review">
                                        <div class="d-flex w-100 text-center justify-content-center">
                                            <!--slider__flex w-100-->
                                            <!--<div class="slider_empty"></div>-->
                                            <div class="img-review w-100 pt-2">
                                                <p class="text-sm text-center font-weight-normal w-100 font-weight-bold">
                                                <?= getLang('hinhanhreview') ?>
                                                </p>

                                                <div class="swiper-container review-swiper swiper-initialized swiper-horizontal swiper-free-mode swiper-ios swiper-backface-hidden">
                                                    <div class="swiper-wrapper" id="swiper-wrapper-65d0a2595410332cc" aria-live="off" style="transition-duration: 0ms; transition-delay: 0ms; transform: translate3d(0px, 0px, 0px);">
                                                        <div class="swiper-slide h-auto px-1 mt-0 swiper-slide-active" data-swiper-slide-index="0" role="group" aria-label="1 / 5" style="width: 80.5px;">
                                                            <div class="img_post">
                                                                <!--slider-img-->
                                                                <img
                                                                    data-sosao="5"
                                                                    data-danhgia="true"
                                                                    data-id="1999"
                                                                    onerror="this.onerror=null;this.src='data:image/gif;base64,R0lGODlhxgDGANUAAMfHx9nZ2crKyuDh4s3NztXV1tDQ0fHy9Obn6MjIyNPT1M/Pz+Dg4cvLy9bW1+3u79vb3O3u8O/w8fT19uTl5s3Nzejp6+Dg4ufn6fHy8+vs7s3OzuPk5drb29/g4dfY2NnZ2tna28zMzPT1993d3tfX2Ovr7dHS0tTU1dTV1fLz9ezt79LS0+3t797e39XW1s/P0NHR0vP09snJyfX2+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4zLWMwMTEgNjYuMTQ1NjYxLCAyMDEyLzAyLzA2LTE0OjU2OjI3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBQTIxMEQwODk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBQTIxMEQwOTk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkFBMjEwRDA2OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkFBMjEwRDA3OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAAAAAAAsAAAAAMYAxgAABv/AAG1ILBqPyKRyyWw6n9CodEo9CoXVrHbL7Xq/RixNDC6bz+i0Naxuu9/wJZk4j9vv+Gydnu/7/0l7RYKAhYZohIOHi4xliWyNkZJSj2uTl5iWlJmcl5VKn52icKGgo6d+pXKorHGqTK+tslGxsLO3X7VNuri9Y2m8vrLBTsTCo8bFx8tIyU/OzI3Qz9HL01DX1X3Z2Nq33LTereCb4siL5OZg6VTs6lvu7e+S8VX189SY9/irnPv8mvwBzPOPS0F+Bw0OJDUroTiHXiBGkxhx4RmKuSyuY4axYbWOrECaESmK5EiN8tSZnLQSEcp8+FoekqmG5h+bNV82e4nTTk//Nz+B6uTDc6jRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1Lt67du3jz6t3Lt6/fv4ADC+4bYQOBwwsyDDbDwcMCAJAhn7gwoLLly5gRLG7SILLnz6BBK9jMhEBozwlOey5Aeonp0wUQPGhBQYFq1q2TvP6cgMKRAbBz6w49YMgDBgMkDIEQGrdwI7sjV5hAw8IMyA1W0DggALTz50SiQ/4wJIZnB0NYeAcPHXQHGiNEeIYxJMV69uFBvxjiwDOEIQbchx8N4gEgwAE0SBAgAAogGEFqn33HXoEAhDDEBCZoQEQBzQ04/wSFAJAgQxEqgBCchyACsAADGCDgQooSgleBajR+hoKHNBggwI489ujjjzyWgOOQRBZp5JFIJqnkkkw26eSTUEYp5ZRUVmnllVhmqeWWXHbp5ZdghinmmGSWaeaZaKbJZVDAHMVmTjq92YacjihFZ0VL3QmPU3raA1Wf5fz5DqB3EGpLVYYGglWikCzKEVeMMgqIoZIWAmilhuiJ6UzjmPXmptKck1ZPoLKUSamepPrWSqgKxEirnYAEa0mZ4iXRrKg4hGtIBPn1z64eMRRYPMD2wk6xvpCDrDDcLHvMNc5akxF+yUT70Z5D8mLtQykZ+cq2g3az5CfgInSok4SUuxHQHupaNEe7GokBL0pXaBlAEAA7'"
                                                                    class="img-fluid center"
                                                                    src="https://ckdvietnam.com/upload/product/z497584883761334e2bdc09ca5d2300111c29cd4081a7b-8352.jpg"
                                                                    alt="nếp nhăn trên cổ cải thiện lắm da căng đẹp hơn nhiều, còn đều màu hơn nữa, thích thật sự luôn á"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide h-auto px-1 mt-0 swiper-slide-next" data-swiper-slide-index="1" role="group" aria-label="2 / 5" style="width: 80.5px;">
                                                            <div class="img_post">
                                                                <!--slider-img-->
                                                                <img
                                                                    data-sosao="5"
                                                                    data-danhgia="true"
                                                                    data-id="1976"
                                                                    onerror="this.onerror=null;this.src='data:image/gif;base64,R0lGODlhxgDGANUAAMfHx9nZ2crKyuDh4s3NztXV1tDQ0fHy9Obn6MjIyNPT1M/Pz+Dg4cvLy9bW1+3u79vb3O3u8O/w8fT19uTl5s3Nzejp6+Dg4ufn6fHy8+vs7s3OzuPk5drb29/g4dfY2NnZ2tna28zMzPT1993d3tfX2Ovr7dHS0tTU1dTV1fLz9ezt79LS0+3t797e39XW1s/P0NHR0vP09snJyfX2+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4zLWMwMTEgNjYuMTQ1NjYxLCAyMDEyLzAyLzA2LTE0OjU2OjI3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBQTIxMEQwODk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBQTIxMEQwOTk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkFBMjEwRDA2OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkFBMjEwRDA3OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAAAAAAAsAAAAAMYAxgAABv/AAG1ILBqPyKRyyWw6n9CodEo9CoXVrHbL7Xq/RixNDC6bz+i0Naxuu9/wJZk4j9vv+Gydnu/7/0l7RYKAhYZohIOHi4xliWyNkZJSj2uTl5iWlJmcl5VKn52icKGgo6d+pXKorHGqTK+tslGxsLO3X7VNuri9Y2m8vrLBTsTCo8bFx8tIyU/OzI3Qz9HL01DX1X3Z2Nq33LTereCb4siL5OZg6VTs6lvu7e+S8VX189SY9/irnPv8mvwBzPOPS0F+Bw0OJDUroTiHXiBGkxhx4RmKuSyuY4axYbWOrECaESmK5EiN8tSZnLQSEcp8+FoekqmG5h+bNV82e4nTTk//Nz+B6uTDc6jRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1Lt67du3jz6t3Lt6/fv4ADC+4bYQOBwwsyDDbDwcMCAJAhn7gwoLLly5gRLG7SILLnz6BBK9jMhEBozwlOey5Aeonp0wUQPGhBQYFq1q2TvP6cgMKRAbBz6w49YMgDBgMkDIEQGrdwI7sjV5hAw8IMyA1W0DggALTz50SiQ/4wJIZnB0NYeAcPHXQHGiNEeIYxJMV69uFBvxjiwDOEIQbchx8N4gEgwAE0SBAgAAogGEFqn33HXoEAhDDEBCZoQEQBzQ04/wSFAJAgQxEqgBCchyACsAADGCDgQooSgleBajR+hoKHNBggwI489ujjjzyWgOOQRBZp5JFIJqnkkkw26eSTUEYp5ZRUVmnllVhmqeWWXHbp5ZdghinmmGSWaeaZaKbJZVDAHMVmTjq92YacjihFZ0VL3QmPU3raA1Wf5fz5DqB3EGpLVYYGglWikCzKEVeMMgqIoZIWAmilhuiJ6UzjmPXmptKck1ZPoLKUSamepPrWSqgKxEirnYAEa0mZ4iXRrKg4hGtIBPn1z64eMRRYPMD2wk6xvpCDrDDcLHvMNc5akxF+yUT70Z5D8mLtQykZ+cq2g3az5CfgInSok4SUuxHQHupaNEe7GokBL0pXaBlAEAA7'"
                                                                    class="img-fluid center"
                                                                    src="https://ckdvietnam.com/upload/product/b0c28e3c0251aa0ff340-9457.jpg"
                                                                    alt="Mình mua tặng bà chị hồi tháng trước, công nhận xài ổn lắm nha mn, đặt biệt là da căng ạ"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide h-auto px-1 mt-0" data-swiper-slide-index="2" role="group" aria-label="3 / 5" style="width: 80.5px;">
                                                            <div class="img_post">
                                                                <!--slider-img-->
                                                                <img
                                                                    data-sosao="5"
                                                                    data-danhgia="true"
                                                                    data-id="1960"
                                                                    onerror="this.onerror=null;this.src='data:image/gif;base64,R0lGODlhxgDGANUAAMfHx9nZ2crKyuDh4s3NztXV1tDQ0fHy9Obn6MjIyNPT1M/Pz+Dg4cvLy9bW1+3u79vb3O3u8O/w8fT19uTl5s3Nzejp6+Dg4ufn6fHy8+vs7s3OzuPk5drb29/g4dfY2NnZ2tna28zMzPT1993d3tfX2Ovr7dHS0tTU1dTV1fLz9ezt79LS0+3t797e39XW1s/P0NHR0vP09snJyfX2+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4zLWMwMTEgNjYuMTQ1NjYxLCAyMDEyLzAyLzA2LTE0OjU2OjI3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBQTIxMEQwODk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBQTIxMEQwOTk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkFBMjEwRDA2OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkFBMjEwRDA3OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAAAAAAAsAAAAAMYAxgAABv/AAG1ILBqPyKRyyWw6n9CodEo9CoXVrHbL7Xq/RixNDC6bz+i0Naxuu9/wJZk4j9vv+Gydnu/7/0l7RYKAhYZohIOHi4xliWyNkZJSj2uTl5iWlJmcl5VKn52icKGgo6d+pXKorHGqTK+tslGxsLO3X7VNuri9Y2m8vrLBTsTCo8bFx8tIyU/OzI3Qz9HL01DX1X3Z2Nq33LTereCb4siL5OZg6VTs6lvu7e+S8VX189SY9/irnPv8mvwBzPOPS0F+Bw0OJDUroTiHXiBGkxhx4RmKuSyuY4axYbWOrECaESmK5EiN8tSZnLQSEcp8+FoekqmG5h+bNV82e4nTTk//Nz+B6uTDc6jRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1Lt67du3jz6t3Lt6/fv4ADC+4bYQOBwwsyDDbDwcMCAJAhn7gwoLLly5gRLG7SILLnz6BBK9jMhEBozwlOey5Aeonp0wUQPGhBQYFq1q2TvP6cgMKRAbBz6w49YMgDBgMkDIEQGrdwI7sjV5hAw8IMyA1W0DggALTz50SiQ/4wJIZnB0NYeAcPHXQHGiNEeIYxJMV69uFBvxjiwDOEIQbchx8N4gEgwAE0SBAgAAogGEFqn33HXoEAhDDEBCZoQEQBzQ04/wSFAJAgQxEqgBCchyACsAADGCDgQooSgleBajR+hoKHNBggwI489ujjjzyWgOOQRBZp5JFIJqnkkkw26eSTUEYp5ZRUVmnllVhmqeWWXHbp5ZdghinmmGSWaeaZaKbJZVDAHMVmTjq92YacjihFZ0VL3QmPU3raA1Wf5fz5DqB3EGpLVYYGglWikCzKEVeMMgqIoZIWAmilhuiJ6UzjmPXmptKck1ZPoLKUSamepPrWSqgKxEirnYAEa0mZ4iXRrKg4hGtIBPn1z64eMRRYPMD2wk6xvpCDrDDcLHvMNc5akxF+yUT70Z5D8mLtQykZ+cq2g3az5CfgInSok4SUuxHQHupaNEe7GokBL0pXaBlAEAA7'"
                                                                    class="img-fluid center"
                                                                    src="https://ckdvietnam.com/upload/product/63f95ffae89ab0be-6741.jpg"
                                                                    alt="Mình được tặng nên dùng thử không ngờ hiệu quả hơn mong đợi luôn nếp nhăn giảm đi rất nhiều"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide h-auto px-1 mt-0" data-swiper-slide-index="3" role="group" aria-label="4 / 5" style="width: 80.5px;">
                                                            <div class="img_post">
                                                                <!--slider-img-->
                                                                <img
                                                                    data-sosao="5"
                                                                    data-danhgia="true"
                                                                    data-id="1892"
                                                                    onerror="this.onerror=null;this.src='data:image/gif;base64,R0lGODlhxgDGANUAAMfHx9nZ2crKyuDh4s3NztXV1tDQ0fHy9Obn6MjIyNPT1M/Pz+Dg4cvLy9bW1+3u79vb3O3u8O/w8fT19uTl5s3Nzejp6+Dg4ufn6fHy8+vs7s3OzuPk5drb29/g4dfY2NnZ2tna28zMzPT1993d3tfX2Ovr7dHS0tTU1dTV1fLz9ezt79LS0+3t797e39XW1s/P0NHR0vP09snJyfX2+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4zLWMwMTEgNjYuMTQ1NjYxLCAyMDEyLzAyLzA2LTE0OjU2OjI3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBQTIxMEQwODk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBQTIxMEQwOTk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkFBMjEwRDA2OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkFBMjEwRDA3OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAAAAAAAsAAAAAMYAxgAABv/AAG1ILBqPyKRyyWw6n9CodEo9CoXVrHbL7Xq/RixNDC6bz+i0Naxuu9/wJZk4j9vv+Gydnu/7/0l7RYKAhYZohIOHi4xliWyNkZJSj2uTl5iWlJmcl5VKn52icKGgo6d+pXKorHGqTK+tslGxsLO3X7VNuri9Y2m8vrLBTsTCo8bFx8tIyU/OzI3Qz9HL01DX1X3Z2Nq33LTereCb4siL5OZg6VTs6lvu7e+S8VX189SY9/irnPv8mvwBzPOPS0F+Bw0OJDUroTiHXiBGkxhx4RmKuSyuY4axYbWOrECaESmK5EiN8tSZnLQSEcp8+FoekqmG5h+bNV82e4nTTk//Nz+B6uTDc6jRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1Lt67du3jz6t3Lt6/fv4ADC+4bYQOBwwsyDDbDwcMCAJAhn7gwoLLly5gRLG7SILLnz6BBK9jMhEBozwlOey5Aeonp0wUQPGhBQYFq1q2TvP6cgMKRAbBz6w49YMgDBgMkDIEQGrdwI7sjV5hAw8IMyA1W0DggALTz50SiQ/4wJIZnB0NYeAcPHXQHGiNEeIYxJMV69uFBvxjiwDOEIQbchx8N4gEgwAE0SBAgAAogGEFqn33HXoEAhDDEBCZoQEQBzQ04/wSFAJAgQxEqgBCchyACsAADGCDgQooSgleBajR+hoKHNBggwI489ujjjzyWgOOQRBZp5JFIJqnkkkw26eSTUEYp5ZRUVmnllVhmqeWWXHbp5ZdghinmmGSWaeaZaKbJZVDAHMVmTjq92YacjihFZ0VL3QmPU3raA1Wf5fz5DqB3EGpLVYYGglWikCzKEVeMMgqIoZIWAmilhuiJ6UzjmPXmptKck1ZPoLKUSamepPrWSqgKxEirnYAEa0mZ4iXRrKg4hGtIBPn1z64eMRRYPMD2wk6xvpCDrDDcLHvMNc5akxF+yUT70Z5D8mLtQykZ+cq2g3az5CfgInSok4SUuxHQHupaNEe7GokBL0pXaBlAEAA7'"
                                                                    class="img-fluid center"
                                                                    src="https://ckdvietnam.com/upload/product/z4950991071504a48d63640132c2db5fff421c49756d54-8935.jpg"
                                                                    alt="lần đầu sử dụng ai ngờ hiệu quả thật, sẽ giới thiệu cho nhiều người biết đến em này"
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="swiper-slide h-auto px-1 mt-0" data-swiper-slide-index="4" role="group" aria-label="5 / 5" style="width: 80.5px;">
                                                            <div class="img_post">
                                                                <!--slider-img-->
                                                                <img
                                                                    data-sosao="5"
                                                                    data-danhgia="true"
                                                                    data-id="1862"
                                                                    onerror="this.onerror=null;this.src='data:image/gif;base64,R0lGODlhxgDGANUAAMfHx9nZ2crKyuDh4s3NztXV1tDQ0fHy9Obn6MjIyNPT1M/Pz+Dg4cvLy9bW1+3u79vb3O3u8O/w8fT19uTl5s3Nzejp6+Dg4ufn6fHy8+vs7s3OzuPk5drb29/g4dfY2NnZ2tna28zMzPT1993d3tfX2Ovr7dHS0tTU1dTV1fLz9ezt79LS0+3t797e39XW1s/P0NHR0vP09snJyfX2+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C1hNUCBEYXRhWE1QPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4zLWMwMTEgNjYuMTQ1NjYxLCAyMDEyLzAyLzA2LTE0OjU2OjI3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBQTIxMEQwODk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBQTIxMEQwOTk0OEExMUUzOEIxNEIwMDZDRDU2QTE0QyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkFBMjEwRDA2OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkFBMjEwRDA3OTQ4QTExRTM4QjE0QjAwNkNENTZBMTRDIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEAAAAAAAsAAAAAMYAxgAABv/AAG1ILBqPyKRyyWw6n9CodEo9CoXVrHbL7Xq/RixNDC6bz+i0Naxuu9/wJZk4j9vv+Gydnu/7/0l7RYKAhYZohIOHi4xliWyNkZJSj2uTl5iWlJmcl5VKn52icKGgo6d+pXKorHGqTK+tslGxsLO3X7VNuri9Y2m8vrLBTsTCo8bFx8tIyU/OzI3Qz9HL01DX1X3Z2Nq33LTereCb4siL5OZg6VTs6lvu7e+S8VX189SY9/irnPv8mvwBzPOPS0F+Bw0OJDUroTiHXiBGkxhx4RmKuSyuY4axYbWOrECaESmK5EiN8tSZnLQSEcp8+FoekqmG5h+bNV82e4nTTk//Nz+B6uTDc6jRo0iTKl3KtKnTp1CjSp1KtarVq1izat3KtavXr2DDih1LtqzZs2jTql3Ltq3bt3Djyp1Lt67du3jz6t3Lt6/fv4ADC+4bYQOBwwsyDDbDwcMCAJAhn7gwoLLly5gRLG7SILLnz6BBK9jMhEBozwlOey5Aeonp0wUQPGhBQYFq1q2TvP6cgMKRAbBz6w49YMgDBgMkDIEQGrdwI7sjV5hAw8IMyA1W0DggALTz50SiQ/4wJIZnB0NYeAcPHXQHGiNEeIYxJMV69uFBvxjiwDOEIQbchx8N4gEgwAE0SBAgAAogGEFqn33HXoEAhDDEBCZoQEQBzQ04/wSFAJAgQxEqgBCchyACsAADGCDgQooSgleBajR+hoKHNBggwI489ujjjzyWgOOQRBZp5JFIJqnkkkw26eSTUEYp5ZRUVmnllVhmqeWWXHbp5ZdghinmmGSWaeaZaKbJZVDAHMVmTjq92YacjihFZ0VL3QmPU3raA1Wf5fz5DqB3EGpLVYYGglWikCzKEVeMMgqIoZIWAmilhuiJ6UzjmPXmptKck1ZPoLKUSamepPrWSqgKxEirnYAEa0mZ4iXRrKg4hGtIBPn1z64eMRRYPMD2wk6xvpCDrDDcLHvMNc5akxF+yUT70Z5D8mLtQykZ+cq2g3az5CfgInSok4SUuxHQHupaNEe7GokBL0pXaBlAEAA7'"
                                                                    class="img-fluid center"
                                                                    src="https://ckdvietnam.com/upload/product/z48007843033813cb3609e65764a182cf2b3cba35bbd8e-1-4269.jpg"
                                                                    alt="Dùng hết 1 chai thấy rất oke, nay mua đúng đợt sale, quá đã luôn "
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
    $(".slider-for").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: ".slider-nav",
    });
    $(".slider-nav").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: ".slider-for",
        dots: true,
        focusOnSelect: true,
    });
    $("a[data-slide]").click(function (e) {
        s;
        e.preventDefault();
        var slideno = $(this).data("slide");
        $(".slider-nav").slick("slickGoTo", slideno - 1);
    });
</script>














OLD CODE



<div class="swiper mySwiper">
	<div class="swiper-wrapper">


		<div class="swiper-slide h-100 h-100">
			<a data-options="hint: off" data-zoom-id="Zoom-detail" id="Zoom-detail"
			   class="MagicZoom"
			   href="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
			   title="<?= $row_detail['ten'] ?>"><img
					class="cloudzoom center img-fluid  h-100 h-100"
					src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
					alt="<?= $row_detail['ten'] ?>"></a>
		</div>
		<?php if (is_array($hinhanhsp) && count($hinhanhsp) >
			0) { ?>
			<?php foreach ($hinhanhsp as $v) { ?>
				<div class="swiper-slide">

					<a data-options="hint: off" data-zoom-id="Zoom-detail" id="Zoom-detail"
					   class="MagicZoom"
					   href="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
					   title="<?= $row_detail['ten'] ?>">
						<img class="cloudzoom center img-fluid"
							 src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
							 alt="<?= $row_detail['ten'] ?>"/>
					</a>

				</div>
			<?php }

		} ?>


	</div>
	<!-- <div class=" swiper-button-next"></div>
	<div class="swiper-button-prev"></div> -->
	<div class="swiper-pagination"></div>
</div>
