<style>

.sz-navbar-mb {
    height: 4rem;
    top: 2rem;
    /* box-shadow: 0 3px 10px rgb(0 0 0 / 0.2); */
}
.menu-icon-mb{
  max-width: 72%;
    height: auto;
}
        </style>
<div class="pc cate-wrap">
	<div class="inner">
		<div class="main_fix">
			<!--site-wrap-->
			<div class="float-left">
				<div class="logo-img df-bannermanager df-bannermanager-wp-head-logo">
					<div class="vertical"><a class="logo" href="<?= MYSITE ?>"> <img class="img-fluid"
																					 src="<?= image_default('logo') ?>"/>
						</a></div>
				</div>
				<div class="bs"><a href="gioi-thieu" title="<?= getLang('gioithieu') ?>"><?= getLang('gioithieu') ?></a>
				</div>
				<div class="bs"><a href="/brand" title="<?= getLang('thuonghieu') ?>"><?= getLang('thuonghieu') ?></a>
					<div
						class="sub-list boardlink"> <?= $func->for1('news', 'bai-viet-thuong-hieu', $lang, $sluglang); ?> </div>
				</div>
				<div class="bs"><a href="khuyen-mai" title="<?= getLang('khuyenmai') ?>"><?= getLang('khuyenmai') ?></a>
				</div>
				<div id="category" class="xans-element- xans-layout xans-layout-category cate-override">
					<ul class="nav-top">
						<li class="bs xans-record-"><a href="san-pham"
													   title="<?= getLang('sanpham') ?>"><?= getLang('sanpham') ?></a>
							<div class="sub-category">
								<div class="sub-left">
									<ul class="sub02 sub02_84">
										<li class="cate_no_140 arrow">
											<a href="<?= MYSITE ?>"
												title="<?= getLang('tatcasanpham') ?>"><?= getLang('tatcasanpham') ?>
											</a>
											<ul class="sub03 sub03_140">
												<li class="cate_no_141"><a href="san-pham"
																		   title="<?= getLang('tatca') ?>"><?= getLang('tatca') ?></a>
												</li>
												<li class="cate_no_142"><a href="tot-nhat"
																		   title="<?= getLang('totnhat') ?>"><?= getLang('totnhat') ?></a>
												</li>
												<li class="cate_no_143"><a href="moi"
																		   title="<?= getLang('moi') ?>"><?= getLang('moi') ?></a>
												</li>
												<li class="cate_no_143"><a href="khuyen-mai"
																		   title="<?= getLang('sanphamkhuyenmai') ?>"><?= getLang('sanphamkhuyenmai') ?></a>
												</li>
											</ul>
										</li>
										<li class="cate_no_85 arrow"><a href="<?= MYSITE ?>"
																		title="<?= getLang('loaisanpham') ?>"><?= getLang('loaisanpham') ?></a>
											<ul class="sub03 sub03_85"> <?= $func->for11('product_list', 'san-pham', $lang, $sluglang); ?> </ul>
										</li>
										<li class="cate_no_86 arrow"><a data-toggle="collapse"
																		id="thuongHieuToggle"><?= getLang('thuonghieu') ?></a>
											<ul class="sub03 sub03_86"
												id="subMenu86"> <?php echo get_thuonghieu(); ?> </ul>
										</li>
										<li class="cate_no_115 arrow"><a href="<?= MYSITE ?>"
																		 title="<?= getLang('dong') ?>"><?= getLang('dong') ?></a>
											<ul class="sub03 sub03_115"> <?= $func->for11('news', 'dong', $lang, $sluglang); ?> </ul>
										</li>
									</ul>
								</div>
								<div class="sub-right">
									<!--<div class="main_fix wap_sanpham mt-lg-5" id="slider_khuyenmai"> <div class="background-masker btn-divide-left"></div> </div>-->
									<!--<a href="san-pham"> <img style="width: 15rem;" class="img-fluid" src="upload/product/anh-chup-man-hinh-2023-06-22-luc-151003-3410.webp"> </a>--> </div>
							</div>
						</li>
					</ul>
				</div>
				<div class="bs"><a href="su-kien" title="<?= getLang('sukien') ?>"><?= getLang('sukien') ?></a></div>
				<div class="bs"><a href="tin-tuc" title="<?= getLang('tintuc') ?>"><?= getLang('tintuc') ?></a>
					<div
						class="sub-list boardlink"> <?= $func->formenu('news', 'tin-tuc', '', $lang, $sluglang); ?> </div>
				</div>
				<div class="bs"><a href="lien-he" title="<?= getLang('lienhe') ?>"><?= getLang('lienhe') ?></a></div>
			</div>
			<div class="float-right"> <!--<form id="searchBarForm" action="#" method="get" target="_self" >--> <input
					id="banner_action" name="banner_action" value="" type="hidden"/>
				<div class="xans-element- xans-layout xans-layout-searchheader">
					<div class="form-group"><label for="keyword">&nbsp;</label><input onKeyDown="doEnter(e, 'keyword')"
																					  id="keyword"
																					  class="inputTypeText" type="text"
																					  autocomplete="off"/>
						<div class="search_auto" onclick="onSearch('keyword');"></div>
						<input class="bt-search" type="image" src="/assets/images/search.svg" alt="CKD COS VIỆT NAM"/>
						<ul class="autoDrop"></ul>
					</div>
				</div> <!--</form>--> </div>
			<div class="clear"></div>
		</div>
	</div>
</div> <?php if ($isMobile):


	$slogan = $d->rawQuery("select ten$lang as ten, mota$lang as mota from #_news where type = ? and hienthi > 0 order by stt,id desc", array('slogan'));


	?>
	<div class="mb layout-menu" id="menu_mobile">
		<div class="sz-navbar-top-slide m-0 p-0">
			<div class="swiper-container m-0 p-0" id="slogan-swiper">
				<div class="swiper-wrapper">
					<?php foreach ($slogan as $k => $v) { ?>
						<!-- Slides -->
						<div class="swiper-slide d-flex justify-content-center align-items-center"

						>
							<a
								class="discount_slide" href="<?= $v['mota'] ?>"><?= $v['ten'] ?></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="sz-navbar">
			<div class="sz-navbar-inner sz-navbar-left">
			<div class="row sz-navbar-mb align-items-center justify-content-center">
            <div class="col-4 d-flex justify-content-start">
			<input type="checkbox" id="sz-navbar-check"/> 
					<label for="sz-navbar-check" class="sz-navbar-hamburger menu-toggle">
						<img src="assets/icon/menu/open_menu.svg" alt="CKD COS VIET NAM" class="img-fluid menu-icon"/>
					</label>
            </div>
			<div class="col-4 d-flex justify-content-center navbar-logo">
			<a class="menu-icon-mb" href="<?= MYSITE ?>"><img src="<?= image_default('logo') ?>"/></a>
            </div>
            <div class="col-4 d-flex justify-content-end">
              <div class="wap_search d-flex align-items-center">
                  <i class="fas fa-search tim"></i>
                  <div class="search"><input type="text" id="keyword2" placeholder="Nhập từ khóa cần tìm..."
											   onkeypress="doEnter(event,'keyword2');" autocomplete="off">
						<p onclick="onSearch('keyword2');"> </p>
						<div class="search_auto"></div>
					</div>
				  <a class="giohang_m" href="gio-hang" title="title"> <i class="fas fa-shopping-bag"></i> </a>
              </div>
          </div>
        </div>
				<!-- <div class="main_menu_show">
					<input type="checkbox" id="sz-navbar-check"/> 
					<label for="sz-navbar-check" class="sz-navbar-hamburger menu-toggle">
						<img src="assets/icon/menu/open_menu.svg" alt="CKD COS VIET NAM" class="img-fluid menu-icon"/>
					</label>
				</div> -->
				<!-- <div class="navbar-logo"><a class="logo" href="<?= MYSITE ?>"><img src="<?= image_default('logo') ?>"/></a>
				</div> -->
				<!-- <div class="wap_search">
					<i class="fas fa-search tim"></i>
					<div class="search"><input type="text" id="keyword2" placeholder="Nhập từ khóa cần tìm..."
											   onkeypress="doEnter(event,'keyword2');" autocomplete="off">
						<p onclick="onSearch('keyword2');"> </p>
						<div class="search_auto"></div>
					</div>
					<a class="giohang_m" href="gio-hang" title="title"> <i class="fas fa-shopping-bag"></i> </a>
				</div> -->
				<div class="sz-navbar-items">
					<div class="ngonngu">
						<div class="execphpwidget">
							<div id="flags">
								<a data-lang_dir="vietnamese" data-lang="vi" href="ngon-ngu/vi/">
									<img width="30" height="30"
										 src="<?= image_default('vi') ?>" alt="Tiếng Việt"/></a>
								<a data-lang_dir="english" data-lang="en" href="ngon-ngu/en/">
									<img width="30" height="30"
										 src="<?= image_default('en') ?>" alt="English"/></a>
								<a href="ngon-ngu/ko/" style="pointer-events: none;">
									<img width="30" height="30"
										 src="<?= image_default('ko') ?>" alt="Korea"
										 style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;"/>
								</a>
								<a href="<?= MYSITE; ?>" style="pointer-events: none;" title="China" class="flag zh-CN">
									<img width="30" height="30"
										 src="<?= image_default('cn') ?>" border="0"
										 style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;"
										 alt="CKD COS VIỆT NAM"/>
								</a>
								<a href="<?= MYSITE; ?>" style="pointer-events: none;" title="Malaysia" class="flag ma">
									<img width="30" height="30"
										 src="<?= image_default('ma') ?>" border="0"
										 style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;"
										 alt="CKD COS VIỆT NAM"/>
								</a>
							</div>
						</div>

					</div>
					<div class="menu-table-mb">
						<div class="row cover-moblie pt-3">
							<div class="col-4 centered-image"><a href="<?= MYSITE ?>"> <img class="menu-icon-cover"
																							src="<?= image_default('iconhome') ?>"
																							alt="CKD COS VIỆT NAM"/>
									<div class="font-menup-mb"> <?php echo getLang('trangchu'); ?> </div>
								</a></div>
							<div class="col-4 centered-image"><a href="san-pham"> <!--assets/icon/menu/shop.png--> <img
										class="menu-icon-cover" src="<?= image_default('iconshop') ?>"
										alt="CKD COS VIỆT NAM"/>
									<div class="font-menup-mb"> Shop</div>
								</a></div> <?php $isLogin = $this->session->userdata('isLogin');
							if ($isLogin) { ?>
								<div class="col-4 centered-image"><a href="<?= MYSITE; ?>account/thong-tin"> <img
											class="menu-icon-cover" src="<?= image_default('iconenter') ?>"
											alt="CKD COS VIỆT NAM"/>
										<div class="font-menup-mb"> <?= getLang('trangcuatoi') ?> </div>
									</a></div>
								<div class="col-4 centered-image"><a c href="<?= MYSITE; ?>account/dang-xuat"> <img
											class="menu-icon-cover" src="<?= image_default('iconedit') ?>"
											alt="CKD COS VIỆT NAM"/>
										<div class="font-menup-mb"> <?= getLang('dangxuat') ?> </div>
									</a></div> <?php } else { ?>
								<div class="col-4 centered-image"><a href="/account/dang-nhap"> <img
											class="menu-icon-cover" src="<?= image_default('iconenter') ?>"
											alt="CKD COS VIỆT NAM"/>
										<div class="font-menup-mb"> <?php echo getLang('dangnhap'); ?> </div>
									</a></div>
								<div class="col-4 centered-image"><a href="/account/dang-ky"> <img
											class="menu-icon-cover" src="<?= image_default('iconedit') ?>"
											alt="CKD COS VIỆT NAM"/>
										<div class="font-menup-mb"> <?php echo getLang('dangky'); ?> </div>
									</a></div> <?php } ?>
							<div class="col-4 centered-image"><a href="/gio-hang"> <img class="menu-icon-cover"
																						src="<?= image_default('shopping-card') ?>"
																						alt="CKD COS VIỆT NAM"/>
									<div class="font-menup-mb"> <?php echo getLang('giohang'); ?> </div>
								</a></div>
							<div class="col-4 centered-image"><a href="https://www.facebook.com/Bluepinkckdguaranteed">
									<img class="menu-icon-cover" src="<?= image_default('iconmess') ?>"
										 alt="CKD COS VIỆT NAM"/>
									<div class="font-menup-mb"> Chat</div>
								</a></div>
						</div>
					</div>
					<nav class="animated bounceInDown nav-menu">
						<ul>
							<li class="text-left"><a href="/"> <?php echo getLang('trangchu'); ?> </a>
							</li class="text-left">
							<li class="text-left"><a href="/gioi-thieu"> <?php echo getLang('gioithieu'); ?> </a></li>
							<li class="sub-menu"><a class="submenu-toggle"
													href="/"> <?php echo getLang('thuonghieu'); ?> <span
										class="submenu-icon">&nbsp</span> </a>
								<ul>
									<li><a href="/brand"> Brand </a></li>
									<li>
										<a href="/cau-chuyen-thuong-hieu"> <?php echo getLang('cauchuyenthuonghieu'); ?> </a>
									</li>
									<li>
										<a href="/gioi-thieu-thuong-hieu"> <?php echo getLang('gioithieuthuonghieu'); ?> </a>
									</li>
									<li><a href="/loi-hua-c-k-d"> <?php echo getLang('loihua'); ?> </a></li>
								</ul>
							</li>
							<li class="text-left"><a href="khuyen-mai"> <?php echo getLang('khuyenmai'); ?> </a></li>
							<li class="sub-menu"><a class="submenu-toggle" href="/"> <?php echo getLang('sanpham'); ?>
									<span class="submenu-icon">&nbsp</span> </a>
								<ul>
									<li class="sub-menu"><a class="submenu-toggle"
															href="/"> <?php echo getLang('tatcasanpham'); ?> <span
												class="submenu-icon">&nbsp</span> </a>
										<ul>
											<li class="sub-menu"><a
													href="/san-pham"> <?php echo getLang('tatca'); ?> </a> <a
													href="/tot-nhat"> <?php echo getLang('totnhat'); ?> </a> <a
													href="/moi"> <?php echo getLang('moi'); ?> </a> <a
													href="/khuyen-mai"> <?php echo getLang('sanphamkhuyenmai'); ?> </a>
											</li>
										</ul>
									</li>
									<li class="sub-menu"><a class="submenu-toggle"
															href="/"> <?php echo getLang('loaisanpham'); ?> <span
												class="submenu-icon">&nbsp</span> </a>
										<ul>
											<li class="sub-menu"><a
													href="lam-sach"> <?php echo getLang('lamsach'); ?> </a> <a
													href="cham-soc-da"> <?php echo getLang('chamsocda'); ?> </a> <a
													href="goi-mat-na"> <?php echo getLang('goimatna'); ?> </a> <a
													href="chong-nang"> <?php echo getLang('chongnang'); ?> </a> <a
													href="co-the-toc"> <?php echo getLang('cothetoc'); ?> </a> <a
													href="nam-gioi"> <?php echo getLang('namgioi'); ?> </a> <a
													href="/combo-ckd">Combo CKD</a></li>
										</ul>
									</li>
									<li class="sub-menu"><a class="submenu-toggle"
															href="/"> <?php echo getLang('thuonghieu'); ?> <span
												class="submenu-icon">&nbsp</span> </a>
										<ul>
											<li class="sub-menu"><a href="ckd">CKD</a> <a href="bellasoo">Bellasu</a> <a
													href="lacto">Lacto</a></li>
										</ul>
									</li>
									<li class="sub-menu"><a class="submenu-toggle"
															href="/"> <?php echo getLang('dong'); ?> <span
												class="submenu-icon">&nbsp</span> </a>
										<ul>
											<li class="sub-menu"><a href="san-pham/retino-collagen">Retino collagen</a>
												<a href="san-pham/nuoc-pha-tron"> <?php echo getLang('nuocphatron'); ?> </a>
												<a href="san-pham/vita-citeca">VitaCiteca</a> <a
													href="san-pham/biotin-amin">Biotin amin</a> <a
													href="san-pham/keo-ong-xanh"> <?php echo getLang('keoongxanh'); ?> </a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="text-left"><a href="/su-kien"> <?php echo getLang('sukien'); ?> </a></li>
							<li class="text-left"><a href="/cam-nang"> <?php echo getLang('tintuc'); ?> </a></li>
							<li class="text-left"><a href="/lien-he"> <?php echo getLang('lienhe'); ?> </a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<div class="menu_overlay"></div>
		<script> NN_FRAMEWORK.Search();$(".sub-menu ul").hide();
			$(".submenu-toggle").click(function (e) {
				e.preventDefault();
				$(this).parent(".sub-menu").children("ul").slideToggle("100");
				var icon = $(this).find(".submenu-icon");
				icon.text(icon.text() == "&nbsp" ? "" : "");
				if ($(this).hasClass('open')) {
					$(this).removeClass('open');
				} else {
					$(this).addClass('open');
				}
			});
			$("#sz-navbar-check").change(function () {
				if (this.checked) {
					$('.layout-menu').addClass('mb_menu_open');
					$('body').addClass("fixed-position");
					$('.menu_overlay').show();
					$(".sz-navbar-hamburger img").attr("src", "assets/icon/menu/close.png");
				} else {
					$('.menu_overlay').hide();
					$('body').removeClass("fixed-position");
					$('.layout-menu').removeClass('mb_menu_open');
					$(".sz-navbar-hamburger img").attr("src", "assets/icon/menu/open_menu.svg");
				}
			});
			$(document).mouseup(function (e) {
				var container = $(".results");
				var menu = $(".sz-navbar-items");
				var search = $(".search");
				if (!container.is(e.target) && container.has(e.target).length === 0) {
					container.hide();
				}
				if (!search.is(e.target) && search.has(e.target).length === 0) {
					search.hide();
					$('.menu_overlay').hide();
					$('body').removeClass("fixed-position");
				}
			}); </script>
	</div> <?php endif; ?>
