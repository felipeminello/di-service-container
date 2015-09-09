<?php
$f = $container['fornecedor-controller'];

$id = (isset($arrayUrl[2])) ? $arrayUrl[2] : 0;

echo $f->cadastro($id);

