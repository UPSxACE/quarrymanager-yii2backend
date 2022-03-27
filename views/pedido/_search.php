<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idUtilizador') ?>

    <?= $form->field($model, 'idProduto') ?>

    <?= $form->field($model, 'desconto') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?php // echo $form->field($model, 'nome') ?>

    <?php // echo $form->field($model, 'morada') ?>

    <?php // echo $form->field($model, 'telefone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'mensagem') ?>

    <?php // echo $form->field($model, 'nif') ?>

    <?php // echo $form->field($model, 'dataHoraPedido') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
