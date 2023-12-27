<?php
$slogan = $d->rawQuery("select ten$lang as ten, motavi from #_news where type = ? and hienthi > 0 order by stt,id desc", array('slogan'));
?>
<div class="pc wap_thongtin clear">
    <div class="main_fix">
        <div class="thongtin slick-coupon">

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ($slogan as $k =>
                                   $v) { ?>
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <a href="<?= $v['motavi'] ?>"><?= $v['ten'] ?></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="swiper-wrapper"></div>
                <div class="swiper-pagination"></div>
            </div>

            <!--<div class="swiper-wrapper">
                <div class="swiper-pagination"></div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>-->
        </div>
    </div>
</div>
