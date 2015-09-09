<?php
namespace Libraries;

class Bootstrap {
    private $url;
    private $config;

    function __construct($url, array $config) {
        $this->url = $url;
        $this->config = $config;
    }

    public function run() {
        $arrayUrl = explode('/', $this->url);

		$s = new Servicos();
		$container = $s->getContainer();

        if (empty($this->url)) {
            include $this->config['dir-action'] . 'home.php';
        } else {
            if (is_file($this->config['dir-action'] . $arrayUrl[0].'/'.$arrayUrl[1] . '.php')) {
                include $this->config['dir-action'] . $arrayUrl[0].'/'.$arrayUrl[1] . '.php';
            } else {
                header("HTTP/1.0 404 Not Found");
                include $this->config['dir-action'] . '404.php';
            }
        }
    }
}