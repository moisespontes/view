<?php

require "../vendor/autoload.php";

$viewPath   = dirname(__FILE__, 1) . '/views';
$viewHead   = "{$viewPath}/includes/head";
$viewAside  = "{$viewPath}/includes/aside";
$viewHeader = "{$viewPath}/includes/header";
$viewFooter = "{$viewPath}/includes/footer";

$assets['style']  = ['style'];
$assets['script'] = ['script'];

$user = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

$v = new \DevPontes\View\View($viewPath, 'php');
/**
 * Default path for styles and scripts folders
 * css and js
 *
 * Use modifier methods to change the pattern
 * setStylePath()
 * setScriptPath()
 */
$v->addAssets('assets', $assets);

$v->setHead($viewHead);
$v->setAside($viewAside);
$v->setHeader(false);
$v->setFooter(false);
$v->render('home', $data);
