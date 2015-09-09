<?php
namespace Libraries;

class Conexao implements ConexaoInterface {
    private $host;
    private $dbname;
    private $user;
    private $password;

    public function __construct(array $arrayDados) {
        $this->host = $arrayDados['dbhost'];
        $this->dbname = $arrayDados['dbname'];
        $this->user = $arrayDados['dbuser'];
        $this->password = $arrayDados['dbpassword'];
    }

    public function connect() {
        return new \PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
    }
}
