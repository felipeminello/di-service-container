<?php
use Controller\FornecedorController;

$fController = new FornecedorController();

$arrayID = $_POST['array_id'];

echo $fController->excluirLote($arrayUrl[2], $arrayID);

