<ul class="cap1">
	<li class="active" data-id="noibat"><?= getLang('totnhat') ?></li>
	<li data-id="moi"><?= getLang('moi') ?></li>
</ul>
<div class="load_sp">
	<div
		class="slick4322 control_slick"> <?php $truyvan = $d->rawQuery("select hethang, photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id, type, mota$lang as mota, moi, soluong from #_product where type = 'san-pham' and noibat > 0 and hienthi > 0 order by stt,id desc limit 0,16");
		echo get_product_slick($truyvan, $sluglang, true); ?> </div>
	<p class="xemtatca"><a href="tot-nhat"><?= getLang('xemthem') ?></a></p></div>
