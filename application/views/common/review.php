<div class="title-main mt-lg-4"><span><?= getLang('titlereview') ?></span></div>
<div
	class="review"> <?php $review = $d->rawQuery("select ten$lang as ten, id, photo,icon, type, mota$lang as mota,id_list from #_news where type = ? and hienthi > 0 order by stt,id desc limit 0,20", array('review'));
	foreach ($review as $k => $v) { ?><?php $product_rv = $d->rawQueryOne("select photo, ten$lang as ten, tenkhongdauvi, tenkhongdauen from #_product where type = ?  and hienthi > 0 and id='" . $v['id_list'] . "' order by stt,id desc limit 0,1", array('san-pham')); ?>
		<div class="item_rv"><p class="m-0 p-0 img_post zoom_hinh" data-id="<?= $v['id'] ?>"><img
					class="viewimg img-fluid cover" data-id="<?= $v['id'] ?>"
					src="<?= UPLOAD_NEWS_L . toWebpREVIEW($v['photo']); ?>" alt="<?= $v['ten'] ?>"></p>
			<div class="px-2"><p class="hinh_sp">
					<a class="w-100 h-100 a_review" href="<?=MYSITE?>san-pham/<?=$product_rv['tenkhongdauvi']??''?>">
						<img class="img-fluid"
							 src="<?= UPLOAD_NEWS_L . toWebpREVIEW($v['icon']) ?>"
							 alt="<?= $v['ten'] ?>"> <span><?= $v['ten'] ?></span>
					</a>

				</p>
				<p class="mota catchuoi4"><?= $v['mota'] ?></p></div>
		</div> <?php } ?> </div> <p class="xemtatca"><a href="review"><?= getLang('xemthem') ?></a></p>
<div class="all_review"></div>
