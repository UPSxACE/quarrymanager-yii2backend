<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idMaterial')->textInput() ?>

    <?= $form->field($model, 'idCor')->textInput() ?>

    <?= $form->field($model, 'Res_Compressao')->textInput() ?>

    <?= $form->field($model, 'Res_Flexao')->textInput() ?>

    <?= $form->field($model, 'Massa_Vol_Aparente')->textInput() ?>

    <?= $form->field($model, 'Absorcao_Agua')->textInput() ?>

    <?= $form->field($model, 'tituloArtigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricaoProduto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
