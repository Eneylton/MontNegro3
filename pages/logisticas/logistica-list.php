<?php
require __DIR__ . '../../../vendor/autoload.php';

use   \App\Db\Pagination;
use   \App\Entidy\Cliente;
use   \App\Entidy\Entregador;
use   \App\Entidy\Logistica;
use   \App\Entidy\Ocorrencia;
use   \App\Entidy\Regiao;
use   \App\Entidy\Servico;
use   \App\Session\Login;

define('TITLE','Lista de Entregas');
define('BRAND','Logistica');


Login::requireLogin();

if (isset($_GET['id']) or is_numeric($_GET['id'])) {

    $id_receber = $_GET['id'];

 }
 



if(isset($_POST['id'])){
    $id= $_POST['id'];

    $entregadores = Entregador:: getEntreRotasID($id);

    foreach ($entregadores as $item) {
        echo '<option value="' . $item->id . '">' . $item->entregadores . '</option>';
     }
    
}


$buscar = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_STRING);

$condicoes = [
    strlen($buscar) ? 'e.nome LIKE "%' . str_replace(' ', '%', $buscar) . '%" 
    or 
    s.nome LIKE "%' . str_replace(' ', '%', $buscar) . '%"
    or 
    c.nome LIKE "%' . str_replace(' ', '%', $buscar) . '%"
    or 
    rg.nome LIKE "%' . str_replace(' ', '%', $buscar) . '%"' : null
];

$condicoes = array_filter($condicoes);

$where = implode(' AND ', $condicoes);

$qtd = Logistica:: getQtd($where);


$pagination = new Pagination($qtd, $_GET['pagina'] ?? 1, 5);

$listar = Logistica::getListProducao($id_receber, 'l.id desc',$pagination->getLimit());

$clientes      =     Cliente::    getList();
$servicos      =     Servico::    getList();
$ocorrencias   =     Ocorrencia:: getList();
$regioes       =     Regiao::     getList(null,'nome ASC',null);



include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/logistica/logistica-form-list.php';
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
        $('#data').val(data[1]);
        $('#cod_id').val(data[2]);
        $('#data_inicio').val(data[3]);
        $('#data_fim').val(data[4]);
        $('#qtd').val(data[5]);
        $('#clientes_id').val(data[6]);
        $('#entregadores_id').val(data[7]);
        $('#servicos_id').val(data[8]);
        $('#entregadores').val(data[9]);
        $('#servicos').val(data[10]);
        $('#clientes').val(data[11]);
    
    });
});
</script>


<script>
$(document).ready(function(){
    $('.editbtn2').on('click', function(){
        $('#editmodal2').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        $('#id2').val(data[0]);
        $('#data2').val(data[1]);
        $('#cod_id2').val(data[2]);
        $('#data_inicio2').val(data[3]);
        $('#data_fim2').val(data[4]);
        $('#qtd2').val(data[5]);
        $('#clientes_id2').val(data[6]);
        $('#entregadores_id2').val(data[7]);
        $('#servicos_id2').val(data[8]);
        $('#entregadores2').val(data[9]);
        $('#servicos2').val(data[10]);
        $('#clientes2').val(data[11]);
    
    });
});
</script>

<script>
$("#regioes_cod").on("change", function(){
   
   var idEstado = $("#regioes_cod").val();
   $.ajax({
       url:'logistica-list.php',
       type:'POST',
       data:{id:idEstado},
       beforeSend:function(){
           $("#entregador").css({'display':'block'});
           $("#entregador").html("carregando....");
       },
       success:function(data){
           $("#entregador").css({'display':'block'});
           $("#entregador").html(data);
       }
   })

});

</script>
