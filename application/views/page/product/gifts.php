<?php

$hasGift = false;
$gifts = @json_decode($row_detail['gift']?? '');
if(!empty($gifts) && count($gifts) > 0){
	$hasGift = true;
	$gifts = (Array)$gifts;
}

?>
<?php if($hasGift == true && !empty($gifts['image']) && count($gifts['image']) > 0):?>
<div class="wp-gift pt-4 pb-4">
	<div class="sp_dis_container">
		<div class="row">
			<div class="col-8">
				<div class="sp_dis_title">
					Các sản phẩm tặng kèm
				</div>
				<div class="sp_dis_mota">
					Chọn 1 trong các quà tặng
				</div>
			</div>
			<div class="col-4 text-right p-0 m-0">
				<!--<div class="img-thumbnail_dis">
					<img class=" float-end"
						 width="50px"
						 src="assets/images/giftbox.png" alt="Hình ảnh"/>
				</div>-->
			</div>
		</div>

		<?php for ($i= 0 ; $i < count($gifts['image']) ; $i++):
			$stt = $i;
			$link = $gifts['image'][$i];
			$img = UPLOAD_PRODUCT_L . $link;
			$name = $gifts['name'][$i] ?? "";
			$desc = $gifts['desc'][$i] ?? "";

			$data = $this->session->userdata('has_quatang');
			if(!empty($data[$row_detail['masp']]) && $data[$row_detail['masp']] == $name){
				$check_name = 'checked="checked"';
			}else{
				$check_name ='';
			}

			?>

		<div class="container-voucher mt-4">
			<div class="row">
				<div class="col-1">
					<div class="form-check">
						<input name="chosen_gift" data-img="<?=$link?>" class="chosen_gift form-check-input" type="radio" id="gift-<?=$stt?>" value="<?=$name?>" <?=$check_name?>/>
					</div>
				</div>
				<div class="col-2 sp_img_dis">
					<img class="voucher-img" src="<?=$img?>" alt="Hình ảnh"/>
				</div>
				<div class="col-9 p-0 m-0">
					<div class="sp_cover_1">
						 <?= htmlspecialchars_decode($desc)?>

					</div>
				</div>
			</div>
		</div>
		<?php endfor; ?>

	</div>
</div>
<?php endif;?>
