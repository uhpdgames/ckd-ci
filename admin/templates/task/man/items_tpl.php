<?php
	$linkMan = "index.php?com=task&act=man&p=".$curPage;
    $linkAdd = "index.php?com=task&act=add&p=".$curPage;
	$linkEdit = "index.php?com=task&act=edit&p=".$curPage;
	$linkDelete = "index.php?com=task&act=delete&p=".$curPage;
?>

<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Danh sách công việc cần làm</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
        <a class="btn btn-primary rounded-pill" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
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
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách công việc cần làm</h3>
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
                        <th class="align-middle text-center" width="10%">STT</th>
                        <th class="align-middle">Tên công việc</th>
                        <th class="align-middle">Nội dung</th>
                        <th class="align-middle">Ngày hoàn thành</th>
                        <th class="align-middle">Trạng thái</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                </thead>
                <?php if(empty($items)) { ?>
                    <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                <?php } else { ?>
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
                                    <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="todo">
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['name']?>"><?=$items[$i]['name']?></a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark comment" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['comment']?>"><?=$items[$i]['comment']?></a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['date']?>"><?=$items[$i]['date']?></a>
                                </td>


                                <?php if ($items[$i]['status'] == 0): ?>
                                    <td class="align-middle">
                                        <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['status']?>"><span class="label label-warning">Pending</span></a>
                                    </td>
                                <?php else: ?>
                                    <td class="align-middle">
                                        <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['status']?>"><span class="label label-success">Completed</span></a>
                                    </td>
                                <?php endif; ?>


                                <td class="align-middle text-center text-md text-nowrap">
                                    <a class="text-primary mr-2" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
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

</section>


<style>
    .label {
        display: inline;
        padding: 0.2em 0.6em 0.3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25em;
    }
    .bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
        background-color: #00a65a !important;
    }
    .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
        background-color: #f39c12 !important;
    }

    .comment{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>