<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Encomendas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-encomendas row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">
        <div class="d-flex align-items-center w-100">
            <h1>Encomendas</h1>
        </div>
        <?php

        $texto = "teste";

        echo GridView::widget([
            'dataProvider' => $listaEncomendas,
            'columns' => [
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    'attribute' => 'idPedido0.id',
                    'format' => 'text',
                    'label' => 'ID Encomenda',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idEstado0.nome',
                    'format'=>'text',
                    'label' => 'Status',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    'attribute' => 'dataEstado',
                    'format' => 'text',
                    'label' => 'Ultima Atualização',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    //'attribute' => 'idMaterial',
                    'attribute' => 'idPedido0.idUser0.username',
                    'format' => 'text',
                    'label' => 'Cliente',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idPedido0.idProduto0.tituloArtigo',
                    //'value' => function(){return "teste";},
                    'format' => 'text',
                    'label' => 'Produto',
                ],
                [
                    'content' => function ($model, $key, $index, $column) {
                        return '<a class="fa-solid fa-angle-right h3" href="/dashboard/encomendas/' . $model->idPedido0->id . '">' ;
                    },
                ],
            ]
        ]);
        ?>
    </div>
</div>

