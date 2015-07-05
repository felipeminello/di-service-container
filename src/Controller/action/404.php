<?php
use Controller\IndexController;

$indexController = new IndexController($this->config);

echo $indexController->error404();