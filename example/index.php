<?php

require "../vendor/autoload.php";

const CONF_VIEWS_PATH  = "views";
const CONF_VIEW_HEAD   = CONF_VIEWS_PATH . "/includes/head.php";
const CONF_VIEW_ASIDE  = CONF_VIEWS_PATH . "/includes/aside.php";
const CONF_VIEW_HEADER = CONF_VIEWS_PATH . "/includes/header.php";
const CONF_VIEW_FOOTER = CONF_VIEWS_PATH . "/includes/footer.php";

$assets['style']  = ['style'];
$assets['script'] = ['script'];

$user  = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

$render = new \DevPontes\View\View('assets');
$render->addAssets($assets);
$render->render('home', $data);
