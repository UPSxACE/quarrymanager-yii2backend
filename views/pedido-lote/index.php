<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoLoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedido Lotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-lote-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pedido Lote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idPedido',
            'codigoLote',
            'trackingID',
            'quantidade',
            //'idTransportadora',
            //'matricula_Veiculo_recolha',
            //'dataHoraRecolha',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\PedidoLote $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
