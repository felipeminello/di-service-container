<?php
namespace Model;

use Libraries\Model;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;

class Produto extends Model {
    private $id;
    private $nome;
    private $unidade;
    private $Fornecedor;

	public function __construct(array $arrayDados = array()) {
		parent::__construct();

		$this->receberDados($arrayDados);
	}

    public function getID() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getUnidade() {
        return $this->unidade;
    }

    public function getFornecedor() {
        return $this->Fornecedor;
    }

	public function setFornecedor(Fornecedor $f) {
		$this->Fornecedor = $f;
	}

    public function receberDados(array $arrayDados) {
        try {
            if (isset($arrayDados['id'])) {
                $this->id = (v::numeric()->validate($arrayDados['id'])) ? $arrayDados['id'] : 0;
            }

            if (isset($arrayDados['nome'])) {
                $this->nome = (v::string()->length(1, 50)->validate($arrayDados['nome'])) ? $arrayDados['nome'] : null;
            }

			if (isset($arrayDados['unidade'])) {
				$this->unidade = (v::int()->validate($arrayDados['unidade'])) ? $arrayDados['unidade'] : 0;
			}

			if (isset($arrayDados['id_fornecedor'])) {
				if (v::instance('Model\Fornecedor')->validate($this->Fornecedor)) {
					$this->Fornecedor->selecionar($arrayDados['id_fornecedor']);


				}
			}

			if (isset($arrayDados['Fornecedor'])) {
				$this->Fornecedor = (v::instance('Model\Fornecedor')->validate($arrayDados['Fornecedor'])) ? $arrayDados['Fornecedor'] : null;
			}



		} catch(NestedValidationExceptionInterface $e) {
            throw new \Exception($e->getCode(), $e->getFullMessage());
        }
    }

	public function validarCadastro() {
		$idFornecedor = $this->Fornecedor->getID();

		if (empty($idFornecedor)) {
			throw new \Exception('Selecione o fornecedor');
		} elseif (empty($this->nome)) {
			throw new \Exception('Preencha o nome');
		} else {
			return true;
		}
	}

    public function selecionar($id) {
        $sql = "SELECT * FROM produtos WHERE id = :id LIMIT 0,1";

        try {
			$id = (v::numeric()->validate($id)) ? $id : 0;

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue('id', $id, \PDO::PARAM_INT);

            if ($stmt->execute()) {
                $linha = $stmt->fetch(\PDO::FETCH_ASSOC);

                if (is_array($linha)) {
                    $this->receberDados($linha);
                } else {
                    throw new \Exception('Produto não encontrado');
                }
            } else {
                $array = $stmt->errorInfo();
                throw new \Exception($array[2], $array[1]);
            }

        } catch (\PDOException $e) {
			throw $e;
        }
    }

    public function excluir() {
        $sql = "DELETE FROM produtos WHERE id = :id";

        try {
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue('id', $this->id, \PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                $array = $stmt->errorInfo();
                throw new \Exception($array[2], $array[1]);
            }

        } catch (\PDOException $e) {
			throw $e;
        }
    }

    public function inserir() {
		try {
			if ($this->validarCadastro()) {

				$sql = "INSERT INTO produtos (id_fornecedor, nome, unidade) VALUES (:id_fornecedor, :nome, :unidade)";

				try {
					$stmt = $this->db->prepare($sql);

					$stmt->bindValue('id_fornecedor', $this->Fornecedor->getID(), \PDO::PARAM_INT);
					$stmt->bindValue('nome', $this->nome, \PDO::PARAM_STR);
					$stmt->bindValue('unidade', $this->unidade, \PDO::PARAM_INT);

					if ($stmt->execute()) {
						$this->id = $this->db->lastInsertId();

						return true;
					}
					else {
						$array = $stmt->errorInfo();
						throw new \Exception($array[2], $array[1]);
					}

				} catch (\PDOException $e) {
					throw $e;
				}
			}
		} catch (\PDOException $e) {
			throw $e;
		}
    }

    public function atualizar() {
		try {
			if ($this->validarCadastro()) {
				$sql = "UPDATE produtos SET id_fornecedor = :id_fornecedor, nome = :nome, unidade = :unidade WHERE id = :id";

				try {
					$stmt = $this->db->prepare($sql);

					$stmt->bindValue('id', $this->id, \PDO::PARAM_INT);
					$stmt->bindValue('id_fornecedor', $this->Fornecedor->getID(), \PDO::PARAM_INT);
					$stmt->bindValue('nome', $this->nome, \PDO::PARAM_STR);
					$stmt->bindValue('unidade', $this->unidade, \PDO::PARAM_STR);

					if ($stmt->execute()) {
						return true;
					} else {
						$array = $stmt->errorInfo();
						throw new \Exception($array[2], $array[1]);
					}

				} catch (\PDOException $e) {
					throw $e;
				}
			}
		} catch (\PDOException $e) {
			throw $e;
		}
    }

    public function listar() {
        $sql = "SELECT p.*, f.id AS f_id, f.nome AS f_nome FROM produtos p LEFT JOIN (fornecedores f) ON f.id = p.id_fornecedor GROUP BY p.id";

        try {
            $stmt = $this->db->query($sql);

            if ($stmt->execute()) {
				$array = array();
                $linhas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

				foreach($linhas as $linha) {
					unset($linha['id_fornecedor']);

					$f = new Fornecedor();
					$f->receberDados(array('id' => $linha['f_id'], 'nome' => $linha['f_nome']));

					$linha['Fornecedor'] = $f;

					$p = new Produto($linha);

					$array[] = $p;
				}

				return $array;

            } else {
                $array = $stmt->errorInfo();
                throw new \Exception($array[2], $array[1]);
            }

        } catch (\PDOException $e) {
			throw $e;
        }
    }
}