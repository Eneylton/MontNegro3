<?php 

require __DIR__.'../../../vendor/autoload.php';

use App\Entidy\Carteira;
use App\Entidy\Entrega;
use App\Entidy\Logistica;
use App\Session\Login;

Login::requireLogin();


if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
 
    header('location: index.php?status=error');

    exit;
}

$item = Logistica::getRotasID($_GET['id']);




if(!$item instanceof Logistica){
    header('location: index.php?status=error');

    exit;
}


$valor1 = 0;
$valor2 = 0;
$calculo = 0;
$calculo2 = 0;

if(isset($_GET['cod_id'])){

    $valor1 = $item->qtd;
   
    $qtd_atual = (int)$valor1;

    
    $valor2 = $_GET['qtd'];
    
    $qtd_entregue = (int)$valor2; 
    
    if($qtd_atual >= $qtd_entregue){

        $entrega = new Entrega;
        $entrega->logisticas_id              = $_GET['id'];
        $entrega->cod_id                     = $_GET['cod_id'];
        $entrega->qtd                        = $_GET['qtd'];
        $entrega->receber_id                 = $_GET['id_receber2'];
        $entrega->entregadores_id            = $_GET['entregadores_id'];
        $entrega->cadastar();


        $calculo2 = $qtd_entregue * 2;
        $calculo = ($qtd_atual - $qtd_entregue);
        
        $item->qtd = $calculo;
        $item-> atualizar();
        
        $carteira = new Carteira;
        
        $carteira->qtd = $_GET['qtd'];
        $carteira->valor = $calculo2;
        $carteira->cod_id = $_GET['cod_id'];
        $carteira->entregadores_id = $_GET['entregadores_id'];
        $carteira->cadastar();


        header('location: ../receber/receber-list.php?status=success');

        exit;


    }

    header('location: logistica-list.php?status=error2');

    exit;
}


