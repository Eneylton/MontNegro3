<?php

require __DIR__ . '../../../vendor/autoload.php';

$alertaCadastro = '';

define('TITLE', 'Detahes');
define('BRAND', 'Detalhes');

use  App\Entidy\Carteira;

use  App\Entidy\Entrega;

use  App\Session\Login;


Login::requireLogin();

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {

    header('location: entregcarteira-list.php?status=error');

    exit;
}

$entregadores = Entrega::getRecID($_GET['id']);

$value = Carteira::getID($_GET['id']);

include __DIR__ . '../../../includes/layout/header.php';
include __DIR__ . '../../../includes/layout/top.php';
include __DIR__ . '../../../includes/layout/menu.php';
include __DIR__ . '../../../includes/layout/content.php';
include __DIR__ . '../../../includes/detalhe/detalhe-form-list.php';
include __DIR__ . '../../../includes/layout/footer.php';

?>

