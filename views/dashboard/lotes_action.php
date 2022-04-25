<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $listaFotografias \yii\data\ActiveDataProvider*/

$this->title = $modelLote->codigo_lote;
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="lotes-action-view">

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
                'label' => 'Quantidade',
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

    <div>
        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $listaFotografias,
            'itemView' => '_lotesFotografia',             //para cada entrada da base de dados, vai ser aplicado o código deste view
            'options' => [
                'class' => ''
            ],
            'itemOptions' => [
                'class' => 'col-2'
            ],
            //'layout' => "<div class='row col-12 justify-content-center d-flex'>{summary}</div><div class='row'>{items}</div><div class='row col-12 justify-content-center d-flex'>{pager}</div>"
            'layout' => "<div class='container-fluid'><div class='row'>{summary}</div><div class='row'>{items}</div><div class='row'>{pager}</div></div>"
        ])
        ?>
    </div>


</div>
