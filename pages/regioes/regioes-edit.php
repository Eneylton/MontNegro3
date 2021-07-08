<?php 

require __DIR__.'../../../vendor/autoload.php';

use \App\Entidy\Regiao;
use   \App\Session\Login;

Login::requireLogin();


if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
 
    header('location: index.php?status=error');

    exit;
}

$item = Regiao::getRotasID($_GET['id']);


if(!$item instanceof Regiao){
    header('location: index.php?status=error');

    exit;
}



if(isset($_GET['nome'])){
    
    $item->nome     = $_GET['nome'];
    $item->rotas_id = $_GET['rotas_id'];
    $item-> atualizar();

    header('location: regioes-list.php?status=edit');

    exit;
}


