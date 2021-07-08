<?php

require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Entregador;
use   \App\Session\Login;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

if (isset($_POST['nome'])) {
   
    $item = new Entregador;
    $item->nome           = $_POST['nome'];
    $item->telefone       = $_POST['telefone'];
    $item->email          = $_POST['email'];
    $item->banco          = $_POST['banco'];
    $item->conta          = $_POST['conta'];
    $item->agencia        = $_POST['agencia'];
    $item->rotas_id       = $_POST['rotas_id'];
    $item->regioes_id     = $_POST['regiao'];
    $item->veiculos_id    = $_POST['veiculos_id'];
    $item->usuarios_id    = $usuario;
    $item->cadastar();

    header('location: entregador-list.php?status=success');
    exit;
}
