<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="novomaterial-form row">

    <div class="col-3">

        <?= $form->field($modelMaterial, 'nome')->textInput() ?>
    </div>
    <div class="col-3">
        <?= $form->field($modelMaterial, 'prefixo')->textInput() ?>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/materiais">Cancel</a>

        </div>

    </div>


</div>
<?php ActiveForm::end(); ?>