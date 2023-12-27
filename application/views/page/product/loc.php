<?php if ($com != 'khuyen-mai'): ?>
	<!--todo: LOC.php-->

	<?php /*$this->load->view('template/product/loc', array('data'=>$this->data))*/ ?>


	<?php
	@$id = htmlspecialchars($_GET['id']);
	@$idl = htmlspecialchars($_GET['idl']);
	@$idc = htmlspecialchars($_GET['idc']);
	@$idi = htmlspecialchars($_GET['idi']);
	@$ids = htmlspecialchars($_GET['ids']);
	@$idb = htmlspecialchars($_GET['idb']);
	@$id_thuonghieu = htmlspecialchars($_GET['id_thuonghieu']);
	@$id_dong = htmlspecialchars($_GET['id_dong']);
	@$isPromotion = htmlspecialchars($_GET['khuyen_mai']);

	/*
   $lang = $this->current_lang;
   $type = $this->com;
   $seo = $data['seo'];
   $seolang = $data['seolang'];
   $func = $data['func'];

   $sluglang = $data['sluglang'];
   $optsetting = $data['optsetting'];*/

	$product_list = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id, photo from #_product_list where type = ? and hienthi > 0 order by stt,id desc", array('san-pham'));

	$thuonghieu = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id from #_news where type = ? and hienthi > 0 order by stt,id desc", array('thuong-hieu'));

	$dong = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id from #_news where type = ? and hienthi > 0 order by stt,id desc", array('dong'));

	$mucgia = $d->rawQuery("select ten$lang as ten, tenkhongdauvi, tenkhongdauen,id, gia1, gia2 from #_news where type = ? and hienthi > 0 order by stt,id desc", array('muc-gia'));
	?>

	<div class="loc">
		<?php if ($deviceType == 'computer') { ?>
			<select name="tatca" id="tatca">
				<option value=""><?= getLang('tatcasanpham') ?></option>
				<option value=""><?= getLang('tatca') ?></option>
				<option
					value="noibat" <?php if ($com == 'tot-nhat') echo 'selected'; ?>><?= getLang('totnhat') ?></option>
				<option value="moi" <?php if ($com == 'moi') echo 'selected'; ?>><?= getLang('moi') ?></option>
				<option
					value="noibat" <?php if ($com == 'khuyen-mai') echo 'selected'; ?>><?= getLang('sanphamkhuyenmai') ?></option>
			</select>
		<?php } ?>

		<select name="loaisanpham" id="loaisanpham">
			<option value=""><?= getLang('loaisanpham') ?></option>
			<?php foreach ($product_list as $k => $v) { ?>
				<option
					value="<?= $v['id'] ?>" <?php if ($idl == $v['id']) echo 'selected'; ?>><?= $v['ten'] ?></option>
			<?php } ?>
		</select>

		<select name="thuonghieu" id="thuonghieu">
			<option value=""><?= getLang('thuonghieu') ?></option>
			<?php foreach ($thuonghieu as $k => $v) { ?>
				<option
					value="<?= $v['id'] ?>" <?php if ($id_thuonghieu == $v['id']) echo 'selected'; ?>><?= $v['ten'] ?></option>
			<?php } ?>
		</select>

		<select name="dong" id="dong">
			<option value=""><?= getLang('dong') ?></option>
			<?php foreach ($dong as $k => $v) { ?>
				<option
					value="<?= $v['id'] ?>" <?php if ($id_dong == $v['id']) echo 'selected'; ?>><?= $v['ten'] ?></option>
			<?php } ?>
		</select>

		<select name="mucgia" id="mucgia">
			<option value=""><?= getLang('mucgia') ?></option>
			<?php foreach ($mucgia as $k => $v) { ?>
				<option value="<?= $v['gia1'] ?>-<?= $v['gia2'] ?>"><?= $v['ten'] ?></option>
			<?php } ?>
		</select>
	</div>


<?php endif; ?>
