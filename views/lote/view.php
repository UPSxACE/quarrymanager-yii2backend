<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lote */

$this->title = $model->codigo_lote;
$this->params['breadcrumbs'][] = ['label' => 'Lotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lote-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codigo_lote' => $model->codigo_lote], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codigo_lote' => $model->codigo_lote], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo_lote',
            'idProduto',
            'quantidade',
            'idLocalExtracao',
            'idLocalArmazem',
            'dataHora',
        ],
    ]) ?>

</div>
