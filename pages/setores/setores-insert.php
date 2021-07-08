<?php

require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Setor;
use   \App\Session\Login;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

if (isset($_POST['nome'])) {
   
    $item = new Setor;
    $item->nome           = $_POST['nome'];
    $item->cadastar();

    header('location: setores-list.php?status=success');
    exit;
}
