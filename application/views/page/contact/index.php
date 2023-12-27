<div class="main_fix">
    <div class="title-main"><span><?=$title_crumb?></span></div>
    <div class="content-main w-clear">
        <div class="top-contact">
            <div class="article-contact"><?=htmlspecialchars_decode(@$content)?></div>
            <form class="form-contact validation-contact" novalidate method="post" enctype="multipart/form-data" id="FormContact">
                <div class="row">
                    <div class="input-contact col-sm-6">
                        <input type="text" class="form-control" id="ten" name="ten" placeholder="<?=getLang('hoten')?>" required />
                        <div class="invalid-feedback"><?=getLang('vuilongnhaphoten')?></div>
                    </div>
                    <div class="input-contact col-sm-6">
                        <input type="number" class="form-control" id="dienthoai" name="dienthoai" placeholder="<?=getLang('sodienthoai')?>" required />
                        <div class="invalid-feedback"><?=getLang('vuilongnhapsodienthoai')?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-contact col-sm-6">
                        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="<?=getLang('diachi')?>" required />
                        <div class="invalid-feedback"><?=getLang('vuilongnhapdiachi')?></div>
                    </div>
                    <div class="input-contact col-sm-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"  />
                    </div>
                </div>
                <div class="input-contact">
                    <input type="text" class="form-control" id="tieude" name="tieude" placeholder="<?=getLang('chude')?>" required />
                    <div class="invalid-feedback"><?=getLang('vuilongnhapchude')?></div>
                </div>
                <div class="input-contact">
                    <textarea class="form-control" id="noidung" name="noidung" placeholder="<?=getLang('noidung')?>"  /></textarea>
                </div>

                <input type="submit" class="btn btn-primary" value="<?=getLang('gui')?>" disabled />

                <input type="hidden" class="btn btn-primary" name="submit-contact" value="1" />
                <input type="reset" class="btn btn-secondary" value="<?=getLang('nhaplai')?>" />
                <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
            </form>
        </div>
        <div class="bottom-contact"><?=htmlspecialchars_decode($optsetting['toado_iframe'])?></div>
    </div>

</div>
