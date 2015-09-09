<?php
namespace Controller;

class ProdutoController extends \Libraries\Controller {
	private $Produto;

	public function setProduto($p) {
		$this->Produto = $p;
	}

    public function listar() {
        try {
            $listaProduto = $this->Produto->listar();

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
        try {
			$arrayFornecedor = $this->Produto->getFornecedor()->listar();

            if ($id > 0) {
				$this->Produto->selecionar($id);

                $pagina = 'editar/'.$id;
            } else {
                $pagina = 'inserir';
            }

            return $this->twig->render(
                'produto/cadastro.twig',
                array(
                    'produto' => $this->Produto,
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

        try {
            $this->Produto->selecionar($id);

            if ($this->Produto->excluir()) {
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
                        'produto'    => $this->Produto,
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

        try {
            foreach ($arrayID as $id) {
                $this->Produto->selecionar($id);

                if ($this->Produto->excluir()) {
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
                        'produto'    => $this->Produto,
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

        try {

            $this->Produto->receberDados($arrayPost);

            if ($this->Produto->inserir()) {
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
                        'produto'    => $this->Produto,
                        'retorno'       => $arrayRetorno,
                        'linkEditar'    => $this->config['dirPublic'].'produto/cadastro/'.$this->Produto->getID(),
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
        try {
            $this->Produto->receberDados($_POST);

            if ($this->Produto->atualizar()) {
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
                        'produto'    => $this->Produto,
                        'retorno'       => $arrayRetorno,
                        'linkEditar'    => $this->config['dirPublic'].'produto/cadastro/'.$this->Produto->getID(),
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