<?php
namespace Libraries;

abstract class Controller {
    protected $twig;
    protected $config;

    public function __construct(array $config = array()) {
        if (count($config) == 0) {
            $this->config = include('../config/local.php');
        } else {
            $this->config = $config;
        }

        \Twig_Autoloader::register();

        $loader = new \Twig_Loader_Filesystem($this->config['dir-view']);

        $this->twig = new \Twig_Environment($loader, array(
            'cache' => $this->config['dir-cache'],
            'debug' => true,
        ));

        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig->addGlobal('config', $this->config);
        $this->twig->addGlobal('menu', $this->config);
    }
}