<?php
// error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$config = include('../config/local.php');

use Libraries\Bootstrap;

$url = (isset($_GET['url'])) ? $_GET['url'] : null;

$b = new Bootstrap($url, $config);

$b->run();