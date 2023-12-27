<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title><?php echo PRODUCT ?> - Login</title>
    <base href="<?php echo base_url() ?>" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/icons/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/icons/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/icons/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/icons/icon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
</head>
<body style="background: #2fc6f7 url(assets/images/bg.png);">
<script type="text/javascript" src="assets/js/core.js"></script>
<script type="text/javascript" src="assets/js/login.js"></script>
<script type="text/javascript">
    var site_url = '<?php echo site_url() ?>';
</script>
<div class="center-vertical">
    <div class="center-content">
        <div class="col-md-3 center-margin" style="max-width: 320px">
            <form method="post" action="<?php echo site_url() ?>" class="form-1">
                <div class="content-box wow bounceInDown modal-content">
                    <h3 class="content-box-header content-box-header-alt bg-default" style="padding: 5px;">
                        <span class="icon-separator">
                            <i class="glyph-icon icon-lock"></i>
                        </span>
                        <span class="header-wrapper" style="text-transform: none">
                            <?php echo PRODUCT ?> <?php echo VERSION ?>
                            <small style="padding: 0;">Vui lòng đăng nhập.</small>
                        </span>
                    </h3>
                    <div class="content-box-wrapper">
                        <div class="form-group" style="display: none">
                            <div class="input-group">
                                <input type="text" class="form-control" name="code" autocomplete="off" placeholder="Mã xác nhận">
                                <span class="input-group-addon bg-blue">
                                    <i class="glyph-icon icon-code"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Tên đăng nhập">
                                <span class="input-group-addon bg-blue">
                                    <i class="glyph-icon icon-user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Mật khẩu">
                                <span class="input-group-addon bg-blue">
                                    <i class="glyph-icon icon-unlock-alt"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block submit">Đăng nhập</button>
                        <div class="failed" style="display: none; text-align: center">Thông tin đăng nhập không chính xác!</div>
                    </div>
                </div>
            </form>
            <div class="form-group" style="text-align: center;">
                <a id="forgotpass" href="javascript:;" style="color: #3e4855">Quên mật khẩu?</a>
            </div>
            <p style="text-align: center">Copyright © <?php echo date('Y') . ' ' . PRODUCT ?>. All rights reserved.</p>
        </div>
    </div>
</div>
</body>
</html>
