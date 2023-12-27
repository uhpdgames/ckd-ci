<?php
$isIndex = !empty($myckd) ? true : false;
?>
<!doctype html>
<html lang="<?= $lang ?>">
<head>
    <script src="<?= site_url() ?>assets/swiper/swiper-bundle.min.js?v=<?= time() ?>"></script>
    <link rel="stylesheet" href="<?= site_url() ?>assets/swiper/swiper-bundle.min.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= site_url() ?>assets/css/base.css?v=<?= time() ?>">

	<?php $this->load->view('all/head'); ?>
</head>

<body id="<?= !empty($isIndex) ? 'main' : 'prod' ?>" class="loading">
<div class="wapper">
	<div class="main-container">
		<?php $this->load->view('all/header'); ?>
		<div class="clear mypage" data-view="<?=$template?>" id="page">
			<?php $this->load->view($template); ?>
		</div>
	</div>

	<?php $this->load->view('all/under'); ?>
</div>
<?php if ($isIndex): ?>
	<script type="text/javascript" src="<?= MYSITE ?>assets/js/home.js?v=<?= time() ?>"></script>
<?php else: ?>
	<script type="text/javascript" src="<?= MYSITE ?>assets/js/ckd.js?v=<?= time() ?>"></script>
<?php endif; ?>


<div class="overlay"></div>
<div id="loader" style="display:none">
	<div class="spinner-border" role="status"></div>
</div>

<!--<link rel="stylesheet" href="<?php /*=MYSITE*/?>/assets/css/text.min.css?v=<?php /*=time()*/?>">-->
</body>
</html>
