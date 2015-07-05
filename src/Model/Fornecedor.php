<?php
namespace Model;

use Lib\Model;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;

class Fornecedor extends Model {
    private $id;
    public $nome;
    private $email;

    public function getID() {
        return $this->id;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getEmail() {
        return $this->email;
    }

    public function receberDados(array $arrayDados) {
        try {
            if (isset($arrayDados['id'])) {
                $this->id = (v::numeric()->validate($arrayDados['id'])) ? $arrayDados['id'] : 0;
            }

            if (isset($arrayDados['nome'])) {
                $this->nome = (v::string()->length(1, 50)->validate($arrayDados['nome'])) ? $arrayDados['nome'] : null;
            } else {
                throw new \Exception('Preencha o nome');
            }

            if (isset($arrayDados['email'])) {
                $this->email = (v::email()->length(1, 255)->validate($arrayDados['email'])) ? $arrayDados['email'] : null;
            } else {
                throw new \Exception('Preencha o email');
            }
        } catch(NestedValidationExceptionInterface $e) {
            throw new \Exception($e->getCode(), $e->getFullMessage());
        }
    }

    public function selecionar($id) {
        $sql = "SELECT * FROM fornecedores WHERE id = :id LIMIT 0,1";

        try {
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue('id', $id, \PDO::PARAM_INT);

            if ($stmt->execute()) {
                $linha = $stmt->fetch(\PDO::FETCH_ASSOC);

                if (is_array($linha)) {
                    $this->id = $linha['id'];
                    $this->nome = $linha['nome'];
                    $this->email = $linha['email'];
                } else {
                    throw new \Exception('Fornecedor não encontrado');
                }
            } else {
                $array = $stmt->errorInfo();
                throw new \Exception($array[2], $array[1]);
            }

        } catch (\PDOException $e) {
            $array = $stmt->errorInfo();

            throw new \Exception($array[2], $array[1]);
        }
    }

    public function excluir() {
        $sql = "DELETE FROM fornecedores WHERE id = :id";

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
            $array = $stmt->errorInfo();

            throw new \Exception($array[2], $array[1]);
        }
    }

    public function inserir() {
        $sql = "INSERT INTO fornecedores (nome, email) VALUES (:nome, :email)";

        try {
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue('nome', $this->nome, \PDO::PARAM_STR);
            $stmt->bindValue('email', $this->email, \PDO::PARAM_STR);

            if ($stmt->execute()) {
                $this->id = $this->db->lastInsertId();

                return true;
            } else {
                $array = $stmt->errorInfo();
                throw new \Exception($array[2], $array[1]);
            }

        } catch (\PDOException $e) {
            $array = $stmt->errorInfo();

            throw new \Exception($array[2], $array[1]);
        }
    }

    public function atualizar() {
        $sql = "UPDATE fornecedores SET nome = :nome, email = :email WHERE id = :id";

        try {
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue('id', $this->id, \PDO::PARAM_STR);
            $stmt->bindValue('nome', $this->nome, \PDO::PARAM_STR);
            $stmt->bindValue('email', $this->email, \PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            } else {
                $array = $stmt->errorInfo();
                throw new \Exception($array[2], $array[1]);
            }

        } catch (\PDOException $e) {
            $array = $stmt->errorInfo();

            throw new \Exception($array[2], $array[1]);
        }
    }

    public function listar() {
        $sql = "SELECT * FROM fornecedores";

        try {
            $stmt = $this->db->prepare($sql);

            if ($stmt->execute()) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);

            } else {
                $array = $stmt->errorInfo();
                throw new \Exception($array[2], $array[1]);
            }

        } catch (\PDOException $e) {
            $array = $stmt->errorInfo();

            throw new \Exception($array[2], $array[1]);
        }
    }
}