<?php
namespace Lib;

use Lib\Conexao;

abstract class Model {
    protected $db;

    public function __construct(ConexaoInterface $c = null, array $config = array()) {
        if (count($config) == 0) {
            $config = include('../config/local.php');
        }

        if (empty($c)) {
            $c = new Conexao($config);
        }

        $this->db = $c->connect();
    }
}