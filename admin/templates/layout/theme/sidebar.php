<!-- Main Sidebar -->


<?php

if (isset($_SESSION[$login_admin]['id_nhomquyen'])) {
	if ($_SESSION[$login_admin]['id_nhomquyen'] >= 0) {
?>
		<aside id="sidebar" class="sidebar">
			<ul id="sidebar-nav" class="sidebar-nav nav nav-pills nav-sidebar flex-column nav-child-indent text-sm"
				data-widget="treeview" role="menu" data-accordion="false">
				<!-- Bảng điều khiển -->
				<?php
				$active = "";
				if ($com == 'index' || $com == '') $active = 'active';
				?>
				<li class="nav-item <?= $active ?>">
					<a class="nav-link collapsed <?= $active ?>" href="index.php" title="<?= bangdieukhien ?>">
						<i class="nav-icon text-sm fas fa-tachometer-alt"></i>
						<span><?= bangdieukhien ?></span>
					</a>
				</li>

				<!-- Group -->
				<?php $disabled = array();
				if (isset($config['group'])) {
					foreach ($config['group'] as $key => $value) { ?>
						<li class="nav-item has-treeview menu-group">
							<a class="nav-link collapsed" href="#" title="<?= $key ?>">
								<i class="nav-icon text-sm fas fa-layer-group"></i>
								<span>
                                <?= $key ?>
                                <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
							</a>
							<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
								<?php if (isset($value['product'])) {
									foreach ($value['product'] as $k) { ?>
										<?php
										$disabled['product'][$k] = 1;
										$v = $config['product'][$k];
										$none = "";
										$active = "";
										$menuopen = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_list', $k, null, 'phrase-1') && $func->check_access('product', 'man_cat', $k, null, 'phrase-1') && $func->check_access('product', 'man_item', $k, null, 'phrase-1') && $func->check_access('product', 'man_sub', $k, null, 'phrase-1') && $func->check_access('product', 'man_brand', $k, null, 'phrase-1') && $func->check_access('product', 'man', $k, null, 'phrase-1') && $func->check_access('import', 'man', $k, null, 'phrase-1') && $func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
										if ((($com == 'product') || ($com == 'import') || ($com == 'export')) && ($k == $_GET['type'])) {
											$active = 'active';
											$menuopen = 'menu-open';
										}
										?>
										<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>" href="#"
											   title="<?= $v['title_main'] ?>">
												<i class="nav-icon text-sm fas fa-boxes"></i>
												<span>
                                            <?= $v['title_main'] ?>

                                        </span>
												<i class="right bi bi-chevron-down ms-auto"></i>
											</a>
											<ul class="nav nav-treeview"
												style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
												<?php if (!empty($v['dropdown'])) {
													if (isset($v['list']) && $v['list'] == true) {
														$none = "";
														$active = "";
														if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
														if ($com == 'product' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
														<li class="nav-item <?= $none ?>"><a
																class="nav-link collapsed <?= $active ?>"
																href="index.php?com=product&act=man_list&type=<?= $k ?>"
																title="<?= danhmuccap1 ?>"><i
																	class="nav-icon text-sm far fa-caret-square-right"></i><span><?= danhmuccap1 ?></span></a>
														</li>
													<?php } ?>
													<?php if (isset($v['cat']) && $v['cat'] == true) {
														$none = "";
														$active = "";
														if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
														if ($com == 'product' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
														<li class="nav-item <?= $none ?>"><a
																class="nav-link collapsed <?= $active ?>"
																href="index.php?com=product&act=man_cat&type=<?= $k ?>"
																title="Danh mục cấp 2"><i
																	class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 2</span></a>
														</li>
													<?php } ?>
													<?php if (isset($v['item']) && $v['item'] == true) {
														$none = "";
														$active = "";
														if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
														if ($com == 'product' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
														<li class="nav-item <?= $none ?>"><a
																class="nav-link collapsed <?= $active ?>"
																href="index.php?com=product&act=man_item&type=<?= $k ?>"
																title="Danh mục cấp 3"><i
																	class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 3</span></a>
														</li>
													<?php } ?>
													<?php if (isset($v['sub']) && $v['sub'] == true) {
														$none = "";
														$active = "";
														if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
														if ($com == 'product' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
														<li class="nav-item <?= $none ?>"><a
																class="nav-link collapsed <?= $active ?>"
																href="index.php?com=product&act=man_sub&type=<?= $k ?>"
																title="Danh mục cấp 4"><i
																	class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 4</span></a>
														</li>
													<?php }
												} ?>
												<?php if (isset($v['brand']) && $v['brand'] == true) {
													$none = "";
													$active = "";
													if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_brand', $k, null, 'phrase-1')) $none = "d-none";
													if ($com == 'product' && ($act == 'man_brand' || $act == 'add_brand' || $act == 'edit_brand') && $k == $_GET['type']) $active = "active"; ?>
													<li class="nav-item <?= $none ?>"><a
															class="nav-link collapsed <?= $active ?>"
															href="index.php?com=product&act=man_brand&type=<?= $k ?>"
															title="Danh mục hãng"><i
																class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục hãng</span></a>
													</li>
												<?php } ?>
												<?php if (isset($v['mau']) && $v['mau'] == true) {
													$none = "";
													$active = "";
													if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_mau', $k, null, 'phrase-1')) $none = "d-none";
													if ($com == 'product' && ($act == 'man_mau' || $act == 'add_mau' || $act == 'edit_mau') && $k == $_GET['type']) $active = "active"; ?>
													<li class="nav-item <?= $none ?>"><a
															class="nav-link collapsed <?= $active ?>"
															href="index.php?com=product&act=man_mau&type=<?= $k ?>"
															title="Danh mục màu sắc"><i
																class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục màu sắc</span></a>
													</li>
												<?php } ?>
												<?php if (isset($v['size']) && $v['size'] == true) {
													$none = "";
													$active = "";
													if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_size', $k, null, 'phrase-1')) $none = "d-none";
													if ($com == 'product' && ($act == 'man_size' || $act == 'add_size' || $act == 'edit_size') && $k == $_GET['type']) $active = "active"; ?>
													<li class="nav-item <?= $none ?>"><a
															class="nav-link collapsed <?= $active ?>"
															href="index.php?com=product&act=man_size&type=<?= $k ?>"
															title="Danh mục kích thước"><i
																class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục kích thước</span></a>
													</li>
												<?php } ?>
												<?php
												$none = "";
												$active = "";
												if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man', $k, null, 'phrase-1')) $none = "d-none";
												if ($com == 'product' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
												?>
												<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																					 href="index.php?com=product&act=man&type=<?= $k ?>"
																					 title="<?= $v['title_main'] ?>"><i
															class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
												</li>
												<?php if (isset($v['import']) && $v['import'] == true) {
													$none = "";
													$active = "";
													if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('import', 'man', $k, null, 'phrase-1')) $none = "d-none";
													if (($com == 'import') && ($k == $_GET['type'])) $active = "active"; ?>
													<li class="nav-item <?= $none ?>">
														<a class="nav-link collapsed <?= $active ?>"
														   href="index.php?com=import&act=man&type=<?= $k ?>" title="Import"><i
																class="nav-icon text-sm far fa-caret-square-right"></i><span>Import</span></a>
													</li>
												<?php } ?>
												<?php if (isset($v['export']) && $v['export'] == true) {
													$none = "";
													$active = "";
													if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
													if (($com == 'export') && ($act == 'man') && ($k == $_GET['type'])) $active = "active"; ?>
													<li class="nav-item <?= $none ?>">
														<a class="nav-link collapsed <?= $active ?>"
														   href="index.php?com=export&act=man&type=<?= $k ?>" title="Export"><i
																class="nav-icon text-sm far fa-caret-square-right"></i><span>Export</span></a>
													</li>
												<?php } ?>
											</ul>
										</li>
									<?php }
								} ?>


								<?php if (isset($value['news'])) {
									foreach ($value['news'] as $k) { ?>
										<?php
										$disabled['news'][$k] = 1;
										$v = $config['news'][$k];
										$none = "";
										$active = "";
										$menuopen = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1') && $func->check_access('news', 'man_cat', $k, null, 'phrase-1') && $func->check_access('news', 'man_item', $k, null, 'phrase-1') && $func->check_access('news', 'man_sub', $k, null, 'phrase-1') && $func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
										if (($com == 'news') && ($k == $_GET['type'])) {
											$active = 'active';
											$menuopen = 'menu-open';
										}
										?>
										<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>" href="#"
											   title="<?= $v['title_main'] ?>">
												<i class="nav-icon text-sm fas fa-book"></i>
												<span>
                                            <?= $v['title_main'] ?>
                                            <i class="right bi bi-chevron-down ms-auto"></i>
                                        </span>
											</a>
											<ul class="nav nav-treeview"
												style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
												<?php if (!empty($v['dropdown'])) {
													if (isset($v['list']) && $v['list'] == true) {
														$none = "";
														$active = "";
														if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
														if ($com == 'news' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
														<li class="nav-item <?= $none ?>"><a
																class="nav-link collapsed <?= $active ?>"
																href="index.php?com=news&act=man_list&type=<?= $k ?>"
																title="<?= danhmuccap1 ?>"><i
																	class="nav-icon text-sm far fa-caret-square-right"></i><span><?= danhmuccap1 ?></span></a>
														</li>
													<?php } ?>
													<?php if (isset($v['cat']) && $v['cat'] == true) {
														$none = "";
														$active = "";
														if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
														if ($com == 'news' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
														<li class="nav-item <?= $none ?>"><a
																class="nav-link collapsed <?= $active ?>"
																href="index.php?com=news&act=man_cat&type=<?= $k ?>"
																title="Danh mục cấp 2"><i
																	class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 2</span></a>
														</li>
													<?php } ?>
													<?php if (isset($v['item']) && $v['item'] == true) {
														$none = "";
														$active = "";
														if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
														if ($com == 'news' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
														<li class="nav-item <?= $none ?>"><a
																class="nav-link collapsed <?= $active ?>"
																href="index.php?com=news&act=man_item&type=<?= $k ?>"
																title="Danh mục cấp 3"><i
																	class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 3</span></a>
														</li>
													<?php } ?>
													<?php if (isset($v['sub']) && $v['sub'] == true) {
														$none = "";
														$active = "";
														if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
														if ($com == 'news' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
														<li class="nav-item <?= $none ?>"><a
																class="nav-link collapsed <?= $active ?>"
																href="index.php?com=news&act=man_sub&type=<?= $k ?>"
																title="Danh mục cấp 4"><i
																	class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 4</span></a>
														</li>
													<?php }
												} ?>
												<?php
												$none = "";
												$active = "";
												if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
												if ($com == 'news' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
												?>
												<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																					 href="index.php?com=news&act=man&type=<?= $k ?>"
																					 title="<?= $v['title_main'] ?>"><i
															class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
												</li>
											</ul>
										</li>
									<?php }
								} ?>

								<?php if (isset($value['tags'])) {
									foreach ($value['tags'] as $k) { ?>
										<?php
										$disabled['tags'][$k] = 1;
										$v = $config['tags'][$k];
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('tags', 'man', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'tags' && $k == $_GET['type']) $active = "active";
										?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=tags&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
										</li>
									<?php }
								} ?>

								<?php if (isset($value['static'])) {
									foreach ($value['static'] as $k) { ?>
										<?php
										$disabled['static'][$k] = 1;
										$v = $config['static'][$k];
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('static', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'static' && $k == $_GET['type']) $active = "active";
										?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=static&act=capnhat&type=<?= $k ?>"
											   title="<?= $v['title_main'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
										</li>
									<?php }
								} ?>

								<?php if (isset($value['newsletter'])) {
									foreach ($value['newsletter'] as $k) { ?>
										<?php
										$disabled['newsletter'][$k] = 1;
										$v = $config['newsletter'][$k];
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('newsletter', 'man', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'newsletter' && $k == $_GET['type']) $active = "active";
										?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=newsletter&act=man&type=<?= $k ?>"
											   title="<?= $v['title_main'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
										</li>
									<?php }
								} ?>

								<?php if (isset($value['photo'])) {
									foreach ($value['photo'] as $k) {
										$disabled['photo'][$k] = 1;
										$v = $config['photo']['man_photo'][$k];
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'man_photo', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'photo' && $_GET['type'] == $k && ($act == 'man_photo' || $act == 'add_photo' || $act == 'edit_photo')) $active = "active"; ?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=photo&act=man_photo&type=<?= $k ?>"
											   title="<?= $v['title_main_photo'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main_photo'] ?></span></a>
										</li>
									<?php }
								} ?>

								<?php if (isset($value['photo_static'])) {
									foreach ($value['photo_static'] as $k) {
										$disabled['photo_static'][$k] = 1;
										$v = $config['photo']['photo_static'][$k];
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'photo_static', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'photo' && $_GET['type'] == $k && $act == 'photo_static') $active = "active"; ?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=photo&act=photo_static&type=<?= $k ?>"
											   title="<?= $v['title_main'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
										</li>
									<?php }
								} ?>
							</ul>
						</li>
					<?php }
				} ?>

				<!-- Sản phẩm -->
				<?php if (isset($config['product'])) { ?>
					<?php foreach ($config['product'] as $k => $v) {
						if (!isset($disabled['product'][$k])) { ?>
							<?php
							$none = "";
							$active = "";
							$menuopen = "";
							if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_list', $k, null, 'phrase-1') && $func->check_access('product', 'man_cat', $k, null, 'phrase-1') && $func->check_access('product', 'man_item', $k, null, 'phrase-1') && $func->check_access('product', 'man_sub', $k, null, 'phrase-1') && $func->check_access('product', 'man_brand', $k, null, 'phrase-1') && $func->check_access('product', 'man', $k, null, 'phrase-1') && $func->check_access('import', 'man', $k, null, 'phrase-1') && $func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
							if ((($com == 'product') || ($com == 'import') || ($com == 'export')) && ($k == $_GET['type'])) {
								$active = 'active';
								$menuopen = 'menu-open';
							}
							?>
							<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
								<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= $v['title_main'] ?>">
									<i class="nav-icon text-sm fas fa-boxes"></i>
									<span>
                                    <?= $v['title_main'] ?>
                                    <i class="right bi bi-chevron-down ms-auto"></i>
                                </span>
								</a>
								<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
									<?php if (!empty($v['dropdown'])) {
										if (isset($v['list']) && $v['list'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'product' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=product&act=man_list&type=<?= $k ?>"
																				 title="<?= danhmuccap1 ?>"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span><?= danhmuccap1 ?></span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['cat']) && $v['cat'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'product' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=product&act=man_cat&type=<?= $k ?>"
																				 title="Danh mục cấp 2"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 2</span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['item']) && $v['item'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'product' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=product&act=man_item&type=<?= $k ?>"
																				 title="Danh mục cấp 3"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 3</span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['sub']) && $v['sub'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'product' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=product&act=man_sub&type=<?= $k ?>"
																				 title="Danh mục cấp 4"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 4</span></a>
											</li>
										<?php }
									} ?>
									<?php if (isset($v['brand']) && $v['brand'] == true) {
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_brand', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'product' && ($act == 'man_brand' || $act == 'add_brand' || $act == 'edit_brand') && $k == $_GET['type']) $active = "active"; ?>
										<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																			 href="index.php?com=product&act=man_brand&type=<?= $k ?>"
																			 title="Danh mục hãng"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục hãng</span></a>
										</li>
									<?php } ?>
									<?php if (isset($v['mau']) && $v['mau'] == true) {
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_mau', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'product' && ($act == 'man_mau' || $act == 'add_mau' || $act == 'edit_mau') && $k == $_GET['type']) $active = "active"; ?>
										<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																			 href="index.php?com=product&act=man_mau&type=<?= $k ?>"
																			 title="Danh mục màu sắc"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục màu sắc</span></a>
										</li>
									<?php } ?>
									<?php if (isset($v['size']) && $v['size'] == true) {
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man_size', $k, null, 'phrase-1')) $none = "d-none";
										if ((isset($_GET['khuyenmai']) && $_GET['khuyenmai'] == 0 || (empty($_GET['khuyenmai']))) && $com == 'product' && ($act == 'man_size' || $act == 'add_size' || $act == 'edit_size') && $k == $_GET['type']) $active = "active"; ?>
										<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																			 href="index.php?com=product&act=man_size&type=<?= $k ?>"
																			 title="Danh mục kích thước"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục kích thước</span></a>
										</li>
									<?php } ?>

									<?php
									$none = "";
									$active = "";
									if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man', $k, null, 'phrase-1')) $none = "d-none";
									if (($_REQUEST['khuyenmai'] == 0) && $com == 'product' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
									?>

									<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																		 href="index.php?com=product&act=man&type=<?= $k ?>"
																		 title="<?= $v['title_main'] ?>"><i
												class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
									</li>
									<?php
									$none = "";
									$active = "";
									if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('product', 'man', $k, null, 'phrase-1')) $none = "d-none";
									if (($_REQUEST['khuyenmai'] == 1) && $com == 'product' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
									?>
									<li class="nav-item"><a class="nav-link collapsed <?= $active ?>"
															href="index.php?com=product&act=man&type=san-pham&khuyenmai=1">
											<i class="nav-icon text-sm far fa-caret-square-right"></i><span>Sản phẩm khuyến mãi</span></a>
										</a></li>
									<?php if (isset($v['import']) && $v['import'] == true) {
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('import', 'man', $k, null, 'phrase-1')) $none = "d-none";
										if (($com == 'import') && ($k == $_GET['type'])) $active = "active"; ?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=import&act=man&type=<?= $k ?>" title="Import"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span>Import</span></a>
										</li>
									<?php } ?>
									<?php if (isset($v['export']) && $v['export'] == true) {
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
										if (($com == 'export') && ($act == 'man') && ($k == $_GET['type'])) $active = "active"; ?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=export&act=man&type=<?= $k ?>" title="Export"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span>Export</span></a>
										</li>
									<?php } ?>
								</ul>
							</li>
						<?php }
					} ?>
				<?php } ?>

				<!-- <?= baiviet ?> (Có cấp) -->
				<?php if (isset($config['news'])) { ?>
					<?php foreach ($config['news'] as $k => $v) {
						if (!isset($disabled['news'][$k])) {
							if (!empty($v['dropdown'])) { ?>
								<?php
								$none = "";
								$active = "";
								$menuopen = "";
								if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1') && $func->check_access('news', 'man_cat', $k, null, 'phrase-1') && $func->check_access('news', 'man_item', $k, null, 'phrase-1') && $func->check_access('news', 'man_sub', $k, null, 'phrase-1') && $func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
								if (($com == 'news') && ($k == $_GET['type'])) {
									$active = 'active';
									$menuopen = 'menu-open';
								}
								?>
								<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
									<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= $v['title_main'] ?>">
										<i class="nav-icon text-sm fas fa-book"></i>
										<span>
                                    <?= $v['title_main'] ?>
                                    <i class="right bi bi-chevron-down ms-auto"></i>
                                </span>
									</a>
									<ul class="nav nav-treeview"
										style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
										<?php if (isset($v['list']) && $v['list'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'news' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=news&act=man_list&type=<?= $k ?>"
																				 title="<?= danhmuccap1 ?>"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span><?= danhmuccap1 ?></span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['cat']) && $v['cat'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'news' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=news&act=man_cat&type=<?= $k ?>"
																				 title="Danh mục cấp 2"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 2</span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['item']) && $v['item'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'news' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=news&act=man_item&type=<?= $k ?>"
																				 title="Danh mục cấp 3"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 3</span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['sub']) && $v['sub'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'news' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=news&act=man_sub&type=<?= $k ?>"
																				 title="Danh mục cấp 4"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 4</span></a>
											</li>
										<?php } ?>
										<?php
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'news' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
										?>
										<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																			 href="index.php?com=news&act=man&type=<?= $k ?>"
																			 title="<?= $v['title_main'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
										</li>
									</ul>
								</li>
							<?php }
						}
					} ?>
				<?php } ?>

				<!-- <?= baiviet ?> (Không cấp) -->
				<?php if (isset($config['shownews']) && $config['shownews'] == true) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', '', $config['news'], 'phrase-2')) $none = "d-none";
					if (($com == 'news') && !isset($disabled['news'][$_GET['type']]) && empty($config['news'][$_GET['type']]['dropdown'])) {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= baiviet ?>">
							<i class="nav-icon text-sm far fa-newspaper"></i>
							<span>
                                <?= baiviet ?>
                                <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php foreach ($config['news'] as $k => $v) {
								if (!isset($disabled['news'][$k]) && empty($v['dropdown'])) { ?>
									<?php
									$none = "";
									$active = "";
									if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
									if ($com == 'news' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
									?>
									<li class="nav-item <?= $none ?>">
										<a class="nav-link collapsed <?= $active ?>"
										   href="index.php?com=news&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i
												class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
									</li>
								<?php }
							} ?>
						</ul>
					</li>
				<?php } ?>

				<!-- Cart -->
				<?php if (isset($config['order']['active']) && $config['order']['active'] == true) { ?>
					<?php
					$none = "";
					$active = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('order', 'man', '', null, 'phrase-1')) $none = "d-none";
					if ($com == 'order') $active = 'active';
					?>
					<li class="nav-item <?= $active ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="index.php?com=order&act=man" title="<?= donhang ?>">
							<i class="nav-icon text-sm fas fa-shopping-bag"></i>
							<span><?= donhang ?></span>
						</a>
					</li>
				<?php } ?>

				<!-- Coupons -->
				<?php if (isset($config['order']['active']) && $config['order']['active'] == true) { ?>
					<?php
					$none = "";
					$active = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('coupons', 'man', '', null, 'phrase-1')) $none = "d-none";
					if ($com == 'coupons') $active = 'active';
					?>
					<li class="nav-item <?= $active ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="index.php?com=coupons&act=man" title=coupons">
							<i class="nav-icon text-sm fas fa-gift"></i>
							<span>Mã giảm giá</span>
						</a>
					</li>
				<?php } ?>

				<!-- Tags -->
				<?php if (isset($config['tags'])) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('tags', 'man', '', $config['tags'], 'phrase-2')) $none = "d-none";
					if ($com == 'tags' && !isset($disabled['tags'][$_GET['type']])) {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="tags">
							<i class="nav-icon text-sm fas fa-tags"></i>
							<span>
                                tags
                        <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php foreach ($config['tags'] as $k => $v) {
								if (!isset($disabled['tags'][$k])) { ?>
									<?php
									$none = "";
									$active = "";
									if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('tags', 'man', $k, null, 'phrase-1')) $none = "d-none";
									if ($com == 'tags' && $k == $_GET['type']) $active = "active";
									?>
									<li class="nav-item <?= $none ?>">
										<a class="nav-link collapsed <?= $active ?>"
										   href="index.php?com=tags&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i
												class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
									</li>
								<?php }
							} ?>
						</ul>
					</li>
				<?php } ?>

				<!-- Newsletter -->
				<?php if (isset($config['newsletter'])) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('newsletter', 'man', '', $config['newsletter'], 'phrase-2')) $none = "d-none";
					if ($com == 'newsletter' && !isset($disabled['newsletter'][$_GET['type']])) {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= nhantin ?>">
							<i class="nav-icon text-sm fas fa-envelope"></i>
							<span>
                                <?= nhantin ?>
                                <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php foreach ($config['newsletter'] as $k => $v) {
								if (!isset($disabled['newsletter'][$k])) { ?>
									<?php
									$none = "";
									$active = "";
									if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('newsletter', 'man', $k, null, 'phrase-1')) $none = "d-none";
									if ($com == 'newsletter' && $k == $_GET['type']) $active = "active";
									?>
									<li class="nav-item <?= $none ?>">
										<a class="nav-link collapsed <?= $active ?>"
										   href="index.php?com=newsletter&act=man&type=<?= $k ?>"
										   title="<?= $v['title_main'] ?>"><i
												class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
									</li>
								<?php }
							} ?>
						</ul>
					</li>
				<?php } ?>

				<!-- Static -->
				<?php if (isset($config['static'])) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('static', 'capnhat', '', $config['static'], 'phrase-2')) $none = "d-none";
					if ($com == 'static' && !isset($disabled['static'][$_GET['type']])) {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= trangtinh ?>">
							<i class="nav-icon text-sm fas fa-bookmark"></i>
							<span>
                                <?= trangtinh ?>
                                <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php foreach ($config['static'] as $k => $v) {
								if (!isset($disabled['static'][$k])) { ?>
									<?php
									$none = "";
									$active = "";
									if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('static', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
									if ($com == 'static' && $k == $_GET['type']) $active = "active";
									?>
									<li class="nav-item <?= $none ?>">
										<a class="nav-link collapsed <?= $active ?>"
										   href="index.php?com=static&act=capnhat&type=<?= $k ?>"
										   title="<?= $v['title_main'] ?>"><i
												class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
									</li>
								<?php }
							} ?>
						</ul>
					</li>
				<?php } ?>

				<!-- Gallery -->
				<?php if (isset($config['photo'])) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'photo_static', '', $config['photo']['photo_static'], 'phrase-2') && $func->check_access('photo', 'man_photo', '', $config['photo']['man_photo'], 'phrase-2')) $none = "d-none";
					if ($com == 'photo' && !isset($disabled['photo'][$_GET['type']]) && !isset($disabled['photo_static'][$_GET['type']])) {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= hinhanhvideo ?>">
							<i class="nav-icon text-sm fas fa-photo-video"></i>
							<span>
                                <?= hinhanhvideo ?>
                                <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php if (isset($config['photo']['photo_static'])) { ?>
								<?php foreach ($config['photo']['photo_static'] as $k => $v) {
									if (!isset($disabled['photo_static'][$k])) {
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'photo_static', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'photo' && $_GET['type'] == $k && $act == 'photo_static') $active = "active"; ?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=photo&act=photo_static&type=<?= $k ?>"
											   title="<?= $v['title_main'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
										</li>
									<?php }
								} ?>
							<?php } ?>
							<?php if (isset($config['photo']['man_photo'])) { ?>
								<?php foreach ($config['photo']['man_photo'] as $k => $v) {
									if (!isset($disabled['photo'][$k])) {
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('photo', 'man_photo', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'photo' && $_GET['type'] == $k && ($act == 'man_photo' || $act == 'add_photo' || $act == 'edit_photo')) $active = "active"; ?>
										<li class="nav-item <?= $none ?>">
											<a class="nav-link collapsed <?= $active ?>"
											   href="index.php?com=photo&act=man_photo&type=<?= $k ?>"
											   title="<?= $v['title_main_photo'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main_photo'] ?></span></a>
										</li>
									<?php }
								} ?>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>

				<!-- Địa điểm -->
				<?php if (isset($config['places']['active']) && $config['places']['active'] == true) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_city', '', null, 'phrase-1') && $func->check_access('places', 'man_district', '', null, 'phrase-1') && $func->check_access('places', 'man_wards', '', null, 'phrase-1') && $func->check_access('places', 'man_street', '', null, 'phrase-1')) $none = "d-none";
					if ($com == 'places') {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="địa điểm">
							<i class="nav-icon text-sm fas fa-building"></i>
							<span>
                                địa điểm
                        <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php
							$none = "";
							$active = "";
							if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_city', '', null, 'phrase-1')) $none = "d-none";
							if ($com == 'places' && ($act == 'man_city' || $act == 'add_city' || $act == 'edit_city')) $active = "active";
							?>
							<li class="nav-item <?= $none ?>">
								<a class="nav-link collapsed <?= $active ?>" href="index.php?com=places&act=man_city"
								   title="Tỉnh thành"><i
										class="nav-icon text-sm far fa-caret-square-right"></i><span>Tỉnh thành</span></a>
							</li>
							<?php
							$none = "";
							$active = "";
							if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_district', '', null, 'phrase-1')) $none = "d-none";
							if ($com == 'places' && ($act == 'man_district' || $act == 'add_district' || $act == 'edit_district')) $active = "active";
							?>
							<li class="nav-item <?= $none ?>">
								<a class="nav-link collapsed <?= $active ?>" href="index.php?com=places&act=man_district"
								   title="Quận huyện"><i
										class="nav-icon text-sm far fa-caret-square-right"></i><span>Quận huyện</span></a>
							</li>
							<?php
							$none = "";
							$active = "";
							if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_wards', '', null, 'phrase-1')) $none = "d-none";
							if ($com == 'places' && ($act == 'man_wards' || $act == 'add_wards' || $act == 'edit_wards')) $active = "active";
							?>
							<li class="nav-item <?= $none ?>">
								<a class="nav-link collapsed <?= $active ?>" href="index.php?com=places&act=man_wards"
								   title="Phường xã"><i
										class="nav-icon text-sm far fa-caret-square-right"></i><span>Phường xã</span></a>
							</li>
							<?php if (isset($config['places']['duong']) && $config['places']['duong'] == true) { ?>
								<?php
								$none = "";
								$active = "";
								if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('places', 'man_street', '', null, 'phrase-1')) $none = "d-none";
								if ($com == 'places' && ($act == 'man_street' || $act == 'add_street' || $act == 'edit_street')) $active = "active";
								?>
								<li class="nav-item <?= $none ?>">
									<a class="nav-link collapsed <?= $active ?>" href="index.php?com=places&act=man_street"
									   title="Đường"><i
											class="nav-icon text-sm far fa-caret-square-right"></i><span>Đường</span></a>
								</li>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>

				<!-- User -->
				<?php if (isset($config['user']['active']) && $config['user']['active'] == true && !$func->check_permission()) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if ($com == 'user' && $act != 'login' && $act != 'logout') {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= user ?>">
							<i class="nav-icon text-sm fas fa-users"></i>
							<span>
                                <?= user ?>
                                <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php if (isset($config['permission']) && $config['permission'] == true) {
								$active = "";
								if ($act == 'permission_group' || $act == 'add_permission_group' || $act == 'edit_permission_group') $active = "active"; ?>
								<li class="nav-item"><a class="nav-link collapsed <?= $active ?>"
														href="index.php?com=user&act=permission_group" title="Nhóm quyền"><i
											class="nav-icon text-sm far fa-caret-square-right"></i><span>Nhóm quyền</span></a>
								</li>
							<?php } ?>
							<?php
							$active = "";
							if ($act == 'admin_edit') $active = "active";
							?>
							<li class="nav-item"><a class="nav-link collapsed <?= $active ?>"
													href="index.php?com=user&act=admin_edit" title="<?= thongtinadmin ?>"><i
										class="nav-icon text-sm far fa-caret-square-right"></i><span><?= thongtinadmin ?></span></a>
							</li>
							<?php if (isset($config['user']['admin']) && $config['user']['admin'] == true) {
								$active = "";
								if ($act == 'man_admin' || $act == 'add_admin' || $act == 'edit_admin') $active = "active"; ?>
								<li class="nav-item"><a class="nav-link collapsed <?= $active ?>"
														href="index.php?com=user&act=man_admin" title="Tài khoản admin"><i
											class="nav-icon text-sm far fa-caret-square-right"></i><span>Tài khoản admin</span></a>
								</li>
							<?php } ?>
							<?php if (isset($config['user']['visitor']) && $config['user']['visitor'] == true) {
								$active = "";
								if ($com == 'user' && ($act == 'man' || $act == 'add' || $act == 'edit')) $active = "active"; ?>
								<li class="nav-item"><a class="nav-link collapsed <?= $active ?>"
														href="index.php?com=user&act=man" title="<?= taikhoankhach ?>"><i
											class="nav-icon text-sm far fa-caret-square-right"></i><span><?= taikhoankhach ?></span></a>
								</li>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>

				<!--Cộng tác viên-->
				<?php if (isset($config['user']['active']) && $config['user']['active'] == true && !$func->check_permission()) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if ($com == 'affiliate' && $act != 'login' && $act != 'logout') {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= user ?>">
							<i class="nav-icon text-sm fas fa-user-friends"></i>
							<span>
                                <?= affiliate ?>
                                <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php if (isset($config['user']['visitor']) && $config['user']['visitor'] == true) {
								$active = "";
								if ($com == 'affiliate' && $act == 'man') $active = "active"; ?>
								<li class="nav-item"><a class="nav-link collapsed <?= $active ?>"
														href="index.php?com=affiliate&act=man" title="<?= taikhoan ?>"><i
											class="nav-icon text-sm far fa-caret-square-right"></i><span><?= taikhoan ?></span></a>
								</li>
							<?php } ?>


							<!-- <?= vinguoidung ?> -->
							<?php
							$none = "";
							$active = "";
							if ($com == 'affiliate' && $act == 'ref_withdrawal') $active = 'active';
							?>
							<li class="nav-item <?= $active ?> <?= $none ?>">
								<a class="nav-link collapsed <?= $active ?>" href="index.php?com=affiliate&act=ref_withdrawal"
								   title="<?= vinguoidung ?>">
									<i class="nav-icon text-sm fas fa-money-bill-alt"></i>
									<span><?= vinguoidung ?></span>
								</a>
							</li>

							<!-- <?= thietlapthongtin ?> -->
							<?php
							$none = "";
							$active = "";
							if ($com == 'affiliate' && $act == 'config') $active = 'active';
							?>
							<li class="nav-item <?= $active ?> <?= $none ?>">
								<a class="nav-link collapsed <?= $active ?>" href="index.php?com=affiliate&act=config"
								   title="<?= thietlapthongtin ?>">
									<i class="nav-icon text-sm fas fa-cogs"></i>
									<span><?= affi_config ?></span>
								</a>
							</li>

						</ul>
					</li>
				<?php } ?>
				<!-- Onesignal -->
				<?php if (isset($config['onesignal']) && $config['onesignal'] == true) { ?>
					<?php
					$none = "";
					$active = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('pushOnesignal', 'man', '', null, 'phrase-1')) $none = "d-none";
					if ($com == 'pushOnesignal') $active = 'active';
					?>
					<li class="nav-item <?= $active ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="index.php?com=pushOnesignal&act=man"
						   title="thông báo đẩy">
							<i class="nav-icon text-sm fas fa-bell"></i>
							<span>thông báo đẩy</span>
						</a>
					</li>
				<?php } ?>

				<!-- <?= seopage ?> -->
				<?php if (isset($config['seopage']) && count($config['seopage']['page']) > 0) { ?>
					<?php
					$none = "";
					$active = "";
					$menuopen = "";
					if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('seopage', 'capnhat', '', $config['seopage']['page'], 'phrase-2')) $none = "d-none";
					if ($com == 'seopage') {
						$active = 'active';
						$menuopen = 'menu-open';
					}
					?>
					<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
						<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= seopage ?>">
							<i class="nav-icon text-sm fas fa-share-alt"></i>
							<span>
                                <?= seopage ?>
                                <i class="right bi bi-chevron-down ms-auto"></i>
                            </span>
						</a>
						<ul class="nav nav-treeview" style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
							<?php foreach ($config['seopage']['page'] as $k => $v) { ?>
								<?php
								$none = "";
								$active = "";
								if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('seopage', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
								if ($com == 'seopage' && $k == $_GET['type']) $active = "active";
								?>
								<li class="nav-item <?= $none ?>">
									<a class="nav-link collapsed <?= $active ?>"
									   href="index.php?com=seopage&act=capnhat&type=<?= $k ?>" title="<?= $v ?>"><i
											class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v ?></span></a>
								</li>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>

				<!-- <?= thietlapthongtin ?> -->
				<?php
				$none = "";
				$active = "";
				if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('setting', 'capnhat', '', null, 'phrase-1')) $none = "d-none";
				if ($com == 'setting') $active = 'active';
				?>
				<li class="nav-item <?= $active ?> <?= $none ?>">
					<a class="nav-link collapsed <?= $active ?>" href="index.php?com=setting&act=capnhat"
					   title="<?= thietlapthongtin ?>">
						<i class="nav-icon text-sm fas fa-cogs"></i>
						<span><?= thietlapthongtin ?></span>
					</a>
				</li>

				<?php
				$none = "";
				$active = "";
				if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('todo', 'todo', '', null, 'phrase-1')) $none = "d-none";
				if ($com == 'todo') $active = 'active';
				?>

				<!--<li class="nav-item <?php /*=$active*/ ?> <?php /*=$none*/ ?>">
                    <a class="nav-link collapsed <?php /*=$active*/ ?>" href="index.php?com=task&act=todo" title="<?php /*=tiendocongviec*/ ?>">
                        <i class="nav-icon text-sm fas fa-cogs"></i>
                        <span><?php /*=tiendocongviec*/ ?></span>
                    </a>
                </li>-->
			</ul>
		</aside>


		<?php
	} else {
?>
		<aside id="sidebar" class="sidebar">
			<ul id="sidebar-nav" class="sidebar-nav nav nav-pills nav-sidebar flex-column nav-child-indent text-sm"
				data-widget="treeview" role="menu" data-accordion="false">
				<!-- Bảng điều khiển -->
				<?php
				$active = "";
				if ($com == 'index' || $com == '') $active = 'active';
				?>
				<li class="nav-item <?= $active ?>">
					<a class="nav-link collapsed <?= $active ?>" href="index.php" title="<?= bangdieukhien ?>">
						<i class="nav-icon text-sm fas fa-tachometer-alt"></i>
						<span><?= bangdieukhien ?></span>
					</a>
				</li>
				<!-- <?= baiviet ?> (Có cấp) -->
				<?php if (isset($config['news'])) { ?>
					<?php foreach ($config['news'] as $k => $v) {
						if (!isset($disabled['news'][$k])) {
							if (!empty($v['dropdown'])) { ?>
								<?php
								$none = "";
								$active = "";
								$menuopen = "";
								if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1') && $func->check_access('news', 'man_cat', $k, null, 'phrase-1') && $func->check_access('news', 'man_item', $k, null, 'phrase-1') && $func->check_access('news', 'man_sub', $k, null, 'phrase-1') && $func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
								if (($com == 'news') && ($k == $_GET['type'])) {
									$active = 'active';
									$menuopen = 'menu-open';
								}
								?>
								<li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
									<a class="nav-link collapsed <?= $active ?>" href="#" title="<?= $v['title_main'] ?>">
										<i class="nav-icon text-sm fas fa-book"></i>
										<span>
                                    <?= $v['title_main'] ?>
                                    <i class="right bi bi-chevron-down ms-auto"></i>
                                </span>
									</a>
									<ul class="nav nav-treeview"
										style="<?php if ($active == ''): ?>display: none; <?php endif; ?>">
										<?php if (isset($v['list']) && $v['list'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'news' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list' || $kind == 'man_list') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=news&act=man_list&type=<?= $k ?>"
																				 title="<?= danhmuccap1 ?>"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span><?= danhmuccap1 ?></span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['cat']) && $v['cat'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'news' && ($act == 'man_cat' || $act == 'add_cat' || $act == 'edit_cat' || $kind == 'man_cat' || $kind == 'man_cat') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=news&act=man_cat&type=<?= $k ?>"
																				 title="Danh mục cấp 2"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 2</span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['item']) && $v['item'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'news' && ($act == 'man_item' || $act == 'add_item' || $act == 'edit_item' || $kind == 'man_item' || $kind == 'man_item') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=news&act=man_item&type=<?= $k ?>"
																				 title="Danh mục cấp 3"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 3</span></a>
											</li>
										<?php } ?>
										<?php if (isset($v['sub']) && $v['sub'] == true) {
											$none = "";
											$active = "";
											if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
											if ($com == 'news' && ($act == 'man_sub' || $act == 'add_sub' || $act == 'edit_sub' || $kind == 'man_sub' || $kind == 'man_sub') && $k == $_GET['type']) $active = "active"; ?>
											<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																				 href="index.php?com=news&act=man_sub&type=<?= $k ?>"
																				 title="Danh mục cấp 4"><i
														class="nav-icon text-sm far fa-caret-square-right"></i><span>Danh mục cấp 4</span></a>
											</li>
										<?php } ?>
										<?php
										$none = "";
										$active = "";
										if (isset($kiemtra) && $kiemtra == true) if ($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
										if ($com == 'news' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type']) $active = "active";
										?>
										<li class="nav-item <?= $none ?>"><a class="nav-link collapsed <?= $active ?>"
																			 href="index.php?com=news&act=man&type=<?= $k ?>"
																			 title="<?= $v['title_main'] ?>"><i
													class="nav-icon text-sm far fa-caret-square-right"></i><span><?= $v['title_main'] ?></span></a>
										</li>
									</ul>
								</li>
							<?php }
						}
					} ?>
				<?php } ?>
 
			</ul>
		</aside>


		<?php
	}
}
?>

<style>
	ul.nav.nav-treeview {
		margin-left: 2rem;
		display: block;
		font-size: 1rem;
	}

	.right {
		position: absolute;
		right: 10px;
		font-weight: 600;
	}
</style>

<script>

	$(document).ready(function () {
		$('.collapsed').collapse()


	});
</script>
