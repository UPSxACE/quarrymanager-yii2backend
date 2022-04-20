<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaLocaisExtracao \app\controllers\DashboardController */

$this->title = 'Locais de Extração';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-lotes row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">
        <div class="d-flex align-items-center w-100">
            <h1> <?= $this->title ?> </h1>
        </div>
        <?php

        echo GridView::widget([
            'dataProvider' => $listaLocaisExtracao,
            'columns' => [
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'nome',
                    'format'=>'text',
                    'label' => 'Nome',
                ],
            ]
        ]);
        ?>
    </div>
</div>