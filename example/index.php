<?php

require "../vendor/autoload.php";

$viewPath   = dirname(__FILE__, 1) . '/views';
$viewHead   = $viewPath . "/includes/head";
$viewAside  = $viewPath . "/includes/aside";
$viewHeader = $viewPath . "/includes/header";
$viewFooter = $viewPath . "/includes/footer";

$css = ['style'];
$js  = ['script'];

$user = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

/**
 * Default path to css and js folder
 * Use modifier methods to change the pattern
 *
 * $v->setStylePath();
 * $v->setScriptPath();
 */
$a = new \DevPontes\View\Assets('assets', false);
$v = new \DevPontes\View\View($viewPath, 'php');

$v->addAssets($a);
$v->assets->makeScript($js);
$v->assets->makeStyle($css);

$v->setHead($viewHead);
$v->setAside($viewAside);
$v->setHeader(null);
$v->setFooter($viewFooter);

$v->render('home', $data);
