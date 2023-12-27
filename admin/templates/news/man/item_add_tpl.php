<?php
	if($act=="add") $labelAct = "Thêm mới";
	else if($act=="edit") $labelAct = "Chỉnh sửa";
	else if($act=="copy")  $labelAct = "Sao chép";

	$linkMan = "index.php?com=news&act=man&type=".$type."&p=".$curPage;
	if($act=='add') $linkFilter = "index.php?com=news&act=add&type=".$type."&p=".$curPage;
	else if($act=='edit') $linkFilter = "index.php?com=news&act=edit&type=".$type."&p=".$curPage."&id=".$id;
    if($act=="copy") $linkSave = "index.php?com=news&act=save_copy&type=".$type."&p=".$curPage;
    else $linkSave = "index.php?com=news&act=save&type=".$type."&p=".$curPage;


    $options2 = (isset($item['options2']) && $item['options2'] != '') ? json_decode($item['options2'],true) : null;

    /* Check cols */
    if(isset($config['news'][$type]['gallery']) && count($config['news'][$type]['gallery']) > 0)
    {
        foreach($config['news'][$type]['gallery'] as $key => $value)
        {
            if($key == $type)
            {
                $flagGallery = true;
                break;
            }
        }
    }

    if(
        (isset($config['news'][$type]['dropdown']) && $config['news'][$type]['dropdown'] == true) || 
        (isset($config['news'][$type]['tags']) && $config['news'][$type]['tags'] == true) || 
        (isset($config['news'][$type]['images']) && $config['news'][$type]['images'] == true))
    {
        $colLeft = "col-xl-8";
        $colRight = "col-xl-4";
    }
    else
    {
        $colLeft = "col-12";
        $colRight = "d-none";   
    }
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><?=$labelAct?> <?=$config['news'][$type]['title_main']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-warning rounded-pill submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-success rounded-pill submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-info rounded-pill"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-danger rounded-pill" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
            <div class="<?=$colLeft?>">
                <?php
                    if(isset($config['news'][$type]['slug']) && $config['news'][$type]['slug'] == true)
                    {
                        $slugchange = ($act=='edit') ? 1 : 0;
                        $copy = ($act!='copy') ? 0 : 1;
                        include TEMPLATE.LAYOUT."slug.php";
                    }
                ?>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung <?=$config['news'][$type]['title_main']?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?=($k=='vi')?'active':''?>" id="tabs-lang" data-toggle="pill" href="#tabs-lang-<?=$k?>" role="tab" aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="card-body card-article">
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                        <div class="tab-pane fade show <?=($k=='vi')?'active':''?>" id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang">
                                            <div class="form-group">
                                                <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                                <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>" <?=($k=='vi')?'required':''?>>
                                            </div>

                                          
                                            
                                            <?php if(isset($config['news'][$type]['mota']) && $config['news'][$type]['mota'] == true) { ?>
                                                <div class="form-group">
                                                    <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                                    <textarea class="form-control for-seo <?=(isset($config['news'][$type]['mota_cke']) && $config['news'][$type]['mota_cke'] == true)?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                                </div>
                                            <?php } ?>
                                            <?php if(isset($config['news'][$type]['noidung']) && $config['news'][$type]['noidung'] == true) { ?>
                                                <div class="form-group">
                                                    <label for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                                    <textarea class="form-control for-seo <?=(isset($config['news'][$type]['noidung_cke']) && $config['news'][$type]['noidung_cke'] == true)?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="<?=$colRight?>">
                <?php if(
                    (isset($config['news'][$type]['dropdown']) && $config['news'][$type]['dropdown'] == true) || 
                    (isset($config['news'][$type]['tags']) && $config['news'][$type]['tags'] == true)
                ) { ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Danh mục <?=$config['news'][$type]['title_main']?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group-category row">
                                <?php if(isset($config['news'][$type]['dropdown']) && $config['news'][$type]['dropdown'] == true) { ?>
                                    <?php if(isset($config['news'][$type]['list']) && $config['news'][$type]['list'] == true) { ?>
                                        <div class="form-group col-xl-6 col-sm-4">
                                            <label class="d-block" for="id_list">Danh mục cấp 1:</label>
                                            <?=$func->get_ajax_category('news', 'list', $type)?>
                                        </div>
                                    <?php } ?>

                                    

                                    <?php if(isset($config['news'][$type]['cat']) && $config['news'][$type]['cat'] == true) { ?>
                                        <div class="form-group col-xl-6 col-sm-4">
                                            <label class="d-block" for="id_cat">Danh mục cấp 2:</label>
                                            <?=$func->get_ajax_category('news', 'cat', $type)?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($config['news'][$type]['item']) && $config['news'][$type]['item'] == true) { ?>
                                        <div class="form-group col-xl-6 col-sm-4">
                                            <label class="d-block" for="id_item">Danh mục cấp 3:</label>
                                            <?=$func->get_ajax_category('news', 'item', $type)?>
                                        </div>
                                    <?php } ?>
                                    <?php if(isset($config['news'][$type]['sub']) && $config['news'][$type]['sub'] == true) { ?>
                                        <div class="form-group col-xl-6 col-sm-4">
                                            <label class="d-block" for="id_sub">Danh mục cấp 4:</label>
                                            <?=$func->get_ajax_category('news', 'sub', $type)?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <?php if(isset($config['news'][$type]['tags']) && $config['news'][$type]['tags'] == true) { ?>
                                    <div class="form-group col-xl-6 col-sm-4">
                                        <label class="d-block" for="id_tags">Danh mục tags:</label>
                                        <?=$func->get_tags(@$item['id'], 'tags_group', 'news', $type)?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
                <?php if(isset($config['news'][$type]['images']) && $config['news'][$type]['images'] == true) { ?>
                    <div class="card card-primary card-outline text-sm">
                        
                        <?php if(isset($config['news'][$type]['sanpham']) && $config['news'][$type]['sanpham'] == true) { ?>
                            <div class="form-group col-xl-12 col-sm-12">
                                <label class="d-block" for="id_list">Sản phẩm:</label>
                                <?=$func->get_them('product', 'san-pham','id_list', 'Chọn sản phẩm')?>
                            </div>
                        <?php } ?>

                        <div class="card-header">
                            <h3 class="card-title">Hình ảnh <?=$config['news'][$type]['title_main']?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $photoDetail = ($act != 'copy') ? UPLOAD_NEWS.@$item['photo'] : '';
                                $dimension = "Width: ".$config['news'][$type]['width']." px - Height: ".$config['news'][$type]['height']." px (".$config['news'][$type]['img_type'].")";
                                include TEMPLATE.LAYOUT."image.php";
                            ?>
                        </div>
                    </div>
                <?php } ?>

                 <?php if(isset($config['news'][$type]['sanpham']) && $config['news'][$type]['sanpham'] == true) { ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình đại diện</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $photoDetailicon = ($act != 'copy') ? UPLOAD_NEWS.@$item['icon'] : '';
                                $dimensionicon = "Width: ".$config['news'][$type]['width']." px - Height: ".$config['news'][$type]['height']." px (".$config['news'][$type]['img_type'].")";
                                include TEMPLATE.LAYOUT."icon.php";
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin <?=$config['news'][$type]['title_main']?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                <?php if(isset($config['news'][$type]['gia']) && $config['news'][$type]['gia'] == true) { ?>
                    <div class="form-group col-md-4">
                        <label class="d-block" for="gia1">Giá từ:</label>
                        <div class="input-group">
                            <input type="text" class="form-control format-price gia_ban" name="data[gia1]" id="gia1" placeholder="Giá từ" value="<?=@$item['gia1']?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><strong>VNĐ</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="d-block" for="gia2">Giá đến:</label>
                        <div class="input-group">
                            <input type="text" class="form-control format-price gia_ban" name="data[gia2]" id="gia2" placeholder="Giá đến" value="<?=@$item['gia2']?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><strong>VNĐ</strong></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if(isset($config['news'][$type]['dientich']) && $config['news'][$type]['dientich'] == true) { ?>
                    <div class="form-group col-md-4">
                        <label class="d-block" for="gia1">Diện tích từ:</label>
                        <div class="input-group">
                            <input type="text" class="form-control format-price dientich_ban" name="data[gia1]" id="gia1" placeholder="Diện tích từ" value="<?=@$item['gia1']?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><strong>m²</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="d-block" for="gia2">Diện tích đến:</label>
                        <div class="input-group">
                            <input type="text" class="form-control format-price dientich_ban" name="data[gia2]" id="gia2" placeholder="Diện tích đến" value="<?=@$item['gia2']?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><strong>m²</strong></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if(isset($config['news'][$type]['link']) && $config['news'][$type]['link'] == true) { ?>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="motavi">Link:</label>
                        <input type="text" class="form-control" name="data[motavi]" id="motavi" placeholder="Link" value="<?=$item['motavi']?>">
                    </div>
                <?php } ?>


                <?php if(isset($config['news'][$type]['sanpham']) && $config['news'][$type]['sanpham'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="sosao">Số sao:</label>
                        <input type="text" class="form-control" name="data[options2][sosao]" id="sosao" placeholder="Số sao" value="<?=$options2['sosao']?>">
                    </div>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="thoigian">Thời gian:</label>
                        <input type="text" class="form-control" name="data[options2][thoigian]" id="thoigian" placeholder="Thời gian" value="<?=$options2['thoigian']?>">
                    </div>
                <?php } ?>

                <?php if(isset($config['news'][$type]['dienthoai']) && $config['news'][$type]['dienthoai'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="dienthoai">Điện thoại:</label>
                        <input type="text" class="form-control" name="data[options2][dienthoai]" id="dienthoai" placeholder="Điện thoại" value="<?=$options2['dienthoai']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['news'][$type]['email']) && $config['news'][$type]['email'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="data[options2][email]" id="email" placeholder="Email" value="<?=$options2['email']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['news'][$type]['website']) && $config['news'][$type]['website'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="website">Website:</label>
                        <input type="text" class="form-control" name="data[options2][website]" id="website" placeholder="Website" value="<?=$options2['website']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['news'][$type]['facebook']) && $config['news'][$type]['facebook'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="facebook">Facebook:</label>
                        <input type="text" class="form-control" name="data[options2][facebook]" id="facebook" placeholder="Facebook" value="<?=$options2['facebook']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['news'][$type]['zalo']) && $config['news'][$type]['zalo'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="zalo">Zalo:</label>
                        <input type="text" class="form-control" name="data[options2][zalo]" id="zalo" placeholder="Zalo" value="<?=$options2['zalo']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['news'][$type]['skype']) && $config['news'][$type]['skype'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="skype">Skype:</label>
                        <input type="text" class="form-control" name="data[options2][skype]" id="skype" placeholder="Skype" value="<?=$options2['skype']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['news'][$type]['chucvu']) && $config['news'][$type]['chucvu'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="chucvu">Chức vụ:</label>
                        <input type="text" class="form-control" name="data[options2][chucvu]" id="chucvu" placeholder="Chức vụ" value="<?=$options2['chucvu']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['news'][$type]['bando']) && $config['news'][$type]['bando'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="bando">Bản đồ:</label>                        
                        <textarea class="form-control for-seo" name="data[options2][bando]" id="bando" rows="5" placeholder="Bản đồ"><?=htmlspecialchars_decode(@$options2['bando'])?></textarea>
                    </div>
                <?php } ?>
                <?php if(isset($config['news'][$type]['diachi']) && $config['news'][$type]['diachi'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="diachi">Địa chỉ:</label>                        
                        <textarea class="form-control for-seo" name="data[options2][diachi]" id="diachi" rows="5" placeholder="Địa chỉ"><?=htmlspecialchars_decode(@$options2['diachi'])?></textarea>
                    </div>
                <?php } ?>
                </div>
                <div class="form-group">
                    <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                        <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                        <label for="hienthi-checkbox" class="custom-control-label"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
                </div>
            </div>
        </div>
        <?php if(isset($flagGallery) && $flagGallery == true) { ?>
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Bộ sưu tập <?=$config['news'][$type]['title_main']?></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="filer-gallery" class="label-filer-gallery mb-3">Album hình: (<?=$config['news'][$type]['gallery'][$key]['img_type_photo']?>)</label>
                        <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
                        <input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                        <input type="hidden" class="act-filer" value="man">
                        <input type="hidden" class="folder-filer" value="news">
                    </div>
                    <?php if(isset($gallery) && count($gallery) > 0) { ?>
                        <div class="form-group form-group-gallery">
                            <label class="label-filer">Album hiện tại:</label>
                            <div class="action-filer mb-3">
                                <a class="btn btn-primary rounded-pill check-all-filer mr-1"><i class="far fa-square mr-2"></i>Chọn tất cả</a>
                                <button type="button" class="btn btn-success rounded-pill text-white sort-filer mr-1"><i class="fas fa-random mr-2"></i>Sắp xếp</button>
                                <a class="btn btn-danger rounded-pill delete-all-filer"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
                            </div>
                            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"><i class="fas fa-info-circle mr-2"></i>Có thể chọn nhiều hình để di chuyển</div>
                            <div class="jFiler-items my-jFiler-items jFiler-row">
                                <ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
                                    <?php foreach($gallery as $v) echo $func->galleryFiler($v['stt'],$v['id'],$v['photo'],$v['tenvi'],'news','col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6'); ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if(isset($config['news'][$type]['seo']) && $config['news'][$type]['seo'] == true) { ?>
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Nội dung SEO</h3>
                    <a class="btn btn-success rounded-pill d-inline-block text-white float-right create-seo" title="Tạo SEO">Tạo SEO</a>
                </div>
                <div class="card-body">
                    <?php
                        $seoDB = $seo->getSeoDB($id,$com,'man',$type);
                        include TEMPLATE.LAYOUT."seo.php";
                    ?>
                </div>
            </div>
        <?php } ?>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-warning rounded-pill submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-success rounded-pill submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-info rounded-pill"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-danger rounded-pill" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>