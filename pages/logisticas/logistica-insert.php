<?php

require __DIR__ . '../../../vendor/autoload.php';

use  \App\Entidy\Logistica;
use App\Entidy\Receber;
use   \App\Session\Login;

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

 // GERAR CODIGO
 $codigo = substr(uniqid(rand()), 0, 8);

 $calc = 0;
 $qtd = 0;

if (isset($_POST['data_inicio'])) {

    $id = $_POST['id_receber'];
    $qtd =  $_POST['qtd'];

    $receb = Receber :: getRecebID($id);
    
    $calc = $receb->qtd - $qtd;

    $receb->qtd = $calc;
    $receb-> atualizar();
   
    $item = new Logistica;
    $item->cod_id              = $codigo;
    $item->qtd                 = $_POST['qtd'];
    $item->data                = $_POST['data_inicio'];
    $item->servicos_id         = $_POST['servicos_id'];
    $item->entregadores_id     = $_POST['entregador'];
    $item->clientes_id         = $_POST['clientes_id'];
    $item->data_inicio         = $_POST['data_inicio'];
    $item->data_fim            = $_POST['data_fim'];
    $item->regioes_id          = $_POST['regioes_id'];
    $item->receber_id          = $_POST['id_receber'];
    $item->cadastar();

    header('location: ../receber/receber-list.php?status=success');

    exit;  
}
