<div class="main_fix my-5">

	<div class="title-main">
		<span><?= getLang('lichsu') ?></span>
	</div>

	<div class="donhang">


		<?php if (is_array($order) && count($order)) {
			foreach ($order as $k => $v) { ?>
				<?php
				$tinhtrang = $d->rawQueryOne("select trangthai from #_status where id = ?", array($v['tinhtrang']));
				$order_detail = $d->rawQuery("select * from #_order_detail where id_order = ?", array($v['id']));
				?>
				<div class="item_dh">
					<p class="tinhtrang"><?= $tinhtrang['trangthai'] ?><span><?= date('d/m/Y', $v['ngaytao']) ?></span>
					</p>
					<ul>
						<?php foreach ($order_detail as $k2 => $v2) { ?>
							<li>
								<div class="img_dh">
									<p class="img">
										<img src="<?php UPLOAD_PRODUCT_L . $v2['photo'] ?>"
											 alt="<?= $v2['ten'] ?>">
										<span>x <?= $v2['soluong'] ?></span>
									</p>
									<h4><?= $v2['ten'] ?></h4>
								</div>
								<p class="gia"><?= format_money($v2['gia'] * $v2['soluong']) ?></p>
							</li>
						<?php } ?>
					</ul>
					<p class="tongtien"><?= getLang('tongtien') ?>: <?= format_money($v['tonggia']) ?></p>
				</div>
			<?php }
		} ?>
	</div>

</div>
