<base href="<?=MYADMIN?>"/>



<script type="text/javascript">
	var site_url = '<?= base_url() ?>';
	var cookie_time = '<?= COOKIE_TIME ?>';
	var user_level = 1; //'<?= !empty($GLOBALS['user']['level']) ? $GLOBALS['user']['level'] : 0 ?>';
	var user_id = '<?= !empty($GLOBALS['user']['id']) ? $GLOBALS['user']['id'] : 0 ?>';
	/*window.addEventListener('DOMContentLoaded', function () {
		"use strict";
		var ql = new QueryLoader2(document.querySelector('body'), {
			barColor: '#00bca4',
			backgroundColor: '#ffffff',
			percentage: true,
			barHeight: 2,
			minimumTime: 200,
			fadeOutTime: 1000
		});
	});*/
	<?php
	$data['filter'] = $this->input->get('filter', true);
	?>
	var uri_url = '<?= http_build_query($data); ?>';
	//            var mfr = '//= $GLOBALS['manufacturers'] ? $GLOBALS['manufacturers'] : '[]' ?>//';
	//            var getDataMFR = JSON.parse(mfr);
	//            var optionMFR = '<option value="">Select...</option>';
	//            for (var k in getDataMFR){
	//                if (typeof getDataMFR[k] !== 'function') {
	//                    optionMFR += '<option value="' + k + '">' + getDataMFR[k] + '</option>';
	//                }
	//            }
	//
	//            var supplier = '//= $GLOBALS['suppliers'] ? $GLOBALS['suppliers'] : '[]' ?>//';
	//            var getDataSupplier = JSON.parse(supplier);
	//            var optionSupplier = '<option value="">Select...</option>';
	//            for (var k in getDataSupplier) {
	//                if (typeof getDataSupplier[k] !== 'function') {
	//                    optionSupplier += '<option value="' + k + '">' + getDataSupplier[k] + '</option>';
	//                }
	//            }
</script>
<style media="screen">
	.yesPrint {
		display: none !important;
	}

	#header-logo .logo-content-big,
	.logo-content-small {

	}
</style>
<style media="print">
	.noPrint {
		display: none !important;
	}
</style>

<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/atckey.css">
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.minicolors.css">
<link rel="stylesheet" type="text/css" href="assets/js/dhtmlxgantt/dhtmlxgantt.css" media="screen">
<script type="text/javascript" src="assets/js/core.js"></script>
<script type="text/javascript" src="assets/js/dhtmlxgantt/dhtmlxgantt.js"></script>
<script type="text/javascript" src="assets/js/dhtmlxgantt/ext/dhtmlxgantt_tooltip.js"></script>
<script type="text/javascript" src="assets/js/autoNumeric.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/crmzx.css">
<link rel="stylesheet" type="text/css" href="assets/css/extra.css">

<script src="js/vendor/bootstrap-notify.min.js"></script>


