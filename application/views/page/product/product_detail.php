<div class="all_review"></div>
<?php

$ci = &get_instance();
$ci->load->library('user_agent');
$slt = 'style="height: 30rem; width: 100%"';
?>

<?php

$num_slider = 1;
?>


<?= $breadcr; ?>
<div class="main_fix d-block mb-2" id="details">
	<!--main_fix-2-->
	<div class="wp-box" <?= $slt ?> >
		<div class="row" <?= $slt ?> >
			<div class="col-12 col-lg-6">



					<div class="wp-slider">
						<div class="slider" <?= $slt ?> >
							<div class="slider__flex">
								<div class="slider__col  justify-content-center text-center">
									<div class="slider__thumbs">
										<div class="swiper-container">
											<div class="swiper-wrapper text-center justify-content-center">
												<div class="swiper-slide ">
													<div class="slider__image">
														<img class="center img-fluid"
															 src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
															 alt="<?= $row_detail['ten'] ?>">
													</div>
												</div>
												<?php if (is_array($hinhanhsp) && count($hinhanhsp) >
													0) { ?>
													<?php foreach ($hinhanhsp as $v) {
                                                        $num_slider++;
                                                        ?>
														<div class="swiper-slide">
															<div class="slider__image">
																<img class="cloudzoom center img-fluid"
																	 src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
																	 alt="<?= $row_detail['ten'] ?>"/>
															</div>
														</div>
													<?php }
												} ?>
											</div>
										</div>
									</div>
								</div>
								<div class="slider__images detail-swiper  justify-content-center text-center">
									<div class="swiper-container">
										<div class="swiper-wrapper album_pro2" style="height: 100%; width: 100%">
											<div class="swiper-slide h-100 h-100">
												<div class="slider__image  h-100 h-100">
													<a data-options="hint: off" data-zoom-id="Zoom-detail"
													   id="Zoom-detail" class="MagicZoom"
													   href="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
													   title="<?= $row_detail['ten'] ?>"><img
															class="cloudzoom center img-fluid  h-100 h-100"
															src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
															alt="<?= $row_detail['ten'] ?>"></a>
												</div>
											</div>
											<?php if (is_array($hinhanhsp) && count($hinhanhsp) >
												0) { ?>
												<?php foreach ($hinhanhsp as $v) { ?>
													<div class="swiper-slide">
														<div class="slider__image">
															<a data-options="hint: off" data-zoom-id="Zoom-detail"
															   id="Zoom-detail"
															   class="MagicZoom"
															   href="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
															   title="<?= $row_detail['ten'] ?>">
																<img class="cloudzoom center img-fluid"
																	 src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
																	 alt="<?= $row_detail['ten'] ?>"/>
															</a>
														</div>
													</div>
												<?php }

											} ?>
										</div>
									</div>
								</div>


							</div>


						</div>
					</div>



			</div>

			<div class="col-12 col-lg-6 right-pro-detail infoArea">
				<div class="brand">

					<?php

					$id_thuonghieu = @$row_detail['id_thuonghieu'] ?? 0;
					if (!empty($row_detail['id_thuonghieu']) && $row_detail['id_thuonghieu'] > 0) {
						$name_thuonghieu = $d->rawQueryOne("select ten$lang as ten from #_news where id=$id_thuonghieu");
						if (!empty($name_thuonghieu) && isset($name_thuonghieu['ten'])) {
							echo $name_thuonghieu['ten'];
						}
					} else {
						echo '<span></span>';
					}

					?>
				</div>

				<p class="headingArea title--detail catchuoi2"><?= $row_detail['ten'] ?></p>
				<div class="row">
					<div class="col-4 detail-title cover--detail pb-3"><?= getLang('masp') ?></div>
					<div
						class="col-8 cover--detail"><?= (isset($row_detail['masp']) && $row_detail['masp'] != '') ? $row_detail['masp'] : '' ?></div>
				</div>
				<div class="row">
					<div class="col-4 detail-title cover--detail pb-3"><?= getLang('thetich') ?></div>
					<div
						class="col-8 cover--detail"><?= (isset($row_detail['thetich']) && $row_detail['thetich'] != '') ? $row_detail['thetich'] : '' ?></div>
				</div>
				<div class="row">
					<div class="col-4 detail-title cover--detail pb-3"><?= getLang('gia') ?></div>
					<div class="col-8 cover--detail">
						<?php if ($row_detail['giamoi']) { ?>
							<span class="price-new-pro-detail"
								  data-gia="<?= $row_detail['giamoi'] ?>"><?= format_money($row_detail['giamoi']) ?></span>
							<span class="price-old-pro-detail"><?= format_money($row_detail['gia']) ?></span>
						<?php } else { ?>
							<span class="price-new-pro-detail"
								  data-gia="<?= $row_detail['gia'] ?>"><?= ($row_detail['gia']) ? format_money($row_detail['gia']) : getLang('lienhe') ?></span>
						<?php } ?>
					</div>
				</div>

				<div class="row">
					<div class="col-4 detail-title cover--detail"><?= getLang('soluong') ?></div>
					<div class="col-4">
						<div class="attr-content-pro-detail d-block">
							<div class="quantity-pro-detail">
								<span class="quantity-minus-pro-detail_2">-</span>
								<input type="number" class="qty-pro" min="1" value="1" onblur="updateMorePrice()"/>
								<span class="quantity-plus-pro-detail_2">+</span>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="attr-content-pro-detail-2">
                            <?php

                            $ci = &get_instance();
                            $tui_giay = $ci->session->userdata('has_tuigiay');
                            if($tui_giay =='true'){
                                $check = 'checked';
                            }else{
                                $check = '';
                            }
                            ?>
							<input <?=$check?> type="checkbox" name="themtui" class="themtui" id="radio-themtui"/>
							<label for="radio-themtui"
								   class="w-100 attr-label-pro-detail-3"><?= getLang('themtui') ?></label>
						</div>
					</div>
				</div>
				<!-- banner hình ảnh quảng cáo -->

				<!--TODO QUA TANG KEM THEO-->

				<!--			<div class="wp-gift pt-4 pb-4">-->
				<!--				<div class="sp_dis_container">-->
				<!--					<div class="row">-->
				<!--						 in đậm -->
				<!--						<div class="col-8">-->
				<!--							<div class="sp_dis_title">-->
				<!--								Các sản phẩm tặng kèm-->
				<!--							</div>-->
				<!--							<div class="sp_dis_mota">-->
				<!--								Chọn 1 trong các quà tặng-->
				<!--							</div>-->
				<!--						</div>-->
				<!--						<div class="col-4 text-right">-->
				<!--							div class="img-thumbnail_dis">-->
				<!--								<img class=" float-end"-->
				<!--									 width="50px"-->
				<!--									 src="giftbox.png" alt="Hình ảnh"/>-->
				<!--							</div> -->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="container-voucher mt-4">-->
				<!--						<div class="row">-->
				<!--							<div class="col-1">-->
				<!--								<div class="form-check">-->
				<!--									<input class="form-check-input" type="radio" id="age1" name="age" value="30"/>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--							<div class="col-2 sp_img_dis">-->
				<!--								<img class="voucher-img" src="assets/images/noimage.webp" alt="Hình ảnh"/>-->
				<!--							</div>-->
				<!--							<div class="col-9">-->
				<!--								<div class="sp_cover_1">-->
				<!--									Khi mua-->
				<!--									<span class="red-text">1</span> BỘ ĐÔI KEM CHỐNG NẮNG 40ML VÀ BÔNG TÂY TRANG <br/>-->
				<!--									Tặng <span class="red-text">1</span> TÚI ĐỰNG MỸ PHẨM DU LỊCH [TRỊ GIÁ 30.000Đ]-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--					<div class="container-voucher mt-4">-->
				<!--						<div class="row">-->
				<!--							<div class="col-1">-->
				<!--								<div class="form-check">-->
				<!--									<input class="form-check-input" type="radio" id="age1" name="age" value="30"/>-->
				<!--								</div>-->
				<!--							</div>-->
				<!--							<div class="col-2 sp_img_dis">-->
				<!--								<img class="voucher-img" src="assets/images/noimage.webp" alt="Hình ảnh"/>-->
				<!--							</div>-->
				<!--							<div class="col-9">-->
				<!--								<div class="sp_cover_1">-->
				<!--									Khi mua <span class="red-text">1</span> BỘ ĐÔI KEM CHỐNG NẮNG 40ML VÀ BÔNG TÂY TRANG-->
				<!--									<br/>-->
				<!--									Tặng <span class="red-text">1</span> TÚI ĐỰNG MỸ PHẨM DU LỊCH [TRỊ GIÁ 30.000Đ]-->
				<!--								</div>-->
				<!--							</div>-->
				<!--						</div>-->
				<!--					</div>-->
				<!--				</div>-->
				<!--			</div>-->

				<!--TODO VOUCHER-->

				<!--<div class="wp-voucher">
					<p class="headingArea title--detail--1">Mã khuyến mãi</p>

					<div class="d-flex flex-row">
						<div class="box-voucher">
							ABC
						</div>
						<div class="box-voucher">
							XYZ
						</div>
						<div class="box-voucher">
							XYZ
						</div>
					</div>
				</div>-->

				<div class="row pt-5 cover-mb-combo-button" style="padding-left: 2%">
					<?= share_link();?>
				</div>
				<div class="row pt-5 cover-mb-combo-button" style="padding-left: 2%">
					<div class="col-12">
						<!-- <div class="col-6"></div> -->

					</div>
					<div class="wp-btn d-flex flex-row justify-content-start cover-mb-combo-button">
						<div class="mr-1">
							<!--wp-muangay-->
							<a
								class="btn btn-primary buynow addcart text-decoration-none left"
								data-id="<?= $row_detail['id'] ?>"
								data-action="buynow"
								style="height: 100%;width: 100%;font-weight: bold;padding: 10px 20px;color: white;background-color: #3C5B2D;display: inline-block;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border: none;"
							>
								<span><?= getLang('dathang') ?></span>
							</a>
						</div>
						<div class="mr-1">

							<a
								class="btn btn-primary transition addnow addcart addcart2 text-decoration-none"
								target="_blank"
								data-id="<?= $row_detail['id'] ?>"
								data-action="addnow"
								style="width: 4rem; height: auto;border: 1px solid #3c5b2d;   background-color: #fff; color: white; padding: 10px 10px; text-decoration: none;"
							>
								<img src="<?= site_url(); ?>assets/icon/cart.png" width="25px" height="25px"/>
							</a>
						</div>

						<div>
							<a
								class="btn btn-primary transition addnow addcart addcart2 text-decoration-none"
								target="_blank"
								href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>"
								style="font-weight: bold; background-color: #118acb; color: white; padding: 10px 20px; text-decoration: none;"
							>
								Zalo
							</a>
						</div>
					</div>
				</div>
				<!-- <div class="pt-5">
					<a href="https://ckdvietnam.vn/account/dangky">
					<img class="img-fluid" src="assets/images/banner_demo.webp"

						 alt="banner"/>
					</a>

				</div> -->
				<!--<div class="col-6">
					<div class="row">
						<div class="col-6">
							<p class="headingArea title--detail--1">Tổng số tiền:</p>
						</div>
						<div class="col-6">
							<div class="gia-font-cover">
								<span class="price-new-pro-detail"
									  data-gia="<?php /*= $row_detail['giamoi'] */ ?>"><?php /*= format_money($row_detail['giamoi']) */ ?></span>
							</div>
						</div>
					</div>
				</div>-->
				<!-- <div class="col-6">

				</div> -->
			</div>
		</div>
	</div>
	<div class="main_fix d-block mb-2">
		<div class="wp-box" style="height: 100%; width: 100%">
			<div class="row" style="height: 100%; width: 100%">
				<div class="col-12 col-lg-6">

					<!--wp-review-->
					<div class="wp-review">
						<div class="d-flex w-100 text-center justify-content-center">
							<!--slider__flex w-100-->
							<!--<div class="slider_empty"></div>-->
							<div class="img-review w-100 pt-4">
								<p class="text-sm text-center font-weight-normal w-100 font-weight-bold">
									<?= getLang('hinhanhreview') ?>
								</p>

								<?php
								//	qq($danhgia);

								?>

								<div class="swiper-container review-swiper">
									<div class="swiper-wrapper">
										<?php
										$count = 1;
										if (is_array($danhgia) && count($danhgia)) {
											foreach ($danhgia as $v) {
												//if($count >=5) break;
												//$count++;
												$opt_rev = (isset($v['options2']) && $v['options2'] != '') ? json_decode($v['options2'], true) : null;
												$sosao = $opt_rev['sosao'] ?? 5;
												if ($v['photo'] == '') continue;
												?>
												<div class="swiper-slide h-auto px-1 mt-0">
													<div class="img_post">
														<!--slider-img-->
														<img
															data-sosao="<?= $sosao ?>"
															data-danhgia="true" data-id="<?= $v['id'] ?>"
															onerror="this.onerror=null;this.src='<?= image_default('empty') ?>'"
															class="img-fluid center"
															src="<?= MYSITE . UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
															alt="<?= !empty($v['motavi']) ? $v['motavi'] : '' ?>"
														/>
													</div>
												</div>
												<?php
											}
										}
										?>
									</div>

								</div>


							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="mt-5 py-2 main_fix section">
		<div id="navbar" style="display: block;">
			<div id="spnarbar" style="display: none;">
				<div class="main_fix relative pc mt-2">
					<div class="info_sp_nav pt-3 d-flex justify-content-start">
						<div class="thumb_sp_nav">
							<img id="imgScrollFix" onerror="this.onerror=null;this.src='<?= image_default('empty') ?>'"
								 src="<?= UPLOAD_PRODUCT_L . toWebp($row_detail['photo']) ?>"
								 alt="<?= $row_detail['ten'] ?>"
								 class="loading img-fluid" data-was-processed="true"/>
						</div>
						<div class="block_info_sp_nav w-100">
							<div class="title_nav">
								<?= $row_detail['ten'] ?? "" ?>
							</div>
							<div class="block_price_nave">
								<?php if ($row_detail['giamoi']) { ?>
									<span class="price-new-pro-detail"
										  data-gia="<?= $row_detail['giamoi'] ?>"><?= format_money($row_detail['giamoi']) ?></span>
									<span class="price-old-pro-detail"><?= format_money($row_detail['gia']) ?></span>
								<?php } else { ?>
									<span class="price-new-pro-detail"
										  data-gia="<?= $row_detail['gia'] ?>"><?= ($row_detail['gia']) ? format_money($row_detail['gia']) : getLang('lienhe') ?></span>
								<?php } ?>
							</div>
						</div>
						<div class="block_add_to_cart_nav">
							<div class="wp-muangay">
								<a
									class="btn btn-primary buynow addcart text-decoration-none left"
									data-id="<?= $row_detail['id'] ?>"
									data-action="buynow"
									style="width: 100%;font-weight: bold;font-size: 16px;padding: 10px 20px;color: white;background-color: #3C5B2D;display: inline-block;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border: none;"
								>
									<span><?= getLang('dathang') ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div>
					<!--  Nút thêm vào giỏ hàng -->

				</div>
			</div>
			<div class="main_fix">
				<ul class="nav-tabs p-0 m-0 main_fix justify-content-evenly d-flex">
					<li class="text-center w-25 nav-item frame-sesson-1" data-tabs="info-pro-detail">
						<a class="nav-link cover-nav-link fix-padding-one" href="#section1">
							<?= getLang('thongtinsanpham') ?>
						</a>
					</li>
					<li class="text-center w-25 nav-item frame-sesson-1" data-tabs="info-thanhphan">
						<a class="nav-link cover-nav-link fix-padding-one" href="#section2">
							<?= getLang('thanhphansanpham') ?>
						</a>
					</li>
					<li class="text-center w-25 nav-item frame-sesson-1" data-tabs="commentfb-pro-detail">
						<a class="nav-link cover-nav-link fix-padding-one" href="#section3">
							<?= getLang('binhluan') ?>
						</a>
					</li>
					<li class="text-center w-25 nav-item frame-sesson-1" data-tabs="sanphamcungloai-detail">
						<a class="nav-link cover-nav-link fix-padding-one" href="#section4">
							<?= getLang('sanphamcungloai') ?>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div id="section1" class="main_fix section"
		 style="padding-top: 0px;">
		<div id="box_sanpham" class="w-100 content-tabs-pro-detail info-pro-detail active">
			<h2 class="py-5 d-flex text-center m-auto w-50">
				<span class="w-100 d-block"><?= getLang('thongtinsanpham') ?></span>
			</h2>

			<?= htmlspecialchars_decode($row_detail['noidung'] ?? "") ?>
		</div>
	</div>
	<div id="section2" class="main_fix section">
		<div id="box_thanhphansanpham" class="w-100 content-tabs-pro-detail info-thanhphan">
			<h2 class="py-5 d-flex text-center m-auto w-50">
				<span class="w-100 d-block"><?= getLang('thanhphansanpham') ?></span>
			</h2>
			<?= htmlspecialchars_decode($row_detail['noidungthanhphan'] ?? "") ?>
		</div>
	</div>
	<div id="section3" class="main_fix section">
		<?php /*if (is_array($danhgia) && count($danhgia) > 0) : */ ?>

		<div id="box_binhluan" class="w-100 content-tabs-pro-detail commentfb-pro-detail">

			<h2 class="py-5 d-flex text-center m-auto w-50">
				<span class="w-100 d-block"><?= getLang('binhluan') ?></span>
			</h2>

			<div class="sao_bl"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
					class="fas fa-star"></i><i
					class="fas fa-star"></i><i class="fas fa-star"></i></div>

			<div class="danhgia2">
				<p class="td"><?= getLang('danhgia') ?></p>
				<p><?= getLang('khachhangnhanxet') ?></p>
				<div class="bao_danhgia">
					<div class="dg1">
						<?php
						$so_danhgia = 1;
						if (is_array($danhgia) && count($danhgia) > 0) {
							$so_danhgia = @$count_danhgia ?? count($danhgia);
						}

						?>
						<p><?= getLang('danhgiatrungbinh') ?></p>
						<p class="so"><?= round($trungbinh['tb'], 1) ?></p>
						<p><?php echo $so_danhgia ?> <?= getLang('nhanxet') ?></p>
					</div>
					<div class="dg2">
						<p class="dong">5 <?= getLang('sao') ?> <span><b
									style="width:<?= ($sao5['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao5['dem'] ?> <?= getLang('rathailong') ?>
						</p>
						<p class="dong">4 <?= getLang('sao') ?> <span><b
									style="width:<?= ($sao4['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao4['dem'] ?> <?= getLang('hailong') ?>
						</p>
						<p class="dong">3 <?= getLang('sao') ?> <span><b
									style="width:<?= ($sao3['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao3['dem'] ?> <?= getLang('binhthuong') ?>
						</p>
						<p class="dong">
							2 <?= getLang('sao') ?>
							<span>
                                        <b style="width:<?= ($sao2['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao2['dem'] ?>
							<?= getLang('khonghailong') ?>
						</p>
						<p class="dong">1 <?= getLang('sao') ?> <span><b
									style="width:<?= ($sao1['dem'] / $so_danhgia) * 100 ?>%;"></b></span><?= $sao1['dem'] ?> <?= getLang('ratte') ?>
						</p>
					</div>
				</div>
			</div>

			<?php if ($isLogin) { ?>
				<div class="danhgia3">
					<p class="td"><?= getLang('danhgiasanphamnay') ?>.</p>

					<div class="danhgiasao">
						<?php for ($i = 1; $i <= 5; $i++) { ?>
							<span data-value="<?= $i ?>"></span>
						<?php } ?>
					</div>

					<form class="form-contact validation-contact" novalidate method="post" action=""
						  enctype="multipart/form-data">
						<input type="hidden" name="link_video" id="link_video" value="5">
						<div class="input-contact">
							<input type="file" class="custom-file-input" name="file">
							<label class="custom-file-label" for="file"
								   title="<?= getLang('chon') ?>"><?= getLang('chonhinhanh') ?></label>
							<p>.jpg, .png, .gif</p>
						</div>

						<div class="input-contact">
                            <textarea class="form-control" id="motavi" name="motavi"
									  placeholder="<?= getLang('noidung') ?>"
									  required/></textarea>
							<div class="invalid-feedback"><?= getLang('vuilongnhapnoidung') ?></div>
						</div>
						<input type="submit" class="btn btn-primary" name="submit-contact"
							   value="<?= getLang('gui') ?>" disabled/>
						<input type="reset" class="btn btn-secondary" value="<?= getLang('nhaplai') ?>"/>
						<input type="hidden" name="recaptcha_response_contact"
							   id="recaptchaResponseContact">
					</form>
				</div>
			<?php } else { ?>
				<div class="vuilongdangnhap">
					<a href="account/dang-nhap"><?= getLang('vuilongdangnhap') ?></a>
				</div>
			<?php } ?>
			<?php if (is_array($danhgia) && count($danhgia)) { ?>
				<div class="danhgia">
					<?php
					//qq($danhgia);
					foreach ($danhgia as $k => $v) { ?>
						<?php
						if (empty($v['photo']) || empty($v['link_video'])) continue;

						$tennguoi = @$v['tenvi'];
						if(!empty($v['id_member']) && $v['id_member'] == 1){

						}else{
							$get_member = $d->rawQueryOne("select ten from #_member where id='" . $v['id_member'] . "'");
							$tennguoi = $get_member['ten'] ?? "";
						}

						?>

						<div class="item_dg">
							<div class="text-small"><?= date('d-m-Y', $v['ngaytao']) ?></div>
							<p class="ten"><?= $tennguoi ?></p>
							<p class="sao">
								<?php
								$sosao = 0;
								for ($i = 1; $i <= 5; $i++) { ?>
									<i class="fas fa-star <?php if ($i <= $v['link_video']) {
										echo 'active';
										$sosao++;
									} ?>"></i>
								<?php } ?>
							</p>
							<p class="mota"><?= htmlspecialchars_decode($v['motavi']) ?></p>
							<?php if ($v['photo'] != '') {

								//$opt_rev = (isset($v['options2']) && $v['options2'] != '') ? json_decode($v['options2'], true) : null;

								//$sosao = $opt_rev['sosao'] ?? 5;

								?>
								<div class="slider-img img img_post"><img data-sosao="<?= $sosao ?>" data-danhgia="true"
																		  data-id="<?= $v['id'] ?>"
																		  src="<?= UPLOAD_PRODUCT_L . toWebp($v['photo']) ?>"
																		  alt="<?= !empty($v['ten']) ? $v['ten'] : '' ?>">
								</div>
							<?php } ?>
						</div>
					<?php }
					?>


					<?php

					if (!empty($paging_danhgia)) {
						?>
						<div class="my-2 pt-4">
							<div
								class="pagination-home"><?= (isset($paging_danhgia) && $paging_danhgia != '') ? $paging_danhgia : '' ?></div>
						</div>
						<?php
					}
					?>
				</div>

			<?php } ?>


		</div>

		<?php /*endif; */ ?>


	</div>
	<div id="section4" class="main_fix section">
		<div id="box_sanphamcungloai" class="w-100 content-tabs-pro-detail sanphamcungloai-detail">
			<h2 class="py-5 d-flex text-center m-auto w-50">
				<span class="w-100 d-block"><?= getLang('sanphamcungloai') ?></span>
			</h2>
			<div class="sanpham">
				<div class="wap_loadthem_sp" data-div=".loadthem_sp100" data-lan="1" data-where="<?= $where ?>"
					 data-sosp="<?= $sosp ?>" data-max="<?= $solan_max ?>">
					<div class="wap_item loadthem_sp100">

					</div>
					<?php if ($solan_max > 1) { ?><p class="load_them"><?= getLang('xemthem') ?>
						<span><?= ($dem['numrows'] - $sosp) ?></span> <?= getLang('sanpham') ?> <i
							class="fas fa-caret-right"></i>
						</p><?php } ?>
				</div>
			</div>

		</div>
	</div>
</div>

<script>

    var total_slider = '<?=$num_slider?>';
</script>
<style>
    .all_review{
        z-index: 99999999999 !important;
    }

	.img_post {
		height: 10rem;
		width: 100%;
	}

	/* CSS cho thanh điều hướng và các tab */
	@media (max-width: 767.98px) {
		.cover-nav-link {
			margin-top: 0.5rem !important;
			padding: 0.6rem 0.4rem !important;
		}

		#navbar {
			top: 94px !important;
		}
	}


	.thumb_sp_nav {
		width: 7rem;
		height: auto;
	}

	.not_fixed {
		font-size: 1.2rem;
		padding: 8px 15px !important;
		/* background-color: #eee !important; */
		border: 1px solid #eee !important;
		margin-right: 1px;
	}

	#navbar {
		/* position: fixed; */
		top: 0;
		width: 100%;
		background-color: #fff;
		z-index: 99; /* Đảm bảo hiển thị trên cùng */
		/* box-shadow: 0 2px 5px #dfdbdb; */
	}

	.nav-tabs {
		list-style-type: none;
		margin: 0;
		padding: 0;
		display: flex;
		border-bottom: none !important;
	}

	.nav-item {
		/* margin-right: 10px; */
	}

	.nav-link {
		margin-bottom: 7% !important;
		/* color: #fff; */
		/* background-color: gray; */
		text-decoration: none;
		/* padding: 15px 19px; */
		/* border-radius: 4px; */
		transition: background-color 0.3s ease;
	}

	.nav-link:hover {
		color: #3d5c16;
		/* border-color: gray !important; */
		background-color: #eee !important;

	}

	.nav-link.active {
		/* padding: 15px 19px; */
		/* margin-bottom: 7% !important; */
		/* background-color: #3d5c16 !important; */
		color: #3d5c16 !important;
		border-color: #fff !important;
		/* bỏ border trên cùng */
		border-top: none !important;
		border-bottom: 2px solid #3d5c16 !important;

	}

	.nav-tabs .nav-link {
		border: 1px solid transparent;
		border-top-left-radius: 0rem !important;
		border-top-right-radius: 0rem !important;
	}

	/* CSS cho các phần */
	.section {
		/* height: 100vh; */
		display: flex;
		justify-content: center;
		align-items: center;
		/*font-size: 3em;*/
		font-size: 1rem;
		scroll-margin-top: 50px; /* Tạo khoảng trống trên cùng để không che phần content */
	}

	.section:nth-child(even) {
		/* background-color: #f0f0f0; */
	}

	.frame-sesson-1 {
		/* padding: 0px 1%; */
		/* margin: 0px 4%;
	  }

	  .container.relative {
		display: flex;
		align-items: center;
		justify-content: space-between;
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.info_sp_nav {
		display: flex;
		align-items: center;
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.block_info_sp_nav {
		margin-left: 20px; /* Điều chỉnh khoảng cách giữa các phần tử */
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.block_add_to_cart_nav {
		display: flex;
		align-items: center;
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.block_add_to_cart_nav .btn {
		margin-left: 20px; /* Điều chỉnh khoảng cách giữa các phần tử */
		/* Các thuộc tính khác tùy thuộc vào yêu cầu cụ thể của bạn */
	}

	.title_nav {
		font-weight: 700;
		font-size: 14px;
		margin-bottom: 5px;
	}

	.block_price_nave {
		font-size: 14px;
		color: #3c5b2d;
		display: inline-block;
	}

	.txt_brand_name_nav {
		font-weight: 700;
		font-size: 14px;
		color: #326e51;
	}

</style>
<style>
	.slider__flex {
		min-height: 0;
		height: 100%;
		max-height: unset;
	}

	.bao_danhgia .dg2 p span b {
		max-width: 100%;
	}

	.wp-review, .wp-review .slider__flex, .wp-review .img-review {
		/*min-height: 12rem;
		height: 10rem;
		max-height: 15rem;
		width: 100%;*/
	}

	.img-review {
		width: 35rem !important;
	}

	.slider-img {
		position: relative;
		display: block;
		width: 12rem;
		height: 12rem;
		/*background-color: blue;*/
		/*border: 2px solid red;*/
	}

	.slider-img img {
		display: block;
		width: 100%;
		max-width: 100%;
		max-height: 100%;
		height: 100%;
		/* object-fit: contain; */
		object-fit: cover;
	}

	.review-swiper img {
		/*height: 15rem;
		max-height: 20rem;
		width: auto;*/
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.brand {
		color: #4fad8b;
		border: 1px solid #4fad8b;
		padding: 0 7px !important;
		font-size: 12px;
		width: fit-content;
		height: auto;
		margin: 0;
	}

	.title--detail {
		padding-top: 5px !important;
		font-size: 1.2rem !important;
		color: var(--color-red);
		line-height: 1;
	}

	.title--detail--1 {
		padding-top: 5px !important;
		font-size: 1.2rem !important;
		color: var(--color-red);
		line-height: 1;
	}

	.slider {
		padding: 0;
		margin: 0;
		color: #fff;
	}

	.slider .swiper-container {
		width: 100%;
		height: 100%;
	}

	.slider__flex {
		display: flex;
		align-items: flex-start;
	}

	.slider__col {
		display: flex;
		flex-direction: column;
		width: 100px;
		min-width: 100px;
		max-width: 100px;
		height: auto;

		margin: auto 1rem;
	}

	.slider_empty {
		width: 5rem;
		min-width: 5rem;
	}

	.slider__prev,
	.slider__next {
		display: none;
		cursor: pointer;
		text-align: center;
		font-size: 14px;
		height: 48px;
		/*display: flex;*/
		align-items: center;
		justify-content: center;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	.slider__prev:focus,
	.slider__next:focus {
		outline: none;
	}

	.slider__thumbs {
		/*//8*4+400*/
		/**/
		height: calc(400px - 100px);
		padding: 0;
		margin: 0;
	}

	.slider__thumbs .swiper-slide {
		height: 100%;
	}

	.slider__thumbs .slider__image {
		transition: 0.25s;
	/*	-webkit-filter: grayscale(100%);
		filter: grayscale(100%);
		opacity: 0.5;*/
	}

	.slider__thumbs .slider__image:hover {
		opacity: 1;
	}

	.slider__thumbs .slider__image {
		border-radius: 50%;
	}

	.slider__thumbs .swiper-slide-thumb-active .slider__image {
	/*	-webkit-filter: grayscale(0%);
		filter: grayscale(0%);
		opacity: 1;*/
	}

	.slider .slider__images {
		height: 40rem;
		min-height: 40rem;
		max-height: 40rem;
		width: auto;
	}

	.slider__images .slider__image img {
		transition: 3s;
	}

	.slider__images .slider__image:hover img {
		transform: scale(1.1);
	}

	.slider__images .slider__image {
		border-radius: 0;
	}

	.slider__image {
		width: 100%;
		/*height: auto;*/
		height: 100%;
		overflow: hidden;
	}

	.slider__thumbs .slider__image {
		border-radius: 50%;
		width: 100%;
		height: 100%;
		/*	width: 70%;*/
	}

	.slider__image img {
		display: block;
		width: 100%;
		height: 100%;
		-o-object-fit: cover;
		object-fit: cover;
	}

	@media (max-width: 767.98px) {

		.img_post {

			height: 6rem;
		}

		.slider-img {

			width: 6rem;
			height: 6rem;
			/*background-color: blue;*/
			/*border: 2px solid red;*/
		}

		.slider .slider__images {
			height: 100%;
			width: 100%;
		}

		.slider__flex {

			flex-direction: row;
			/* flex-direction: column-reverse; */
		}

		.slider__col {
			flex-direction: column;
			/* flex-direction: row; */
			align-items: center;
			margin-right: 0;
			/* margin-top: 24px; */
			margin: 0;
			margin-top: 0;
			margin-left: 0;
			width: 100%;
			height: 100%;
		}

		.slider__images {
			width: 100%;
		}

		.slider__thumbs {
			height: 18rem;
			width: 6rem;
			margin-left: 2rem;
			/* margin: 0 16px; */
		}

		.slider_empty {
			display: none;
		}

		.slider .slider__images {
			/* height: 30.5rem !important;	 */
			min-height: 0rem !important;
			/* width: auto; */
		}

		.slider__prev,
		.slider__next {
			height: auto;
			width: 32px;
		}

		.slider__images .slider__image {
			border-radius: 0;
			width: 70%;
		}

		.slider__thumbs .slider__image {
			border-radius: 50%;
			width: 62%;
		}

		.grid-pro-detail {
			margin-bottom: 0;
		}

		.slider__images {
			min-height: 0rem;
		}
	}

	.wp-slider .swiper-slide:first-child {
		margin-top: 1rem;
	}

	.slider-img.img_post {
		margin-top: 0 !important;
	}
</style>

<link rel="stylesheet" href="<?= MYSITE ?>assets/css/product.css?v=<?= random_string() ?>"/>
<input type="hidden" value="<?= $row_detail['id'] ?>" id="pid"/>
<link rel="stylesheet" href="<?= MYSITE ?>assets/magiczoomplus/magiczoomplus.css?v=<?= random_string() ?>"/>
<script src="<?= MYSITE ?>assets/magiczoomplus/magiczoomplus.js?v=<?= random_string() ?>"></script>


<script src="<?= MYSITE ?>/assets/swiper/swiper-bundle.min.js?v=<?= random_string() ?>"></script>

<link rel="stylesheet" href="<?= MYSITE ?>/assets/swiper/swiper-bundle.min.css?v=<?= random_string() ?>"/>


<script>
    function isEven(n) {
        return n % 2 == 0;
    }

	var slider = 3;
    if(isEven(total_slider)){
        slider = 4;
    }else {
        slider = 3;
    }

	const sliderThumbs = new Swiper(".slider__thumbs .swiper-container", {
		direction: "vertical",
		slidesPerView: slider,
		centeredSlides: false,
		roundLengths: true,
		spaceBetween: 16,
		navigation: {
			nextEl: ".slider__next",
			prevEl: ".slider__prev",
		},
		autoplay: {
			delay: 3500,
		},
		freeMode: true,
		breakpoints: {
			0: {
                slidesPerView: slider,
				direction: "vertical",
			},
			768: {
                slidesPerView: slider,
				direction: "vertical",
			},
            990: {
                slidesPerView: slider,
				direction: "vertical",
			},
		},
	});

	const sliderImages = new Swiper(".slider__images.detail-swiper .swiper-container", {
		autoplay: {
			delay: 3500,
		},
		direction: "vertical",
		slidesPerView: 1,
		spaceBetween: 10,
		mousewheel: true,
		navigation: {
			nextEl: ".slider__next",
			prevEl: ".slider__prev",
		},
		grabCursor: true,
		thumbs: {
			swiper: sliderThumbs,
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 10,
				direction: "horizontal",
			},
			768: {
				slidesPerView: 1,
				spaceBetween: 10,
				direction: "vertical",
			},
		},
	});

	const sliderReivew = new Swiper('.review-swiper', {
		direction: "horizontal",
		slidesPerView: 4,
		spaceBetween: 0,
		freeMode: true,
		loop: true,
		autoplay: {
			delay: 3000,
		},
	});



    setTimeout(function (){

        $(".slider__thumbs").css({"height": "calc("+((slider *100 )+100)+"px - 100px)"});

    }, 250)
</script>

 
<style>

	.slider__thumbs .swiper-wrapper .swiper-slide:first-child {

	}

	#scrollable {
		height: 1000px;
		overflow: scroll;
		position: relative;
		overflow-x: hidden;
	}
</style>

<script>
	// Code goes here

	document.addEventListener('DOMContentLoaded', function () {
		setTimeout(function () {
			var hash = document.location.hash;
			if (hash) {
				$([document.documentElement, document.body]).animate({
					scrollTop: $(hash).offset().top
				}, 500,function(){


					window.location.hash = hash;
				});
			}
		}, 500);
	})

	$(document).ready(function () {


		var loading = false;

		load_san_pham_cung_loai();

		function load_san_pham_cung_loai(_this) {

			const where = $(_this).data('where') || "<?=$where?>";
			const sosp = $(_this).data('solan') || "<?=$sosp?>";

			if (!loading) {
				loading = true;
				load_them('.loadthem_sp100', 0, where, sosp);
			}
		}


		$('.nav-link.cover-nav-link').on('click', function (e) {

			e.preventDefault();

		})


		$('[data-spy="scroll"]').each(function () {
			var $spy = $(this).scrollspy('refresh');
		});

		$('#target_nav').on('activate.bs.scrollspy', function () {
			var activeTab = $('.nav-tabs li.active a');
			activeTab.parent().removeClass('active');
			activeTab.tab('show');
		});


		setTimeout(fixEdImages, 1500);

		const checkbox = document.getElementById('radio-themtui')
		checkbox.addEventListener('change', (event) => {
			$check = event.currentTarget.checked;
			$.ajax({
				type: "post",
				url: site_url() + "ajax/sethasTuiGiay",
				data: {has_tuigiay: $check},
				beforeSend: function () {
				},
			})
		})
	});
</script>

<script>
	// JavaScript để xử lý Scrollspy
	window.addEventListener("scroll", function () {
		const sections = document.querySelectorAll(".section");
		let currentSection = "";

		sections.forEach((section) => {
			const sectionTop = section.offsetTop - 0;
			const sectionHeight = section.clientHeight;
			if (
				pageYOffset >= sectionTop &&
				pageYOffset < sectionTop + sectionHeight
			) {
				currentSection = section.getAttribute("id");

				console.log(currentSection);
			}
		});

		const navLinks = document.querySelectorAll(".nav-link");

		// khi click vào tab thì sẽ scroll đến section tương ứng và active tab đó ngay lập tức và khi scroll thì tab đó sẽ active theo section tương ứng
		navLinks.forEach((link) => {
			link.addEventListener("click", () => {
				for (let i = 0; i < navLinks.length; i++) {
					navLinks[i].classList.remove("active");
					console.log(navLinks[i]);
				}
				link.classList.add("active");
				const target = link.getAttribute("href").substring(1);
				const targetSection = document.getElementById(target);
				window.scrollTo({
					top: targetSection.offsetTop - 0,
					behavior: "smooth",
				});
			});
		});

		navLinks.forEach((link) => {

			link.classList.remove("active");
			if (link.getAttribute("href").substring(1) == (currentSection)) {
				link.classList.add("active");
			}
		});

		const navbar = document.getElementById("navbar");
		const cover_nav_link = document.querySelectorAll(".cover-nav-link");
		var block = $('#details').outerHeight();


		var spnarbar = document.getElementById('spnarbar');


		if (document.documentElement.scrollTop > 1000) {
			$('#navbar').addClass('fixed');
			$('#spnarbar').show();
		} else {
			$('#navbar').removeClass('fixed');
			$('#spnarbar').hide();
		}
		//spnarbar.style.display = "block";
		if (window.scrollY > block) {
			//  cover-nav-link thêm class not_fixed
			cover_nav_link.forEach((link) => {
				link.classList.remove("not_fixed");
				link.classList.remove("fix-padding-one");

			});

			navbar.style.position = "fixed";
			//box-shadow: 0 2px 5px #dfdbdb
			navbar.style.boxShadow = "0 2px 5px #dfdbdb";
			spnarbar.style.display = "block";


		} else {
			cover_nav_link.forEach((link) => {
				link.classList.add("not_fixed");
				link.classList.add("fix-padding-one");
			});

			navbar.style.position = "static";
			//	navbar.style.boxShadow = "none";
			//spnarbar.style.display = "none";
		}
	});
</script>


<style>

	img.center {
		display: block;
		margin: 0 auto;
	}


	.swiper {
		width: 100%;
		height: 100%;
	}


	.swiper .swiper-slide {
		height: auto;
	}

	.swiper-slide img {
		display: block;
		width: 100%;
		height: 100%;
		object-fit: cover;

		/*box-shadow: 0px 0px 10px -3px rgba(0, 0, 0, 0.225);*/
	}

	.slider .slider__images img {
		height: 100%;
		width: 100%;
		object-fit: contain;
	}


	/*
		@media (max-width: 1366px) {
			!*.slider .slider__images{
				height: 26rem;
				min-height: 26rem;
				max-height: 26rem;
			}*!
			!*.slider__col{
				width: 6rem;
				min-width: 6rem;
				max-width: 6rem;
			}
			.slider__thumbs{
				height: 26rem;
			}*!
		}
		@media (max-width: 990px) {
			.slider .slider__images{
				height: 26rem;
				min-height: 26rem;
				max-height: 26rem;
			}
			!*.slider__col{
				width: 6rem;
				min-width: 6rem;
				max-width: 6rem;
			}
			.slider__thumbs{
				height: 26rem;
			}*!
		}
		@media (max-width: 768px) {
			!*.slider .slider__images{
				height: 20rem;
				min-height: 20rem;
				max-height: 20rem;
			}

			.slider__col{
				width: 3rem;
				min-width: 3rem;
				max-width: 3rem;
			}
			.slider__thumbs{
				height: 16rem;
			}*!

		}
		@media (max-width: 450px) {
			!*.slider .slider__images{
				height: 20rem;
				min-height: 20rem;
				max-height: 20rem;
			}

			.slider__col{
				width: 3rem;
				min-width: 3rem;
				max-width: 3rem;
			}
			.slider__thumbs{
				height: 16rem;
			}*!

		}

		*/

</style>


<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper(".mySwiper", {
		slidesPerView: 1,
		spaceBetween: 30,
		loop: true,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
	});
</script>

<!-- Demo styles -->
<style>#header .top-area,
	#header.fixed, .cate-wrap .inner {
		border: none;
	}

	#header.fixed .cate-wrap .inner,
	#header .top-area, #header .top-member {
		border-bottom: 0 !important;
	}

	#header {
		border: none;
		box-shadow: none;
	}

	span.w-100 {
		/*font-size: 1rem;*/
		color: var(--color-red);
		font-size: 1.68rem;
		text-transform: uppercase;
		display: inline-block;
		font-weight: 700;

	}
	.main_fix {
		background: #fff;
	}

	.mySwiper .swiper {
		width: 100%;
		height: 100%;
	}

	.mySwiper .swiper-slide {
		text-align: center;


		/* Center slide text vertically */
		display: -webkit-box;
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		-webkit-justify-content: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		-webkit-align-items: center;
		align-items: center;
	}

	.mySwiper .swiper-slide img {
		display: block;
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.mySwiper .swiper {
		margin-left: auto;
		margin-right: auto;
	}

	.mySwiper .swiper-button-prev {
		background-image: none !important;
		color: #3C5B2D !important;
	}

	.mySwiper .swiper-button-next {
		background-image: none !important;
		color: #3C5B2D !important;
		width: 50px !important;
	}

	.mySwiper .swiper-pagination-bullet-active {
		border-radius: 11px;
		background: #3C5B2D !important;
		padding-left: 26px !important;
		padding-right: 5px !important;
	}


	.fixed {
		display: block !important;
		position: fixed !important;
		/*		top: -10rem;
				width: 100%;
				background-color: #fff;*/
		/*		z-index: 999;
				height: 22rem;
				padding-top: 12rem;*/
	/*	box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.02);*/
	}
	html {
		scroll-behavior: smooth !important;
	}

	.swiper-pagination{
		display: none;
	}
</style>



<!--mobile ver-->
<?php ?>
