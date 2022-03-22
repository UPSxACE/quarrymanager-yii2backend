<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CodigoDescontoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Codigo Descontos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codigo-desconto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Codigo Desconto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'descricao',
            'descontoGeral',
            'idProduto',
            'descontoProduto',
            //'dataExpiracao',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CodigoDesconto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'codigo' => $model->codigo]);
                 }
            ],
        ],
    ]); ?>


</div>
