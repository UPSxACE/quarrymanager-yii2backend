<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */

$this->title = $modelLote->codigo_lote;
$this->params['breadcrumbs'][] = ['label' => 'Lotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="local-armazem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update-lote', 'codigo_lote' => $modelLote->codigo_lote], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete-lote', 'codigo_lote' => $modelLote->codigo_lote], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $modelLote,
        'attributes' => [
            'codigo_lote',
            [
                    'label' => 'Nome do Material',
                    'value' => $modelLote->idProduto0->idMaterial0->nome,
            ],
            [
                'label' => 'Nome da Cor',
                'value' => $modelLote->idProduto0->idCor0->nome,
            ],
            [
                'label' => 'Quantidade Disponível em Stock',
                'value' => $modelLote->quantidade . 'm²',
            ],
            [
                'label' => 'Local de Extração',
                'value' => $modelLote->idLocalExtracao0->nome,
            ],
            [
                'label' => 'Local de Armazém',
                'value' => $modelLote->idLocalArmazem0->nome,
            ],
            [
                'label' => 'Data/Hora de Extração',
                'value' => $modelLote->dataHora,
            ],
        ],
    ]) ?>

</div>
