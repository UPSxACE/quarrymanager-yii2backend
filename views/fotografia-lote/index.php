<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FotografiaLoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fotografia Lotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotografia-lote-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fotografia Lote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigoLote',
            'idFotografia',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\FotografiaLote $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
