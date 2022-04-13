<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaProdutos \app\controllers\DashboardController */

$this->title = 'Gestores';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-gestores row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">
        <div class="d-flex align-items-center w-100">
            <h1> <?= $this->title ?> </h1>
        </div>
        <?php

        echo GridView::widget([
            'dataProvider' => $listaGestores,
            'columns' => [
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'username',
                    'format'=>'text',
                    'label' => 'Username',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'profile0.full_name',
                    'format'=>'text',
                    'label' => 'Nome',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'created_at',
                    'format'=>'datetime',
                    'label' => 'Data',
                ],


            ]
        ]);
        ?>
    </div>
</div>

