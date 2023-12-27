<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>



<?php

///?id=17&id_tracking=19258224313
///
///
///
///
//$content = file_get_contents('https://viettelpost.vn/viettelpost-iframe/tra-cuu-hanh-trinh-don-hang-v3-recaptcha');
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <h1>Theo dỏi trạng thái đơn hàng</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href=".">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Đơn hàng</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>


    <!--//https://viettelpost.vn/thong-tin-don-hang?peopleTracking=sender&orderNumber=19258224313-->

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 p-4">
                <div class="card-header">
                </div>
                <div class="card-body card-body-view">
                    <div class="iframe-viettelpost"></div>
                    <iframe
                            id="viettelpost"
                            data-src="//viettelpost.vn/viettelpost-iframe/tra-cuu-hanh-trinh-don-hang-v3-recaptcha"
                            width="100%"
                            height="800"
                            style="border:0;"
                            allowfullscreen="true"
                            loading="lazy"
                            allow="accelerometer; autoplay;
        encrypted-media; gyroscope;
        picture-in-picture"
                            frameborder="0"
                    >
                    </iframe>
                </div>

                <div class="card-footer">
                    <div class="text-sm">
						<code>0376069683 | Vtp@1234</code>
                        <!--<a class="d-block" href="https://viettelpost.vn/thong-tin-don-hang?peopleTracking=sender&orderNumber=19258224313" target="_blank"><span><i class="iconsminds-receipt-4"></i>Lịch sử đơn hàng</span></a>-->
						<a target="_blank" class="d-block" href="https://viettelpost.vn/thong-tin-don-hang?peopleTracking=sender&orderNumber=<?=getRequest('id_tracking')?>"><span><i class="iconsminds-receipt-4"></i>Lịch sử đơn hàng</span></a>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!--<link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css"/>
<link rel="stylesheet" href="css/vendor/perfect-scrollbar.css"/>
<link rel="stylesheet" href="css/vendor/smart_wizard.min.css"/>
<link rel="stylesheet" href="font/iconsmind-s/css/iconsminds.css"/>
<link rel="stylesheet" href="font/simple-line-icons/css/simple-line-icons.css"/>
<script src="js/vendor/jquery.smartWizard.min.js"></script>
-->
<script type="application/javascript" defer>
var id_tracking = '<?=$_GET['id_tracking']?>';
</script>



<script>
	if ('loading' in HTMLIFrameElement.prototype) {
		const iframes = document.querySelectorAll('iframe[loading="lazy"]');
		iframes.forEach(iframe => {
			iframe.src = iframe.dataset.src;
		});
		console.log(id_tracking);
	} else {
		console.log(id_tracking);
		const script = document.createElement('script');
		script.src =
			'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js?v=<?=time()?>';
		document.body.appendChild(script);
	}
</script>

<style>

    .card-body-view {
        height: 100vh;
    }
    iframe{
        height: 100%;
        width: 100%;
    }

    #app-container.menu-hidden main, #app-container.menu-sub-hidden main, #app-container.sub-hidden main{
        height: 100vh
    }

    #trackingContent{
        background-image:none !important;
    }

</style>



<script>


    https://api.viettelpost.vn/api/setting/getOrderDetailForWeb?OrderNumber=19258224313
</script>
