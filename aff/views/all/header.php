<!--todo: HEADER-->
<script type="text/javascript">

	//img loader
	class SaveImage {
		constructor(name) {
			this.img = '';
			this.name = name;
		}

		set(i) {
			this.img = i

			localStorage.setItem(this.name, this.img);
		}

		get() {
			return this.img
		}

		check() {
			return localStorage.getItem(this.name);

		}
	}

	var empty_image = '<?= image_default('empty')?>'

	var key_all_image = 'myImage';
	$all_imgae = new SaveImage(key_all_image);

	var all_image = $all_imgae.check(key_all_image);
	if (all_image === null) {
		all_image = '<?=image_default('all')?>';

		if (typeof all_image != 'undefined' && all_image != '') {
			$all_imgae.set(all_image);
			console.log('store')
		}
	}
	if (typeof all_image != 'undefined' && all_image != '') {
		all_image = JSON.parse(all_image)

	}
</script>


<div id="header">
	<div id="sub_menu"></div>
	<?php if (!$aff):?>
	<div id="main_menu"></div>
	<?php else:?>
		<div id="menu_aff"></div>
	<?php endif;?>
    <?php /*$this->load->view('common/menu')*/?>
</div>
