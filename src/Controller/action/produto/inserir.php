<?php
use Controller\ProdutoController;

$p = new ProdutoController();

$arrayPost = $_POST;

echo $p->inserir(null, $arrayPost);

