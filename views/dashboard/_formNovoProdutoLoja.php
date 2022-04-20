<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="novoproduto-form row">
    <div class="col-6"><?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php
        echo $form->field($modelProduto, 'idProductToUpdate')->dropdownList($arrayProdutos,
            ['text' => 'teste', 'prompt'=>'Selecione um Produto'],
        );
        ?>
    </div>
    <div class="col-12"><?= $form->field($modelProduto, 'imageFile')->fileInput() ?></div>
    <div class="col-9"><?= $form->field($modelProduto, 'tituloArtigo')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'preco')->textInput() ?></div>
    <div class="col-12"><?= $form->field($modelProduto, 'descricaoProduto')->textInput() ?></div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>
