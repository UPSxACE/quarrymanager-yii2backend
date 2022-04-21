<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaProdutos \app\controllers\DashboardController */

$this->title = 'Loja';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-produtos row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">
        <div class="d-flex align-items-center w-100">
            <h1><?= $this->title ?></h1>
            <a style="margin-left:auto" href="/dashboard/novo-produto-loja"><button type="button" class="btn btn-primary" style="height:100%">Adicionar Produto à Loja</button></a>
        </div>
        <?php

        echo GridView::widget([
            'dataProvider' => $listaProdutos,
            'columns' => [
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'tituloArtigo',
                    'format'=>'text',
                    'label' => 'Titulo do Artigo',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    'attribute' => 'idMaterial0.nome',
                    'format' => 'text',
                    'label' => 'Material',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    'attribute' => 'idCor0.nome',
                    'format' => 'text',
                    'label' => 'Cor',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    'attribute' => 'preco',
                    'format' => 'text',
                    'label' => 'Preco',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    //'attribute' => 'quantidade_pedidos',
                    'content' => function ($model, $key, $index, $column) {
                        return $model->numeroPedidos($model->id) ;
                    },
                    'format' => 'text',
                    'label' => 'Nº Pedidos',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    //'attribute' => 'quantidade_vendida',
                    'content' => function ($model, $key, $index, $column) {
                        return $model->quantidadeVendida($model->id) ;
                    },
                    'format' => 'text',
                    'label' => 'Quantidade Vendida',
                ],
                /*
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    'attribute' => 'quantidade_vendida',
                    'format' => 'text',
                    'label' => 'Quantidade Vendida',
                ],
                */
            ]
        ]);
        ?>
    </div>
</div>

