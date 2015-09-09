<?php
namespace Libraries;

use Controller\FornecedorController;
use Controller\IndexController;
use Controller\ProdutoController;
use Model\Fornecedor;
use Model\Produto;
use Pimple;

class Servicos {
	private $container;

	public function __construct() {
		$arrayConfig = include('../config/local.php');

		$this->container = new Pimple();

		$this->container['dbhost'] = $arrayConfig['dbhost'];
		$this->container['dbname'] = $arrayConfig['dbname'];
		$this->container['dbuser'] = $arrayConfig['dbuser'];
		$this->container['dbpassword'] = $arrayConfig['dbpassword'];

		$this->setConexao();
		$this->setFornecedor();
		$this->setProduto();
		$this->setFornecedorController();
		$this->setProdutoController();
		$this->setIndexController();
	}

	public function getContainer() {
		return $this->container;
	}


	private function setConexao() {
		$this->container['conexao'] = $this->container->share(function(Pimple $container) {
			$con = new Conexao(['dbhost' => $container['dbhost'], 'dbname' => $container['dbname'], 'dbuser' => $container['dbuser'], 'dbpassword' => $container['dbpassword']]);
			return $con->connect();
		});
	}

	private function setFornecedor() {
		$this->container['fornecedor'] = $this->container->share(function(Pimple $container) {
			return new Fornecedor();
		});
	}

	private function setProduto() {
		$this->container['produto'] = $this->container->share(function(Pimple $container) {
			$p = new Produto();
			$p->setFornecedor($container['fornecedor']);

			return $p;
		});
	}

	private function setFornecedorController() {
		$this->container['fornecedor-controller'] = $this->container->share(function(Pimple $container) {
			$fc = new FornecedorController();
			$fc->setFornecedor($container['fornecedor']);

			return $fc;
		});
	}

	private function setProdutoController() {
		$this->container['produto-controller'] = $this->container->share(function(Pimple $container) {
			$pc = new ProdutoController();
			$pc->setProduto($container['produto']);

			return $pc;
		});
	}

	private function setIndexController() {
		$this->container['index-controller'] = $this->container->share(function(Pimple $container) {
			$ic = new IndexController();

			return $ic;
		});
	}
}