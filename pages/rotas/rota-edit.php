<?php 

require __DIR__.'../../../vendor/autoload.php';

use \App\Entidy\Rota;
use   \App\Session\Login;

Login::requireLogin();


if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
 
    header('location: index.php?status=error');

    exit;
}

$item = Rota::getRotasID($_GET['id']);


if(!$item instanceof Rota){
    header('location: index.php?status=error');

    exit;
}



if(isset($_GET['descricao'])){
    
    $item->descricao = $_GET['descricao'];
    $item-> atualizar();

    header('location: rota-list.php?status=edit');

    exit;
}


