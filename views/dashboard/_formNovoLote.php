<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="novolote-form row">
    <div class="col-6"><?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php
        echo $form->field($modelLote, 'idProduto')->dropdownList($arrayProdutos,
            ['text' => 'teste', 'prompt'=>'Selecione um Produto'],
        );
        ?>
    </div>

    <div class="col-6">
        <?= $form->field($modelLote, 'dataHora', ['inputOptions' => ['value'=>date('Y-m-d H:i:s'), 'class'=>'form-control', 'type'=>'datetime', 'readonly'=>'']])->textInput()?>
    </div>


    <div class="col-6">
        <?php
        echo $form->field($modelLote, 'idLocalArmazem')->dropdownList($arrayLocaisArmazens,
            ['text' => 'teste', 'prompt'=>'Selecione um Local'],
        );
        ?>
    </div>

    <div class="col-6">
        <?php
        echo $form->field($modelLote, 'idLocalExtracao')->dropdownList($arrayLocaisExtracoes,
            ['text' => 'teste', 'prompt'=>'Selecione um Local'],
        );
        ?>
    </div>

    <div class="col-6">
        <?= $form->field($modelLote, 'quantidade', ['template' => "
        {label}\n
        <div class='input-group'>
            
            {input}
            <div class='input-group-prepend'>
              <div class='input-group-text'>m²</div>
            </div>
        </div>\n
        {hint}\n
        {error}
        "])->textInput() ?>
    </div>

    <!--
    <div class="col-3">
        <div class="form-group">
            <label>Coordenadas_X</label>
            <div class="input-group">
                <input class="form-control" readonly value="JAVASCRIPT">
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label>Coordenadas_X</label>
            <div class="input-group">
                <input class="form-control" readonly value="JAVASCRIPT">
            </div>
        </div>
    </div>-->

    <div class="col-12">
        <?= $form->field($modelLote, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
   </div>


    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/loja">Cancel</a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>
