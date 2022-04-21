<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="novoproduto-form row">




    <div class="col-6"><?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php
        echo $form->field($modelProduto, 'idMaterial')->dropdownList($arrayMateriais,
            ['text' => 'teste', 'prompt'=>'Selecione um material'],
        );
        ?>
    </div>
    <div class="col-6"><?php
        echo $form->field($modelProduto, 'idCor')->dropdownList($arrayCores,
            ['prompt'=>'Selecione uma cor']
        );
        ?>
    </div>
    <div class="col-3"><?= $form->field($modelProduto, 'Res_Compressao')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'Res_Flexao')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'Massa_Vol_Aparente')->textInput() ?></div>
    <div class="col-3"><?= $form->field($modelProduto, 'Absorcao_Agua')->textInput() ?></div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/produtos">Cancel</a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>
