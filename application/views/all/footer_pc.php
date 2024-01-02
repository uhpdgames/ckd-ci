<?php

$hotro = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten, photo, noidung$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('ho-tro'));

$mangxahoi = $d->rawQuery("select link, photo, options from #_photo where type = ? order by stt,id desc", array('mangxahoi'));

$lienhe = $d->rawQueryOne("select noidung$lang as noidung, ten$lang as ten from #_static where type = ?", array('trungtam'));

$thongtinkhac = $d->rawQueryOne("select noidung$lang as noidung, ten$lang as ten from #_static where type = ?", array('thong-tin-khac'));

$chinhsach = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten from #_news where type = ? order by stt,id desc", array('chinh-sach'));
//?com=news&act=man&type=chinh-sach&p=1


?>


<footer class="pc" id="footer">
	<div class="row center justify-content-center">
		<div class="col-3">
		<div class="title text-center"><?= $lienhe['ten'] ?? '' ?></div>
						<div class="grp_return m-0  p-0 mt-2">
							<?= htmlspecialchars_decode($lienhe['noidung'] ?? '') ?>
						</div>
		</div>
		<div class="col-3">
		<div class="title text-center"><?= $thongtinkhac['ten'] ?? "" ?></div>
						<div class="grp_return m-0  p-0 mt-2">
							<?= htmlspecialchars_decode($thongtinkhac['noidung'] ?? "") ?>
						</div>
		</div>
		<div class="col-3">
		<div class="row">

<?php
foreach ($hotro as $h) {
	?>
	<div class="col-6">
		<div href="<?= MYSITE . $h['link'] ?>">
			<p  class="justify-content-center text-center">
			<span class="w-100">
				<img src="<?= MYSITE . UPLOAD_NEWS_L . $h['photo'] ?>"
					 alt="<?= $h['ten'] ?>">
			</span>
				<span class="number-cover">
				<?= $h['ten'] ?>
			</span>
				<span>
				<?= strip_tags_content($h['mota'] ?? "") ?>
			</span>

			</p>

		</div>
	</div>

	<?php
}
?>


</div>
		</div>
	</div>
</footer>

<script>
	$("#accordion").on("show.bs.collapse", function (e) {
		$(e.target).prev(".card-header").find(".accordion-toggle-icon").removeClass("fa-plus").addClass("fas fa-minus");
	});
	$("#accordion").on("hide.bs.collapse", function (e) {
		$(e.target).prev(".card-header").find(".accordion-toggle-icon").removeClass("fas fa-minus").addClass(" fa-plus");
	});
</script>
