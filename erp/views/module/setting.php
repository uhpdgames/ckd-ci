<?php
$options = (isset($item['options']) && $item['options'] != '') ? json_decode($item['options'],true) : null;
?>

<?php
//$att = array('class'=>"validation-form", 'novalidate'=>true, 'method'=>"post", 'enctype'=>"multipart/form-data");
//echo form_open($com.'/save',$att);
//?>

<?php
if ($this->session->flashdata('msg') != ''):
	?>
	<div class="alert alert-success rounded" role="alert">
		<?=$this->session->flashdata('msg')?>
	</div>
	<?php
endif;
?>
<?php if(!empty($error)):?>
<div class="alert alert-danger rounded" role="alert">
	<?=(isset($error)) ? $error : "";?>
</div>
<?php endif;?>
<div class="container-fluid">

	<div class="row">
		<div class="col-12" id="accordion">

			<div class="card d-flex mb-3">
				<div style="cursor: pointer" class="d-flex flex-grow-1 min-width-zero" data-toggle="collapse" data-target="#collapseOne"
					 aria-expanded="true" aria-controls="collapseOne">
					<a class="card-body btn btn-empty list-item-heading text-left text-one">
						<i class="simple-icon-badge"></i>&nbsp;Thông tin chung
					</a>
				</div>
				<div id="collapseOne" class="collapse show" data-parent="#accordion">
						<div class="card-body">
							<div class="card-outline card-outline-tabs">
								<div class="p-0 border-bottom-0">
									<ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
										<?php foreach($config['website']['lang'] as $k => $v) { ?>
											<li class="nav-item">
												<a class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?=$k?>" role="tab" aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></a>
											</li>
										<?php } ?>
									</ul>
								</div>
								<div class="mt-4 card-article">
									<div class="tab-content" id="custom-tabs-three-tabContent-lang">
										<?php foreach($config['website']['lang'] as $k => $v) { ?>
											<div class="tab-pane fade show <?=($k=='vi')?'active':''?>" id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang">
												<div class="form-group">
													<label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
													<input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>" <?=($k=='vi')?'required':''?>>
												</div>

												<?php if(isset($config['setting']['slogan']) && $config['setting']['slogan'] == true) { ?>
													<div class="form-group">
														<label for="slogan<?=$k?>">SLogan (<?=$k?>):</label>
														<textarea class="form-control for-seo form-control-ckeditor" name="data[slogan<?=$k?>]" id="slogan<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['slogan'.$k])?></textarea>
													</div>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>

							<?php if(count($config['website']['lang']) > 1) { ?>
								<div class="form-group">
									<label>Ngôn ngữ mặc định:</label>
									<div class="form-group">
										<?php foreach($config['website']['lang'] as $k => $v) { ?>
											<div class="custom-control custom-radio d-inline-block mr-3 text-md">
												<input class="custom-control-input" type="radio" id="lang_default-<?=$k?>" name="data[options][lang_default]" <?=($k=='vi' ? "checked" : ($k==$options['lang_default'])) ? "checked" : ""?> value="<?=$k?>">
												<label for="lang_default-<?=$k?>" class="custom-control-label font-weight-normal"><?=$v?></label>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>


							<div class="row">
									<div class="form-group col-md-4 col-sm-6">
										<label for="diachi">Địa chỉ:</label>
										<input type="text" class="form-control" name="data[options][diachi]" id="diachi" placeholder="Địa chỉ" value="<?=$options['diachi']?>">
									</div>


									<div class="form-group col-md-4 col-sm-6">
										<label for="email">Email:</label>
										<input type="email" class="form-control" name="data[options][email]" id="email" placeholder="Email" value="<?=$options['email']?>">
									</div>


									<div class="form-group col-md-4 col-sm-6">
										<label for="hotline">Hotline:</label>
										<input type="text" class="form-control" name="data[options][hotline]" id="hotline" placeholder="Hotline" value="<?=$options['hotline']?>">
									</div>


									<div class="form-group col-md-4 col-sm-6">
										<label for="dienthoai">Điện thoại:</label>
										<input type="text" class="form-control" name="data[options][dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=$options['dienthoai']?>">
									</div>


									<div class="form-group col-md-4 col-sm-6">
										<label for="zalo">Zalo:</label>
										<input type="text" class="form-control" name="data[options][zalo]" id="zalo" placeholder="Zalo" value="<?=$options['zalo']?>">
									</div>


									<div class="form-group col-md-4 col-sm-6">
										<label for="oaidzalo">OAID Zalo:</label>
										<input type="text" class="form-control" name="data[options][oaidzalo]" id="oaidzalo" placeholder="OAID Zalo" value="<?=$options['oaidzalo']?>">
									</div>




									<div class="form-group col-md-4 col-sm-6">
										<label for="inter">Istargram:</label>
										<input type="text" class="form-control" name="data[options][inter]" id="inter" placeholder="Istargram" value="<?=$options['inter']?>">
									</div>





									<div class="form-group col-md-4 col-sm-6">
										<label for="toado">Tọa độ google map:</label>
										<input type="text" class="form-control" name="data[options][toado]" id="toado" placeholder="Tọa độ google map" value="<?=$options['toado']?>">
									</div>



									<div class="form-group col-md-4 col-sm-6">
										<label for="slogan">Copyright:</label>
										<input type="text" class="form-control" name="data[options][copyright]" id="copyright" placeholder="copyright top" value="<?=$options['copyright']?>">
									</div>


									<div class="form-group col-md-4 col-sm-6">
										<label for="chiduong">Chỉ đường:</label>
										<input type="text" class="form-control" name="data[options][chiduong]" id="chiduong" placeholder="Link chỉ đường" value="<?=$options['chiduong']?>">
									</div>


									<div class="form-group col-md-4 col-sm-6">
										<label for="giohoatdong">Giờ hoạt động:</label>
										<input type="text" class="form-control" name="data[options][giohoatdong]" id="giohoatdong" placeholder="Giờ hoạt động" value="<?=$options['giohoatdong']?>">
									</div>

							</div>

								<div class="form-group">
									<label for="toado_iframe">
										<span>Tọa độ google map iframe:</span>
										<a class="text-sm font-weight-normal ml-1" href="https://www.google.com/maps" target="_blank" title="Lấy mã nhúng google map">(Lấy mã nhúng)</a>
									</label>
									<textarea class="form-control" name="data[options][toado_iframe]" id="toado_iframe" rows="5" placeholder="Tọa độ google map iframe"><?=htmlspecialchars_decode($options['toado_iframe'])?></textarea>
								</div>

							<div class="form-group">
								<label for="analytics">Google analytics:</label>
								<textarea class="form-control" name="data[analytics]" id="analytics" rows="5" placeholder="Google analytics"><?=htmlspecialchars_decode(@$item['analytics'])?></textarea>
							</div>
							<div class="form-group">
								<label for="headjs">Head JS:</label>
								<textarea class="form-control" name="data[headjs]" id="headjs" rows="5" placeholder="Head JS"><?=htmlspecialchars_decode(@$item['headjs'])?></textarea>
							</div>
							<div class="form-group">
								<label for="bodyjs">Body JS:</label>
								<textarea class="form-control" name="data[bodyjs]" id="bodyjs" rows="5" placeholder="Body JS"><?=htmlspecialchars_decode(@$item['bodyjs'])?></textarea>
							</div>

						</div>

				</div>

				<div style="cursor: pointer" class="d-flex flex-grow-1 min-width-zero" data-toggle="collapse" data-target="#collapseTwo"
					 aria-expanded="true" aria-controls="collapseTwo">
					<a class="card-body btn btn-empty list-item-heading text-left text-one">
						<i class="iconsminds-align-justify-all"></i>&nbsp;Phân trang
					</a>
				</div>

				<div id="collapseTwo" class="collapse show" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="form-group col-md-4 col-sm-6">
								<label for="soluong_sp">Số S.phẩm phân trang:</label>
								<input type="text" class="form-control" name="data[options][soluong_sp]" id="soluong_sp" placeholder="Số lượng phân trang" value="<?=$options['soluong_sp']?>">
							</div>

							<div class="form-group col-md-4 col-sm-6">
								<label for="soluong_spk">Số S.phẩm liên quan phân trang:</label>
								<input type="text" class="form-control" name="data[options][soluong_spk]" id="soluong_spk" placeholder="Số lượng phân trang" value="<?=$options['soluong_spk']?>">
							</div>

							<div class="form-group col-md-4 col-sm-6">
								<label for="soluong_tin">Số Tin phân trang:</label>
								<input type="text" class="form-control" name="data[options][soluong_tin]" id="soluong_tin" placeholder="Số lượng phân trang" value="<?=$options['soluong_tin']?>">
							</div>

							<div class="form-group col-md-4 col-sm-6">
								<label for="soluong_tink">Số tin liên quan phân trang:</label>
								<input type="text" class="form-control" name="data[options][soluong_tink]" id="soluong_tink" placeholder="Số lượng phân trang" value="<?=$options['soluong_tink']?>">
							</div>

						</div>
					</div>
				</div>



				<div style="cursor: pointer" class="d-flex flex-grow-1 min-width-zero" data-toggle="collapse" data-target="#collapseThree"
					 aria-expanded="true" aria-controls="collapseThree">
					<a class="card-body btn btn-empty list-item-heading text-left text-one">
						<i class="iconsminds-google"></i>&nbsp;Meta tags
					</a>
				</div>


				<div id="collapseThree" class="collapse show" data-parent="#accordion">
					<div class="card-body">
						<div class="row">

							<div class="form-group col-12">
								<label for="soluong_sp">Thông tin meta</label>


									<?php /*= htmlspecialchars_decode(implode("\n",get_meta_tags('https://ckdvietnam.com/')));*/?>
								<textarea rows="20" class="form-control">
								 <?php

								 $meta = get_meta_tags('https://ckdvietnam.com/');

								 echo"\n";
								 echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
								 foreach ($meta as $name => $content) {
									 echo"\n";
									 echo '<meta name="' . $name . '" content="' . $content . '"/>';
								 }
								 echo"\n";

								 ?>
								</textarea>
							</div>


						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="form-group col-md-1 col-sm-6">
							<label class="col-12 col-form-label">Cache Website</label>
							<div class="col-12">
								<div class="custom-switch custom-switch-primary mb-2">
									<input class="custom-switch-input" id="cache_on" type="checkbox">
									<label class="custom-switch-btn" for="cache_on"></label>
								</div>
							</div>
						</div>

						<div class="form-group col-md-1 col-sm-6">
							<label class="col-12 col-form-label">Bảo trì Website</label>
							<div class="col-12">
								<div class="custom-switch custom-switch-primary mb-2">
									<input class="custom-switch-input" id="switch" type="checkbox">
									<label class="custom-switch-btn" for="switch"></label>
								</div>
							</div>
						</div>
						<div class="form-group col-md-1 col-sm-6">
							<label class="col-12 col-form-label">Tắt lỗi hệ thống</label>
							<div class="col-12">
								<div class="custom-switch custom-switch-primary mb-2">
									<input class="custom-switch-input" id="error_off" type="checkbox">
									<label class="custom-switch-btn" for="error_off"></label>
								</div>
							</div>
						</div>
						<div class="form-group col-md-1 col-sm-6">
							<label class="col-12 col-form-label">Debug website</label>
							<div class="col-12">
								<div class="custom-switch custom-switch-primary mb-2">
									<input class="custom-switch-input" id="debug" type="checkbox">
									<label class="custom-switch-btn" for="debug"></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
		</div>
	</div>
</div>
<?=form_close()?>

<!-- Setting js -->
<script type="text/javascript">
	$(document).ready(function(){
		$(".mailertype").click(function(){
			var value = parseInt($(this).val());

			if(value == 1)
			{
				$(".host-email").removeClass("d-none");
				$(".host-email").addClass("d-block");
				$(".gmail-email").removeClass("d-block");
				$(".gmail-email").addClass("d-none");
			}
			if(value == 2)
			{
				$(".gmail-email").removeClass("d-none");
				$(".gmail-email").addClass("d-block");
				$(".host-email").removeClass("d-block");
				$(".host-email").addClass("d-none");
			}
		})
	})
</script>
