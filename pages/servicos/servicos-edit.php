<?php 

require __DIR__.'../../../vendor/autoload.php';

use \App\Entidy\Servico;
use   \App\Session\Login;

Login::requireLogin();


if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
 
    header('location: index.php?status=error');

    exit;
}

$item = Servico::getID($_GET['id']);


if(!$item instanceof Servico){
    header('location: index.php?status=error');

    exit;
}

if(isset($_GET['nome'])){
    
    $item->nome         = $_GET['nome'];
    $item-> atualizar();

    header('location: servicos-list.php?status=edit');

    exit;
}


