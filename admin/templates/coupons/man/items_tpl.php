<?php
$linkMan = "index.php?com=coupons&act=man&p=".$curPage;
$linkAdd = "index.php?com=coupons&act=man&p=".$curPage;
$linkEdit = "index.php?com=coupons&act=man&p=".$curPage;
$linkDelete = "index.php?com=coupons&act=man&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Coupons list</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">

    <div class="card card-primary card-outline text-sm mb-0">
          <div class="card-footer text-sm sticky-top">


              <a id="btn-coupons" class="btn btn-primary rounded-pill" href="#" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Tạo mã</a>


            <a class="btn btn-danger rounded-pill" id="delete-all" data-url="<?=$linkDelete?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
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


        <div class="card-header">
            <h3 class="card-title d-block">danh sách mã giảm giá</h3>
        </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="align-middle text-center" width="5%">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label for="selectall-checkbox" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="align-middle text-center" style="width:1%">STT</th>
                        <th class="align-middle text-center">Mã giảm giá</th>
                        <th class="align-middle text-center">Ngày có hiêu lực</th>
                        <th class="align-middle text-center">Ngày hết hạn sử dụng</th>
                        <th class="align-middle text-center">Giá giảm</th>
                        <th class="align-middle text-center">Phần trăm giảm</th>
                        <th class="align-middle text-center">Loại mã giá</th>
                        <th class="align-middle text-center">Áp dụng</th>
                        <th class="align-middle text-center">Hiển thị</th>
                        <th class="align-middle text-center">Chức năng</th>
                    </tr>
                    </thead>
                    <?php if(empty($items)) { ?>
                        <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                    <?php } else { ?>
                        <tbody>
                        <?php $stt = 1; for($i=0;$i<count($items);$i++) { ?>
                            <tr>
                                <td class="align-middle text-center">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                        <label for="select-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <?=$stt++;?>
                                </td>
                                <td class="align-middle text-center">
                                    <span>
                                        <?=$items[$i]['code']?>
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span>
                                        <?=$items[$i]['start_date']?>
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span>
                                        <?=$items[$i]['end_date']?>
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span>
                                        <?=$items[$i]['discount_amount']?>
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span>
                                        <?=$items[$i]['discount_percentage']?>
                                    </span>
                                </td>

                                <td class="align-middle text-center">
                                    <span>
                                        <?=$items[$i]['is_one_time_use'] == 1 ? 'Sử dụng 1 lần': 'Tất cả'?>
                                    </span>
                                </td>
                                 <td class="align-middle text-center">
                                    <span>
                                        <?= $items[$i]['is_combinable'] == 1 ? 'Tất cả': 'riêng biệt';?>
                                    </span>
                                </td>

                                <td class="align-middle text-center">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="tags" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                        <label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-md text-nowrap">
                                    <a class="text-danger" id="delete-item" data-url="<?=$linkDelete?>&id=<?=$items[$i]['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
    </div>
    <?php if($paging) { ?>
        <div class="card-footer text-sm pb-0">
            <?=$paging?>
        </div>
    <?php } ?>

    <div class="card-footer text-sm">

    </div>

</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="wp p-4">
                    <form action="">
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="stt">Số lượng mã giảm giá</label>
                                <input name="data[code]" type="text" class="form-control" id="stt" placeholder="Số lượng mã giảm giá">
                                <small id="stt" class="form-text text-muted">Bạn muốn tạo ra bao nhiêu mã giảm giá?</small>
                            </div>

                            <div class="col-6 form-group">
                                <label for="date">Ngày áp dụng</label>
                                <input name="data[start_date]" type="text" class="form-control" id="start_date" />
                            </div>
                            <div class="col-6 form-group">
                                <label for="date">Ngày hết hạn</label>
                                <input name="data[end_date]" type="text" class="form-control" id="end_date" />
                            </div>
                            <div class="col-6 form-group">
                                <label for="date">Số tiền giảm</label>
                                <input name="data[discount_amount]" type="text" class="form-control" id="discount_amount" />
                            </div>
                            <div class="col-6 form-group">
                                <label for="date">Số phần trăm giảm</label>
                                <input name="data[discount_percentage]" type="text" class="form-control" id="discount_percentage" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input name="data[is_one_time_use]" class="form-check-input" type="checkbox" id="is_one_time_use" value="1" >
                                <label class="form-check-label" for="is_one_time_use">Dùng 1 lần</label>
                            </div>
                            <div class="col-6 form-group">
                                <input name="data[is_combinable]" class="form-check-input" type="checkbox" id="is_combinable" value="1" >
                                <label class="form-check-label" for="is_combinable">Sử dụng cùng các chương trình khuyến mãi khác</label>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>>
</div>


<script>
    $(document).ready(function () {

        $('#btn-coupons').on('click', function (){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'ajax/taomagiamgia.php',
                async: false,
                data: {},
                success: function(result)
                {
                    console.log(result);
                    if(result.success)
                    {
                        window.location = "index.php";
                    }

                }
            });
        })


    })
</script>
