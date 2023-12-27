
<div class="w_1000">
    <div class="affiliate text-center mx-auto">
        <div class="title-main"><span><?=getLang('thongtintaikhoan')?></span></div>
        <hr class="p-0 my-4 f-small"/>
        <div class="wp_form bank m-auto p-0">
            <div class="h5 wap_form_title"><?=getLang('taikhoannganhang')?></div>

            <form class="form-user validation-user" novalidate method="post" action="account/them-tai-khoan" enctype="multipart/form-data">
                <div class="input-group input-user">
                    <input type="number" class="form-control" id="stk" name="stk" placeholder="<?=getLang('sotaikhoan')?>" required value="<?=@($item['stk']);?>"/>
                    <div class="invalid-feedback"><?=getLang('vuilongsotaikhoan')?></div>
                </div>
                <div class="input-group input-user">
                    <input type="text" class="form-control" id="nganhang" name="nganhang" placeholder="<?=getLang('nganhang')?>" required value="<?=@($item['nganhang']);?>"/>
                    <div class="invalid-feedback"><?=getLang('vuilongnganhang')?></div>
                </div>
                <div class="input-group input-user">
                    <input type="text" class="form-control" id="hoten" name="hoten" placeholder="<?=getLang('chuthe')?>" required value="<?=@($item['hoten']);?>"/>
                    <div class="invalid-feedback"><?=getLang('vuilongchuthe')?></div>
                </div>
                <div class="input-group input-user">
                    <input type="text" class="form-control" id="cccd" name="cccd" placeholder="<?=getLang('soccd')?>" required value="<?=@($item['cccd']);?>"/>
                    <div class="invalid-feedback"><?=getLang('vuilongsoccd')?></div>
                </div>

                <input type="hidden" value="<?=@$uid?>" name="uid">
                <input type="hidden" value="<?=@($item['id']);?>" name="id">

                <div class="button-user">
                    <input type="submit" class="btn btn-primary" name="xacnhan" value="<?=getLang('xacnhanthongtin')?>" disabled>
                </div>
            </form>
        </div>
    </div>
</div>
<hr class="p-0 my-4 f-small"/>
