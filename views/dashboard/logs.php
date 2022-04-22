<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $listaProdutos \app\controllers\DashboardController */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-logs row">
    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>
    <div class="col-10">
        <div class="d-flex align-items-center w-100">
            <h1> <?= $this->title ?> </h1>
        </div>
        <?php

        echo GridView::widget([
            'dataProvider' => $listaLogs,
            'columns' => [
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idUser0.username',
                    'format'=>'text',
                    'label' => 'Username',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idUser0.profile0.full_name',
                    'format'=>'text',
                    'label' => 'Nome',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idUser0.role0.name',
                    'format'=>'text',
                    'label' => 'Cargo',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'idTipoAcao0.nome',
                    'format'=>'text',
                    'label' => 'Tipo de Ação',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'descricao',
                    'format'=>'text',
                    'label' => 'Descrição',
                ],
                [
                    'class' => 'yii\grid\DataColumn', // this line is optional
                    'attribute' => 'dataHora',
                    'format'=>'datetime',
                    'label' => 'Data',
                ],


            ]
        ]);
        ?>
    </div>
</div>

