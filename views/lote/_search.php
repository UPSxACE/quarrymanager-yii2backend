<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lote-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo_lote') ?>

    <?= $form->field($model, 'idProduto') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?= $form->field($model, 'idLocalExtracao') ?>

    <?= $form->field($model, 'idLocalArmazem') ?>

    <?php // echo $form->field($model, 'dataHora') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
