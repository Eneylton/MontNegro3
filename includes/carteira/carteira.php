<?php

if (isset($_GET['status'])) {

   switch ($_GET['status']) {
      case 'success':
         $icon  = 'success';
         $title = 'Parabéns';
         $text = 'Cadastro realizado com Sucesso !!!';
         break;

      case 'del':
         $icon  = 'error';
         $title = 'Parabéns';
         $text = 'Esse usuário foi excluido !!!';
         break;

      case 'edit':
         $icon  = 'warning';
         $title = 'Parabéns';
         $text = 'Cadastro atualizado com sucesso !!!';
         break;


      default:
         $icon  = 'error';
         $title = 'Opss !!!';
         $text = 'Você não tem nenhum saldo na carteira até o momento!!!';
         break;
   }

   function alerta($icon, $title, $text)
   {
      echo "<script type='text/javascript'>
      Swal.fire({
        type:'type',  
        icon: '$icon',
        title: '$title',
        text: '$text'
       
      }) 
      </script>";
   }

   alerta($icon, $title, $text);
}


$valor = 0;
$saldo = 0;
$val = 0;
$valor_dia = 0;
$saldo_dia = 0;
$val_dia = 0;
$dev_dia = 0;


foreach ($entregas as $item) {

   $valor += $item->total;
}

foreach ($entregas_dia as $item) {

   $valor_dia += $item->total;
}

foreach ($devolucoes_dia as $item) {

   $dev_dia += $item->total;
}


$val_dia = $valor_dia;
$val = $valor;
$saldo_dia = ($valor_dia * 2);
$saldo = ($valor * 2);

?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-6">
            <div class="card">
               <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                     <h3 class="card-title">Entregas</h3>
                     <a href="javascript:void(0);">TOTAL PRO MÊS</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex">
                     <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Quantidade: <?= $val ?></span>
                        <span>Entregador: <?= $nome ?></span>
                     </p>
                     <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                           <i class="fas fa-arrow-up"></i>&nbsp; R$ <?= number_format($saldo, "2", ",", ".") ?>
                        </span>
                        <span class="text-muted">Desde o último mês</span>
                     </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="card-body">

                     <canvas id="myChart" width="400" height="100"></canvas>
                  </div>

                  <div class="d-flex flex-row justify-content-end">
                     <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Entregadores
                     </span>

                     <span>
                        <i class="fas fa-square text-gray"></i> <?= date('d/m/Y') ?>
                     </span>
                  </div>
               </div>
            </div>



         </div>

         <div class="col-lg-6">
            <div class="card">
               <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                     <h3 class="card-title">
                        <P>PRODUÇÃO DIÁRIA</P>
                     </h3>
                     <a href="javascript:void(0);">TOTAL POR DIA </a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex">
                     <p class="d-flex flex-column">
                        <span class="text-bold text-lg">R$ <?= number_format($saldo_dia, "2", ",", ".") ?></span>
                        <span>Acumulado no mês</span>
                     </p>
                     <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                           <i class="fas fa-arrow-up"></i> &nbsp; R$ <?= number_format($total, "2", ",", ".") ?>
                        </span>
                        <span class="text-muted">Acumulado do dia </span>
                     </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="card-body">

                     <canvas id="myChart2" width="400" height="100"></canvas>

                  </div>

                  <div class="d-flex flex-row justify-content-end">
                     <span class="mr-2">
                        <i class="fas fa-square text-success"></i> Entrga: <?= $valor_dia ?>
                     </span>

                     <span>
                        <i class="fas fa-square text-danger"></i> Devolução: <?= $dev_dia ?>
                     </span>
                  </div>
               </div>
            </div>



         </div>

         <div class="col-lg-6">
            <div class="card">
               <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                     <h3 class="card-title">OCORRÊNCIAS</h3>
                     <a href="javascript:void(0);">ESTATÍSTICA</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex">
                     <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Quantidade: 18</span>
                        <span>Mensal</span>
                     </p>
                     <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-danger">
                           <i class="fas fa-arrow-down"></i> 45.9%
                        </span>
                        <span class="text-muted">Deste mês</span>
                     </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="card-body">

                     <canvas id="myChart3" width="400" height="130"></canvas>

                  </div>

                  <div class="d-flex flex-row justify-content-end">
                     <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Ocorrências
                     </span>

                     <span>
                        <i class="fas fa-square text-gray"></i> <?= date('d/m/Y') ?>
                     </span>
                  </div>
               </div>
            </div>



         </div>

         <div class="col-lg-6">
            <div class="card">
               <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                     <h3 class="card-title">OCORRÊNCIAS</h3>
                     <a href="javascript:void(0);">ESTATÍSTICAS</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex">
                     <p class="d-flex flex-column">
                        <span class="text-bold text-lg">45</span>
                        <span>TOTAL DE DIÁRIAS</span>
                     </p>
                     <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-danger">
                           <i class="fas fa-arrow-down"></i> 43.1%
                        </span>
                        <span class="text-muted">DIÁRIA</span>
                     </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="card-body">

                     <canvas id="myChart4" width="400" height="130"></canvas>

                  </div>

                  <div class="d-flex flex-row justify-content-end">
                     <span class="mr-2">
                        <i class="fas fa-square text-warning"></i> Ocorrências
                     </span>

                     <span>
                        <i class="fas fa-square text-danger"></i> <?= date('d/m/Y') ?>
                     </span>
                  </div>
               </div>
            </div>



         </div>


      </div>

</section>