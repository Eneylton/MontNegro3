<?php

require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Devolucao;
use App\Entidy\Logistica;
use App\Session\Login;

Login::requireLogin();


if (!isset($_GET['id2']) or !is_numeric($_GET['id2'])) {

    header('location: index.php?status=error');

    exit;
}

$item = Logistica::getRotasID($_GET['id2']);




if (!$item instanceof Logistica) {
    header('location: index.php?status=error');

    exit;
}


$valor1 = 0;
$valor2 = 0;
$calculo = 0;

if (isset($_GET['cod_id2'])) {

    $valor1 = $item->qtd;

    $qtd_atual = (int)$valor1;


    $valor2 = $_GET['qtd2'];

    $qtd_dev = (int)$valor2;

    if ($qtd_atual >= $qtd_dev) {

        $entrega = new Devolucao;
        $entrega->logisticas_id              = $_GET['id2'];
        $entrega->cod_id                     = $_GET['cod_id2'];
        $entrega->qtd                        = $_GET['qtd2'];
        $entrega->entregadores_id            = $_GET['entregadores_id2'];
        $entrega->receber_id                 = $_GET['id_receber3'];
        $entrega->ocorrencias_id             = $_GET['ocorrencias_id2'];
        $entrega->cadastar();

        $calculo = ($qtd_atual - $qtd_dev);

        $item->qtd = $calculo;
        $item->atualizar();


        header('location: ../receber/receber-list.php?status=success');

        exit;
    }

    header('location: ../receber/receber-list.php?status=error2');
    exit;
}
