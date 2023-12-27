<div class="pc cate-wrap">
    <div class="inner">
        <div class="main_fix">
            <!--site-wrap-->
            <div class="float-left">
                <div class="logo-img">
                    <div class="vertical">
                        <a class="logo" href="<?= $config_base; ?>"> <img src="<?= $func->get_photo('logo' . $m) ?>" /></a>
                    </div>
                </div>
                <div class="bs">
                    <a href="gioi-thieu" title="<?= getLang('gioithieu') ?>"><?= getLang('gioithieu') ?></a>
                </div>
                <div class="bs">
                    <a href="/brand" title="<?= getLang('thuonghieu') ?>"><?= getLang('thuonghieu') ?></a>
                    <div class="sub-list boardlink"><?= $func->for1('news', 'bai-viet-thuong-hieu', $lang, $sluglang); ?></div>
                </div>
                <div class="bs">
                    <a href="khuyen-mai" title="<?= getLang('khuyenmai') ?>"><?= getLang('khuyenmai') ?></a>
                </div>
                <div id="category" class="xans-element- xans-layout xans-layout-category cate-override">
                    <ul class="nav-top">
                        <li data-param="?cate_no=84" class="bs xans-record-">
                            <a href="san-pham" title="<?= getLang('sanpham') ?>"><?= getLang('sanpham') ?></a>
                            <div class="sub-category">
                                <div class="sub-left">
                                    <ul class="sub02 sub02_84">
                                        <li class="cate_no_140 arrow">
                                            <a
                                                href="<?= site_url() ?>"
                                                title="<?= getLang('tatcasanpham') ?>
											"
                                            >
                                                <?= getLang('tatcasanpham') ?>
                                            </a>
                                            <ul class="sub03 sub03_140">
                                                <li class="cate_no_141">
                                                    <a href="san-pham" title="<?= getLang('tatca') ?>"><?= getLang('tatca') ?></a>
                                                </li>
                                                <li class="cate_no_142">
                                                    <a href="tot-nhat" title="<?= getLang('totnhat') ?>"><?= getLang('totnhat') ?></a>
                                                </li>
                                                <li class="cate_no_143">
                                                    <a href="moi" title="<?= getLang('moi') ?>"><?= getLang('moi') ?></a>
                                                </li>
                                                <li class="cate_no_143">
                                                    <a href="khuyen-mai" title="<?= getLang('sanphamkhuyenmai') ?>"><?= getLang('sanphamkhuyenmai') ?></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="cate_no_85 arrow">
                                            <a
                                                href="<?= site_url() ?>"
                                                title="<?= getLang('loaisanpham') ?>
											"
                                            >
                                                <?= getLang('loaisanpham') ?>
                                            </a>
                                            <ul class="sub03 sub03_85">
                                                <?= $func->for11('product_list', 'san-pham', $lang, $sluglang); ?>
                                            </ul>
                                        </li>
                                        <li class="cate_no_86 arrow">
                                            <a data-toggle="collapse" id="thuongHieuToggle"><?= getLang('thuonghieu') ?></a>
                                            <ul class="sub03 sub03_86" id="subMenu86">
                                                <?php echo get_thuonghieu(); ?>
                                            </ul>
                                        </li>
                                        <li class="cate_no_115 arrow">
                                            <a
                                                href="<?= site_url() ?>"
                                                title="<?= getLang('dong') ?>
											"
                                            >
                                                <?= getLang('dong') ?>
                                            </a>
                                            <ul class="sub03 sub03_115">
                                                <?= $func->for11('news', 'dong', $lang, $sluglang); ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="sub-right">
                                    <!--<div class="main_fix wap_sanpham mt-lg-5" id="slider_khuyenmai"><div class="background-masker btn-divide-left"></div></div>-->
                                    <!--<a href="san-pham"><img style="width: 15rem;" class="img-fluid"src="upload/product/anh-chup-man-hinh-2023-06-22-luc-151003-3410.webp"></a>-->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="bs">
                    <a href="su-kien" title="<?= getLang('sukien') ?>"><?= getLang('sukien') ?></a>
                </div>
                <div class="bs">
                    <a href="tin-tuc" title="<?= getLang('tintuc') ?>"><?= getLang('tintuc') ?></a>
                    <div class="sub-list boardlink"><?= $func->formenu('news', 'tin-tuc', '', $lang, $sluglang); ?></div>
                </div>
                <div class="bs">
                    <a href="lien-he" title="<?= getLang('lienhe') ?>"><?= getLang('lienhe') ?></a>
                </div>
                <div class="bs">
                    <a href="<?= MYSITE_AFFILIATE ?>" target="_blank" title="<?= getLang('tiepthilienket') ?>"><?= getLang('tiepthilienket') ?></a>
                    <?php if (!empty($aff)): ?>
                    <div class="sub-list boardlink">
                        <ul></ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="float-right">
                <!--<form id="searchBarForm" action="#" method="get" target="_self">-->
                <input id="banner_action" name="banner_action" value="" type="hidden" />
                <div class="xans-element- xans-layout xans-layout-searchheader">
                    <div class="form-group">
                        <label for="keyword">&nbsp;</label><input onKeyDown="doEnter(e, 'keyword')" id="keyword" class="inputTypeText" type="text" autocomplete="off" />
                        <div class="search_auto" onclick="onSearch('keyword');"></div>
                        <input class="bt-search" type="image" src="/assets/images/search.svg" alt="CKD COS VIỆT NAM" />
                        <ul class="autoDrop">
                            <li><span>&nbsp;</span></li>
                        </ul>
                    </div>
                </div>
                <!--</form>-->
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
