<?php

$hotro = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten, photo, noidung$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('ho-tro'));

$mangxahoi = $d->rawQuery("select link, photo, options from #_photo where type = ? order by stt,id desc", array('mangxahoi'));

$lienhe = $d->rawQueryOne("select noidung$lang as noidung, ten$lang as ten from #_static where type = ?", array('trungtam'));

$thongtinkhac = $d->rawQueryOne("select noidung$lang as noidung, ten$lang as ten from #_static where type = ?", array('thong-tin-khac'));

$chinhsach = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten from #_news where type = ? order by stt,id desc", array('chinh-sach'));
//?com=news&act=man&type=chinh-sach&p=1


?>


<footer>
	<div class="pc repo_footer">
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
	<div class="mb repo_footer1 container-fluid">

		<div>
			<div class="d-flex justify-content-center align-items-center">
				<div class="row">
					<div class="col">
						<div class="footer-title-info">
							<div class="footer-info-1" style="text-align: center;">
								<div class="footer-address">
									<div class="font-weight-bold">
										<?= getLang('ctttnhhbluepink') ?>
									</div>
									<div>
										<?= $optsetting['diachi'] ?>
									</div>
								</div>
								<div class="pt-2"></div>
								<div class="footer-phone font-weight-bold">
									<?= getLang('thongtinfooter2') ?>
									<br/>
									<?= getLang('thongtinfooter3') ?>
									<br/>
								</div>
								<div class="pt-2"></div>
								<div class="footer-contact">
									bluepink@ckdcosvietnam.com
									<br/>
									<?= getLang('chitietxuatkhau') ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="pt-2"></div>
			<footer style="display: none;">
				<div class="grp_sns">
					<a
						href="<?= site_url(); ?>"
						target="_blank" alt="CKD COS VIET NAM" class="glb">
						<!-- <img style="width: 20px;" src="assets/images/footer/tiktok.webp" /> -->
						<span class="add-image" data-img="tiktok" data-class="cover_img_30_30" style="width: 20px;"></span>
					</a>
					<a
						href="<?= site_url(); ?>"
						target="_blank" alt="CKD COS VIET NAM" class="glb">
						<!-- <img style="width: 20px;" src="assets/images/footer/shoppe.webp" /> -->
						<span class="add-image" data-img="shopee" data-class="cover_img_30_30" style="width: 20px;"></span>
					</a>
					<a
						href="<?= site_url(); ?>"
						target="_blank" alt="CKD COS VIET NAM" class="glb">
						<!-- <img style="width: 20px;" src="assets/images/footer/instagram.webp" /> -->
						<span class="add-image" data-img="ig" data-class="cover_img_30_30" style="width: 20px;"></span>
					</a>
					<a
						href="<?= site_url(); ?>"
						target="_blank" alt="CKD COS VIET NAM" class="glb">
						<!-- <div class="add-image" data-img="fb" data-style="width: 20px;"></div> -->
						<span class="add-image" data-img="fb" data-class="cover_img_30_30" style="width: 20px;"></span>
					</a>
					<a
						href="<?= site_url(); ?>"
						target="_blank" alt="CKD COS VIET NAM" class="glb">
						<!-- <div class="add-image" data-img="fb" data-style="width: 20px;"></div> -->
						<span class="add-image" data-img="lazada" data-class="cover_img_30_30" style="width: 20px;"></span>
					</a>
				</div>
			</footer>
			<div class="pt-2"></div>
		</div>
		<div>
			<div class="row">
				<div class="col-6 pr-0">
					<div>
						<div class="font-sm">
							<div class="highlighted-text"><?= $lienhe['ten'] ?? "" ?></div>
							<div>
								<?= htmlspecialchars_decode($lienhe['noidung'] ?? '') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 pl-0">
					<div>
						<div>
							<div class="font-sm">
								<div class="highlighted-text"><?= $thongtinkhac['ten'] ?? "" ?></div>
								<div>
									<?= htmlspecialchars_decode($thongtinkhac['noidung'] ?? "") ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center justify-content-center">
			<div class="col-12">
				<div class="col">
					<div class="col font-weight-bold">
						<?= getLang('chapnhanthanhtoan') ?>
					</div>
					<div class="col">
						<div width="20%" class="escrow">
							<img class="img-fluid cover_img_30_30" src="<?= image_default('momo') ?>"
								 alt="CKD COS VIET NAM">
							<img class="img-fluid cover_img_30_30" src="<?= image_default('zalo') ?>"
								 alt="CKD COS VIET NAM">
							<img class="img-fluid cover_img_30_30" src="<?= image_default('delivery-transfer-footer') ?>"
								 alt="CKD COS VIET NAM">
							<img class="img-fluid cover_img_30_30" src="<?= image_default('delivery-local-footer') ?>"
								 alt="CKD COS VIET NAM">

							<!--<span class="add-image" data-img="momo" data-class="cover_img_30_30"></span>
							<span class="add-image" data-img="zalo" data-class="cover_img_30_30"></span>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="line"></div>
		<div id="accordion text-align-left-cover">
			<div class="card mb-3">
				<div id="headingOne">
					<div class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
						 aria-controls="collapseOne">
						<div class="row p-2 custom-font-size-1">
							<div class="col-12">
								<?= getLang('lienhevoichungtoi') ?>
							</div>
						</div>
					</div>
				</div>
				<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="footer-col pt-2">

						<div class="row p-0">
							<?php
							foreach ($hotro as $h) {
								?>
								<div class="col-4">
									<?= $h['ten'] ?>
								</div>
								<div class="col-8">

									<?= strip_tags_content($h['mota'] ?? "") ?>


								</div>

								<?php
							}
							?>
						</div>

					</div>
				</div>
			</div>
			<div class="card">
				<div id="headingTwo">
					<h5 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
						aria-controls="collapseTwo">
						<div class="row p-2 custom-font-size-1">
							<div class="col-12">
								<?= getLang('hotro') ?>
							</div>
						</div>
					</h5>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
					<div>
						<div class="footer-col pt-2">


							<div class="row p-0">


								<?php

								foreach ($chinhsach as $cs) {
									?>

									<div class="col-12">
										<a href="<?= $cs['link'] ?? '#' ?>" target="_self"><?= $cs['ten'] ?></a>


									</div>
									<?php
								}
								?>




							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pb-3"></div>
		<div class="pb-5"></div>
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
