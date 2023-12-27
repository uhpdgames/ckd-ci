<?php
    $linkSave = "index.php?com=static&act=save&type=".$type;
    $options2 = (isset($item['options2']) && $item['options2'] != '') ? json_decode($item['options2'],true) : null;
    
    if(isset($config['static'][$type]['images']) && $config['static'][$type]['images'] == true)
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
                <li class="breadcrumb-item active">Quản lý trang tĩnh</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-warning rounded-pill submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-info rounded-pill"><i class="fas fa-redo mr-2"></i>Làm lại</button>
        </div>
        <div class="row">
            <div class="<?=$colLeft?>">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung <?=$config['static'][$type]['title_main']?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($config['static'][$type]['file']) && $config['static'][$type]['file'] == true) { ?>
                            <div class="form-group">
                                <label class="change-file mb-1 mr-2" for="file-taptin">
                                    <p>Upload tập tin:</p>
                                    <strong class="ml-2">
                                        <span class="btn btn-success rounded-pill"><i class="fas fa-file-upload mr-2"></i>Chọn tập tin</span>
                                        <div><b class="text-sm text-split"></b></div>
                                    </strong>
                                </label>
                                <strong class="d-block mt-2 mb-2 text-sm"><?php echo $config['static'][$type]['file_type']; ?></strong>
                                <div class="custom-file my-custom-file d-none">
                                    <input type="file" class="custom-file-input" name="file-taptin" id="file-taptin">
                                    <label class="custom-file-label" for="file-taptin">Chọn file</label>
                                </div>
                                <?php if(isset($item['taptin']) && $item['taptin'] != '') { ?>
                                    <a class="btn btn-primary rounded-pill d-inline-block align-middle p-2 rounded mb-1" href="<?=UPLOAD_FILE.@$item['taptin']?>" title="Download tập tin hiện tại"><i class="fas fa-download mr-2"></i>Download tập tin hiện tại</a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                            <div class="custom-control custom-checkbox d-inline-block align-middle">
                                <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                                <label for="hienthi-checkbox" class="custom-control-label"></label>
                            </div>
                        </div>
                        <?php if(
                            (isset($config['static'][$type]['tieude']) && $config['static'][$type]['tieude'] == true) || 
                            (isset($config['static'][$type]['mota']) && $config['static'][$type]['mota'] == true) || 
                            (isset($config['static'][$type]['noidung']) && $config['static'][$type]['noidung'] == true)
                        ) { ?>
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
                                                <?php if(isset($config['static'][$type]['tieude']) && $config['static'][$type]['tieude'] == true) { ?>
                                                    <div class="form-group">
                                                        <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                                        <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]" id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>" <?=($k=='vi')?'required':''?>>
                                                    </div>
                                                <?php } ?>
                                                <?php if(isset($config['static'][$type]['mota']) && $config['static'][$type]['mota'] == true) { ?>
                                                    <div class="form-group">
                                                        <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                                        <textarea class="form-control for-seo <?=(isset($config['static'][$type]['mota_cke']) && $config['static'][$type]['mota_cke'] == true)?'form-control-ckeditor':''?>" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                                    </div>
                                                <?php } ?>
                                                <?php if(isset($config['static'][$type]['noidung']) && $config['static'][$type]['noidung'] == true) { ?>
                                                    <div class="form-group">
                                                        <label for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                                        <textarea class="form-control for-seo <?=(isset($config['static'][$type]['noidung_cke']) && $config['static'][$type]['noidung_cke'] == true)?'form-control-ckeditor':''?>" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="<?=$colRight?>">
                <?php if(isset($config['static'][$type]['images']) && $config['static'][$type]['images'] == true) { ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình ảnh <?=$config['static'][$type]['title_main']?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $photoDetail = UPLOAD_NEWS.@$item['photo'];
                                $dimension = "Width: ".$config['static'][$type]['width']." px - Height: ".$config['static'][$type]['height']." px (".$config['static'][$type]['img_type'].")";
                                include TEMPLATE.LAYOUT."image.php";
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        
        <?php if(isset($config['static'][$type]['thongtinthem']) && $config['static'][$type]['thongtinthem'] == true) { ?>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">THÔNG TIN THÊM</h3>                
            </div>
            <div class="card-body">
                <div class="row">
                <?php if(isset($config['static'][$type]['so1']) && $config['static'][$type]['so1'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="so1">số 1:</label>
                        <input type="text" class="form-control" name="data[options2][so1]" id="so1" placeholder="Nhập số" value="<?=$options2['so1']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['static'][$type]['so2']) && $config['static'][$type]['so2'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="so2">số 2:</label>
                        <input type="text" class="form-control" name="data[options2][so2]" id="so2" placeholder="Nhập số" value="<?=$options2['so2']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['static'][$type]['so3']) && $config['static'][$type]['so3'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="so3">số 3:</label>
                        <input type="text" class="form-control" name="data[options2][so3]" id="so3" placeholder="Nhập số" value="<?=$options2['so3']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['static'][$type]['so4']) && $config['static'][$type]['so4'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="so4">số 4:</label>
                        <input type="text" class="form-control" name="data[options2][so4]" id="so4" placeholder="Nhập số" value="<?=$options2['so4']?>">
                    </div>
                <?php } ?>
                <?php if(isset($config['static'][$type]['so5']) && $config['static'][$type]['so5'] == true) { ?>
                    <div class="form-group col-md-4 col-sm-6">
                        <label for="so5">số 5:</label>
                        <input type="text" class="form-control" name="data[options2][so5]" id="so5" placeholder="Nhập số" value="<?=$options2['so5']?>">
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(isset($config['static'][$type]['seo']) && $config['static'][$type]['seo'] == true) { ?>
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Nội dung SEO</h3>
                    <a class="btn btn-success rounded-pill d-inline-block text-white float-right create-seo" title="Tạo SEO">Tạo SEO</a>
                </div>
                <div class="card-body">
                    <?php
                        $seoDB = $seo->getSeoDB(0,$com,'capnhat',$type);
                        include TEMPLATE.LAYOUT."seo.php";
                    ?>
                </div>
            </div>
        <?php } ?>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-warning rounded-pill submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-info rounded-pill"><i class="fas fa-redo mr-2"></i>Làm lại</button>
        </div>
    </form>
</section>