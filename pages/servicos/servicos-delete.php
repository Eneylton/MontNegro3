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



if(!isset($_POST['excluir'])){
    
 
    $item->excluir();

    header('location: servicos-list.php?status=del');

    exit;
}

