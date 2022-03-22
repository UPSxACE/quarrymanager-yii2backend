<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CodigoDesconto */

$this->title = 'Update Codigo Desconto: ' . $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Codigo Descontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo, 'url' => ['view', 'codigo' => $model->codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="codigo-desconto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
