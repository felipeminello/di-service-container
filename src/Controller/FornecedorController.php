<?php
namespace Controller;

use Model\Fornecedor;

class FornecedorController extends \Lib\Controller {
    public function listar() {

        $f = new Fornecedor();

        try {
            $listaFornecedor = $f->listar();

            return $this->twig->render(
                'fornecedor/listar.twig',
                array(
                    'listaFornecedor' => $listaFornecedor,
                    'linkEditar'    => $this->config['dirPublic'].'fornecedor/cadastro/',
                    'linkInserir'    => $this->config['dirPublic'].'fornecedor/cadastro/',
                    'linkExcluir'    => $this->config['dirPublic'].'fornecedor/excluir/json/',
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
        $f = new Fornecedor();

        try {
            if ($id > 0) {
                $f->selecionar($id);

                $pagina = 'editar/'.$id;
            } else {
                $pagina = 'inserir';
            }

            return $this->twig->render(
                'fornecedor/cadastro.twig',
                array(
                    'fornecedor' => $f,
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
        $f = new Fornecedor();

        try {
            $f->selecionar($id);

            if ($f->excluir()) {
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
                        'fornecedor'    => $f,
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
            $f->receberDados($arrayPost);

            if ($f->inserir()) {
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
                        'fornecedor'    => $f,
                        'retorno'       => $arrayRetorno,
                        'linkEditar'    => $this->config['dirPublic'].'fornecedor/cadastro/'.$f->getID(),
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
        $f = new Fornecedor();

        try {
            $f->receberDados($_POST);

            if ($f->atualizar()) {
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
                        'fornecedor'    => $f,
                        'retorno'       => $arrayRetorno,
                        'linkEditar'    => $this->config['dirPublic'].'fornecedor/cadastro/'.$f->getID(),
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