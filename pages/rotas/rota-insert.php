<?php

require __DIR__ . '../../../vendor/autoload.php';

use  \App\Entidy\Rota;
use   \App\Session\Login;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

if (isset($_POST['descricao'])) {
   
    $item = new Rota;
    $item->descricao     = $_POST['descricao'];
    $item->cadastar();

    header('location: rota-list.php?status=success');
    exit;
}
