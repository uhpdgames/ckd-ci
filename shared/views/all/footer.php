<?php

$hotro = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten, photo, noidung$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('ho-tro'));

$mangxahoi = $d->rawQuery("select link, photo, options from #_photo where type = ? order by stt,id desc", array('mangxahoi'));

$lienhe = $d->rawQueryOne("select noidung$lang as noidung from #_static where type = ?", array('trungtam'));

$thongtinkhac = $d->rawQueryOne("select noidung$lang as noidung from #_static where type = ?", array('thong-tin-khac'));

$chinhsach = $d->rawQuery("select tenkhongdau$lang as link, ten$lang as ten from #_news where type = ? order by stt,id desc", array('chinh-sach'));
//?com=news&act=man&type=chinh-sach&p=1


//qq($chinhsach);

?>


<div class="pc repo_footer">
	<div style="display: none;" id="footer">
		<div class="inner">
			<div class="site-wrap">
				<div class="foot_grp1 m-0 p-0">
					<div class="title text-center"><?= getLang('hotrotructuyen') ?></div>
					<div class="grp_return m-0  p-0 mt-2 text-left">
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
					<div class="title text-center"><?= getLang('yeucauxuatkhau') ?></div>
					<div class="grp_return m-0  p-0 mt-2 text-left">
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
								<a href="<?=$cs['link'] ?? '#'?>" target="_self"><?= $cs['ten'] ?></a>

							</li>

							<?php
						}
						?>
					</ul>
					<div class="grp_sns ">

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
								<img class="cover_img_30_30 img-fluid" src="<?= image_default('delivery-transfer-footer') ?>"/>

								<!-- <img src="assets/images/footer/footer-12.webp" alt="CKD COS VIỆT NAM" /> -->
							</a>
						</li>
                        <li class="inline">
							<a href="<?= site_url(); ?>">
								<img class="cover_img_30_30 img-fluid" src="<?= image_default('delivery-local-footer') ?>"/>

								<!-- <img src="assets/images/footer/footer-12.webp" alt="CKD COS VIỆT NAM" /> -->
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mb repo_footer1 main_fix">
    <div class="foot_grp1">
        <div class="">
            <div class="row justify-content-center text-center vertical-top align-items-center">
                <div class="col text-left d-flex align-items-center justify-content-center">
                    <a
                        class="logo"
                        href="
								<?= $config_base; ?>"
                    >
						<img class="img-fluid" src="<?= image_default('logo')?>"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="col">
                    <div class="footer-title-info">
                        <div class="footer-info-1" style="text-align: center;">
                            <div class="footer-address">
                                <div class="font-weight-bold">
                                    <?=getLang('ctttnhhbluepink')?>
                                </div>
                                <div>
                                    <?=$optsetting['diachi']?>
                                </div>
                            </div>
                            <div class="pt-2"></div>
                            <div class="footer-phone font-weight-bold">
                                <?=getLang('thongtinfooter2')?>
                                <br />
                                <?=getLang('thongtinfooter3')?>
                                <br />
                            </div>
                            <div class="pt-2"></div>
                            <div class="footer-contact">
                                <?=$optsetting['email']?>
                                <br />
                                <?=getLang('chitietxuatkhau')?>
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
                href="<?=site_url();?>"
                target="_blank" alt="CKD COS VIET NAM" class="glb">
                    <!-- <img style="width: 20px;" src="assets/images/footer/tiktok.webp" /> -->
                    <!-- <div class="add-image" data-img="tiktok" data-style="width: 20px;"></div>-->
					<img class="img-fluid" src="<?= image_default('tiktok')?>" alt="CKD COS VIỆT NAM"/>
                </a>
                <a 
                href="<?=site_url();?>"
                target="_blank" alt="CKD COS VIET NAM" class="glb">
                    <!-- <img style="width: 20px;" src="assets/images/footer/shoppe.webp" /> -->
                    <!--<div class="add-image" data-img="shoppe" data-style="width: 20px;"></div>-->
					<img class="img-fluid" src="<?= image_default('tiktok')?>" alt="CKD COS VIỆT NAM"/>
                </a>
                <a 
                href="<?=site_url();?>"
                target="_blank" alt="CKD COS VIET NAM" class="glb">
                    <!-- <img style="width: 20px;" src="assets/images/footer/instagram.webp" /> -->
                    <!--<div class="add-image" data-img="instagram" data-style="width: 20px;"></div>-->
					<img class="img-fluid" src="<?= image_default('ig')?>" alt="CKD COS VIỆT NAM"/>
                </a>
                <a 
                href="<?=site_url();?>"
                target="_blank" alt="CKD COS VIET NAM" class="glb">
                    <!-- <img style="width: 20px;" src="assets/images/footer/facebook-01.webp" /> -->
                    <!--<div class="add-image" data-img="fb" data-style="width: 20px;"></div>-->
					<img class="img-fluid" src="<?= image_default('fb')?>" alt="CKD COS VIỆT NAM"/>
                </a>
                <a 
                href="<?=site_url();?>"
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
            <div class="col-6">
                <div>
                    <div class="pr-2 pl-2 font-sm">
                        <div><?=getLang('hotrotructuyen')?></div>
                        <p class="p_runtime"><?= getLang('tuvankhachhang');?></p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div>
                    <div>
                        <div class="pr-2 pl-2 font-sm">
                            <div><?=getLang('yeucauxuatkhau')?></div>
                            <ul>
                                <?= getLang('chitietxuatkhau') ?>
                            </ul>
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
                    <div>
                        <!-- <img 
                        class="cover_img_30_30"
                         src="assets/images/footer/footer-11.webp" alt="CKD COS VIỆT NAM" />
                        <img 
                        class="cover_img_30_30"
                         src="assets/images/footer/footer-12.webp" alt="CKD COS VIỆT NAM" /> -->
						<img class="img-fluid" src="<?= image_default('momo')?>" alt="CKD COS VIỆT NAM"/>
						<img class="img-fluid" src="<?= image_default('zalo')?>" alt="CKD COS VIỆT NAM"/>
                         <!--<div class="add-image" data-img="momo" data-class="cover_img_30_30"></div>
                         <div class="add-image" data-img="zalo" data-class="cover_img_30_30"></div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div id="accordion text-align-left-cover">
        <div class="card mb-3">
            <div class="card-header" id="headingOne">
                <div class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <div class="row p-2 custom-font-size-1">
                        <div class="col-12">
                            <?= getLang('lienhevoichungtoi') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="footer-col pt-2">
                    <ul>
                        <div class="row p-2">
                            <div class="col-6">
                                <p class="highlighted-text-1">
                                    <?= getLang('banphim0') ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <div class="pl-2"><?= getLang('gaptuvantienghanquoc') ?></div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-6">
                                <p class="highlighted-text-1">
                                    <?= getLang('banphim1') ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <div class="pl-2"><?= getLang('hotrotuvanmuahang') ?></div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-6">
                                <p class="highlighted-text-1">
                                    <?= getLang('banphim2') ?>
                                </p>
                            </div>
                            <div class="col">
                                <div class="pl-2"><?= getLang('lienhebophancskh') ?></div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-6">
                                <p class="highlighted-text-1">
                                    <?= getLang('banphim3') ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <div class="pl-2"><?= getLang('hotrovecacvande') ?></div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="row p-2 custom-font-size-1">
                        <div class="col-12">
                            <?= getLang('hotro') ?>
                        </div>
                    </div>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <div class="footer-col">
                        <ul class="util1 text-align-center">
                            
                            <li>
                                <a href="/cau-hoi-thuong-gap">
                                    <?= getLang('cauhoithuonggap') ?>
                                </a>
                            </li>
                            <li>
                                <a href="/chinh-sach-bao-mat-thong-tin">
                                    <?= getLang('chinhsachbaomatthongtin') ?>
                                </a>
                            </li>
                            <li>
                                <a href="/ho-tro-dat-hang">
                                    <?= getLang('hotrodatmuahang') ?>
                                </a>
                            </li>
                            <li>
                                <a href="/chinh-sach-tra-hang">
                                    <?= getLang('chinhsachtrahang') ?>
                                </a>
                            </li>
                            <li>
                                <a href="/chinh-sach-bao-hanh">
                                    <?= getLang('chinhsachbaohanh') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-3"></div>
    <div class="pb-5"></div>
</div>

<script>
	$("#accordion").on("show.bs.collapse", function (e) {
		$(e.target).prev(".card-header").find(".accordion-toggle-icon").removeClass("fa-plus").addClass("fas fa-minus");
	});
	$("#accordion").on("hide.bs.collapse", function (e) {
		$(e.target).prev(".card-header").find(".accordion-toggle-icon").removeClass("fas fa-minus").addClass(" fa-plus");
	});
</script>
