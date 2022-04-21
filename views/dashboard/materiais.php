<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaMateriais \app\controllers\DashboardController */

$this->title = 'Materiais';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-lotes row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">
        <div class="d-flex align-items-center w-100">
            <h1> <?= $this->title ?> </h1>
            <a style="margin-left:auto" href="/dashboard/novo-material"><button type="button" class="btn btn-primary" style="height:100%">Novo Material</button></a>
        </div>
        <?php

        echo GridView::widget([
            'dataProvider' => $listaMateriais,
            'columns' => [
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'nome',
                    'format'=>'text',
                    'label' => 'Nome',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'prefixo',
                    'format'=>'text',
                    'label' => 'Prefixo',
                ],
            ]
        ]);
        ?>
    </div>
</div>

