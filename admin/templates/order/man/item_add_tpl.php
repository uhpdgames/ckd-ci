<?php
	$linkMan = "index.php?com=order&act=man&p=".$curPage;
    $linkSave = "index.php?com=order&act=save&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý đơn hàng">Quản lý đơn hàng</a></li>
                <li class="breadcrumb-item active">Thông tin đơn hàng <span class="text-primary">#<?=$item['madonhang']?></span></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" id="form_order" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-warning rounded-pill" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-info rounded-pill"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-danger rounded-pill" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin chính</h3>
            </div>
            <div class="card-body row">
                <div class="form-group col-md-4 col-sm-6">
					<label>Mã đơn hàng:</label>
					<p class="text-primary"><?=@$item['madonhang']?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Hình thức thanh toán:</label>
					<p class="text-info"><?=$func->get_payments(@$item['httt'])?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Họ tên:</label>
					<p class="font-weight-bold text-uppercase text-success"><?=@$item['hoten']?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Điện thoại:</label>
					<p><?=@$item['dienthoai']?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Email:</label>
					<p><?=@$item['email']?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Địa chỉ:</label>
					<p><?=@$item['diachi']?></p>
				</div>
				<?php if(isset($config['order']['ship']) && $config['order']['ship'] == true) { ?>
					<div class="form-group col-md-4 col-sm-6">
						<label>Phí vận chuyển:</label>
						<p class="font-weight-bold text-danger">
							<?php if(isset($item['phiship']) && $item['phiship'] > 0) { ?>
								<?=$func->format_money($item['phiship'])?>
							<?php } else { ?>
								Không
							<?php } ?>
						</p>
					</div>
				<?php } ?>
				<div class="form-group col-md-4 col-sm-6">
					<label>Ngày đặt:</label>
					<p><?=date("h:i:s A - d/m/Y", @$item['ngaytao'])?></p>
				</div>
				<div class="form-group col-md-4 col-sm-6">
					<label>Túi giấy:</label>
					<p><?= @$item['tui_giay'] ? 'Có kèm theo' : 'Không có túi';?></p>
				</div>
				<div class="form-group col-12">
					<label for="ghichu">Yêu cầu khác:</label>
					<textarea class="form-control" name="data[yeucaukhac]" id="yeucaukhac" rows="5" placeholder="Yêu cầu khác"><?=@$item['yeucaukhac']?></textarea>
				</div>
				<div class="form-group col-12">
					<label for="tinhtrang" class="mr-2">Tình trạng:</label>
					<?=$func->orderStatus(@$item['tinhtrang'])?>
				</div>
				<div class="form-group col-12">
					<label for="ghichu">Ghi chú:</label>
					<textarea class="form-control" name="data[ghichu]" id="ghichu" rows="5" placeholder="Ghi chú"><?=@$item['ghichu']?></textarea>
				</div>
			    <?php /* ?>
				    <div class="form-group">
	                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
	                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
	                </div>
	            <?php */ ?>
            </div>
        </div>
        <div class="card card-primary card-outline text-sm">
        	<div class="card-header">
                <h3 class="card-title">Thông tin vận đơn</h3>
            </div>
            <div class="card-body ">
            	<div class="row">
            		<div class="form-group col-md-4">
                        <label class="d-block" for="thuho">Tiền thu hộ:</label>
                        <div class="input-group">
                        	<input type="text" class="form-control format-price" <?=(!empty($item['id_tracking']))?'disabled':''?> name="json_order[thuho]" id="thuho" placeholder="Tiền thu hộ" value="<?=@$json_order['thuho']??$item['tamtinh']?>">
                        	<div class="input-group-append">
                        		<div class="input-group-text"><strong>VNĐ</strong></div>
                        	</div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="d-block" for="nguoitracuoi">Người trả cước:</label>
                        <select id="nguoitracuoi" <?=(!empty($item['id_tracking']))?'disabled':''?> name="json_order[nguoitracuoi]" class="form-control text-sm">
                        	<option value="1" <?=(@$json_order['nguoitracuoi']==1)?'selected':''?>>Người nhận trả</option>
                        	<option value="2" <?=(@$json_order['nguoitracuoi']==2)?'selected':''?>>Người gửi trả</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="d-block" for="khoiluong">Khối lượng kiện hàng:</label>
                        <div class="input-group">
                        	<input type="text" class="form-control format-price" <?=(!empty($item['id_tracking']))?'disabled':''?> name="json_order[khoiluong]" id="khoiluong" placeholder="Khối lượng kiện hàng" value="<?=@$json_order['khoiluong']??$item['khoiluong']?>">
                        	<div class="input-group-append">
                        		<div class="input-group-text"><strong>Gram</strong></div>
                        	</div>
                        </div>
                    </div>
                    <?php if(!empty($item['id_tracking'])){?>
                    <div class="form-group col-md-12">
                        <label class="d-block" for="id_tracking">Mã vận đơn:</label>
                        <input type="text" class="form-control" <?=(!empty($item['id_tracking']))?'disabled':''?> name="data[id_tracking]" id="id_tracking" placeholder="Mã vận đơn" value="<?=@$item['id_tracking']?>">
                    </div>
                    <div class="alert alert-danger w-100" role="alert">
					  <strong>Lưu ý:</strong> Đơn hàng đã tạo vận đơn, mọi vấn đề về cập nhật hoặc xóa đơn. Vui lòng cập nhật và xóa đơn trên hệ thống của Viettel Post!
					</div>
                	<?php }?>
                    <div class="form-group col-md-12 mb-0 text-center">
                    	<button type="button" id="taovandon"  <?=(!empty($item['id_tracking']))?'disabled':''?> class="btn btn-warning rounded-pill"><i class="fas fa-truck mr-2"></i>Tạo vận đơn</button>
                    </div>
            	</div>
            </div>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Chi tiết đơn hàng</h3>
            </div>
            <div class="card-body table-responsive p-0">
	            <table class="table table-hover">
	                <thead>
	                    <tr>
	                        <th class="align-middle text-center" width="10%">STT</th>
	                        <th class="align-middle">Hình ảnh</th>
	                        <th class="align-middle" style="width:30%">Tên sản phẩm</th>
	                        <th class="align-middle text-center">Đơn giá</th>
	                        <th class="align-middle text-right">Số lượng</th>
	                        <th class="align-middle text-right">Tạm tính</th>
	                    </tr>
	                </thead>
	                <?php if(empty($chitietdonhang)) { ?>
	                    <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
	                <?php } else { ?>
	                    <tbody>
	                        <?php foreach($chitietdonhang as $k => $v) { ?>
	                            <tr>
	                                <td class="align-middle text-center"><?=($k+1)?></td>
	                                <td class="align-middle">
	                                    <a title="<?=$v['ten']?>"><img class="rounded img-preview" src="<?= '../'.UPLOAD_PRODUCT_L.$v['photo']?>" alt="<?=$v['ten']?>"></a>
	                                </td>
	                                <td class="align-middle">
	                                	<p class="text-primary mb-1"><?=$v['ten']?></p>
										<?php if($v['mau']!='' || $v['size']!='') { ?>
											<p class="mb-0">
												<?php if($v['mau']!='') { ?>
													<span class="pr-2">Màu: <?=$v['mau']?></span>
												<?php } ?>
												<?php if($v['size']!='') { ?>
													<span>Size: <?=$v['size']?></span>
												<?php } ?>
											</p>
										<?php } ?>
	                                </td>
	                                <td class="align-middle text-center">
	                                	<div class="price-cart-detail">
											<?php if($v['giamoi']) { ?>
												<span class="price-new-cart-detail"><?=$func->format_money($v['giamoi'])?></span>
												<span class="price-old-cart-detail"><?=$func->format_money($v['gia'])?></span>
											<?php } else { ?>
												<span class="price-new-cart-detail"><?=$func->format_money($v['gia'])?></span>
											<?php } ?>
										</div>
	                                </td>
	                                <td class="align-middle text-right"><?=$v['soluong']?></td>
	                                <td class="align-middle text-right">
	                                	<div class="price-cart-detail">
											<?php if($v['giamoi']) { ?>
												<span class="price-new-cart-detail"><?=$func->format_money($v['giamoi']*$v['soluong'])?></span>
												<span class="price-old-cart-detail"><?=$func->format_money($v['gia']*$v['soluong'])?></span>
											<?php } else { ?>
												<span class="price-new-cart-detail"><?=$func->format_money($v['gia']*$v['soluong'])?></span>
											<?php } ?>
										</div>
	                                </td>
	                            </tr>
	                        <?php } ?>
	                        <?php if(
	                        	(isset($config['order']['ship']) && $config['order']['ship'] == true)
	                        ) { ?>
		                        <tr>
									<td colspan="5" class="title-money-cart-detail">Tạm tính:</td>
									<td colspan="1" class="cast-money-cart-detail"><?=$func->format_money($item['tamtinh'])?></td>
								</tr>
							<?php } ?>
							<?php if(isset($config['order']['ship']) && $config['order']['ship'] == true) { ?>
								<tr>
									<td colspan="5" class="title-money-cart-detail">Phí vận chuyển:</td>
									<td colspan="1" class="cast-money-cart-detail">
										<?php if($item['phiship']) { ?>
											<?=$func->format_money($item['phiship'])?>
										<?php } else { ?>
											Không
										<?php } ?>
									</td>
								</tr>


								<tr>
									<td colspan="5" class="title-money-cart-detail">Giảm giá:</td>
									<td colspan="1" class="cast-money-cart-detail">
										<?php if($item['giadagiam']) { ?>
											<?=$func->format_money($item['giadagiam'])?>
										<?php } else { ?>
											Không
										<?php } ?>
									</td>
								</tr>


							<?php } ?>
							<tr>
								<td colspan="5" class="title-money-cart-detail">Tổng giá trị đơn hàng:</td>
								<td colspan="1" class="cast-money-cart-detail"><?=$func->format_money($item['tonggia'])?></td>
							</tr>
	                    </tbody>
	                <?php } ?>
	            </table>
	        </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-warning rounded-pill" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-info rounded-pill"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-danger rounded-pill" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
            <input type="hidden" value="<?=isset($item['ref_uid']) ? $item['ref_uid'] : ''?>" name="ref_uid">
            <input type="hidden" value="<?=isset($item['ref_code']) ? $item['ref_code'] : ''?>" name="ref_code">
        </div>
    </form>
</section>
