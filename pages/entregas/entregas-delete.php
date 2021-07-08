<?php 

require __DIR__.'../../../vendor/autoload.php';

use \App\Entidy\Setor;
use   \App\Session\Login;


Login::requireLogin();



if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
 
    header('location: index.php?status=error');

    exit;
}

$item = Setor::getID($_GET['id']);

if(!$item instanceof Setor){
    header('location: index.php?status=error');

    exit;
}



if(!isset($_POST['excluir'])){
    
 
    $item->excluir();

    header('location: setores-list.php?status=del');

    exit;
}

