<div class="slider" id="banner">
	<?= get_banner() ?>
</div>

<div class="cate" id="cate">
	<?= get_slider_cate() ?>
</div>

<div id="append_content">
	<div id="banner_1">

		<a href="<?= get_link_photo($d, 'banner' . $lang . $m) ?>" class="banner1">
			<img class="img-fluid w-100 img-lazy" src="<?= image_default() ?>"
				 data-src="<?php echo MYSITE . get_photo($d, 'banner' . $lang . $m) ?>" alt="CKD COS VIỆT NAM">
		</a>
	</div>
	<div class="main_fix wap_sanpham" id="slider_product">

	</div>
	<div id="banner_2" class="mt-5">
		<a href="<?= get_link_photo($d, 'banner2' . $lang . $m) ?>" class="banner2">
			<img class="img-fluid w-100 img-lazy" src="<?= image_default() ?>"
				 data-src="<?= MYSITE . get_photo($d, 'banner2' . $lang . $m) ?>" alt="CKD COS VIỆT NAM">
		</a>
	</div>
	<div class="main_fix wap_sanpham mt-lg-5" id="slider_khuyenmai">

	</div>
	<div class="main_fix wap_review mt-5" id="review">

	</div>
	<div class="main_fix mt-lg-5" id="videolocal">
		<div class="title-main"><a href="/video"><span>VIDEO</span></a></div> <a href="https://youtu.be/cAI57ElFDv4?list=TLGGodQhJWV8_vQxNTExMjAyMw" target="_blank"> <video playsinline autoplay loop muted> <source type="video/mp4" src="<?= site_url()?>assets/webm/welcome.mp4"> <source type="video/webm" src="<?= site_url()?>assets/webm/welcome.webm"> <source type="video/ogg" src="<?= site_url()?>assets/webm/welcome.ogg" /> </video> </a>
	</div>
	<div class="container-fluid mt-5" id="quangcao">

	</div>
</div>

