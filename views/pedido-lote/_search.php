<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoLoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-lote-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idPedido') ?>

    <?= $form->field($model, 'codigoLote') ?>

    <?= $form->field($model, 'trackingID') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?php // echo $form->field($model, 'idTransportadora') ?>

    <?php // echo $form->field($model, 'matricula_Veiculo_recolha') ?>

    <?php // echo $form->field($model, 'dataHoraRecolha') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
