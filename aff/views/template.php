<!doctype html>
<html lang="<?= $lang ?>">
<head>

	<link rel="stylesheet" href="<?= site_url() ?>assets/css/base.css?v=<?=time() ?>">
	<?php $this->load->view('all/aff_head'); ?>
	<script src="<?= MYSITE ?>assets/swiper/swiper-bundle.min.js?v=<?= time() ?>"></script>
	<link rel="stylesheet" href="<?= MYSITE ?>assets/swiper/swiper-bundle.min.css?v=<?= time() ?>">

	<link rel="stylesheet" href="<?= MYSITE ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= MYSITE ?>/assets/css/fa.css">
	<link rel="stylesheet" href="<?= MYSITE ?>/assets/css/optimizer.css">
	<link rel="stylesheet" href="<?= MYSITE ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?= MYSITE ?>/assets/css/tuan.css">
	<link rel="stylesheet" href="<?= MYSITE ?>/assets/css/media.css">

</head>

<body id="main" class="<?= !empty($aff) ? 'aff' : 'normalize' ?>">
<div class="wapper">
	<div class="main-container">
		<?php $this->view('all/header'); ?>
		<div class="clear mypage">

			<?php $this->view($template); ?>
		</div>
	</div>
	<?php $this->load->view('all/under'); ?>
</div>
<script type="text/javascript" src="<?= MYSITE ?>assets/js/uhpd.js?v=<?= time() ?>"></script>
 <script type="text/javascript" src="<?= MYSITE ?>assets/js/aff.js?v=<?= time() ?>"></script>


<div class="overlay"></div>
<div id="loader" style="display:none">
	<div class="spinner-border" role="status"></div>
</div>
</body>
</html>
