<?php
use Controller\ProdutoController;

$p = new ProdutoController();

$id = (isset($arrayUrl[2])) ? $arrayUrl[2] : 0;

echo $p->cadastro($id);

