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


$resultados = '';

foreach ($listar as $item) {

   $resultados .= '<tr>
                      <td style="display:none">' . $item->id . '</td>
                      <td style="text-transform:uppercase">' . $item->nome . '</td>
                      <td style="text-transform:uppercase">' . $item->telefone . '</td>
                      <td>' . $item->email . '</td>
                     
                      <td style="display:none">' . $item->rotas_id . '</td>
                      <td style="display:none">' . $item->regioes_id . '</td>
                      <td style="display:none">' . $item->veiculos_id . '</td>
                      <td style="text-transform:uppercase"> <h5><span class="badge badge-pill badge-danger">' . $item->rota . '</span></h5> </td>
                      <td style="text-transform:uppercase"> <h5><span class="badge badge-pill badge-warning">' . $item->regiao . '</span></h5> </td>
                      <td style="text-transform:uppercase"> <h5><span class="badge badge-pill badge-primary">' . $item->veiculo . '</span></h5> </td>
                     

                      <td style="text-align: center;">

                      <a href="entregcarteira-edit.php?id=' . $item->id . '">
                      <button type="submit" class="btn btn-success" > <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp; CARTEIRA</button>
                    
                    </a>
                          
                      
                      </td>
                      </tr>

                      ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="9" class="text-center" > Nenhum entregador cadastrado !!!!! </td>
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

                           <label>Buscar por Nome</label>
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
                           <td colspan="10">
                              <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-plus"></i> &nbsp; Nova</button>
                              <a href="gerar-pdf.php" target="_blank">
                                 <button type="submit" class="btn btn-light float-right"> <i class="fas fa-print"></i> &nbsp; &nbsp; IMPRIMIR RELATÓRIO</button>
                              </a>
                           </td>
                        </tr>
                        <tr>
                           <th> NOME </th>
                           <th> TELEFONE </th>
                           <th> EMAIL </th>
                           <th> REGIÔES </th>
                           <th> ROTAS </th>
                           <th> VEÍCULOS </th>

                           <th style="text-align: center; width:200px"> AÇÃO </th>
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
         <form action="./entregador-insert.php" method="post">

            <div class="modal-header">
               <h4 class="modal-title">Novo Entregador
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">


               <div class="row">

                  <div class="col-12">
                     <div class="form-group">
                        <label>Nome</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="nome" required>
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        <label>Telefone</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="telefone" id="cel" required>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label>Email</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="email" required>
                     </div>
                  </div>

                  <div class="col-4">
                     <div class="form-group">
                        <label>Banco</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="banco" required>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label>Conta</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="conta" required>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label>Agência</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="agencia" required>
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        <label>Rotas</label>
                        <select class="form-control select" style="width: 100%;" name="rotas_id" id="rotas_cod">
                           <option value=""> Selecione uma Rota </option>
                           <?php

                           foreach ($rotas as $item) {
                              echo '<option value="' . $item->id . '">' . $item->descricao . '</option>';
                           }
                           ?>

                        </select>
                     </div>

                  </div>
                  <div class="col-6">
                     <div class="form-group">

                        <label>Regiões</label>
                        <select class="form-control" name="regiao" id="regiao" required></select>
                     </div>
                  </div>

                  <div class="col-12">
                     <div class="form-group">
                        <label>Veiculos</label>
                        <select class="form-control select" style="width: 100%;" name="veiculos_id">
                           <option value=""> Selecione um veículo </option>
                           <?php

                           foreach ($veiculos as $item) {
                              echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                           }
                           ?>

                        </select>
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
      <form action="./entregador-edit.php" method="get">
         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">Editar Entregador
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="row">

                  <div class="col-12">
                     <div class="form-group">
                        <label>Nome</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="nome" id="nome" required>
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        <label>Telefone</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="telefone" id="telefone" required>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label>Email</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="email" id="email" required>
                     </div>
                  </div>

                  <div class="col-4">
                     <div class="form-group">
                        <label>Banco</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="banco" id="banco" required>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label>Conta</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="conta" id="conta" required>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="form-group">
                        <label>Agência</label>
                        <input style="text-transform:uppercase" type="text" class="form-control" name="agencia" id="agencia" required>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                        <label>Rotas</label>
                        <select class="form-control select" style="width: 100%;" name="rotas_id" id="rotas_id">
                           <option value=""> Selecione uma Rota </option>
                           <?php

                           foreach ($rotas as $item) {
                              echo '<option value="' . $item->id . '">' . $item->descricao . '</option>';
                           }
                           ?>

                        </select>
                     </div>

                  </div>
                  <div class="col-6">
                     <div class="form-group">

                        <label>Regiões</label>
                        <select class="form-control" name="regioes_id" id="regioes_id" required></select>
                     </div>
                  </div>

                  <div class="col-6">
                     <div class="form-group">
                        <label>Veículos</label>
                        <select class="form-control select" style="width: 100%;" name="veiculos_id" id="veiculos_id">

                           <?php

                           foreach ($veiculos as $item) {
                              echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                           }
                           ?>

                        </select>
                     </div>

                  </div>

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