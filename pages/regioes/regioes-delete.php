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



if(!isset($_POST['excluir'])){
    
 
    $item->excluir();

    header('location: regioes-list.php?status=del');

    exit;
}

