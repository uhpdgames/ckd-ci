<?php

$hotro = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten, photo, noidung$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('ho-tro'));

$mangxahoi = $d->rawQuery("select link, photo, options from #_photo where type = ? order by stt,id desc", array('mangxahoi'));

$lienhe = $d->rawQueryOne("select noidung$lang as noidung, ten$lang as ten from #_static where type = ?", array('trungtam'));

$thongtinkhac = $d->rawQueryOne("select noidung$lang as noidung, ten$lang as ten from #_static where type = ?", array('thong-tin-khac'));

$chinhsach = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten from #_news where type = ? order by stt,id desc", array('chinh-sach'));
//?com=news&act=man&type=chinh-sach&p=1


?>


<footer class="pc">
	<div class="repo_footer">
		<div style="display: none;" id="footer">
			<div class="inner">
				<div class="main_fix site-wrap">
					<div class="foot_grp1 m-0 p-0">
						<div class="title text-center"><?= $lienhe['ten'] ?? '' ?></div>
						<div class="grp_return m-0  p-0 mt-2">
							<?= htmlspecialchars_decode($lienhe['noidung'] ?? '') ?>
						</div>

						<!--<a
						class="logo text-center w-100"
						href="
									<?php /*= MYSITE */ ?>"
					>
						<img class="img-fluid" src="<?php /*= image_default('logo')*/ ?>"/>
					</a>-->

					</div>
					<div class="foot_grp1 m-0 p-0 pl-2">
						<div class="title text-center"><?= $thongtinkhac['ten'] ?? "" ?></div>
						<div class="grp_return m-0  p-0 mt-2">
							<?= htmlspecialchars_decode($thongtinkhac['noidung'] ?? "") ?>
						</div>
					</div>


					<div class="foot_grp3 foot_grp3-cover">
						<div class="grp_menu">
							<div class="row">

								<?php
								foreach ($hotro as $h) {
									?>
									<div class="col-6">
										<div href="<?= MYSITE . $h['link'] ?>">
											<p class="justify-content-center text-center">
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
				</div>
				<div class="foot_grp4">
					<div class="site-wrap">
						<ul class="util">
							<?php

							foreach ($chinhsach as $cs) {
								?>

								<li>
									<a href="<?= $cs['link'] ?? '#' ?>" target="_self"><?= $cs['ten'] ?></a>

								</li>

								<?php
							}
							?>
						</ul>

						<div class="grp_sns">
							<?php

							foreach ($mangxahoi as $xh) {
								?>
								<a
									href="<?= $xh['link'] ?>"
									target="_blank" alt="CKD COS VIỆT NAM">
									<!-- <img src="assets/images/footer/tiktok.webp" /> -->
									<img class="img-fluid" src="<?= image_default($xh['options'] ?? '') ?>"/>
									<!--<span class="add-image" data-img="tiktok" ></span>-->
								</a>
								<?php
							}
							?>


						</div>
					</div>
				</div>
				<div class="foot_grp5">
					<div class="site-wrap">
						<div class="xans-element- xans-layout xans-layout-footer shopinfo">
							<span> <?= getLang('ctttnhhbluepink') ?>  </span>
							<span class="line">|</span>
							<span> bluepink@ckdcosvietnam.com</span>
							<span class="line">|</span>
							<span> <?php echo getLang('nguoidaidien'); ?> </span>
							<span class="line">|</span>
							<span> <?php echo getLang('masothue'); ?> </span>
							<br/>
							<div class="copyright"><?php echo getLang('banquyen'); ?></div>
						</div>
						<div class="highlighted-text-2"><?= getLang('chapnhanthanhtoan') ?></div>
						<ul class="escrow">

							<li class="inline">
								<a href="<?= site_url(); ?>">
									<img class="cover_img_30_30 img-fluid" src="<?= image_default('momo') ?>"/>

									<!-- <img src="assets/images/footer/footer-11.webp" alt="CKD COS VIỆT NAM" /> -->
								</a>
							</li>
							<li class="inline">
								<a href="<?= site_url(); ?>">
									<img class="cover_img_30_30 img-fluid" src="<?= image_default('zalo') ?>"/>

									<!-- <img src="assets/images/footer/footer-12.webp" alt="CKD COS VIỆT NAM" /> -->
								</a>
							</li>
							<li class="inline">
								<a href="<?= site_url(); ?>">
									<img class="cover_img_30_30 img-fluid"
										 src="<?= image_default('delivery-transfer-footer') ?>"/>

									<!-- <img src="assets/images/footer/footer-12.webp" alt="CKD COS VIỆT NAM" /> -->
								</a>
							</li>
							<li class="inline">
								<a href="<?= site_url(); ?>">
									<img class="cover_img_30_30 img-fluid"
										 src="<?= image_default('delivery-local-footer') ?>"/>

									<!-- <img src="assets/images/footer/footer-12.webp" alt="CKD COS VIỆT NAM" /> -->
								</a>
							</li>
						</ul>
					</div>
				</div>
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
