<?php
$f = $container['fornecedor-controller'];

$arrayPost = $_POST;

echo $f->inserir(null, $arrayPost);

