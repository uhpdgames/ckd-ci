<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function image_loader()
{
	echo '<script>';
	echo '</script>';
}

function get_thuonghieu()
{
	$ci = &get_instance();
	$lang = $ci->current_lang;
	$sluglang = $ci->sluglang;
	$html = '';
	$posts = $ci->data['d']->rawQuery("SELECT id,ten$lang AS ten,tenkhongdauvi,tenkhongdauen FROM #_news WHERE hienthi > 0 AND type = 'thuong-hieu' ORDER BY stt,id DESC");
	if (is_array($posts) && count($posts)) {
		foreach ($posts as $v) {
			$html .= '<li><a href="' . $v[$sluglang] . '">' . $v["ten"] . '</a></li>';
		}
	}
	return $html;
}

function get_banner()
{
	$ci = &get_instance();

	//$func = $ci->data['func'];
	$d = $ci->data['d'];
	//$lang = $ci->current_lang;
	$lang = 'vi';
	$m = $ci->data['m'];
	$slider = $d->rawQuery("select id, ten$lang as ten, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc", array('slide' . $lang . $m));

	$html = '<div id="slick_banner" class="main_bnr_100 swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper">';

	$full = '';
	if (!$ci->data['isMobile']) {
		$full = "style=height:43.75rem;";
	}

	$empty = image_default('temp');


	foreach ($slider as $v) {
		$link = !empty($v['link']) ? $v['link'] : MYSITE;
		$html .= '<div class="swiper-slide">';
		$html .= '<a href="' . $link . '" title="' . $v['ten'] . '">';
		//$html .= '<img class="img-fluid" ' . $full . ' src="' . UPLOAD_PHOTO_L . ($v['photo']) . '"/>';
		$html .= '<img class="img-fluid img-lazy"  src="' . $empty . '" data-src="' . UPLOAD_PHOTO_L . ($v['photo']) . '" alt="CKD COS VIỆT NAM">';
		$html .= '</a></div>';


	}

	$html .= '
            
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>';
	$html .= '</div></div>';
	return $html;
}

function get_slider_cate()
{

	$ci = &get_instance();

	$sluglang = $ci->sluglang;
	$lang = $ci->current_lang;
	$d = $ci->data['d'];
	$product_list = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id, photo from #_product_list where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));
	$empty = image_default('empty');

	$full = '';
	if (!$ci->data['isMobile']) {
		$full = "style=height:43.75rem;";
	}
	$html =

		'<div id="slick_cate" class="swiper wap_danhmuccc main_fix my-2 my-md-5">
		<div class="swiper-wrapper">';
	foreach ($product_list as $k => $v) {
		$html .= '<div class="swiper-slide">';
		$html .= '<div class="item_dm">';
		$html .= '<p class="img_sp zoom_hinh">';
		$html .= '<a href="' . $v[$sluglang] . '" title="' . $v['ten'] . '">';
		$html .= '<img class="img-fluid img-lazy" src="' . $empty . '" data-src="' . UPLOAD_PRODUCT_L . ($v['photo']) . '" alt="' . $v['ten'] . '" />';
		//$html .= '<img class="img-fluid lazy" src ="'.image_default('empty').'" data-src="' . UPLOAD_PRODUCT_L . ($v['photo']) . '" alt="CKD COS VIỆT NAM">';
		$html .= '<h2 class="name_sp catchuoi2">' . $v['ten'] . '</h2>';
		$html .= '</a>';
		$html .= '</p>';
		$html .= '</div>';
		$html .= '</div>';

		$path_img = MYSITE . UPLOAD_PHOTO_L . ($v['photo']);
		$imgSRC = getDataURI($path_img);
		//cache_localStore($v[$sluglang], $imgSRC);
	}


	$html .= '</div> 
     <div class="prev slick-prev slick-arrow"></div>
     <div class="next slick-next slick-arrow"></div>
    ';
	//$html .= '<div class="swiper-pagination"></div>';
	//$html .= '<div class="prev wp-cate"></div> <div class="next wp-cate"></div>';
	//$html .= '<div class="swiper-scrollbar"></div>';
	$html .= '</div>';

	return $html;

}

function get_text($type)
{
	$ci = &get_instance();
	$lang = $ci->current_lang;
	$one_post = $ci->data['d']->rawQueryOne("SELECT noidung$lang AS noidung FROM table_static WHERE type = ? LIMIT 0,1", array($type));
	return $one_post['noidung'];
}

function getLinkFileView($file)
{
	echo 'view/' . $file;
}

function transfer($msg = '', $page = '', $status = true)
{
	$ci = &get_instance();
	$ci->session->set_flashdata('showtext', $msg);
	$ci->session->set_flashdata('page', $page);
	$ci->session->set_flashdata('stt', $status);

	redirect('process');
}

function load_addon()
{
	$ci = &get_instance();
	$setting = $ci->data['setting'];
	$optsetting = $ci->data['optsetting'];

	$type = (isset($_REQUEST["type"])) ? htmlspecialchars($_REQUEST["type"]) : '';
	$func = $ci->func;
	$sluglang = $ci->sluglang;
	$lang = $ci->current_lang;
	$d = $ci->data['d'];

	?>

	<?php if ($type == 'video-fotorama') {

	$videonb = $d->rawQuery("select link_video, id, ten$lang from #_photo where type = ? and act <> ? and hienthi > 0 order by stt, id desc", array('video', 'photo_static'));
	if (count($videonb)) { ?>
		<div id="fotorama-videos" data-width="100%" data-thumbmargin="5" data-height="320" data-fit="cover"
			 data-thumbwidth="100" data-thumbheight="70" data-allowfullscreen="false" data-nav="thumbs">
			<?php for ($i = 0; $i < count($videonb); $i++) { ?>
				<a href="https://youtube.com/watch?v=<?= $func->getYoutube($videonb[$i]['link_video']) ?>"
				   title="<?= $videonb[$i]['ten' . $lang] ?>"></a>
			<?php } ?>
		</div>
		<script type="text/javascript">
			$(document).ready(function () {
				$("#fotorama-videos").fotorama();
			});
		</script>
	<?php }
} ?>

	<?php if ($type == 'video-select') {
	$videonb = $d->rawQuery("select link_video, id, ten$lang from #_photo where type = ? and act <> ? and hienthi > 0 order by stt, id desc", array('video', 'photo_static'));
	if (count($videonb)) { ?>
		<!-- Video Select -->
		<div class="video-main">
			<iframe width="100%" height="100%"
					src="//www.youtube.com/embed/<?= $func->getYoutube($videonb[0]['link_video']) ?>"
					frameborder="0" allowfullscreen></iframe>
		</div>
		<select class="listvideos">
			<?php for ($i = 0; $i < count($videonb); $i++) { ?>
				<option value="<?= $videonb[$i]['id'] ?>"><?= $videonb[$i]['ten' . $lang] ?></option>
			<?php } ?>
		</select>
		<script type="text/javascript">
			$(document).ready(function () {
				$('.listvideos').change(function () {
					var id = $(this).val();
					$.ajax({
						url: 'ajax/ajax_video.php',
						type: "POST",
						dataType: 'html',
						data: {id: id},
						success: function (result) {
							$('.video-main').html(result);
						}
					});
				});
			});
		</script>
	<?php }
} ?>

	<?php if ($type == 'footer-map') {
	echo htmlspecialchars_decode($optsetting['toado_iframe']);
} ?>

	<?php if ($type == 'fanpage-facebook') { ?>
	<!-- Fanpage -->
	<div class="fb-page"
		 data-href="<?= $optsetting['fanpage'] ?>"
		 data-tabs="timeline"
		 data-width="400"
		 data-height="200"
		 data-small-header="true"
		 data-adapt-container-width="true"
		 data-hide-cover="false" data-show-facepile="true">
		<div class="fb-xfbml-parse-ignore">
			<blockquote cite="<?= $optsetting['fanpage'] ?>">
				<a href="<?= $optsetting['fanpage'] ?>">Facebook</a>
			</blockquote>
		</div>
	</div>
<?php } ?>

	<?php if ($type == 'messages-facebook') { ?>
	<!-- Chat Messenger 2 -->
	<div class="js-facebook-messenger-box onApp rotate bottom-right cfm rubberBand animated" data-anim="rubberBand">
		<svg id="fb-msng-icon" data-name="messenger icon" xmlns="" viewBox="0 0 30.47 30.66">
			<path
				d="M29.56,14.34c-8.41,0-15.23,6.35-15.23,14.19A13.83,13.83,0,0,0,20,39.59V45l5.19-2.86a16.27,16.27,0,0,0,4.37.59c8.41,0,15.23-6.35,15.23-14.19S38,14.34,29.56,14.34Zm1.51,19.11-3.88-4.16-7.57,4.16,8.33-8.89,4,4.16,7.48-4.16Z"
				transform="translate(-14.32 -14.34)" style="fill:#fff"></path>
		</svg>
		<svg id="close-icon" data-name="close icon" xmlns="" viewBox="0 0 39.98 39.99">
			<path
				d="M48.88,11.14a3.87,3.87,0,0,0-5.44,0L30,24.58,16.58,11.14a3.84,3.84,0,1,0-5.44,5.44L24.58,30,11.14,43.45a3.87,3.87,0,0,0,0,5.44,3.84,3.84,0,0,0,5.44,0L30,35.45,43.45,48.88a3.84,3.84,0,0,0,5.44,0,3.87,3.87,0,0,0,0-5.44L35.45,30,48.88,16.58A3.87,3.87,0,0,0,48.88,11.14Z"
				transform="translate(-10.02 -10.02)" style="fill:#fff"></path>
		</svg>
	</div>
	<div class="js-facebook-messenger-container">
		<div class="js-facebook-messenger-top-header">
			<span><?= $setting['ten' . $lang] ?></span>
		</div>
		<div class="fb-page" data-href="<?= $optsetting['fanpage'] ?>" data-tabs="messages" data-small-header="true"
			 data-height="300" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
			<blockquote cite="<?= $optsetting['fanpage'] ?>" class="fb-xfbml-parse-ignore"><a
					href="<?= $optsetting['fanpage'] ?>">Facebook</a></blockquote>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			$(".js-facebook-messenger-box").on("click", function () {
				$(".js-facebook-messenger-box, .js-facebook-messenger-container").toggleClass("open"), $(".js-facebook-messenger-tooltip").length && $(".js-facebook-messenger-tooltip").toggle()
			}), $(".js-facebook-messenger-box").hasClass("cfm") && setTimeout(function () {
				$(".js-facebook-messenger-box").addClass("rubberBand animated")
			}, 3500), $(".js-facebook-messenger-tooltip").length && ($(".js-facebook-messenger-tooltip").hasClass("fixed") ? $(".js-facebook-messenger-tooltip").show() : $(".js-facebook-messenger-box").on("hover", function () {
				$(".js-facebook-messenger-tooltip").show()
			}), $(".js-facebook-messenger-close-tooltip").on("click", function () {
				$(".js-facebook-messenger-tooltip").addClass("closed")
			}))
			$(".search_open").click(function () {
				$(".search_box_hide").toggleClass('opening');
			});
		});
	</script>
<?php } ?>

	<?php if ($type == 'script-main') { ?>
	<!-- SDK Facebook -->
	<div id="fb-root"></div>
	<script>(function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.async = true;
			js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- Like Share -->
	<script src="//sp.zalo.me/plugins/sdk.js"></script>
	<script async src="https://static.addtoany.com/menu/page.js"></script>
	<script type="text/javascript">
		var addthis_config = addthis_config || {};
		addthis_config.lang = 'vi'
	</script>
<?php } ?>

	<?php
}

function stringRandom($sokytu = 10)
{
	$str = '';
	if ($sokytu > 0) {
		$chuoi = 'ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789';
		for ($i = 0; $i < $sokytu; $i++) {
			$vitri = mt_rand(0, strlen($chuoi));
			$str = $str . substr($chuoi, $vitri, 1);
		}
	}
	return $str;
}

function digitalRandom($min = 1, $max = 10, $num = 10)
{
	$result = '';
	if ($num > 0) {
		for ($i = 0; $i < $num; $i++) {
			$result .= rand($min, $max);
		}
	}
	return $result;
}

function trimHtml($view, $data = '')
{

	$ci = &get_instance();
	$text = $ci->load->view($view, $data, true);
	$newStr = preg_replace('/<!--(.|\s)*?-->/', '', $text);

	$html = str_replace("\r\n", "", $newStr);

	/*$html = str_replace("\t", "", $html);
	$html = str_replace("\e", "", $html);
	$html = str_replace("\f", "", $html);
	$html = str_replace("\v", "", $html);
	$html = str_replace("\\", "", $html);*/

	echo $html;
}

function getRequest($name)
{
	$data = '';
	if (isset($_REQUEST)) {
		$ci = &get_instance();
		$data = $ci->input->get($name, true);
		if (empty($data)) {
			$data = $ci->input->post($name, false);
		}
	}

	//if (!empty($_REQUEST[$name])) return htmlspecialchars(trim($_REQUEST[$name]));
	return $data;
}

function redirectphp($url)
{
	$url = str_replace('https//', '', $url);
	$url = str_replace('https/', 'https://', $url);
	$arrayurl = explode('://', $url);
	if (count($arrayurl) == 3) {
		$url = $arrayurl[0] . '://' . $arrayurl[2];
	}
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $url");
}

function create_BreadCrumbs($com, $title_crumb)
{
	$ci = &get_instance();
	$breadcr = $ci->data['breadcr'];
	$breadcr->setBreadCrumbs($com, $title_crumb);


	//$html = '<div class="main_fix">';
	//$html .= $breadcr->getBreadCrumbs();
	//$html .= '</div>';

	return $breadcr->getBreadCrumbs();
}

function getCurrentPageURLSSL()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	return $pageURL;
}

function getProtocol()
{
	$pageURL = 'http';
	if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	return $pageURL;
}

function checkLogin($d, $config_base, $login_member)
{

	return false;

	//var_dump($_SESSION);die;

	$func = 1;
	if (isset($_SESSION[$login_member]) || isset($_COOKIE['login_member_id'])) {
		$flag = true;
		$iduser = (isset($_COOKIE['login_member_id']) && $_COOKIE['login_member_id'] > 0) ? $_COOKIE['login_member_id'] : $_SESSION[$login_member]['id'];
		if ($iduser) {
			$row = $d->rawQueryOne("select login_session, id, username, dienthoai, diachi, email, ten from #_member where id = ? and hienthi > 0", array($iduser));
			if (isset($row['id']) && $row['id'] > 0) {
				$login_session = (isset($_COOKIE['login_member_session']) && $_COOKIE['login_member_session'] > 0) ? $_COOKIE['login_member_session'] : $_SESSION[$login_member]['login_session'];
				if ($login_session == $row['login_session']) {
					$_SESSION[$login_member]['active'] = true;
					$_SESSION[$login_member]['id'] = $row['id'];
					$_SESSION[$login_member]['username'] = $row['username'];
					$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
					$_SESSION[$login_member]['diachi'] = $row['diachi'];
					$_SESSION[$login_member]['email'] = $row['email'];
					$_SESSION[$login_member]['ten'] = $row['ten'];
				} else $flag = false;
			} else $flag = false;
			if (!$flag) {
				unset($_SESSION[$login_member]);
				setcookie('login_member_id', "", -1, '/');
				setcookie('login_member_session', "", -1, '/');
				$func->transfer("Tài khoản của bạn đã hết hạn đăng nhập hoặc đã đăng nhập trên thiết bị khác", $config_base, false);
			}
		}
	}
}

function checkURL($index = false)
{
	$func = 1;
	global $config_base;
	$url = '';
	$urls = array('index', 'index.html', 'trang-chu', 'trang-chu.html');
	if (array_key_exists('REDIRECT_URL', $_SERVER)) {
		$root = str_replace("/index.php", "", $_SERVER['PHP_SELF']);
		$url = str_replace($root . "/", "", $_SERVER['REDIRECT_URL']);
	} else {
		$url = explode("/", $_SERVER['REQUEST_URI']);
		$url = $url[count($url) - 1];
		if (strpos($url, "?")) {
			$url = explode("?", $url);
			$url = $url[0];
		}
	}
	if ($index) array_push($urls, "index.php");
	else if (array_search('index.php', $urls)) $urls = array_diff($urls, ["index.php"]);
	if (in_array($url, $urls)) $func->redirect($config_base, 301);
}

function checkTimeSSL($domainName)
{
	$url = $domainName;

	$orignal_parse = parse_url($url, PHP_URL_HOST);

	$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
	stream_context_set_option($get, 'ssl', 'verify_peer', false);
	$read = stream_socket_client("ssl://" . $orignal_parse . ":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
	$cert = stream_context_get_params($read);
	$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
	if (strpos($orignal_parse, 'www') !== false) {
		$orignal_parse = str_replace("www.", "", $orignal_parse);
	}
	if ($certinfo['extensions']['subjectAltName'] != "") {
		$cer_domainlist = explode(",", $certinfo['extensions']['subjectAltName']);
		$cer_domainlist = array_map('trim', $cer_domainlist);
		$check_domain = "DNS:" . $orignal_parse;
		if (!in_array($check_domain, $cer_domainlist)) {
			$arrayInfossl = array('songay' => 0, 'version' => $certinfo['version']);
		} else {
			$arrayInfossl = array('songay' => $certinfo['validTo_time_t'], 'version' => $certinfo['version']);
		}
	} else {
		$arrayInfossl = array('songay' => $certinfo['validTo_time_t'], 'version' => $certinfo['version']);
	}
	return $arrayInfossl;
}

function changeDomainssl($domainName)
{
	$arrayDomain = explode("://", $domainName);
	if ($arrayDomain[0] == 'http') {
		$stringDomainName = str_replace('http:', 'https:', $domainName);
		redirectphp($stringDomainName);
	}
}

function CheckChangSLL($runDomainName, $arrayConfig)
{
	$flagdomain = 1;

	$DomainRun = $_SERVER["SERVER_NAME"];
	if (in_array($DomainRun, $arrayConfig)) {
		$flagdomain = 1;
	} else {
		$flagdomain = 0;
		$runDomainName = 'http://' . $arrayConfig['0'] . $_SERVER["REQUEST_URI"];
	}

	//kiem tra han
	$arrayinfossl = checkTimeSSL($runDomainName);
	/*if($arrayinfossl['songay']=='' && $arrayinfossl['version']==''){
		die("Error: Unable to check certificate. Please check function checkTimeSSL() !");
	}*/
	$timeSLL = $arrayinfossl['songay'];
	$version = $arrayinfossl['version'];

	$NgayHienTai = date('d-m-Y', time());
	$soNgayConLaitInt = $timeSLL - strtotime($NgayHienTai);
	$soNgayConLai = (int)($soNgayConLaitInt / 24 / 60 / 60);

	$arrayDomain = explode("://", $runDomainName);

	if ($soNgayConLai >= 1 && $version > 0) {
		changeDomainssl($runDomainName);
	} else {
		if ($flagdomain == 0) {
			//do nothing
		} else {
			if ($arrayDomain[0] == 'https') {
				$stringDomainName = str_replace('https:', 'http:', $runDomainName);
				redirectphp($stringDomainName);
			}
		}

	}
}

function getLang($keyCode = 'welcome_message')
{
	$CI = &get_instance();
	return $CI->lang->line($keyCode);
}

function toWebp($filename)
{
	return $filename;
	//return preg_replace('/\.[^.]+$/', '.', $filename) . 'webp';
}

function toWebpREVIEW($filename)
{
	//return $filename;
	return preg_replace('/\.[^.]+$/', '.', $filename) . 'webp';
}

function get_photo($d, $type)
{
	$one_post = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? limit 0,1", array($type, 'photo_static'));

	return UPLOAD_PHOTO_L . toWebp($one_post['photo']);

}

function get_link_photo($d, $type)
{
	$one_post = $d->rawQueryOne("select link from #_photo where type = ? and act = ? limit 0,1", array($type, 'photo_static'));
	return $one_post['link'];
}

function format_money($price = 0, $unit = 'đ', $html = false)
{
	$str = '';
	if ($price) {
		$str .= number_format($price, 0, ',', '.');
		if ($unit != '') {
			if ($html) {
				$str .= '<span>' . $unit . '</span>';
			} else {
				$str .= $unit;
			}
		}
	}
	return $str;
}

function get_product_slick($truyvan, $sluglang, $slide = false)
{
	$html = '';


	if (is_array($truyvan) && count($truyvan)) {
		foreach ($truyvan as $v) {
			$giamoi = $v['giamoi'] > 0 ? format_money($v['giamoi']) : '';
			$gia = $v['gia'] > 0 ? format_money($v['gia']) : getLang('lienhe');

			$mota = htmlspecialchars_decode($v['mota']);
			$id = $v['id'];
			$ten = $v['ten'];
			$link = 'san-pham/' . $v[$sluglang];
			$img = UPLOAD_PRODUCT_L . toWebp($v['photo']);
			$isHetHang = $v['soluong'] <= 0 || $v['hethang'];
			$t_hethang = '';
			if ($isHetHang) {
				$t_hethang = '<p class="hethang"><span class="hethang-text">' . getLang('hethang') . '</span></p>';
			}

			$isNew = ($v['giamoi'] > 0);
			$t_class = '';
			$t_moi = '';
			if ($isNew) {
				$t_moi = '<span class="new">New</span>';
				$t_class = 'giacu';
			}

			$not_slide = '';
			if (!$slide) {
				$not_slide .= '<p class="mota catchuoi3">' . $mota . '</p>';
			}

		 $s = rand(1,5);
			$start = ' <div class="m-p p-0"><span class="star-rating">';
			for($ii = 1; $ii <=5; $ii++){
				$start .= '<label><i class="fa-solid fa-star '. ($ii <= $s ? 'active' : ''). '"></i></label>';
			}
			$start .= '</span></div>';


			$html .= <<<HTML
                <div class="box-item item_img">
                <div class="item item_i swiper-slide">
                    <div class="img_sp zoom_hinh">
                        <a href="$link" title="$ten"><img
                                    class="no_lazy"
                                    data-lazy="$img"
                                    alt="$ten"></a>
                        <span class="cart-buy addcart transition " data-id="$id" data-action="buynow"></span>
                        $t_hethang
                    </div>
                    <h3 class="name_sp catchuoi2"><a href="$link" title="$ten">$ten</a></h3>
                    
                    
                    <div>
                    
</div>
                    
                    
                   $not_slide 
				   <p class="gia_sp">
   						 <span class="giamoi" style="display: block;">$giamoi</span>
    					 <span class="gia $t_class" style="display: block;">$gia</span>
   					   $t_moi
   					   
				  </p>     
				        
                </div>
            </div>
HTML;
///$t_moi = $start
		}
	}

	return $html;
}

function get_slider($d, $type, $thumb = '', $src = 'src', $lang = 'vi')
{

	$slider = $d->rawQuery("select ten$lang as ten, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc", array($type));
	foreach ($slider as $k => $v) { ?>
		<li class="swiper-slide swiper-slide-duplicate"><a href="<?= $v['link'] ?>"
														   title="<?= $v['ten'] ?>"><img <?= $src ?>=
				"<?= $thumb ?><?= UPLOAD_PHOTO_L . toWebp($v['photo']) ?>" alt="<?= $v['ten'] ?>" title=
				"<?= $v['ten'] ?>"/></a></li>
	<?php }
}

function get_product($truyvan, $sluglang)
{

	$dongdau = '';//$dongdau = WATERMARK.'/product/400x400x1/';
	//$dongdau = THUMBS . '/400x400x1/';//$dongdau = WATERMARK.'/product/400x400x1/';
	foreach ($truyvan as $k => $v) {
		if ($v[$sluglang] == '') continue; ?>
		<div class="item">
			<div class="img_sp zoom_hinh"><a href="san-pham/<?= $v[$sluglang] ?>" title="<?= $v['ten'] ?>"><img
						class="img-fluid" src="<?= $dongdau . UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
						alt="<?= $v['ten'] ?>"></a>
				<span class="cart-buy addcart transition " data-id="<?= $v['id'] ?>" data-action="buynow"></span>
				<?php if ($v['soluong'] <= 0 || $v['hethang']) echo '<p class="hethang"><span class="hethang-text">' . getLang('hethang') . '</span></p>'; ?>
			</div>
			<h3 class="name_sp catchuoi2"><a href="san-pham/<?= $v[$sluglang] ?>"
											 title="<?= $v['ten'] ?>"><?= $v['ten'] ?></a>
			</h3>
			<!--<p class="mota catchuoi3"><?php /*= htmlspecialchars_decode($v['mota']) */ ?></p>-->
			<p class="gia_sp">
				<span style="display: block;"
					  class="gia <?php if ($v['giamoi'] > 0) echo 'giacu' ?>"><?php if ($v['gia'] > 0) echo format_money($v['gia']); else echo getLang('lienhe'); ?></span>
				<span style="display: block;"
					  class="giamoi"><?php if ($v['giamoi'] > 0) echo format_money($v['giamoi']) ?></span>
			</p>
			<?php if ($v['moi'] > 0) echo '<span class="new">New</span>' ?>
		</div>
	<?php }
}

function get_posts($sluglang, $truyvan, $class, $thumb = '', $desc = 1, $day = 0, $view = 0)
{

	foreach ($truyvan as $k => $v) { ?>
		<div class="<?= $class ?>">
			<p class="img_post zoom_hinh"><a href="san-pham/<?= $v[$sluglang] ?>"><img
						src="<?= $thumb ?><?= UPLOAD_NEWS_L . toWebp($v['photo']); ?>"
						alt="<?= $v['ten'] ?>"></a></p>
			<h3><a class="name_post catchuoi2" href="san-pham/<?= $v[$sluglang] ?>"><?= $v['ten'] ?></a></h3>
			<?php if ($day > 0) { ?><p class="day_post"><?= ngaydang ?>
				: <?= date("d/m/Y h:i A", $v['ngaytao']) ?></p><?php } ?>
			<?php if ($desc > 0) { ?>
				<div class="desc_post catchuoi3"><?= $v['mota'] ?></div><?php } ?>
			<?php if ($view > 0) { ?><p class="xemthem"><a href="javascript:void(0)"><?= xemthem ?></a>
				</p><?php } ?>
		</div>
	<?php }
}

function createSitemap($d, $com = '', $type = '', $field = '', $table = '', $time = '', $changefreq = '', $priority = '', $lang = 'vi', $orderby = '', $menu = true)
{
	$config_base = site_url();
	$urlsm = '';
	$ci = &get_instance();
	$sitemap = null;
	if ($type != '' && $table != 'photo') {
		$sitemap = $d->rawQuery("select tenkhongdau$lang as ten, ngaytao from #_$table where type = ? order by $orderby desc", array($type));
	}
	if ($menu == true && $field == 'id') {
		$urlsm = $config_base . $com;
		echo '<url>';
		echo '<loc>' . $urlsm . '</loc>';
		echo '<lastmod>' . date('c', time()) . '</lastmod>';
		echo '<changefreq>' . $changefreq . '</changefreq>';
		echo '<priority>' . $priority . '</priority>';
		echo '</url>';
	}
	if ($sitemap) {
		foreach ($sitemap as $value) {
			if (
				$com == 'tin-tuc' ||
				$com == 'su-kien' ||
				$com == 'san-pham'

			) {
				$urlsm = $config_base . $com . '/' . $value['ten'];

			} else {
				$urlsm = $config_base . $value['ten'];
			}

			echo '<url>';
			echo '<loc>' . $urlsm . '</loc>';
			echo '<lastmod>' . date('c', $value['ngaytao']) . '</lastmod>';
			echo '<changefreq>' . $changefreq . '</changefreq>';
			echo '<priority>' . $priority . '</priority>';
			echo '</url>';
		}
	}
}