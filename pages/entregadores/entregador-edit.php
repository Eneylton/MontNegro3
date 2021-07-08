<?php 

require __DIR__.'../../../vendor/autoload.php';

use \App\Entidy\Entregador;
use   \App\Session\Login;

Login::requireLogin();


if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
 
    header('location: index.php?status=error');

    exit;
}

$item = Entregador::getID($_GET['id']);


if(!$item instanceof Entregador){
    header('location: index.php?status=error');

    exit;
}

if(isset($_GET['nome'])){
    
    $item->nome         = $_GET['nome'];
    $item->telefone     = $_GET['telefone'];
    $item->email        = $_GET['email'];
    $item->banco        = $_GET['banco'];
    $item->conta        = $_GET['conta'];
    $item->agencia      = $_GET['agencia'];
    $item->rotas_id     = $_GET['rotas_id'];
    $item->regioes_id   = $_GET['regioes_id'];
    $item->veiculos_id  = $_GET['veiculos_id'];
    $item-> atualizar();

    header('location: entregador-list.php?status=edit');

    exit;
}


