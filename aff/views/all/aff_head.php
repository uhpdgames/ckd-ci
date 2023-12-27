<base href="<?= MYSITE_AFFILIATE ?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?= $seo->getSeo('title') ?></title>
<meta name="keywords" content="<?= $seo->getSeo('keywords') ?>"/>
<meta name="description" content="<?= $seo->getSeo('description') ?>"/>
<meta name="revisit-after" content="1 days"/>
<meta http-equiv="audience" content="General"/>
<meta name="resource-type" content="Document"/>
<meta name="distribution" content="Global"/>
<link rel="apple-touch-icon" sizes="180x180" href="<?= MYSITE ?>apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= MYSITE ?>favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= MYSITE ?>favicon-16x16.png">
<meta name="theme-color" content="#ffffff">

<link rel="manifest" href="<?= MYSITE ?>assets/images/favicon/manifest.json">
<meta name="robots" content="index, follow, noodp, noydir, max-image-preview:large"/>
<link rel="icon" href="<?= MYSITE ?>favicon.ico" type="image/x-icon"/>

<?= htmlspecialchars_decode($setting['mastertool']) ?>
<meta name="geo.region" content="VN"/>
<meta name="geo.placename" content="Hồ Chí Minh"/>
<meta name="geo.position" content="10.823099;106.629664"/>
<meta name="ICBM" content="10.823099, 106.629664"/>
<meta name='revisit-after' content='1 days'/>
<meta name="author" content="<?= $setting['ten' . $lang] ?>"/>
<meta name="copyright" content="<?= $setting['ten' . $lang] . " - [" . $optsetting['email'] . "]" ?>"/>
<meta name="abstract" content="<?= $setting['ten' . $lang] ?>"/>
<meta property="og:type" content="<?= $seo->getSeo('type') ?>"/>
<meta property="og:site_name" content="<?= $setting['ten' . $lang] ?>"/>
<meta property="og:title" content="<?= $seo->getSeo('title') ?>"/>
<meta property="og:description" content="<?= $seo->getSeo('description') ?>"/>
<meta property="og:url" content="<?= $seo->getSeo('url') ?>"/>
<meta property="og:image" content="<?= $config_base ?>/assets/images/logo.webp"/>
<meta property="og:image:alt" content="<?= $seo->getSeo('title') ?>"/>
<meta property="og:image:type" content="<?= $seo->getSeo('photo:type') ?>"/>
<meta property="og:image:width" content="<?= $seo->getSeo('photo:width') ?>"/>
<meta property="og:image:height" content="<?= $seo->getSeo('photo:height') ?>"/>
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:site" content="<?= $optsetting['email'] ?>"/>
<meta name="twitter:creator" content="<?= $setting['ten' . $lang] ?>"/>
<meta property="og:url" content="<?= $seo->getSeo('url') ?>"/>
<meta property="og:title" content="<?= $seo->getSeo('title') ?>"/>
<meta property="og:description" content="<?= $seo->getSeo('description') ?>"/>
<link rel="canonical" href="<?= getCurrentPageURL() ?>"/>
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="user-scalable=1, width=device-width, initial-scale=1"/>
<?php
echo htmlspecialchars_decode($setting['headjs']);

$def = !empty($myckd) ? 'defer ' : '';
?>
<link rel="stylesheet" href="<?= MYSITE ?>assets/css/base.css?v=<?=stringRandom() ?>">
<script type="text/javascript" src="<?= MYSITE; ?>assets/js/jquery.min.js?v=<?=stringRandom() ?>"></script>
<script type="text/javascript"
		src="<?= MYSITE ?>assets/bootstrap/bootstrap.js?v=<?=stringRandom() ?>"></script>
<script type="text/javascript"
		src="<?= MYSITE ?>assets/js/jquery.lazyload.pack.js?v=<?=stringRandom() ?>"></script>
<script type="text/javascript"
		src="<?= MYSITE ?>assets/js/slick.min.js?v=<?=stringRandom() ?>"></script>
<script type="text/javascript">

	document.addEventListener('DOMContentLoaded', function () {
		var wap_danhmuc = document.getElementById('slick_cate')
		if (typeof wap_danhmuc != 'undefined' && wap_danhmuc != null) {
			var swiper = new Swiper('.wap_danhmuccc', {
				slidesPerView: 2,
				spaceBetween: 10,
				autoplay: {
					delay: 5000,
				},
				navigation: {
					nextEl: '.next',
					prevEl: '.pre',
				},
				/*scrollbar: {
					el: '.swiper-scrollbar',
				},
				pagination: {
					el: '.swiper-pagination',
				},*/
				pagination: {
					el: '.swiper-pagination',
				},
				breakpoints: {
					450: {
						slidesPerView: 3,
						spaceBetween: 5,

					},
					600: {
						slidesPerView: 4,
						spaceBetween: 10,
					},
					900: {
						slidesPerView: 5,
						spaceBetween: 20,
					}
				},
				// Optional parameters


			})

		}

		/*var slick4322 = document.getElementById('slider_sanpham')
		if (typeof slick4322 != 'undefined' && slick4322 != null) {
			var swiper = new Swiper('.slick4322', {
				slidesPerView: 4,
				slidesPerColumn: 2,
				slidesToScroll: 1,
				spaceBetween: 10,
				infinite: true,
				arrows: true,
				centerMode: false,
				dots: false,
				draggable: true,
				pauseOnHover: true,
				autoplay: {
					delay: 3000,
				},
				navigation: {
					nextEl: '.next',
					prevEl: '.pre',
				},
				grid: {
					rows: 2
				},
				/!*scrollbar: {
					el: '.swiper-scrollbar',
				},
				pagination: {
					el: '.swiper-pagination',
				},*!/
				breakpoints: {
					500: {
						slidesPerView: 2,
						spaceBetween: 5,
						rows: 1
					},
					800: {
						rows: 1,
						slidesPerView: 3,
						spaceBetween: 10,
					},
					960: {
						rows: 1,
						slidesPerView: 4,
						spaceBetween: 20,
					}
				},
				// Optional parameters


			})

		}*/

		var slick_banner = document.getElementById('slick_banner')
		if (typeof slick_banner != 'undefined' && slick_banner != null) {
			new Swiper("#slick_banner", {
				autoplay: {
					delay: 5000,
				},
				pagination: {
					el: ".swiper-pagination",
					type: "progressbar",
				},
			});

		}

	});

	var NN_FRAMEWORK = NN_FRAMEWORK || {};
	var CONFIG_BASE = '<?=MYSITE?>';
	var WEBSITE_NAME = '<?=(isset($setting['ten' . $lang]) && $setting['ten' . $lang] != '') ? addslashes($setting['ten' . $lang]) : ''?>';
	var TIMENOW = '<?=date("d/m/Y", time())?>';
	var SHIP_CART = <?=(isset($config['order']['ship']) && $config['order']['ship'] == true) ? 'true' : 'false'?>;
	var GOTOP = 'assets/images/top.svg';
	var LANG = {
		'no_keywords': '<?=getLang('no_keywords')?>',
		'delete_product_from_cart': '<?=getLang('delete_product_from_cart')?>',
		'no_products_in_cart': '<?=$this->lang->line('no_products_in_cart')?>',
		'wards': '<?=$this->lang->line('wards')?>',
		'back_to_home': '<?=$this->lang->line('back_to_home')?>',
	};

	function site_url() {
		return '<?=$config_base?>';
	}
	function site_root () {
		return '<?=MYSITE?>';
	}
	function site_aff() {
		return '<?=MYSITE_AFFILIATE?>';
	}
	var $isMobile = '<?=$isMobile?>';
</script>

