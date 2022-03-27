<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoPedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEstado')->textInput() ?>

    <?= $form->field($model, 'idPedido')->textInput() ?>

    <?= $form->field($model, 'dataEstado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
