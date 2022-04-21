<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="novolocalarmazem-form row">

    <div class="col-3">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($modelLocalArmazem, 'nome')->textInput() ?>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/locais-armazens">Cancel</a>
            <?php ActiveForm::end(); ?>
        </div>

    </div>


</div>
