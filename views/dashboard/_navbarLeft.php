<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;


?>

<?php echo Nav::widget([
    'options' => ['class' => 'd-flex flex-column'],
    'items' => [
        ['label' => 'Home', 'url' => ['/dashboard/home']],
        ['label' => 'Stock', 'url' => ['/dashboard/stock']],
        ['label' => 'Encomendas', 'url' => ['/dashboard/encomendas']],
        ['label' => 'Configurar Loja', 'url' => ['/dashboard/configurar-lote']],
        ['label' => 'Usuários', 'url' => ['/dashboard/users']],
        ['label' => 'Logs', 'url' => ['/dashboard/logs']],
        ['label' => 'Ajuda', 'url' => ['/dashboard/help']],
    ]
]); ?>


