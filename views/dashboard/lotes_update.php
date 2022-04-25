<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelLote app\models\Lote */

$this->title = 'Update Lote: ' . $modelLote->codigo_lote;
$this->params['breadcrumbs'][] = ['label' => 'Lotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelLote->codigo_lote, 'url' => ['view', 'id' => $modelLote->codigo_lote]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lotes-action-update row">

    <div class="col-2">
        <?= $this->render('_navbarLeft') ?>
    </div>

    <div class="col-10">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_formUpdateLote', [
            'modelLote' => $modelLote,
            'arrayProdutos' => $arrayProdutos,
            'arrayLocaisArmazens' => $arrayLocaisArmazens,
            'arrayLocaisExtracoes' => $arrayLocaisExtracoes,
        ]) ?>
    </div>




</div>
