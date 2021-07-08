<?php 

require __DIR__.'../../../vendor/autoload.php';

use \App\Entidy\Ocorrencia;
use   \App\Session\Login;

Login::requireLogin();


if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
 
    header('location: index.php?status=error');

    exit;
}

$item = Ocorrencia::getRotasID($_GET['id']);


if(!$item instanceof Ocorrencia){
    header('location: index.php?status=error');

    exit;
}



if(isset($_GET['nome'])){
    
    $item->nome = $_GET['nome'];
    $item-> atualizar();

    header('location: ocorrencia-list.php?status=edit');

    exit;
}


