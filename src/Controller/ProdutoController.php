<?php
namespace Controller;

use Model\Fornecedor;
use Model\Produto;

class ProdutoController extends \Lib\Controller {
    public function listar() {
		$f = new Fornecedor();

        try {
			$p = new Produto(array('Fornecedor' => $f));

            $listaProduto = $p->listar();

            return $this->twig->render(
                'produto/listar.twig',
                array(
                    'listaProduto' => $listaProduto,
                    'linkEditar'    => $this->config['dirPublic'].'produto/cadastro/',
                    'linkInserir'    => $this->config['dirPublic'].'produto/cadastro/',
                    'linkExcluir'    => $this->config['dirPublic'].'produto/excluir/json/',
                    'linkExcluirLote'    => $this->config['dirPublic'].'produto/excluir-lote/html/',
                )
            );
        } catch (\Exception $e) {
            return $this->twig->render(
                'error/exception.twig',
                array('mensagem' => $e->getMessage())
            );
        }
    }

    public function cadastro($id = 0) {
        $p = new Produto();
		$f = new Fornecedor();

        try {
			$p = new Produto(array('Fornecedor' => $f));

			$arrayFornecedor = $f->listar();

            if ($id > 0) {
				$p->selecionar($id);

                $pagina = 'editar/'.$id;
            } else {
                $pagina = 'inserir';
            }

            return $this->twig->render(
                'produto/cadastro.twig',
                array(
                    'produto' => $p,
					'listaFornecedor' => $arrayFornecedor,
                    'action' => $this->config['dirPublic'].'produto/'.$pagina,
                    'linkListar' => $this->config['dirPublic'].'produto/listar/',
                )
            );
        } catch (\Exception $e) {
            return $this->twig->render(
                'error/exception.twig',
                array('mensagem' => $e->getMessage())
            );
        }
    }

    public function excluir($retorno = null, $id = 0) {
        $arrayRetorno = array();
        $p = new Produto();

        try {
            $p->selecionar($id);

            if ($p->excluir()) {
                $arrayRetorno['r'] = true;
                $arrayRetorno['m'] = 'Produto excluído com sucesso';
            } else {
                $arrayRetorno['r'] = false;
                $arrayRetorno['m'] = 'Problema ao excluir (ProdutoController)';
            }

            if (strtolower($retorno) == 'json') {
                return json_encode($arrayRetorno);
            } else {
                return $this->twig->render(
                    'produto/excluir.twig',
                    array(
                        'produto'    => $p,
                        'retorno'       => $arrayRetorno,
                    )
                );
            }
        } catch (\Exception $e) {
            return $this->twig->render(
                'error/exception.twig',
                array('mensagem' => $e->getMessage())
            );
        }
    }

    public function excluirLote($retorno = null, array $arrayID = array()) {
        $arrayRetorno = array();
        $p = new Produto();

        try {
            foreach ($arrayID as $id) {
                $p->selecionar($id);

                if ($p->excluir()) {
                    $arrayRetorno['r'] = true;
                    $arrayRetorno['m'] = 'Produtoes excluídos com sucesso';
                } else {
                    $arrayRetorno['r'] = false;
                    $arrayRetorno['m'] = 'Problema ao excluir (ProdutoController)';

                    break;
                }
            }

            if (strtolower($retorno) == 'json') {
                return json_encode($arrayRetorno);
            } else {
                return $this->twig->render(
                    'produto/excluir.twig',
                    array(
                        'produto'    => $p,
                        'retorno'       => $arrayRetorno,
                    )
                );
            }
        } catch (\Exception $e) {
            return $this->twig->render(
                'error/exception.twig',
                array('mensagem' => $e->getMessage())
            );
        }
    }

    public function inserir($retorno = null, array $arrayPost = array()) {
        $arrayRetorno = array();
        $f = new Fornecedor();

        try {
			$p = new Produto(array('Fornecedor' => $f));

            $p->receberDados($arrayPost);

            if ($p->inserir()) {
                $arrayRetorno['r'] = true;
                $arrayRetorno['m'] = 'Produto inserido com sucesso';
            } else {
                $arrayRetorno['r'] = false;
                $arrayRetorno['m'] = 'Problema ao inserir (ProdutoController)';
            }

            if (strtolower($retorno) == 'json') {
                return json_encode($arrayRetorno);
            } else {
                return $this->twig->render(
                    'produto/visualizar.twig',
                    array(
                        'produto'    => $p,
                        'retorno'       => $arrayRetorno,
                        'linkEditar'    => $this->config['dirPublic'].'produto/cadastro/'.$p->getID(),
                        'linkInserir'    => $this->config['dirPublic'].'produto/cadastro/',
                        'linkListar'    => $this->config['dirPublic'].'produto/listar/',
                    )
                );
            }
        } catch (\Exception $e) {
            return $this->twig->render(
                'error/exception.twig',
                array('mensagem' => $e->getMessage())
            );
        }
    }

    public function atualizar($retorno = null) {
        $arrayRetorno = array();
		$f = new Fornecedor();

        try {
			$p = new Produto(array('Fornecedor' => $f));

            $p->receberDados($_POST);

            if ($p->atualizar()) {
                $arrayRetorno['r'] = true;
                $arrayRetorno['m'] = 'Produto atualizado com sucesso';
            } else {
                $arrayRetorno['r'] = false;
                $arrayRetorno['m'] = 'Problema ao atualizar (ProdutoController)';
            }

            if (strtolower($retorno) == 'json') {
                return json_encode($arrayRetorno);
            } else {
                return $this->twig->render(
                    'produto/visualizar.twig',
                    array(
                        'produto'    => $p,
                        'retorno'       => $arrayRetorno,
                        'linkEditar'    => $this->config['dirPublic'].'produto/cadastro/'.$p->getID(),
                        'linkInserir'    => $this->config['dirPublic'].'produto/cadastro/',
                        'linkListar'    => $this->config['dirPublic'].'produto/listar/',
                    )
                );
            }
        } catch (\Exception $e) {
            return $this->twig->render(
                'error/exception.twig',
                array('mensagem' => $e->getMessage())
            );
        }
    }
}