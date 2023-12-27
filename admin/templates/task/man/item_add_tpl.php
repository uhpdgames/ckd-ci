<?php
    $linkMan = "index.php?com=task&act=man&p=".$curPage;
    $linkSave = "index.php?com=task&act=save&p=".$curPage;

    e
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết công việc</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-warning rounded-pill" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-info rounded-pill"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-danger rounded-pill" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> công việc</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Tên công việc: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="data[name]" id="name" placeholder="Tên công việc" value="<?=@$item['name']?>" <?=($act=="edit")?'readonly':'';?> required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">Ngày dự tính hoàn thành:</label>
                        <input type="text" class="form-control" name="data[date]" id="date" placeholder="Ngày ước tính hoàn thành công việc" value="<?=(@$item['date'])?@$item['date']:"";?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="comment">Nội dung: <span class="text-danger">*</span></label>

                        <textarea  name="data[comment]" class="form-control"id="comment" placeholder="Công việc"><?=@$item['comment']?></textarea>

                    </div>
                </div>

				<div class="form-group">
					<label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
					<input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
				</div>
            </div>
        </div>

    </form>
</section>

<!-- User js -->
<script type="text/javascript">
	$(document).ready(function(){
	    $('#date').datetimepicker({
	        timepicker: false,
	        format: 'd/m/Y',
	        formatDate: 'd/m/Y',
	        // minDate: '1950/01/01',
	        maxDate: '<?=date("Y/m/d",time())?>'
	    });
	});
</script>