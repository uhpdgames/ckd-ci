<?php
$ci = &get_instance();
$com = $this->uri->segment(2);
if($com =='') $com = 'khuyen-mai';
$mm = $ci->agent->is_mobile();
if($mm) $com .= '-m';
//=$breadcr;?>



<?php $bg = MYSITE . 'assets/images/cate/'.$com.'.webp';
if (!empty($pro_cat)):// $bg = UPLOAD_PRODUCT_L . toWebp($pro_cat['photo']); ?>
	<div class="container-fluid bg-img">
		<div style="--bg:url(<?= $bg ?>)" class="title-main title-main_sp">
			<span  style="--bg:url(<?=$bg?>);--bg-m:url(<?=$mm?>)"><?php /*= (@$title_cat != '') ? $title_cat : @$title_crumb */?></span></div>
	</div>
<?php else: ?>
	<div class="container-fluid bg-img">
		<div class="title-main title-main_sp">
			<span  style="--bg:url(<?=$bg?>);--bg-m:url(<?=$mm?>)"><?php /*= (@$title_cat != '') ? $title_cat : @$title_crumb */?></span></div>
	</div>
<?php endif; ?>

<div class="main_fix pt-3 pt-md-0">

	<?php if (is_array($product) && count($product)) : ?>
		<?php $this->load->view('page/product/loc');?>
		<div class="wap_loadthem_sp sanpham">
			<div class="wap_item loadthem_sp100">
				<?php
				get_product($product, $sluglang);
				?>
			</div>
		</div>
		<div class="mb-5">
			<?php share_link();?>
		</div>
	<?php endif; ?>
</div>

<?php if(empty($product)):?>
	<div class="searchResult">
		<p class="noData"><?php echo getLang('no_keywords')?></p>
	</div>
<?php endif;?>

<link rel="stylesheet" href="<?= MYSITE ?>assets/css/product.css?v=<?=stringRandom();?>">

<script defer src="<?= MYSITE ?>assets/js/product_init.js"></script>
