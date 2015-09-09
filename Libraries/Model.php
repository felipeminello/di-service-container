<?php
namespace Libraries;

abstract class Model {
    protected $db;

    public function __construct() {
		$s = new Servicos();
		$c = $s->getContainer();

		$this->db = $c['conexao'];
    }
}