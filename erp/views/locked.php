<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title><?php echo PRODUCT ?> <?php echo VERSION ?></title>
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
    <script type="text/javascript" src="assets/js/core.js"></script>
</head>
<body>
<script type="text/javascript" src="assets/js/wow.js"></script>
<script type="text/javascript">
    /* WOW animations */
    wow = new WOW({
        animateClass: 'animated',
        offset: 100
    });
    wow.init();
</script>
<img src="assets/images/poly-bg/poly-bg-1.jpg" class="login-img wow fadeIn"  />
<div class="center-vertical">
    <div class="center-content">
        <div class="col-md-4 col-sm-5 col-xs-11 col-lg-3 center-margin">
            <div class="content-box wow bounceInDown modal-content pad20A clearfix">
                <div class="col-md-3">
                    <img src="assets/avatars/thumbs/<?php echo ($GLOBALS['user']['icon'] && goodfile('assets/avatars/thumbs/'.$GLOBALS['user']['icon']) ? $GLOBALS['user']['icon'] : 'no-avatar.png') ?>"  class="img-bordered border-gray radius-all-4 img-full"/>
                </div>
                <div class="col-md-9">
                    <div class="meta-box text-left">
                        <h3 class="meta-heading font-size-16"><?php echo ($GLOBALS['user']['fullname'] ? $GLOBALS['user']['fullname'] : $GLOBALS['user']['username']) ?></h3>
                        <h4 class="meta-subheading font-size-13 font-gray"><?php echo get_data('usergroups', 'id = "' . $GLOBALS['user']['level'] . '"', 'name_vn') ?></h4>
                        <div class="divider"></div>
                        <form action="<?php echo site_url() ?>" class="form-inline pad10T" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"><i class="glyph-icon icon-unlock-alt"></i></button>
                                    </span>
                                </div>
                                <div class="note">
                                    <a href="./dashboard/logout">Không phải <?php echo ($GLOBALS['user']['fullname'] ? end(explode(' ', $GLOBALS['user']['fullname'])) : $GLOBALS['user']['username']) ?> ?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>