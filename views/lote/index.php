<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lote-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Lote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo_lote',
            'idProduto',
            'quantidade',
            'idLocalExtracao',
            'idLocalArmazem',
            //'dataHora',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \app\models\Lote $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'codigo_lote' => $model->codigo_lote]);
                 }
            ],
        ],
    ]); ?>


</div>
