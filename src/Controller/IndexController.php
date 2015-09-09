<?php
namespace Controller;


class IndexController extends \Libraries\Controller {
    public function index() {
        return $this->twig->render('index/home.twig');
    }

    public function error404() {
        return $this->twig->render('error/404.twig');
    }
}