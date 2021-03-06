<?php

require __DIR__ . '../../../vendor/autoload.php';

define('TITLE', 'Novo Usuário');
define('BRAND', 'Cadastrar Usuário');

use  \App\Entidy\Cliente;
use   \App\Session\Login;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

if (isset($_POST['nome'])) {

    $item = new Cliente;
    $item->nome              = $_POST['nome'];
    $item->servicos_id       = $_POST['servicos_id'];
    $item->setores_id        = $_POST['setores_id'];
    $item->usuarios_id       = $usuario ;
    $item->cadastar();

    header('location: clientes-list.php?status=success');
    exit;
}
