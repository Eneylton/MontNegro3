<?php

require __DIR__ . '../../../vendor/autoload.php';

use  \App\Entidy\Ocorrencia;
use   \App\Session\Login;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

if (isset($_POST['nome'])) {
   
    $item = new Ocorrencia;
    $item->nome            = $_POST['nome'];
    $item->usuarios_id     = $usuario;
    $item->cadastar();

    header('location: ocorrencia-list.php?status=success');
    exit;
}
