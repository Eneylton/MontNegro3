<?php

require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Estatistica;
use   \App\Session\Login;

define('TITLE','Estatísticas');
define('BRAND','Estatística');

$alertaLogin  = '';
$alertaCadastro = '';

$usuariologado = Login::getUsuarioLogado();

$usuario = $usuariologado['id'];

Login::requireLogin();

$estatistica01 = Estatistica :: getList();
$estatistica02 = Estatistica :: getList2();


include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/estatistica/estatistica-form-list.php';
include __DIR__ . '../../../includes/layout/footer.php';

?>


<script type="text/javascript">
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [

            <?php
            foreach ($estatistica01 as $item) {
                echo "'".$item->entregadores."',";
            }
             
            ?>
        ]
        ,
        datasets: [{
            label: '• Entragas •',
            data: [
                <?php
            foreach ($estatistica01 as $item) {
                echo "'".$item->entregas."',";
            }
             
            ?>
            ],
            backgroundColor: [
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                
               
            ],
            borderColor: [
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
                '#44c109',
               
             
            ],
            borderWidth: 1
        },
        {
            label: '• Devoluções  •',
            data: [
                <?php
            foreach ($estatistica01 as $item) {
                echo "'".$item->devolucao."',";
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
var ctx = document.getElementById('myChart2').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [

            <?php
            foreach ($estatistica02 as $item) {
                echo "'".$item->ocorrencias."',";
            }
             
            ?>
        ]
        ,
        datasets: [{
            label: '• PRODUTOS MAIS VENDIDOS •',
            data: [
                <?php
            foreach ($estatistica02 as $item) {
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
                '#33b092'
            ],
            borderColor: [
                '#6EE633',
                '#9d64a4',
                '#ee911d',
                '#d12f61',
                '#3d606c',
                '#F0379A',
                '#763DD9',
                '#d0ff00',
                '#3794F0',
                '#33b092'
             
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
var ctx = document.getElementById('myChart3').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [

            <?php
            foreach ($estatistica01 as $item) {
                echo "'".$item->entregadores."',";
            }
             
            ?>
        ]
        ,
        datasets: [{
            label: '• Entragas •',
            fill: false,
            tension:0.5,
            data: [
                <?php
            foreach ($estatistica01 as $item) {
                echo "'".$item->entregas."',";
            }
             
            ?>
            ],
            backgroundColor: [
                '#00ff00', 
               
            ],
            borderColor: [
                '#00ff00',
                
            ],
            borderWidth: 1
        },
        {
            label: '• Devoluções  •',
            fill: true,
            tension: 0.5,
            data: [
                <?php
            foreach ($estatistica01 as $item) {
                echo "'".$item->devolucao."',";
            }
             
            ?>
            ],
            backgroundColor: [
                '#ff0000',
              
            ],
            borderColor: [
                '#ff0000',
                
                
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
var ctx = document.getElementById('myChart4').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [

            <?php
            foreach ($estatistica02 as $item) {
                echo "'".$item->ocorrencias."',";
            }
             
            ?>
        ]
        ,
        datasets: [{
            label: '• PRODUTOS MAIS VENDIDOS •',
            data: [
                <?php
            foreach ($estatistica02 as $item) {
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
                '#33b092'
            ],
            borderColor: [
                '#6EE633',
                '#9d64a4',
                '#ee911d',
                '#d12f61',
                '#3d606c',
                '#F0379A',
                '#763DD9',
                '#d0ff00',
                '#3794F0',
                '#33b092'
             
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