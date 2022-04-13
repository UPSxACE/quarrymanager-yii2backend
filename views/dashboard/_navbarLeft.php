<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;


?>

<?php echo Nav::widget([
    'options' => ['class' => 'd-flex flex-column'],
    'items' => [
        ['label' => 'Home', 'url' => ['/dashboard/home']],
        ['label' => 'Lotes', 'url' => ['/dashboard/lotes']],
        ['label' => 'Stock', 'url' => ['/dashboard/stock']],
        ['label' => 'Produtos', 'url' => ['/dashboard/produtos']],
        ['label' => 'Encomendas', 'url' => ['/dashboard/encomendas']],
        ['label' => 'Configurar Loja', 'url' => ['/dashboard/configurar-loja']],
        ['label' => 'Usuários', 'url' => ['/dashboard/users']],
        ['label' => 'Logs', 'url' => ['/dashboard/logs']],
        ['label' => 'Ajuda', 'url' => ['/dashboard/help']],
    ]
]); ?>


