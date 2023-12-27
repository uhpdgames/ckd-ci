<?php
/*
$this->uri->segment(1); // controller
$this->uri->segment(2); // action
$this->uri->segment(3); // 1stsegment
$this->uri->segment(4); // 2ndsegment
*/
/*$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
echo $controller;
echo $method;
echo $this->uri->uri_string();*/

$current_page = uri_string();

$text_title = 'CKD VIỆT NAM, collagen, ckd vietnam, Ngăn Ngừa Nếp Nhăn Retino Collagen, ckd retino collagen, CKD Guaranteed, ngăn ngừa lão hóa da';
$text_keywords = 'collagen mỹ phẩm, collagen đàn hồi, collagen là gì, dinh dưỡng ứng dụng collagen, collagen sáng da, collagen có tốt không, collagen dành cho da, huyết thanh collagen, giảm thâm mắt, sản phẩm chăm sóc lão hóa, các bước chăm sóc lão hóa vẻ đẹp, cách chăm sóc da lão hóa, Chăm sóc da mặt lão hóa, Chăm sóc da lão hóa, sản phẩm chăm sóc da, sản phẩm chăm sóc da sau 30 tuổi, mỹ phẩm chăm sóc lão hóa, bộ chăm sóc da ckd, , giảm vết thâm, vết thâm trên gia, sản phẩm, serum giảm thâm mụn, mặt nạ giảm thâm mụn, Review serum ckd giảm thâm,  mỹ phẩm hàn quốc ckd, hãng mỹ phẩm hàn quốc, thương hiệu mỹ phẩm ckd, ckd retinol collagen hàn, mỹ phẩm hàn quốc sulwhasoo, mỹ phẩm cao cấp, thương hiệu mỹ phẩm hàn, mỹ phẩm hàn quốc the face shop, ckd mỹ phẩm xách tay, mỹ phẩm hàn quốc an toàn cho bà bầu, serum collagen hàn quốc, các loại serum collagen, serum collagen tươi, serum collagen có tác dụng gì, huyết thanh collagen x3, huyết thanh collagen tươi, serum collagen hàn quốc,  serum collagen ckd, serum ckd, serum collagen dưỡng trắng da, serum collagen x3 có tốt không, serum collagen chống lão hóa,  serum collage chống nhăn,  serum collage cải thiện nếp nhăn';
$text_description = 'Khám phá sức mạnh của collagen tự nhiên và Retino trong  sản phẩm CKD khắc phục chống lão hóa, cải thiện nếp nhăn, làm sáng da và tăng độ đàn hồi, tăng sinh collagen  Hãy trải nghiệm ngay. Serum Collagen, Chăm sóc da bằng collagen, Collagen chống lão hóa, Collagen chống nếp nhăn, collagen Hàn Quốc, collagen thủy phân tử, Retinol chống lão hóa, Tác dụng phụ của Retinol, Retinol trị mụn, Retinol cho nếp nhăn, Retinol cho da nhạy cảm, collagen tự nhiên, kem dưỡng da chống lão hóa';
$seo_title = !$current_page ?  'CKD VIỆT NAM, collagen, ckd vietnam, Ngăn Ngừa Nếp Nhăn Retino Collagen, ckd retino collagen, CKD Guaranteed, ngăn ngừa lão hóa da' : $seo->getSeo('title');
$seo_keywords = !$current_page ? 'collagen mỹ phẩm, collagen đàn hồi, collagen là gì, dinh dưỡng ứng dụng collagen, collagen sáng da, collagen có tốt không, collagen dành cho da, huyết thanh collagen, giảm thâm mắt, sản phẩm chăm sóc lão hóa, các bước chăm sóc lão hóa vẻ đẹp, cách chăm sóc da lão hóa, Chăm sóc da mặt lão hóa, Chăm sóc da lão hóa, sản phẩm chăm sóc da, sản phẩm chăm sóc da sau 30 tuổi, mỹ phẩm chăm sóc lão hóa, bộ chăm sóc da ckd, , giảm vết thâm, vết thâm trên gia, sản phẩm, serum giảm thâm mụn, mặt nạ giảm thâm mụn, Review serum ckd giảm thâm,  mỹ phẩm hàn quốc ckd, hãng mỹ phẩm hàn quốc, thương hiệu mỹ phẩm ckd, ckd retinol collagen hàn, mỹ phẩm hàn quốc sulwhasoo, mỹ phẩm cao cấp, thương hiệu mỹ phẩm hàn, mỹ phẩm hàn quốc the face shop, ckd mỹ phẩm xách tay, mỹ phẩm hàn quốc an toàn cho bà bầu, serum collagen hàn quốc, các loại serum collagen, serum collagen tươi, serum collagen có tác dụng gì, huyết thanh collagen x3, huyết thanh collagen tươi, serum collagen hàn quốc,  serum collagen ckd, serum ckd, serum collagen dưỡng trắng da, serum collagen x3 có tốt không, serum collagen chống lão hóa,  serum collage chống nhăn,  serum collage cải thiện nếp nhăn.': $seo->getSeo('keywords');
$seo_description =  !$current_page ? 'Khám phá sức mạnh của collagen tự nhiên và Retino trong  sản phẩm CKD khắc phục chống lão hóa, cải thiện nếp nhăn, làm sáng da và tăng độ đàn hồi, tăng sinh collagen  Hãy trải nghiệm ngay. Serum Collagen, Chăm sóc da bằng collagen, Collagen chống lão hóa, Collagen chống nếp nhăn, collagen Hàn Quốc, collagen thủy phân tử, Retinol chống lão hóa, Tác dụng phụ của Retinol, Retinol trị mụn, Retinol cho nếp nhăn, Retinol cho da nhạy cảm, collagen tự nhiên, kem dưỡng da chống lão hóa,':$seo->getSeo('description');
$seo_author = $setting['ten' . $lang];

if($seo_title =='') $seo_title = $text_title;
if($seo_keywords =='') $seo_keywords = $text_keywords;
if($seo_description =='') $seo_description = $text_description;

?>
<base href="<?= MYSITE ?>"/>
<title><?= $seo_title ?></title>
<link rel="manifest" href="<?= site_url() ?>assets/images/favicon/manifest.json">
<link rel="icon" href="<?= site_url() ?>favicon.ico" type="image/x-icon"/>
<link rel="canonical" href="<?= getCurrentPageURL() ?>"/>


<?php
$meta = array(
	'google-site-verification' => '',
	'robots' => 'index, follow, noodp, noydir, noarchive, max-image-preview:standard,max-video-preview:-1,max-snippet:-1,notranslate',
	'keywords' => $seo_keywords,
	'description' => $seo_description,
	'author' => $seo_author,
	'copyright' => $seo_author . " - [" . $optsetting['email'] . "]",
	'abstract' => $seo_author,
	'revisit-after' => "1 days",
	'resource-type' => "Document",
	'distribution' => "Global",
	'theme-color' => "#ffffff",
	'geo.region' => "VN",
	'geo.placename' => "Hồ Chí Minh",
	'geo.position' => "10.726993;106.707453",
	'ICBM' => "10.726993;106.707453",
	'format-detection' => "telephone=no, email=no, address=no",
	'viewport' => "user-scalable=1, width=device-width, initial-scale=1",
);
echo"\n";
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
foreach ($meta as $name => $content) {
	echo"\n";
	echo '<meta name="' . $name . '" content="' . $content . '"/>';
}
echo"\n";

$meta = array(
	'title'=>$seo_title,
	'site_name'=> $seo_author,
	'url'=> $seo->getSeo('url'),
	'type'=> $seo->getSeo('type'),
	'description'=> $seo_description,
	'image'=> $seo->getSeo('photo:img')?? MYSITE . 'assets/images/logo.webp',
	'image:alt'=> $seo_title,
);
foreach ($meta as $name => $content) {
	echo"\n";
	echo '<meta property="og:' . $name . '" content="' . $content . '"/>';
}
echo"\n";
foreach ($meta as $name => $content) {
	echo"\n";
	echo '<meta property="twitter:' . $name . '" content="' . $content . '"/>';
}
echo"\n";
?>
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:creator" content="<?= $seo_author ?>"/>

<style type="text/css">a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }</style>
<script type="text/javascript" src="<?= MYSITE ?>assets/js/jquery.min.js?v=<?= time() ?>"></script>
<script type="text/javascript" src="<?= MYSITE ?>assets/js/slick.min.js?v=<?= time() ?>"></script>
<script type="text/javascript">
	<?=htmlspecialchars_decode($setting['headjs'])?>
	function load_css(url) {
		let link = document.createElement('link');
		link.rel = 'stylesheet';
		link.type = 'text/css';
		link.href = `assets/css/${url}.css`;
		document.body.appendChild(link)
	}
	document.addEventListener('DOMContentLoaded', function () {
		window.addEventListener('load', () => {
			load_css('bootstrap.min');
			load_css('fa');
			load_css('optimizer');
			load_css('style');
			load_css('tuan');
			//load_css('cart');
			load_css('media');
			/*load_css('text.min');*/
		});
	})

	var temp_banner = '';
	var NN_FRAMEWORK = NN_FRAMEWORK || {};
	var CONFIG_BASE = '<?=MYSITE?>';
	var WEBSITE_NAME = '<?=(isset($seo_author) && $seo_author != '') ? addslashes($seo_author) : ''?>';
	var TIMENOW = '<?=date("d/m/Y")?>';
	var SHIP_CART = <?=(isset($config['order']['ship']) && $config['order']['ship'] == true) ? 'true' : 'false'?>;
	var LANG = {
		'no_keywords': '<?=getLang('no_keywords')?>',
		'delete_product_from_cart': '<?=getLang('delete_product_from_cart')?>',
		'no_products_in_cart': '<?=$this->lang->line('no_products_in_cart')?>',
		'wards': '<?=$this->lang->line('wards')?>',
		'back_to_home': '<?=$this->lang->line('back_to_home')?>',
	};
	var empty_image = '<?= image_default('empty')?>';
	var GOTOP = empty_image;

	function site_url() {
		return '<?=MYSITE?>';
	}

	function admin_site_url() {
		return '<?=MYADMIN?>';
	}

	function aff_site_url() {
		return '<?=MYSITE_AFFILIATE?>';
	}

	var $isMobile = '<?=$isMobile?>';

</script>
<!--todo cache image-->
<!--<div class="add-image" data-img="mono">đây là thẻ cache image</div>-->
<!--todo cache data-->
<script defer type="text/javascript">
	function initImage() {
		var imgDefer = document.querySelectorAll('.img-lazy:not(.img-load)');
		for (let i = 0; i < imgDefer.length; i++) {
			if (imgDefer[i].getAttribute('data-src')) {
				imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
				imgDefer[i].removeAttribute('data-src');
				imgDefer[i].classList.add('img-load');
			}
		}
	}
	window.onload = initImage;
</script>
