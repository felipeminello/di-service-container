<?php
use Controller\ProdutoController;

$p = new ProdutoController();

$arrayID = $_POST['array_id'];

echo $p->excluirLote($arrayUrl[2], $arrayID);

