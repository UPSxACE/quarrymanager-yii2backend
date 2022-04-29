<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;


?>

<?php echo Nav::widget([
    'options' => ['class' => 'd-flex flex-column'],
    'items' => [
        ['label' => 'Home', 'url' => ['/dashboard/home'], 'visible' => Yii::$app->user->can('operario')],
        ['label' => 'Lotes', 'url' => ['/dashboard/lotes'], 'visible' => Yii::$app->user->can('operario')],
        ['label' => 'Stock', 'url' => ['/dashboard/stock'], 'visible' => Yii::$app->user->can('operario')],
        ['label' => 'Produtos', 'url' => ['/dashboard/produtos'], 'visible' => Yii::$app->user->can('operario')],
        ['label' => 'Materiais', 'url' => ['/dashboard/materiais'], 'visible' => Yii::$app->user->can('operario')],
        ['label' => 'Cores', 'url' => ['/dashboard/cores'], 'visible' => Yii::$app->user->can('operario')],
        ['label' => 'Encomendas', 'url' => ['/dashboard/encomendas'], 'visible' => Yii::$app->user->can('operario')],
        ['label' => 'Transportadoras', 'url' => ['/dashboard/transportadoras'], 'visible' => Yii::$app->user->can('gestor')],
        ['label' => 'Loja', 'url' => ['/dashboard/loja'], 'visible' => Yii::$app->user->can('gestor')],
        ['label' => 'Clientes', 'url' => ['/dashboard/clientes'], 'visible' => Yii::$app->user->can('gestor')],
        ['label' => 'Operários', 'url' => ['/dashboard/operarios'], 'visible' => Yii::$app->user->can('gestor')],
        ['label' => 'Gestores', 'url' => ['/dashboard/gestores'], 'visible' => Yii::$app->user->can('admin')],
        ['label' => 'Administradores', 'url' => ['/dashboard/administradores'], 'visible' => Yii::$app->user->can('admin')],
        ['label' => 'Locais de Armazéns', 'url' => ['/dashboard/locais-armazens'], 'visible' => Yii::$app->user->can('admin')],
        ['label' => 'Locais de Extração', 'url' => ['/dashboard/locais-extracao'], 'visible' => Yii::$app->user->can('admin')],
        ['label' => 'Logs', 'url' => ['/dashboard/logs'], 'visible' => Yii::$app->user->can('gestor')],
        //['label' => 'Ajuda', 'url' => ['/dashboard/help']],
    ]
]); ?>


