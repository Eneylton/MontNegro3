<?php

require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Cliente;
use  \App\Entidy\Receber;
use   \App\Session\Login;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

if (isset($_POST['qtd'])) {
   
    $item = new Receber;
    $item->qtd              = $_POST['qtd'];
    $item->recebido         = $_POST['qtd'];
    $item->usuarios_id      = $usuario ;
    $item->clientes_id      = $_POST['clientes_id'];
    $item->cadastar();

    header('location: receber-list.php?status=success');
    exit;
}
