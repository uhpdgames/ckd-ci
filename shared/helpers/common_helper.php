<?php
if ( ! defined('BASEPATH')) exit('BẠN KHÔNG CÓ QUYỀN TRUY CẬP VÀO TRANG NÀY');


function ww($d)
{
	echo '<pre>';
	var_dump($d);
	echo '</pre>';
}
function qq($data, $die = false){
	highlight_string("<?php\n " . var_export($data, true) . "?>");
	echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
	echo '<br/>';
	echo '<br/>';
	echo '<br/>';

	if($die) die();
}
function getScripts()
{
	require_once(APPPATH . "views/common/scripts.php");
}

function getCSSScript($fileName)
{
	echo link_tag(site_url() . 'assets/css/page/' . $fileName . '.css?v=' . time());
}


function share_link()
{

	echo '<script async src="https://static.addtoany.com/menu/page.js"></script>';

	$current_page = getCurrentPageURL();
	$optsetting = getOptSetting();
	$zalo = !empty($optsetting['oaidzalo']) ? $optsetting['oaidzalo'] : '579745863508352884';

	echo <<<HTML
<div class="a2a_kit a2a_kit_size_32 a2a_default_style share" data-a2a-title="Share">
<a class="a2a_dd" href="$current_page"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_facebook_messenger"></a>
<div class="zalo-share-button" data-href="$current_page" data-oaid="$zalo" data-layout="3" data-color="blue" data-customize=false>
</div></div>
<style type="text/css">.a2a_kit{height: 50px}.a2a_svg{height: 30px !important}</style>
HTML;

	return;
	echo <<<HTML

<div class="share">
<div class="share-btn">
<a class='share-facebook' href="http://www.facebook.com/share.php?u=$current_page" target="_blank"
>
<i class="fab fa-facebook-f"></i>
</a>
</div>
</div>
HTML;

}

function getCurrentPageURL()
{
	$pageURL = 'http';
	if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";
	$pageURL .= "://";
	$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	$urlpos = strpos($pageURL, "?p");
	$pageURL = ($urlpos) ? explode("?p=", $pageURL) : explode("&p=", $pageURL);
	return $pageURL[0];
}

function getSetting()
{
	$ci = &get_instance();
	return $ci->data['setting'];
}

function getOptSetting()
{
	$ci = &get_instance();
	return $ci->data['optsetting'];
}
