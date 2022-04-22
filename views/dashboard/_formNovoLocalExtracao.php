<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="novolocalextracao-form row">

    <div class="col-3">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($modelLocalExtracao, 'nome')->textInput() ?>
        <?= $form->field($modelLocalExtracao, 'coordenadasGPS_X')->textInput() ?>
        <?= $form->field($modelLocalExtracao, 'coordenadasGPS_Y')->textInput() ?>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/locais-extracao">Cancel</a>
            <?php ActiveForm::end(); ?>
        </div>

    </div>


</div>
