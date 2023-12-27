<?php
define('LIBRARIES', '../libraries/');
define('TODAY', date('Y-m-d'));
/* Config */
require_once LIBRARIES . "config.php";
require_once LIBRARIES . 'autoload.php';
new AutoLoad();
$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);
$func = new Functions($d);