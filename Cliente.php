<?php
class Cliente {
    public function listar() {
        global $db;
        $sql = "SELECT * FROM clientes";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}