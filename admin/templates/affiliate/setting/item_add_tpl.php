<?php
$linkSave = "index.php?com=affiliate&act=save_config";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Cấu hình</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?= $linkSave ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $item['id']; ?>">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-warning rounded-pill submit-check"><i class="far fa-save mr-2"></i>Lưu
            </button>
            <button type="reset" class="btn btn-info rounded-pill"><i class="fas fa-redo mr-2"></i>Làm lại
            </button>
        </div>
        <?php if (isset($config['website']['debug-developer']) && $config['website']['debug-developer'] == true) { ?>
            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Cấu hình cộng tác viên</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="rate">Tỉ lệ: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="data[rate]" id="rate"
                                       value="<?= !empty($item['rate']) ? $item['rate'] : '' ?>"
                                       placeholder="Phần trăm hoa hồng" required>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="vat">VAT </label>
                                <input type="text" class="form-control money-format" name="data[vat]" id="vat"
                                       value="<?php if ($item['vat']) {
                                           $price = $item['vat'];
                                           echo $price;
                                       }//number_format($price, 0, '', '.');}?>"
                                       placeholder="VAT" required>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="cit">CIT </label>
                                <input type="text" class="form-control money-format" name="data[cit]" id="cit"
                                       value="<?php if ($item['cit']) {
                                           $price = $item['cit'];
                                           echo $price;
                                       }//number_format($price, 0, '', '.');}?>"
                                       placeholder="CIT" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="min_withdraw">Số tiền tối thiểu rút của cộng tác viên </label>
                                <input type="text" class="form-control money-format" name="data[min_withdraw]" id="min_withdraw"
                                       value="<?php if ($item['min_withdraw']) {
                                           $price = $item['min_withdraw'];
                                           echo $price;
                                       }// number_format($price, 0, '', '.');}?>"
                                       placeholder="Số tiền rút tối thiểu" required>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="max_withdraw">Số tiền tối đa rút của cộng tác viên </label>
                                <input type="text" class="form-control money-format" name="data[max_withdraw]" id="max_withdraw"
                                       value="<?php if ($item['max_withdraw']) {
                                           $price = $item['max_withdraw'];
                                           echo $price;
                                       }// number_format($price, 0, '', '.');}?>"
                                       placeholder="Số tiền rút tối thiểu" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary card-outline text-sm">
                <div class="card-header">
                    <h3 class="card-title">Cấp độ cộng tác viên</h3>
                </div>
                <div class="card-body">
                    <p class="small">Điều kiện tăng cấp độ</p>
                    <div class="row">
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="rate">LV-1: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control money-format" name="data[lv1]" id="lv1"
                                       value="<?= !empty($item['lv1']) ? $item['lv1'] : '' ?>"
                                       placeholder="Số thu nhập cần để thăng cấp" required>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="rate">LV-2: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control money-format" name="data[lv2]" id="lv2"
                                       value="<?= !empty($item['lv2']) ? $item['lv2'] : '' ?>"
                                       placeholder="Số thu nhập cần để thăng cấp" required>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="rate">LV-3: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control money-format" name="data[lv3]" id="lv3"
                                       value="<?= !empty($item['lv3']) ? $item['lv3'] : '' ?>"
                                       placeholder="Số thu nhập cần để thăng cấp" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </form>
</section>

<!-- Setting js -->
<script type="text/javascript">
    $(document).ready(function () {

    })
</script>
