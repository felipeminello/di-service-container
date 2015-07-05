<?php
use Controller\FornecedorController;

$fController = new FornecedorController();

$id = (isset($arrayUrl[2])) ? $arrayUrl[2] : 0;

echo $fController->cadastro($id);

