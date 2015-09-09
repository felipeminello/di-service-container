<?php
namespace Controller;

class FornecedorController extends \Libraries\Controller {
	private $Fornecedor;

	public function setFornecedor($f) {
		$this->Fornecedor = $f;
	}

    public function listar() {
        try {
            $listaFornecedor = $this->Fornecedor->listar();

            return $this->twig->render(
                'fornecedor/listar.twig',
                array(
                    'listaFornecedor' => $listaFornecedor,
                    'linkEditar'    => $this->config['dirPublic'].'fornecedor/cadastro/',
                    'linkInserir'    => $this->config['dirPublic'].'fornecedor/cadastro/',
                    'linkExcluir'    => $this->config['dirPublic'].'fornecedor/excluir/json/',
                    'linkExcluirLote'    => $this->config['dirPublic'].'fornecedor/excluir-lote/html/',
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
            if ($id > 0) {
                $this->Fornecedor->selecionar($id);

                $pagina = 'editar/'.$id;
            } else {
                $pagina = 'inserir';
            }

            return $this->twig->render(
                'fornecedor/cadastro.twig',
                array(
                    'fornecedor' => $this->Fornecedor,
                    'action' => $this->config['dirPublic'].'fornecedor/'.$pagina,
                    'linkListar' => $this->config['dirPublic'].'fornecedor/listar/',
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
            $this->Fornecedor->selecionar($id);

            if ($this->Fornecedor->excluir()) {
                $arrayRetorno['r'] = true;
                $arrayRetorno['m'] = 'Fornecedor excluído com sucesso';
            } else {
                $arrayRetorno['r'] = false;
                $arrayRetorno['m'] = 'Problema ao excluir (FornecedorController)';
            }

            if (strtolower($retorno) == 'json') {
                return json_encode($arrayRetorno);
            } else {
                return $this->twig->render(
                    'fornecedor/excluir.twig',
                    array(
                        'fornecedor'    => $this->Fornecedor,
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
                $this->Fornecedor->selecionar($id);

                if ($this->Fornecedor->excluir()) {
                    $arrayRetorno['r'] = true;
                    $arrayRetorno['m'] = 'Fornecedores excluídos com sucesso';
                } else {
                    $arrayRetorno['r'] = false;
                    $arrayRetorno['m'] = 'Problema ao excluir (FornecedorController)';

                    break;
                }
            }

            if (strtolower($retorno) == 'json') {
                return json_encode($arrayRetorno);
            } else {
                return $this->twig->render(
                    'fornecedor/excluir.twig',
                    array(
                        'fornecedor'    => $this->Fornecedor,
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
            $this->Fornecedor->receberDados($arrayPost);

            if ($this->Fornecedor->inserir()) {
                $arrayRetorno['r'] = true;
                $arrayRetorno['m'] = 'Fornecedor inserido com sucesso';
            } else {
                $arrayRetorno['r'] = false;
                $arrayRetorno['m'] = 'Problema ao inserir (FornecedorController)';
            }

            if (strtolower($retorno) == 'json') {
                return json_encode($arrayRetorno);
            } else {
                return $this->twig->render(
                    'fornecedor/visualizar.twig',
                    array(
                        'fornecedor'    => $this->Fornecedor,
                        'retorno'       => $arrayRetorno,
                        'linkEditar'    => $this->config['dirPublic'].'fornecedor/cadastro/'.$this->Fornecedor->getID(),
                        'linkInserir'    => $this->config['dirPublic'].'fornecedor/cadastro/',
                        'linkListar'    => $this->config['dirPublic'].'fornecedor/listar/',
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
            $this->Fornecedor->receberDados($_POST);

            if ($this->Fornecedor->atualizar()) {
                $arrayRetorno['r'] = true;
                $arrayRetorno['m'] = 'Fornecedor atualizado com sucesso';
            } else {
                $arrayRetorno['r'] = false;
                $arrayRetorno['m'] = 'Problema ao atualizar (FornecedorController)';
            }

            if (strtolower($retorno) == 'json') {
                return json_encode($arrayRetorno);
            } else {
                return $this->twig->render(
                    'fornecedor/visualizar.twig',
                    array(
                        'fornecedor'    => $this->Fornecedor,
                        'retorno'       => $arrayRetorno,
                        'linkEditar'    => $this->config['dirPublic'].'fornecedor/cadastro/'.$this->Fornecedor->getID(),
                        'linkInserir'    => $this->config['dirPublic'].'fornecedor/cadastro/',
                        'linkListar'    => $this->config['dirPublic'].'fornecedor/listar/',
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