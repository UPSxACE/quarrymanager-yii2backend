<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="novoproduto-form row">


    <div class="col-6"><?php $form = ActiveForm::begin(); ?>
        <?= $form->field($modelProduto, 'idMaterial')->textInput() ?>
    </div>
    <div class="col-6"><?= $form->field($modelProduto, 'idCor')->textInput() ?></div>

    <div class="col-12"><?= $form->field($modelProduto, 'idFotografia')->textInput() ?></div>
    <div class="col-9"><?= $form->field($modelProduto, 'tituloArtigo')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'preco')->textInput() ?></div>
    <div class="col-12"><?= $form->field($modelProduto, 'descricaoProduto')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'Res_Compressao')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'Res_Flexao')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'Massa_Vol_Aparente')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'Absorcao_Agua')->textInput() ?></div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>
