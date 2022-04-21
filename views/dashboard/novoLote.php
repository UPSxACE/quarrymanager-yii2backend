<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Novo Lote';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-novolote">
    <h1><?= $this->title ?></h1>
    <?= $this->render('_formNovoLote', [
        'modelLote' => $modelLote,
        'arrayProdutos' => $arrayProdutos,
        'arrayLocaisArmazens' => $arrayLocaisArmazens,
        'arrayLocaisExtracoes' => $arrayLocaisExtracoes,
    ]) ?>
</div>