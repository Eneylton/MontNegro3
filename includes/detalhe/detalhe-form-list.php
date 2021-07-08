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

$sub_total = 0;
$bruto = 0;
$saldo = 0;
$sub = 0;
$calc = 0;

$resultados = '';

foreach ($entregadores as $item) {
   
   $sub_total = ($item->entrega + $item->devolucao);

   $sub =   $sub_total * 2 ;

   $calc = $sub * 2 ; 

   $bruto += $sub_total;

   $saldo = $bruto * 2; 

   $resultados .= '<tr>
                      <td style="display:none">' . $item->codigo . '</td>
                      <td style="text-transform:uppercase">' . $item->codigo . '</td>
                      <td style="text-transform:uppercase">' . $item->entregador . '</td>
                      <td style="text-transform:uppercase">' .  date('d/m/Y  Á\S  H:i:s', strtotime($item->data_entrega)) . '</td>
                      <td style="text-transform:uppercase; text-align:center"> <h5><span class="badge badge-pill badge-success">' . $item->entrega . '</span></h5> </td>
                      <td style="text-transform:uppercase; text-align:center"> <h5><span class="badge badge-pill badge-danger">' . $item->devolucao  . '</span></h5> </td>
                      <td style="text-transform:uppercase; text-align:center"> <h5><span class="badge badge-pill badge-dark">' . $sub_total  . '</span></h5> </td>
                      <td style="text-align: center;">R$ '. number_format($sub,"2",",",".") .'</td>
                      </tr>

                      ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="6" class="text-center" > Nenhum cliente cadastrado !!!!! </td>
                                                     </tr>';



?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-6">
            <div class="card">
               <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                     <h3 class="card-title">PRODUÇÃO DIÁRIA</h3>
                     <a href="javascript:void(0);">RELATÓRIO</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex">
                     <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Quantidade: &nbsp; <?= $bruto ?></span>
                        
                     </p>
                     <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                           <i class="fas fa-arrow-up"></i>&nbsp; R$ <?= number_format($saldo,"2",",",".") ?>
                        </span>
                        <span class="text-muted">Desde o último dia</span>
                     </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="card-body">

                     <table class="table">
                        <thead>
                           <tr>
                              <th>CÓDIGO</th>
                              <th>ENTREGADOR</th>
                              <th>DATA</th>
                              <th>ENTREGA</th>
                              <th>DEVOLUÇÃO</th>
                              <th>QTD</th>
                              <th>SALDO</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <?= $resultados ?>
                           </tr> 
                           <tr>
                           <td colspan="5" style="text-align: right;">
                            TOTAL
                           </td>
                           <td style="text-align: center;">
                            <?= $bruto ?>
                           </td>
                           <td style="text-align: center;">
                           R$ <?= number_format($calc, "2", ",", ".") ?>
                           </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

                  <div class="d-flex flex-row justify-content-end">
                     <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Data 
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


      </div>

</section>