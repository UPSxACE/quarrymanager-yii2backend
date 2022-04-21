<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="novolocalextracao-form row">

    <div class="col-3">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($modelLocalExtracao, 'nome')->textInput() ?>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/locais-extracao">Cancel</a>
            <?php ActiveForm::end(); ?>
        </div>

    </div>


</div>
