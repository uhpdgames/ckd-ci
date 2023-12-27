<?php
if ($isMobile) {
	$this->load->view('all/toolbar');
}


$this->load->view('all/footer');
?>
<!--KHÔNG THAY ĐỔI NỘI DUNG BÊN DƯỚI-->



<!-- Js Body -->
<?= htmlspecialchars_decode($setting['bodyjs']) ?>

<?php if (isset($config['googleAPI']['recaptcha']['active']) && $config['googleAPI']['recaptcha']['active'] == true) { ?>
	<!-- Js Google Recaptcha V3 -->
	<script
		src="https://www.google.com/recaptcha/api.js?render=<?= $config['googleAPI']['recaptcha']['sitekey'] ?>"></script>

	<script type="text/javascript">
		grecaptcha.ready(function () {
			<?php if($source == 'contact') { ?>
			grecaptcha.ready(function () {
				document.getElementById('FormContact').addEventListener("submit", function (event) {
					event.preventDefault();
					grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', {action: 'contact'}).then(function (token) {
						document.getElementById("recaptchaResponseContact").value = token;
						document.getElementById('FormContact').submit();
					});
				}, false);
			});
			<?php } ?>
		});
	</script>
<?php } ?>
<?php if (isset($config['oneSignal']['active']) && $config['oneSignal']['active'] == true) { ?>
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script type="text/javascript">
		var OneSignal = window.OneSignal || [];
		OneSignal.push(function () {
			OneSignal.init({
				appId: "<?=$config['oneSignal']['id']?>"
			});
		});
	</script>
<?php } ?>
<!--load .css-->
<!--<link def rel="stylesheet" href="<?php /*site_url() */?>assets/css/bootstrap.min.css?v=<?php /*= time(); */?>">-->
<!--<link rel="stylesheet" href="<?php /*site_url() */?>assets/css/import.css?v=<?php /*= time(); */?>">-->

<!--<link rel="stylesheet" href="<?php /*site_url() */ ?>assets/css/fa.css?v=<?php /*= time(); */ ?>">
<link rel="stylesheet" href="<?php /*site_url() */ ?>assets/css/optimizer.css?v=<?php /*= time(); */ ?>">
<link rel="stylesheet" href="<?php /*site_url() */ ?>assets/css/style.css?v=<?php /*= time(); */ ?>">
<link rel="stylesheet" href="<?php /*= site_url() */ ?>assets/css/tuan.css?v=<?php /*= rand(0, 9999) */ ?>">
<link rel="stylesheet" href="<?php /*= site_url() */ ?>assets/css/media.css?v=<?php /*= rand(0, 9999) */ ?>">-->

<?php if ($isMobile) : echo link_tag(site_url() . 'assets/css/mobile.css?v=' . time()); ?>
<?php endif; ?>

<div id="modal"></div>
<div id="overlay" class="overlay-addon"></div>

<div class="scrollToTop">
	<div onclick="_scrollTo()" class="gototop">
	</div>
</div>
