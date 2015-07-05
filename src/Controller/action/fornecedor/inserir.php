<?php
use Controller\FornecedorController;

$fController = new FornecedorController();

$arrayPost = $_POST;

echo $fController->inserir(null, $arrayPost);

