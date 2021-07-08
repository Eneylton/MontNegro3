<?php
require __DIR__ . '../../../vendor/autoload.php';

use  \App\Db\Pagination;
use   App\Entidy\Cliente;
use App\Entidy\Entregador;
use App\Entidy\Servico;
use App\Entidy\Setor;
use   \App\Session\Login;

define('TITLE','Lista de Clientes');
define('BRAND','Clientes');


Login::requireLogin();


$buscar = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_STRING);

$condicoes = [
    strlen($buscar) ? 'cli.nome LIKE "%'.str_replace(' ','%',$buscar).'%" or 
                       s.nome LIKE "%'.str_replace(' ','%',$buscar).'%"
                       or 
                       st.nome LIKE "%'.str_replace(' ','%',$buscar).'%"
                       or 
                       et.nome LIKE "%'.str_replace(' ','%',$buscar).'%"
                       ' : null
];

$condicoes = array_filter($condicoes);

$where = implode(' AND ', $condicoes);

$qtd = Cliente:: getQtdClientes($where);


$pagination = new Pagination($qtd, $_GET['pagina'] ?? 1, 5);

$listar = Cliente::getListCleintes($where, 'id desc',$pagination->getLimit());

$entregadores   = Entregador   :: getList();
$setores        = Setor        :: getList();
$servicos       = Servico      :: getList();

include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/cliente/cliente-form-list.php';
include __DIR__ . '../../../includes/layout/footer.php';

?>

<script>
$(document).ready(function(){
    $('.editbtn').on('click', function(){
        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        $('#id').val(data[0]);
        $('#nome').val(data[1]);
        $('#servicos').val(data[2]);
        $('#setores').val(data[3]);
        $('#servicos_id').val(data[4]);
        $('#setores_id').val(data[5]);
      
    });
});
</script>
