<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idMaterial') ?>

    <?= $form->field($model, 'idCor') ?>

    <?= $form->field($model, 'Res_Compressao') ?>

    <?= $form->field($model, 'Res_Flexao') ?>

    <?php // echo $form->field($model, 'Massa_Vol_Aparente') ?>

    <?php // echo $form->field($model, 'Absorcao_Agua') ?>

    <?php // echo $form->field($model, 'tituloArtigo') ?>

    <?php // echo $form->field($model, 'descricaoProduto') ?>

    <?php // echo $form->field($model, 'preco') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
