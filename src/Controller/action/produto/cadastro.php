<?php
$p = $container['produto-controller'];

$id = (isset($arrayUrl[2])) ? $arrayUrl[2] : 0;

echo $p->cadastro($id);

