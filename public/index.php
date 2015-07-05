<?php
require_once '../vendor/autoload.php';

$config = include('../config/local.php');

use Lib\Bootstrap;

$url = (isset($_GET['url'])) ? $_GET['url'] : null;

$b = new Bootstrap($url, $config);

$b->run();