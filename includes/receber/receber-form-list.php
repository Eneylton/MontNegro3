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
            $msn = "Todos os itens foram distribuidos";
            $disabled = "";
            break;

      default:
         $cor2 = "badge-light";
         $qtd = $item->qtd;
         $msn = " DISPONIVEIS PARA ENTREGA";
         $disabled = "";
         break;
   }


   $resultados .= '<tr>
                      <td>' . $item->id . '</td>
                      <td style="text-transform:uppercase">' . date('d/m/Y  Á\S  H:i:s', strtotime($item->data)) . '</td>
                      <td style="text-transform:uppercase">' . $item->cliente . '</td>
                      <td style="text-transform:uppercase"> <h3><span class="badge badge-pill badge-warning"> <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;' . $item->recebido . '&nbsp; </span></h3> </td>
                      <td style="text-transform:uppercase"> <h3><span class="badge badge-pill '.$cor2.'"> <i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;' . $item->qtd . '&nbsp; '.$msn.'</span></h3> </td>

                      <td style="text-align: center;">
                        
                      <a href="../detalhe/detalhe-list.php?id=' . $item->id . '">
                      <button type="button" class="btn btn-light"> <i class="fa fa-th-list" aria-hidden="true"></i> &nbsp; DETALHES </button>
                      </a>
                      &nbsp;
                       <a href="../logisticas/logistica-list.php?id=' . $item->id . '">
                       <button type="button" class="btn btn-danger"> <i class="fa fa-paper-plane" aria-hidden="true"></i> &nbsp; PRODUÇÃO </button>
                       </a>


                      </td>
                      </tr>

                      ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="6" class="text-center" > Nenhum item recebido até o momento !!!!! </td>
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

                           <label>Buscar por Clientes</label>
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
                           <td colspan="5">
                              <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-plus"></i> &nbsp; Nova</button>
                           </td>
                        </tr>
                        <tr>
                           <th style="text-align: left; width:80px"> CÓDIGO </th>

                           <th> DATA DO RECEBIMENTO </th>
                           <th> CLIENTES </th>
                           <th> RECEBIDO </th>
                           <th> QUANTIDADE </th>

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
         <form action="./receber-insert.php" method="post">

            <div class="modal-header">
               <h4 class="modal-title">Receber Itens
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">

               <div class="form-group">
                  <label>Clientes</label>
                  <select class="form-control select" style="width: 100%;" name="clientes_id" required>
                     <option value=""> Selecione uma cliente </option>
                     <?php

                     foreach ($clientes as $item) {
                        echo '<option style="text-transform:capitalize" value="' . $item->id . '">' . $item->nome . '</option>';
                     }
                     ?>

                  </select>
               </div>


               <div class="form-group">
                  <label>Quantidade recebida</label>
                  <input style="text-transform:uppercase" type="text" class="form-control" name="qtd" required>
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
      <form action="./rota-edit.php" method="get">
         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">Editar Rota
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id" id="id">

               <div class="form-group">
                  <label>Rota</label>
                  <input type="text" class="form-control" name="descricao" id="descricao" required>
               </div>

            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-primary">Salvar
               </button>
            </div>
         </div>
      </form>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>