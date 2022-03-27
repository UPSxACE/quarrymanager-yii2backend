<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoLote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-lote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPedido')->textInput() ?>

    <?= $form->field($model, 'codigoLote')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trackingID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'idTransportadora')->textInput() ?>

    <?= $form->field($model, 'matricula_Veiculo_recolha')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataHoraRecolha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
