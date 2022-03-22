<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_lote')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idProduto')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'idLocalExtracao')->textInput() ?>

    <!-- @var $form yii\widgets\ActiveForm -->
    <?php
        echo $form->field($model, 'idLocalExtracao')->dropdownList([$localextracao],
        ['prompt'=>'Select Category']
        );
    ?>

    <?= $form->field($model, 'idLocalArmazem')->textInput() ?>

    <?= $form->field($model, 'dataHora')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
