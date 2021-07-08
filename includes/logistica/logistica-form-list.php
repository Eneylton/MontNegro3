<?php

use App\Entidy\Receber;

if (isset($_GET['id']) or is_numeric($_GET['id'])) {

   $id_receber = $_GET['id'];

   $receb = Receber :: getRecebID($id_receber);

   $clientes_id = $receb->clientes_id;
   $qtd2 = $receb->qtd;
}

if (isset($_GET['status'])) {

   switch ($_GET['status']) {
      case 'success':
         $icon  = 'success';
         $title = 'Parabéns';
         $text = 'Entrega realizada com sucesso !!!';
         break;

      case 'del':
         $icon  = 'error';
         $title = 'Parabéns';
         $text = 'Esse usuário foi excluido !!!';
         break;

         case 'devolucao':
            $icon  = 'error';
            $title = 'Devolução';
            $text = 'Algo deu errado na entrega !!!';
            break;

         case 'error2':
            $icon  = 'error';
            $title = 'OPS ALGO DEU ERRADO !!!';
            $text = 'O valor é maior que quantidade de entrega  !!!';
            break;


      case 'edit':
         $icon  = 'warning';
         $title = 'Parabéns';
         $text = 'Cadastro atualizado com sucesso !!!';
         break;


      default:
         $icon  = 'error';
         $title = 'Opss !!!';
         $text = 'Algo deu errado entre em contato com admin !!!';
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


$resultados = '';
$dia = '';
$cor = '';

foreach ($listar as $item) {

   switch ($item->qtd) {
      case '10':
         $cor2 = "badge-warning";
         $qtd = "10";
         $msn = "";
         $disabled = "";
         break;

      case '9':
         $cor2 = "badge-warning";
         $qtd = "9";
         $msn = "";
         $disabled = "";
         break;

      case '8':
         $cor2 = "badge-warning";
         $qtd = "8";
         $msn = "";
         $disabled = "";
         break;


      case '7':
         $cor2 = "badge-warning";
         $qtd = "7";
         $msn = "";
         $disabled = "";
         break;


      case '6':
         $cor2 = "badge-warning";
         $qtd = "6";

         $msn = "";
         $disabled = "";
         break;


      case '5':
         $cor2 = "badge-danger";
         $qtd = "5";
         $msn = "";
         $disabled = "";
         break;
      case '4':
         $cor2 = "badge-danger";
         $qtd = "4";
         $msn = "";
         $disabled = "";
         break;

      case '3':
         $cor2 = "badge-danger";
         $qtd = "3";
         $msn = "";
         $disabled = "";
         break;

      case '2':
         $cor2 = "badge-danger";
         $qtd = "2";
         $msn = "";
         $disabled = "";
         break;

      case '1':
         $cor2 = "badge-danger";
         $qtd = "1";
         $msn = "";
         $disabled = "";
         break;
 
         case '0':
            $cor2 = "badge-success";
            $qtd = "";
            $msn = "Entrega Concluida";
            $disabled = "disabled";
            break;

      default:
         $cor2 = "badge-light";
         $qtd = $item->qtd;
         $msn = "";
         $disabled = "";
         break;
   }

   date_default_timezone_set('America/Sao_Paulo');

   $dat1 = date('Y-m-d');
   $data_formatada  = date('d/m/Y', strtotime($dat1));
   $dat2 = $item->data_fim;

   $data1 = strtotime($dat1);
   $data2 = strtotime($dat2);

   $data_final = ($data2 - $data1) / 86400;

   if ($data_final < 0) {
      $data_vencimento = $data_final * -1;
   }

   switch ($data_final) {

      case '-5':
         $cor = "badge-danger";
         $dia = "Já se passaram 5 dias do vencimento...";
         break;
      case '-4':
         $cor = "badge-danger";
         $dia = "Já se passaram 4 dias do vencimento...";
         break;
      case '-3':
         $cor = "badge-danger";
         $dia = "Já se passaram 3 dias do vencimento...";
         break;

      case '-2':
         $cor = "badge-danger";
         $dia = "Já se passaram 2 dias do vencimento...";
         break;

      case '-1':
         $cor = "badge-danger";
         $dia = "Já se passou 1 dia do prazo de vencimento...";
         break;

      case '0':
         $cor = "badge-success";
         $dia = "Dia do vencimento...";
         break;

      case '1':
         $cor = "badge-warning";
         $dia = "Falta apenas 1 dia para o vencimento...";
         break;

      case '2':
         $cor = "badge-warning";
         $dia = "Faltam apenas 2 dias para o vencimento...";
         break;

      case '3':
         $cor = "badge-secondary";
         $dia = "Faltam apenas 3 dias para o vencimento...";
         break;

      case '4':
         $cor = "badge-info";
         $dia = "Faltam apenas 4 dias para o vencimento...";
         break;

      case '5':
         $cor = "badge-primary";
         $dia = "Faltam apenas 5 dias para o vencimento...";
         break;

      default:
         $cor = "badge-light";
         $dia = "" . date('d/m/Y ', strtotime($dat2)) . "";
         break;
   }


   $resultados .= '<tr>
                      <td style="display:none">' . $item->id . '</td>
                      <td style="display:none">' . $item->data . '</td>
                      <td style="display:none">' . $item->cod_id . '</td>
                      <td style="display:none">' . $item->data_inicio . '</td>
                      <td style="display:none">' . $item->data_fim . '</td>
                      <td style="display:none">' . $item->qtd . '</td>
                      <td style="display:none">' . $item->clientes_id . '</td>
                      <td style="display:none">' . $item->entregadores_id . '</td>
                      <td style="display:none">' . $item->servicos_id . '</td>
                      <td style="display:none">' . $item->entregadores . '</td>
                      <td style="display:none">' . $item->servicos . '</td>
                      <td style="display:none">' . $item->clientes . '</td>

                     
                      
                      <td>' . $item->cod_id . '</td>
                      <td>' . $item->clientes . '</td>
                      <td style="text-transform:uppercase"> <h5><span class="badge badge-pill badge-light"> <i class="fa fa-motorcycle" aria-hidden="true"></i> &nbsp;' . $item->entregadores. '</span></h5> </td>
                      <td style="text-transform:uppercase">' . $item->regioes . '</td>
                      <td style="text-transform:uppercase">' . $item->servicos . '</td>
                      <td style="text-transform:uppercase">' . date('d/m/Y  Á\S  H:i:s', strtotime($item->data)) . '</td>
                      <td>
                      <h4>
                      <small class="badge badge-pill ' . $cor . '"><i class="far fa-clock"></i> &nbsp; &nbsp;' . $dia . '</small>
                      </h4>
                      </td>
                      <td style="text-align:center">
                      <h4>
                      <small class="badge badge-pill ' . $cor2 . ' ">' . $qtd . ''.$msn.'</small>
                      </h4>
                      </td>

                      <td style="text-align: center;">
                        
                      <button type="submit" class="btn btn-primary editbtn" '.$disabled.'> <i class="fa fa-arrow-left" aria-hidden="true"></i>
                      &nbsp; ENTREGAS </button>
                      &nbsp;
                      <button type="submit" class="btn btn-danger editbtn2" '.$disabled.' > <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp; DEVOLUÇÕES </button>
                      
                      </td>
                      </tr>

                      ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="9" class="text-center" > Nenhuma entrega cadastrada !!!!! </td>
                                                     </tr>';


unset($_GET['status']);
unset($_GET['pagina']);
$gets = http_build_query($_GET);

//PAGINAÇÂO

$paginacao = '';
$paginas = $pagination->getPages();

foreach ($paginas as $key => $pagina) {
   $class = $pagina['atual'] ? 'btn-primary' : 'btn-secondary';
   $paginacao .= '<a href="?pagina=' . $pagina['pagina'] . '&' . $gets . '">

                  <button type="button" class="btn ' . $class . '">' . $pagina['pagina'] . '</button>
                  </a>';
}

?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card card-purple">
               <div class="card-header">

                  <form method="get">
                     <div class="row my-7">
                        <div class="col">

                           <label>Buscar por Código</label>
                           <input type="text" class="form-control" name="buscar" value="<?= $buscar ?>">

                        </div>


                        <div class="col d-flex align-items-end">
                           <button type="submit" class="btn btn-warning" name="">
                              <i class="fas fa-search"></i>

                              Pesquisar

                           </button>

                        </div>


                     </div>

                  </form>
               </div>

               <div class="table-responsive">

                  <table class="table table-bordered table-dark table-bordered table-hover table-striped">
                     <thead>
                        <tr>
                           <td colspan="9">
                              <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-plus"></i> &nbsp; Nova</button>
                           </td>
                        </tr>
                        <tr>
                           <th style="text-align: left; width:80px"> CÓDIGO </th>
                           <th style="text-align: left; width:120px"> CLIENTE </th>
                           <th style="text-align: left; width:160px"> ENTREGADORES </th>
                           <th style="text-align: left; "> REGIÕES </th>
                           <th style="text-align: left; width:200px"> SERVIÇOS </th>

                           <th style="text-align:center"> DATA </th>
                           <th> PRAZO DE ENTREGA </th>
                           <th style="text-align: center; width:120px"> QTD </th>

                           <th style="text-align: center; width:400px"> AÇÃO </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?= $resultados ?>
                     </tbody>

                  </table>

               </div>


            </div>

         </div>

      </div>

   </div>

</section>

<?= $paginacao ?>


<div class="modal fade" id="modal-default">
   <div class="modal-dialog modal-lg">
      <div class="modal-content bg-light">
         <form action="./logistica-insert.php" method="post">
            <input type="hidden" name="id_receber" value="<?= $id_receber ?>">
            <input type="hidden" name="clientes_id" value="<?= $clientes_id ?>">
            <div class="modal-header">
               <h4 class="modal-title">ITENS DISPONÍVEIS:<span style="color: #ff0000; font-size:25px"> &nbsp;<?= $qtd2 ?></span>
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">

               <div class="row">

                  <div class="col-6">

                     <div class="form-group">
                        <label>Inicio </label>
                        <input type="datetime-local" class="form-control" name="data_inicio" required>
                     </div>

                  </div>

                  <div class="col-6">

                     <div class="form-group">
                        <label>Prazo da entrega</label>
                        <input type="datetime-local" class="form-control" name="data_fim" required>
                     </div>

                  </div>

               </div>
               <div class="row">

               <div class="col-6">
               <div class="form-group">
               <label>Regiões</label>
                       
                        <select class="form-control select" style="width: 100%;" name="regioes_id" id="regioes_cod">
                           <option value=""> Selecione uma região </option>
                           <?php

                           foreach ($regioes  as $item) {
                              echo '<option style="text-transform:capitalize" value="' . $item->id . '">' . $item->nome . '</option>';
                           }
                           ?>

                        </select>
                     </div>
               
               </div>
               
               <div class="col-6">
                     <div class="form-group">

                        <label>Entregadores</label>
                        <select class="form-control" name="entregador" id="entregador" required></select>
                     </div>
                  </div>

               </div>

               <div class="row">

                  <div class="col-6">

                     <div class="form-group">
                        <label>Serviços</label>
                        <select class="form-control select" style="width: 100%;" name="servicos_id" required>
                           <option value=""> Selecione um serviços </option>
                           <?php

                           foreach ($servicos as $item) {
                              echo '<option style="text-transform:capitalize" value="' . $item->id . '">' . $item->nome . '</option>';
                           }
                           ?>

                        </select>
                     </div>

                  </div>

                  <div class="col-6">

                     <div class="form-group">
                        <label>Quantidade</label>
                        <input type="text" class="form-control" name="qtd" required>
                     </div>

                  </div>

               </div>



            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

         </form>

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<!-- EDITAR -->

<div class="modal fade" id="editmodal">
   <div class="modal-dialog">
      <form action="./logistica-edit.php" method="get">
      <input type="hidden" name="id_receber2" value="<?= $id_receber ?>">
         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">Entrega
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <input type="hidden" class="form-control" name="cod_id" id="cod_id" required>
               <input type="hidden" class="form-control" name="entregadores_id" id="entregadores_id" required>

               <div class="row">

                  <div class="col-6">
                     <div class="form-group">
                        <label>Cliente</label>
                        <input style="background-color: #454d55 !important; border:1px solid #454d55; color:#fff; text-transform:uppercase" type="text" class="form-control" name="clientes" id="clientes" required>
                     </div>


                  </div>
            <div class="row">
               
               <div class="col-12">
               <div class="form-group">
                        <label>Entregodor</label>
                        <input style="background-color: #454d55 !important; border:1px solid #454d55; color:#fff; text-transform:uppercase" type="text" class="form-control"  name="entregadores" id="entregadores"  disabled>
                     </div>
               
               </div>
               
               </div>
                  <div class="col-6">

                     <div class="form-group">
                        <label>Serviço</label>
                        <input style="background-color: #454d55 !important; border:1px solid #454d55; color:#fff; text-transform:uppercase" type="text" class="form-control" name="servicos" id="servicos" disabled>
                     </div>
                  </div>

                  <div class="col-6">

                     <div class="form-group">
                        <label>Data</label>
                        <input style="background-color: #454d55 !important; border:1px solid #454d55; color:#fff; text-transform:uppercase" type="text" class="form-control" value="<?= $data_formatada ?>" disabled>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label>Qtd</label>
                        <input type="text" class="form-control col-4" name="qtd" required>
                     </div>

                  </div>
               </div>

            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-primary">Entregue
               </button>
            </div>
         </div>
      </form>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="editmodal2">
   <div class="modal-dialog">
      <form action="./devolucao.php" method="get">
      <input type="hidden" name="id_receber3" value="<?= $id_receber ?>">
         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">Devolução
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id2" id="id2">   
               <input type="hidden" class="form-control" name="cod_id2" id="cod_id2" required>
               <input type="hidden" class="form-control" name="entregadores_id2" id="entregadores_id2" required>

               <div class="row">

                  <div class="col-6">
                     <div class="form-group">
                        <label>Cliente</label>
                        <input style="background-color: #454d55 !important; border:1px solid #454d55; color:#fff; text-transform:uppercase" type="text" class="form-control" name="clientes2" id="clientes2" required>
                     </div>


                  </div>
                  <div class="col-6">

                     <div class="form-group">
                        <label>Entregador</label>
                        <input style="background-color: #454d55 !important; border:1px solid #454d55; color:#fff; text-transform:uppercase" type="text" class="form-control" name="entregadores2" id="entregadores2" required>
                     </div>
                  </div>

                  <div class="col-6">

                     <div class="form-group">
                        <label>Serviço</label>
                        <input style="background-color: #454d55 !important; border:1px solid #454d55; color:#fff; text-transform:uppercase" type="text" class="form-control" name="servicos2" id="servicos2" disabled>
                     </div>
                  </div>

                  <div class="col-6">

                     <div class="form-group">
                        <label>Data</label>
                        <input style="background-color: #454d55 !important; border:1px solid #454d55; color:#fff; text-transform:uppercase" type="text" class="form-control" value="<?= $data_formatada ?>" disabled>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label>Qtd</label>
                        <input type="text" class="form-control col-4" name="qtd2" required>
                     </div>

                  </div>
                  <div class="col-6">
                  <div class="form-group">
                        <label>Ocorrências</label>
                        <select class="form-control select" style="width: 100%;" name="ocorrencias_id2" required>
                           <option value=""> Selecione uma Ocorrência </option>
                           <?php

                           foreach ($ocorrencias as $item) {
                              echo '<option style="text-transform:capitalize" value="' . $item->id . '">' . $item->nome . '</option>';
                           }
                           ?>

                        </select>
                     </div>

                  </div>
               </div>

            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-danger">Devolver
               </button>
            </div>
         </div>
      </form>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>