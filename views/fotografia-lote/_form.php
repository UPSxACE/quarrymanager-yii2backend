<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FotografiaLote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fotografia-lote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigoLote')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idFotografia')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
