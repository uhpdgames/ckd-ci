<?php
	$linkView = $config_base .'';
    $khuyenmai = (isset($_REQUEST['khuyenmai'])) ? htmlspecialchars($_REQUEST['khuyenmai']) : "0";
	$linkMan = $linkFilter = "index.php?com=product&act=man&type=".$type."&p=".$curPage;
	$linkAdd = "index.php?com=product&act=add&type=".$type."&p=".$curPage . "&khuyenmai=". $khuyenmai;
    $linkCopy = "index.php?com=product&act=copy&type=".$type."&p=".$curPage . "&khuyenmai=". $khuyenmai;
    $linkEdit = "index.php?com=product&act=edit&type=".$type."&p=".$curPage . "&khuyenmai=". $khuyenmai;
    $linkDelete = "index.php?com=product&act=delete&type=".$type."&p=".$curPage . "&khuyenmai=". $khuyenmai;
    $linkMulti = "index.php?com=product&act=man_photo&kind=man&type=".$type."&p=".$curPage . "&khuyenmai=". $khuyenmai;
    $copyImg = (isset($config['product'][$type]['copy_image']) && $config['product'][$type]['copy_image'] == true) ? TRUE : FALSE;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý <?=$config['product'][$type]['title_main']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
    	<a class="btn btn-primary rounded-pill" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-danger rounded-pill" id="delete-all" data-url="<?=$linkDelete?><?=$strUrl?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <div class="form-inline form-search d-inline-block align-middle ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?=(isset($_GET['keyword'])) ? $_GET['keyword'] : ''?>" onkeypress="doEnter(event,'keyword','<?=$linkMan?>')">
                <div class="input-group-append bg-primary rounded-right">
                    <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','<?=$linkMan?>')">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php if(
        (isset($config['product'][$type]['dropdown']) && $config['product'][$type]['dropdown'] == true) || 
        (isset($config['product'][$type]['brand']) && $config['product'][$type]['brand'] == true)
    ) { ?>
	    <div class="card-footer form-group-category text-sm bg-light row">
			<?php if(isset($config['product'][$type]['list']) && $config['product'][$type]['list'] == true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=$func->get_link_category('product', 'list', $type)?></div>
			<?php } ?>
			<?php if(isset($config['product'][$type]['cat']) && $config['product'][$type]['cat'] == true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=$func->get_link_category('product', 'cat', $type)?></div>
			<?php } ?>
			<?php if(isset($config['product'][$type]['item']) && $config['product'][$type]['item'] == true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=$func->get_link_category('product', 'item', $type)?></div>
			<?php } ?>
			<?php if(isset($config['product'][$type]['sub']) && $config['product'][$type]['sub'] == true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=$func->get_link_category('product', 'sub', $type)?></div>
			<?php } ?>
			<?php if(isset($config['product'][$type]['brand']) && $config['product'][$type]['brand'] == true) { ?>
				<div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=$func->get_link_category('product', 'brand', $type, 'Chọn hãng')?></div>
			<?php } ?>
	    </div>
	<?php } ?>
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách <?=$config['product'][$type]['title_main']?></h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="align-middle" width="5%">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label for="selectall-checkbox" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="align-middle text-center" width="2%">STT</th>
                        <th class="align-middle text-center" width="2%">CODE</th>
						<?php if(isset($config['product'][$type]['show_images']) && $config['product'][$type]['show_images'] == true) { ?>
							<th class="align-middle">Hình</th>
						<?php } ?>
						<th class="align-middle" style="width:30%">Tiêu đề</th>
						<?php if(isset($config['product'][$type]['gallery']) && count($config['product'][$type]['gallery']) > 0) { ?>
							<th class="align-middle">Gallery</th>
						<?php } ?>
                        <th class="align-middle">SL tồn</th>
                        <th class="align-middle text-center">Đã bán</th>
						<?php if(isset($config['product'][$type]['check'])) { foreach($config['product'][$type]['check'] as $key => $value) { ?>
							<th class="align-middle text-center"><?=$value?></th>
						<?php } } ?>
						<th class="align-middle text-center">Hiển thị</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                </thead>
                <?php if(empty($items)) { ?>
                    <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                <?php } else { ?>
                    <tbody>
                        <?php for($i=0;$i<count($items);$i++) {
                        	$linkID = "";
							if($items[$i]['id_list']) $linkID .= "&id_list=".$items[$i]['id_list'];
							if($items[$i]['id_cat']) $linkID .= "&id_cat=".$items[$i]['id_cat'];
							if($items[$i]['id_item']) $linkID .= "&id_item=".$items[$i]['id_item'];
							if($items[$i]['id_sub']) $linkID .= "&id_sub=".$items[$i]['id_sub'];
							if($items[$i]['id_brand']) $linkID .= "&id_brand=".$items[$i]['id_brand'];
                            if($items[$i]['id_thuonghieu']) $linkID .= "&id_thuonghieu=".$items[$i]['id_thuonghieu'];
                            if($items[$i]['id_dong']) $linkID .= "&id_dong=".$items[$i]['id_dong'];


                           // var_dump(THUMBS.'/'.$config['product'][$type]['thumb'].'/'.UPLOAD_PRODUCT_L.$items[$i]['photo']);die;
                        ?>
                            <tr>
                                <td class="align-middle">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                        <label for="select-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle">

                                    <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="product">
                                </td>
                                <td class="align-middle">
                                    <span style="color:red;font-weight: bold"><?=$items[$i]['masp'];?></span>
                                </td>
                                <?php if(isset($config['product'][$type]['show_images']) && $config['product'][$type]['show_images'] == true) { ?>
                                    <td class="align-middle">
                                    	<a href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>">


                                            <img class="rounded img-preview"


                                                 src="<?=$config_base.'upload/product/'.$items[$i]['photo']?>"


                                                 alt="<?=$items[$i]['tenvi']?>">


                                        </a>



                                    </td>
                                <?php } ?>

                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><?=$items[$i]['tenvi']?></a>
                                    <div class="tool-action mt-2 w-clear">
                                    	<?php if(isset($config['product'][$type]['view']) && $config['product'][$type]['view'] == true) { ?>
                                    		<a class="text-primary mr-3" href="<?=$linkView?><?=$items[$i]['tenkhongdauvi']?>" target="_blank" title="<?=$items[$i]['tenvi']?>"><i class="far fa-eye mr-1"></i>View</a>
                                    	<?php } ?>
                                    	<a class="text-info mr-3" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><i class="far fa-edit mr-1"></i>Edit</a>
                                    	<?php if(isset($config['product'][$type]['copy']) && $config['product'][$type]['copy'] == true) { ?>
                                    		<div class="dropdown">
			                            		<a id="dropdownCopy" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-success p-0 pr-3"><i class="far fa-clone mr-1"></i>Copy</a>
									            <ul aria-labelledby="dropdownCopy" class="dropdown-menu border-0 shadow">
									                <li><a href="#" class="dropdown-item copy-now" data-id="<?=$items[$i]['id']?>" data-table="product" data-copyimg="<?=$copyImg?>"><i class="far fa-caret-square-right text-secondary mr-2"></i>Sao chép ngay</a></li>
									                <li><a href="<?=$linkCopy?><?=$linkID?>&id_copy=<?=$items[$i]['id']?>" class="dropdown-item"><i class="far fa-caret-square-right text-secondary mr-2"></i>Chỉnh sửa thông tin</a></li>
									            </ul>
			                            	</div>
                                    	<?php } ?>
                                    	<a class="text-danger" id="delete-item" data-url="<?=$linkDelete?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['tenvi']?>"><i class="far fa-trash-alt mr-1"></i>Delete</a>

                                        <?php 
                                            $danhgia = $d->rawQuery("select id from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? order by stt,id desc",array($items[$i]['id'],$type,'video'));
                                            $danhgia2 = $d->rawQuery("select id from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi <=0 order by stt,id desc",array($items[$i]['id'],$type,'video'));
                                         ?>
                                        <a class="text-primary" href="index.php?com=product&act=man_photo&kind=man&type=<?=$type?>&p=1&idc=<?=$items[$i]['id']?>&val=video" title="<?=$items[$i]['tenvi']?>"><i class="fas fa-comment-dots" style="margin:0 5px 0 10px;"></i>Bình luận
                                            <p style="text-align: right; " class="ml-2">View: <span style="color:red;"><?=count($danhgia2);?></span>/<?=count($danhgia);?></p>
                                        </a>

                                        
                                    </div>
                                </td>

                               

                                <?php if(isset($config['product'][$type]['gallery']) && count($config['product'][$type]['gallery']) > 0) { ?>
		                            <td class="align-middle">
		                            	<div class="dropdown">
		                            		<button type="button" class="btn btn-success rounded-pill dropdown-toggle" id="dropdown-gallery" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thêm</button>
		                            		<div class="dropdown-menu" aria-labelledby="dropdown-gallery">
		                            			<?php foreach($config['product'][$type]['gallery'] as $key => $value) { ?>
					                                <a class="dropdown-item text-dark" href="<?=$linkMulti?>&idc=<?=$items[$i]['id']?>&val=<?=$key?>" title="<?=$value['title_sub_photo']?>"><i class="far fa-caret-square-right text-secondary mr-2"></i><?=$value['title_sub_photo']?></a>
					                            <?php } ?>
		                            		</div>
		                            	</div>
		                            </td>
		                        <?php } ?>

                                 <td class="align-middle"><?=$items[$i]['soluong']?></td>
                                <td class="align-middle"><?=$items[$i]['daban']?></td>
                                
                                <?php if(isset($config['product'][$type]['check'])) { foreach($config['product'][$type]['check'] as $key => $value) { ?>
								  	<td class="align-middle text-center">
	                                	<div class="custom-control custom-checkbox my-checkbox">
	                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" data-table="product" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" <?=($items[$i][$key])?'checked':''?>>
	                                        <label for="show-checkbox-<?=$key?>-<?=$items[$i]['id']?>" class="custom-control-label"></label>
	                                    </div>
	                                </td>
								<?php } } ?>
								<td class="align-middle text-center">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="product" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                        <label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-md text-nowrap">
                                	<?php if(isset($config['product'][$type]['copy']) && $config['product'][$type]['copy'] == true) { ?>
                                    	<div class="dropdown d-inline-block align-middle">
		                            		<a id="dropdownCopy" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-success p-0 pr-2"><i class="far fa-clone"></i></a>
								            <ul aria-labelledby="dropdownCopy" class="dropdown-menu border-0 shadow">
								                <li><a href="#" class="dropdown-item copy-now" data-id="<?=$items[$i]['id']?>" data-table="product"><i class="far fa-caret-square-right text-secondary mr-2"></i>Sao chép ngay</a></li>
								                <li><a href="<?=$linkCopy?><?=$linkID?>&id=<?=$items[$i]['id']?>" class="dropdown-item"><i class="far fa-caret-square-right text-secondary mr-2"></i>Chỉnh sửa thông tin</a></li>
								            </ul>
		                            	</div>
                                    <?php } ?>
                                    <a class="text-primary mr-2" href="<?=$linkEdit?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                    <a class="text-danger" id="delete-item" data-url="<?=$linkDelete?><?=$linkID?>&id=<?=$items[$i]['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php if($paging) { ?>
        <div class="card-footer text-sm pb-0"><?=$paging?></div>
    <?php } ?>
    <div class="card-footer text-sm">
    	<a class="btn btn-primary rounded-pill" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-danger rounded-pill" id="delete-all" data-url="<?=$linkDelete?><?=$strUrl?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
    </div>
</section>