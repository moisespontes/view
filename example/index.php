<?php

require "../vendor/autoload.php";

$viewPath = dirname(__FILE__, 1) . DIRECTORY_SEPARATOR . 'views';

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

$v->setHead('includes.head');
$v->setAside('includes.aside');
$v->setHeader('includes.header');
$v->setFooter('includes.footer');

$v->render('home', $data);
