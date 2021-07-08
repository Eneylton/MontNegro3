<?php

require __DIR__ . '../../../vendor/autoload.php';

$alertaCadastro = '';

define('TITLE', 'Carteira');
define('BRAND', 'Carteira');

use \App\Entidy\Carteira;
use App\Entidy\Devolucao;
use  \App\Entidy\Entrega;
use App\Entidy\Entregador;
use   \App\Session\Login;



Login::requireLogin();

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {

    header('location: entregcarteira-list.php?status=error');

    exit;
}

$entregador = Entregador::getID($_GET['id']);

$nome =  $entregador->nome;

$value = Carteira::getID($_GET['id']);



if (!$value instanceof Carteira) {

    header('location: entregcarteira-list.php?status=error');
    
    exit;
}

$entregas = Entrega :: getListEntregas($_GET['id']);

$entregas_dia = Entrega :: getListEntID($_GET['id']);

$devolucoes = Devolucao:: getDevID($_GET['id']);

$ocorrencias = Devolucao:: getDevOcorrencia($_GET['id']);

$devolucoes_dia = Devolucao:: getDevDia($_GET['id']);

$diaria = Entrega :: getListEntTotal($_GET['id']);

$total = $diaria->total * 2;

include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/carteira/carteira.php';
include __DIR__ . '../../../includes/layout/footer.php';

?>

<script type="text/javascript">
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [

            <?php
           
            foreach ($entregas as $item) {
           
                echo "'".date('d / M', strtotime($item->data))."',";
            }
             
            ?>
        ]
        ,
        datasets: [{
            label: '• PRODUÇÃO MENSAL •',
            data: [
                <?php
            foreach ($entregas as $item) {
                echo "'".$item->total."',";
            }
             
            ?>
            ],
            backgroundColor: [
                '#6fe633a8',
                '#9d64a480',
                '#ee901d8f',
                '#d12f61',
                '#3d606c',
                '#F0379A',
                '#763dd986',
                '#d0ff0093',
                '#3794F0',
                '#ff00ff',
                '#ff0000',
                '#121212'
            ],
            borderColor: [
                '#6fe633a8',
                '#9d64a480',
                '#ee901d8f',
                '#d12f61',
                '#3d606c',
                '#F0379A',
                '#763dd986',
                '#d0ff0093',
                '#3794F0',
                '#ff00ff',
                '#ff0000',
                '#121212'
             
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script type="text/javascript">
var ctx = document.getElementById('myChart2').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [

            <?php
           
            foreach ($entregas_dia as $item) {
           
                echo "'".date('d / M', strtotime($item->data))."',";
            }
             
            ?>
        ]
        ,
        datasets: [{
            label: '• ENTREGAS •',
            data: [
                <?php
            foreach ($entregas_dia as $item) {
                echo "'".$item->total."',";
            }
             
            ?>
            ],
            backgroundColor: [
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
             
            ],
            borderColor: [
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8',
                '#6fe633a8'
             
            ],
            borderWidth: 1
        },
        
        {
            label: '• DEVOLUÇÕES •',
            data: [
                <?php
            foreach ($devolucoes as $item) {
                echo "'".$item->total."',";
            }
             
            ?>
            ],
            backgroundColor: [
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000'
            ],
            borderColor: [
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000',
                '#ff0000'
             
            ],
            borderWidth: 1
        }
        
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script type="text/javascript">
var ctx = document.getElementById('myChart3').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [

            <?php
           
            foreach ($ocorrencias as $item) {
           
                echo "'".$item->nome."',";
            }
             
            ?>
        ]
        ,
        datasets: [{
            label: '• OCORRÊNCIAS •',
            data: [
                <?php
            foreach ($ocorrencias as $item) {
                echo "'".$item->total."',";
            }
             
            ?>
            ],
            backgroundColor: [
                '#6fe633a8',
                '#9d64a480',
                '#ee901d8f',
                '#d12f61',
                '#3d606c',
                '#F0379A',
                '#763dd986',
                '#d0ff0093',
                '#3794F0',
                '#ff00ff',
                '#ff0000',
                '#121212'
            ],
            borderColor: [
                '#6fe633a8',
                '#9d64a480',
                '#ee901d8f',
                '#d12f61',
                '#3d606c',
                '#F0379A',
                '#763dd986',
                '#d0ff0093',
                '#3794F0',
                '#ff00ff',
                '#ff0000',
                '#121212'
             
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>


<script type="text/javascript">
var ctx = document.getElementById('myChart4').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [

            <?php
           
            foreach ($ocorrencias as $item) {
           
                echo "'".$item->nome."',";
            }
             
            ?>
        ]
        ,
        datasets: [{
            label: '• OCORRÊNCIAS •',
            data: [
                <?php
            foreach ($ocorrencias as $item) {
                echo "'".$item->total."',";
            }
             
            ?>
            ],
            backgroundColor: [
                '#6fe633a8',
                '#9d64a480',
                '#ee901d8f',
                '#d12f61',
                '#3d606c',
                '#F0379A',
                '#763dd986',
                '#d0ff0093',
                '#3794F0',
                '#ff00ff',
                '#ff0000',
                '#121212'
            ],
            borderColor: [
                '#6fe633a8',
                '#9d64a480',
                '#ee901d8f',
                '#d12f61',
                '#3d606c',
                '#F0379A',
                '#763dd986',
                '#d0ff0093',
                '#3794F0',
                '#ff00ff',
                '#ff0000',
                '#121212'
             
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

