<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Logs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idUtilizador',
            'idTipoAcao',
            'descricao',
            'dataHora',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Logs $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
