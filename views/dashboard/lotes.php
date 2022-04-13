<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaProdutos \app\controllers\DashboardController */

$this->title = 'Lotes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-lotes row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">
        <div class="d-flex align-items-center w-100">
            <h1>Produtos</h1>
        </div>
        <?php

        echo GridView::widget([
            'dataProvider' => $listaLotes,
            'columns' => [
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'codigo_lote',
                    'format'=>'text',
                    'label' => 'Código do Lote',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idProduto0.idMaterial0.nome',
                    'format'=>'text',
                    'label' => 'Material',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idProduto0.idCor0.nome',
                    'format'=>'text',
                    'label' => 'Cor',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'quantidade',
                    'format'=>'text',
                    'label' => 'Quantidade',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idLocalExtracao0.nome',
                    'format'=>'text',
                    'label' => 'Local de Retirada',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idLocalExtracao0.coordenadasGPS_X',
                    'format'=>'text',
                    'label' => 'Coordenadas GPS X',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idLocalExtracao0.coordenadasGPS_Y',
                    'format'=>'text',
                    'label' => 'Coordenadas GPS Y',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'dataHora',
                    'format'=>'date',
                    'label' => 'Data',
                ],

            ]
        ]);
        ?>
    </div>
</div>

