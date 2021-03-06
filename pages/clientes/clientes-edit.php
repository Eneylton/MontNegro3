<?php 

require __DIR__.'../../../vendor/autoload.php';

use \App\Entidy\Cliente;
use   \App\Session\Login;

Login::requireLogin();


if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
 
    header('location: index.php?status=error');

    exit;
}

$item = Cliente::getID($_GET['id']);


if(!$item instanceof Cliente){
    header('location: index.php?status=error');

    exit;
}

if(isset($_GET['nome'])){
    
    $item->nome              = $_GET['nome'];
    $item->servicos_id       = $_GET['servicos_id'];
    $item->setores_id        = $_GET['setores_id'];
    $item-> atualizar();

    header('location: clientes-list.php?status=edit');

    exit;
}


