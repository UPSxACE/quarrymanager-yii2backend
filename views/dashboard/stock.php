<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaProdutos \app\controllers\DashboardController */

$this->title = 'Stock';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-stock row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">
        <div class="d-flex align-items-center w-100">
            <h1>Stock</h1>
        </div>
        <?php

        echo GridView::widget([
            'dataProvider' => $listaStock,
            'columns' => [
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idMaterial0.nome',
                    'format'=>'text',
                    'label' => 'Produto',
                ],
            ]
        ]);
        ?>
    </div>
</div>

