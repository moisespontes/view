<?php

require "../vendor/autoload.php";

define('CONF_ROOT_PATH', dirname(__FILE__, 1));
define('CONF_VIEWS_PATH', CONF_ROOT_PATH . "/views");
define('CONF_VIEW_HEAD', CONF_VIEWS_PATH . "/includes/head.php");
define('CONF_VIEW_ASIDE', CONF_VIEWS_PATH . "/includes/aside.php");
define('CONF_VIEW_HEADER', CONF_VIEWS_PATH . "/includes/header.php");
define('CONF_VIEW_FOOTER', CONF_VIEWS_PATH . "/includes/footer.php");

$assets['style']  = ['style'];
$assets['script'] = ['script'];

$user  = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

$render = new \DevPontes\View\View();
$render->addAssets('assets', $assets, false);
$render->render('home', $data);
