<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 19.02.2019
 * Time: 09:42
 */

require_once 'vendor/autoload.php';

/** @var \Base $f3 */
$f3 = \Base::instance();

$f3->config('App/Config/config.cfg');
$f3->config('App/Config/routes.cfg');
$f3->config('App/Config/db.cfg');

$f3->run();
