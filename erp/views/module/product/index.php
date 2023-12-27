<?php

///qq($items);
?>

<?php
$linkMan = '#';
$linkEdit = '#';
$linkDelete = '#';
$linkExcel = '#';
$linkWord = '#';
$arrStatus = array("text-primary", "text-info", "text-warning", "text-success", "text-danger");
?>

<div class="container-fluid disable-text-selection">



    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Danh sách đơn hàng</h1>
                <div class="top-right-button-container">

                    <div class="btn-group">
                        <div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
                            <label class="custom-control custom-checkbox mb-0 d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                <span class="custom-control-label">&nbsp;</span>
                            </label>
                        </div>
                        <button type="button"
                                class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Di chuyển vào thùng rác</a>
                            <a class="dropdown-item" href="#">Xóa tất cả</a>

                        </div>
                    </div>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href=".">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="don-hang"">Đơn hàng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                    </ol>
                </nav>
            </div>


            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <div id="result" style=" display: none;width: 100%" class="alert alert-success rounded" role="alert">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 list" data-check-all="checkAll">

            <div class="table-responsive">
                <table class="m-t-30 no-wrap table-hover product-list data-table data-product table table-hover"
                       width="100%">

                    <!--Mã đơn hàng	Họ tên	Ngày đặt	Hình thức thanh toán	Tổng giá	Mã vận đơn	Tình trạng	Thao tác-->
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th class="align-middle text-center" align="center" valign="center">Mã đơn hàng</th>
                        <th class="align-middle text-center" align="center" valign="center" style="width:15%">Họ tên
                        </th>
                        <th class="align-middle text-center" align="center" valign="center">Ngày đặt</th>
                        <th class="align-middle text-center" align="center" valign="center">Hình thức thanh toán</th>
                        <th class="align-middle text-center" align="center" valign="center">Tổng giá</th>
                        <th class="align-middle text-center" align="center" valign="center">Mã vận đơn</th>
                        <th class="align-middle text-center" align="center" valign="center">Tình trạng</th>
                        <th class="align-middle text-center" align="center" valign="center">Hành động</th>
                        <th class="align-middle text-center" align="center" valign="center">Chức Năng</th>
                    </tr>

                    </thead>
                    <?php if (empty($items)) { ?>
                        <tbody>
                        <tr>
                            <td colspan="100" class="text-center">Không có dữ liệu</td>
                        </tr>
                        </tbody>
                    <?php } else { ?>
                        <tbody>
                        <?php $stt = 1;
                        for ($i = 0; $i < count($items); $i++) {

                            if (isset($items[$i]['tinhtrang']) && $items[$i]['tinhtrang'] > 0) {
                                $id_tinhtrang = $items[$i]['tinhtrang'];
                                $tinhtrang = $d->rawQueryOne("select trangthai from #_status where id = ?", array($id_tinhtrang));
                            }

                            ?>
                            <tr>


                                <td class="align-middle text-center">
                                    <span><?= $stt++ ?></span>
                                </td>

                                <td class="align-middle">
                                    <a class="text-primary" href="product/tracking/?id=<?=@$items[$i]['id']?>&id_tracking=<?=@$items[$i]['id_tracking']??0?>"
                                       title="<?= @$items[$i]['madonhang'] ?>">
                                        <span><?= @$items[$i]['madonhang'] ?></span>
                                    </a>
                                </td>
                                <td class="align-middle">
                                   <span><?= @$items[$i]['hoten'] ?></span>
                                </td>
                                <td class="align-middle"><?= date("h:i:s A - d/m/Y", $items[$i]['ngaytao']) ?></td>
                                <td class="align-middle">
                                    <span class="text-info"><?= $func->get_payments($items[$i]['httt']) ?></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-danger font-weight-bold"><?= $func->format_money($items[$i]['tonggia']) ?></span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-success font-weight-bold"><?= $items[$i]['id_tracking'] ?></span>
                                </td>
                                <td class="align-middle">
                                    <span class="<?= $arrStatus[$id_tinhtrang - 1] ?> text-capitalize"><?= $tinhtrang['trangthai'] ?></span>
                                </td>
                                <td class="align-middle text-center text-md text-nowrap">

                                    <?php

                                    if ($id_tinhtrang == '1') {
                                        $data_this = ' data-id="'.@$items[$i]['id'].'"';
                                        //$data_this .= ' data-thuho="'.@$items[$i]['tonggia'].'"';
                                        //$data_this .= ' data-khoiluong="'.@$items[$i]['khoiluong'].'"';
                                        echo '<a '.$data_this.' href="javascript:void(0)" onclick="taovandon(this)" type="button" class="text-small btn btn-primary mb-1">Tạo vận chuyển</a>';
                                    } else {
                                        echo '<button href="javascript:void(0)" disabled type="button" class="text-small btn btn-danger mb-1">Đã vận chuyển</button>';
                                    }
                                    ?>

                                </td>

                                <td class="align-middle text-center">




                                    <div class="d-flex text-center align-items-center">
                                        <div class="print mr-1 mt-1">
                                            <?php if(!empty($items[$i]['id_tracking'])){?>
                                                <a class="text-primary p-2 mt-1 ml-1" onclick="PrintBild('<?=$items[$i]['id_tracking']?>');" href="javascript:void(0)" title="Print Bill"><i class="simple-icon-printer"></i></a>
                                            <?php }else{?>
                                                <a class="text-primary p-2 mt-1 " disabled href="javascript:void(0)" title="Print Bill"><i class="disabled iconsminds-empty-box"></i></a>
                                            <?php }?>


                                            <a class="text-primary p-2 mt-1 " disabled  href="javascript:void(0)" title="Xóa"><i class="disabled simple-icon-trash"></i></a>
                                        </div>

                                       <!-- <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="custom-control-input select-checkbox"
                                                   id="select-checkbox-<?php /*= $items[$i]['id'] */?>"
                                                   value="<?php /*= $items[$i]['id'] */?>">
                                            <label for="select-checkbox-<?php /*= $items[$i]['id'] */?>"
                                                   class="custom-control-label"></label>
                                        </div>-->
                                    </div>


                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>

            </div>


        </div>
    </div>
</div>




<script defer>



	function taovandon(_this) {

		var url = 'ajax/taovanchuyen';


		var $data = {
			'id':_this.data('id'),
        }


		var posting = $.post(url, $data);

		posting.done(function (data) {
			$('#result').fadeIn(500);

			if(data.error ==1){
				$('#result').text('Có lỗi xảy ra!');
            }else {
				$('#result').text('Tạo đơn hàng thành công!');
            }

			setTimeout(function () {
				$('#result').fadeOut(500);
			}, 3000)
		});
		posting.fail(function () {
			$('#result').fadeIn(500);
			$('#result').text('Cập nhật thất bại');
			setTimeout(function () {
				$('#result').fadeOut(500);
			}, 3000)
		});
	}


	function PrintBild(id_order){
		$.ajax({
			url: 'ajax/printbill',
			type: 'POST',
			dataType: 'json',
			data: {id_order: id_order},
			success:function(data){
				if(data.status == 200 && data.error == false){
					let link =`https://digitalize.viettelpost.vn/DigitalizePrint/report.do?type=1&bill=${data.message}&showPostage=1`;
					const downloadLink = document.createElement("a");
					downloadLink.href = link;
					downloadLink.setAttribute('target', '_blank');
					downloadLink.click();
				}
			}
		})
	}

</script>

<style>

    .disabled{
        color:grey;
        user-select: none;
        pointer-events: none;
        cursor: not-allowed;
    }
   table i {
        font-size: 1rem;
    }
</style>
