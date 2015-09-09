<?php
$p = $container['produto-controller'];

$arrayPost = $_POST;

echo $p->inserir(null, $arrayPost);

