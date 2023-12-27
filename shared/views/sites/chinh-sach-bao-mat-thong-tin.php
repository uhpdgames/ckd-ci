<div class="main_fix my-5">
	<?php
	$chinhsach = $d->rawQueryOne("select  noidung$lang as noidung from #_news where tenkhongdau$lang = ?", array($url));
	echo htmlspecialchars_decode($chinhsach['noidung']);
	?>
</div>
