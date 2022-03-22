<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CodigoDescontoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="codigo-desconto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'descontoGeral') ?>

    <?= $form->field($model, 'idProduto') ?>

    <?= $form->field($model, 'descontoProduto') ?>

    <?php // echo $form->field($model, 'dataExpiracao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
