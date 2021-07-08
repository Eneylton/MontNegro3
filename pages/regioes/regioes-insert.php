<?php

require __DIR__ . '../../../vendor/autoload.php';

use  \App\Entidy\Regiao;
use   \App\Session\Login;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

if (isset($_POST['nome'])) {
   
    $item = new Regiao;
    $item->nome     = $_POST['nome'];
    $item->rotas_id     = $_POST['rotas_id'];
    $item->cadastar();

    header('location: regioes-list.php?status=success');
    exit;
}
