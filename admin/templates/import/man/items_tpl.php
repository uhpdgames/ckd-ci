<?php
	$linkUploadImg = "index.php?com=import&act=uploadImages&type=".$type;
	$linkEditImg = "index.php?com=import&act=editImages&type=".$type."&p=".$curPage;
	$linkDeleteImg = "index.php?com=import&act=deleteImages&type=".$type."&p=".$curPage;
	$linkUploadExcel = "index.php?com=import&act=uploadExcel&type=".$type;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Import Excel</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
	<?php if(isset($config['import']['images']) && $config['import']['images'] == true) { ?>
		<form method="post" action="<?=$linkUploadImg?>" enctype="multipart/form-data">
	        <div class="card card-primary card-outline text-sm mb-0">
	            <div class="card-header">
	                <h3 class="card-title">Hình ảnh import</h3>
	            </div>
	            <div class="card-body">
	            	<label class="text-danger">Cách 1:</label>
	            	<div class="alert my-alert alert-success mb-2" role="alert">Bạn có thể nhập hình bằng cách copy đường dẫn hình online vào tập tin excel</div>
	            	<div class="alert my-alert alert-info" role="alert">
	            		<p class="mb-0">Ví dụ: <strong>https://tenmien.com/upload/ten-hinh-anh.png</strong></p>
	            		<p class="mb-0 text-danger">=> Copy đường dẫn như ví dụ trên vào tập tin excel để import hình ảnh</p>
	            	</div>
	            	<label class="text-danger">Cách 2:</label>
	                <div class="form-group mb-0">
	                    <label for="filer-import" class="label-filer-gallery mb-3">Album hình: (<?=$config['import']['img_type']?>)</label>
	                    <input type="file" name="files[]" id="filer-import" multiple="multiple">
	                    <input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6">
	                </div>
	            </div>
	        </div>
	        <div class="card-footer text-sm">
	            <button type="submit" class="btn btn-warning rounded-pill" name="uploadImg"><i class="far fa-save mr-2"></i>Lưu</button>
	        </div>
	    </form>
	    <?php if(count($items)) { ?>
		    <div class="card card-primary card-outline text-sm">
		        <div class="card-header">
		            <h3 class="card-title">Danh sách hình ảnh import</h3>
		        </div>
		        <div class="card-body table-responsive p-0">
		            <table class="table table-hover table-hover">
		                <thead>
		                    <tr>
		                        <th class="align-middle" width="5%">
		                            <div class="custom-control custom-checkbox my-checkbox">
		                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
		                                <label for="selectall-checkbox" class="custom-control-label"></label>
		                            </div>
		                        </th>
		                        <th class="align-middle text-center" width="10%">STT</th>
								<th class="align-middle">Hình</th>
								<th class="align-middle" style="width:30%">Tiêu đề</th>
								<th class="align-middle text-center">Copy</th>
		                        <th class="align-middle text-center">Thao tác</th>
		                    </tr>
		                </thead>
	                    <tbody>
	                        <?php for($i=0;$i<count($items);$i++) { ?>
	                            <tr>
	                                <td class="align-middle">
	                                    <div class="custom-control custom-checkbox my-checkbox">
	                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
	                                        <label for="select-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
	                                    </div>
	                                </td>
	                                <td class="align-middle">
	                                    <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="excel">
	                                </td>
	                                <td class="align-middle">
                                    	<a href="<?=$linkEditImg?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['photo']?>"><img class="rounded img-preview" onerror="src='assets/images/noimage.webp'" src="<?=THUMBS?>/<?=$config['import']['thumb']?>/<?=UPLOAD_EXCEL_L.$items[$i]['photo']?>" alt="<?=$items[$i]['photo']?>"></a>
                                    </td>
	                                <td class="align-middle">
	                                    <a class="text-dark" href="<?=$linkEditImg?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['photo']?>"><?=$items[$i]['photo']?></a>
	                                </td>
	                                <td class="align-middle text-center">
	                                    <a class="btn btn-success rounded-pill text-white copy-excel" data-text="<?=$items[$i]['photo']?>" title="Copy">Copy</a>
	                                </td>
	                                <td class="align-middle text-center text-md text-nowrap">
	                                    <a class="text-primary mr-2" href="<?=$linkEditImg?>&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
	                                    <a class="text-danger" id="delete-item" data-url="<?=$linkDeleteImg?>&id=<?=$items[$i]['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
	                                </td>
	                            </tr>
	                        <?php } ?>
	                    </tbody>
		            </table>
		        </div>
		    </div>
		    <?php if($paging) { ?>
		        <div class="card-footer text-sm pb-0">
		            <?=$paging?>
		        </div>
		    <?php } ?>
		    <div class="card-footer text-sm">
		        <a class="btn btn-danger rounded-pill" id="delete-all" data-url="<?=$linkDeleteImg?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
		    </div>
		<?php } ?>
	<?php } ?>
    <form method="post" action="<?=$linkUploadExcel?>" enctype="multipart/form-data">
        <div class="card card-primary card-outline text-sm mb-0">
            <div class="card-header">
                <h3 class="card-title">Import danh sách dữ liệu</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="d-inline-block align-middle mb-1 mr-2">Upload tập tin:</label>
                    <strong class="d-block mt-2 mb-2 text-sm">Loại : .xls|.xlsx (Ms.Excel 2003 - 2007)</strong>
                    <div class="custom-file my-custom-file">
                        <input type="file" class="custom-file-input" name="file-excel" id="file-excel">
                        <label class="custom-file-label" for="file-excel">Chọn file</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-success rounded-pill" name="importExcel"><i class="fas fa-upload mr-2"></i>Import</button>
        </div>
    </form>
</section>

<?php if(isset($config['import']['images']) && $config['import']['images'] == true) { ?>
	<!-- Import js -->
	<script type="text/javascript">
		$('.copy-excel').click(function(){
			var text = $(this).data("text");
			var dummy = document.createElement("input");

		    document.body.appendChild(dummy);
		    dummy.value = text;
		    dummy.select();
		    document.execCommand("copy");
		    document.body.removeChild(dummy);

		    if(!$(this).hasClass("active"))
		    {
		    	$(this).addClass("active");
		    	$(this).html("Copied");
		    }
		});
	</script>
<?php } ?>