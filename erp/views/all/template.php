<?php

?>


<!doctype html>
<html lang="<?= $lang ?>">
<head>
	<link rel="icon" href="https://ckdvietnam.com/favicon.ico" type="image/x-icon"/>

	<?php $this->view('theme/head'); ?>
	<?php /*$this->view('all/head'); */?>
</head>

<body id="app-container" class="menu-default show-spinner">
<!--<body class="fixed-header fixed-sidebar closed-sidebar"
	  style="background: #fafcfe" oncontextmenu="return false">-->


<input type="hidden" id="jsonSort"/>
<div class="opaDiv"></div>
 <div id="updateMes" class="noPrint"></div>

<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
	<div class="lds-ripple">
		<div class="lds-pos"></div>
		<div class="lds-pos"></div>
	</div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
<!--	--><?php /*$this->view('all/header'); */?>
	<?php $this->view('theme/menu'); ?>
	<?php $this->view('theme/nav'); ?>



	<!--TODO MENU SIDEBAR-->
	<?php /*$this->view('all/sidebar'); */?>

	<!-- ============================================================== -->
	<!-- Page wrapper part -->
	<!-- ============================================================== -->


	<main>
		<?php $this->view($template)?>
	</main>
	<!--<div class="page-wrapper">
		<?php /*$this->view($template)*/?>
	</div>-->




<!--	--><?php //$this->view('all/afooter'); ?>
	<?php $this->view('theme/footer'); ?>
</div>
</body>
</html>
