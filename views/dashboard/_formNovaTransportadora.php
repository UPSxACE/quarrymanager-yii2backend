<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="novatransportadora-form row">

    <div class="col-3">

        <?= $form->field($modelTransportadora, 'nome')->textInput() ?>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/transportadoras">Cancel</a>

        </div>

    </div>


</div>
<?php ActiveForm::end(); ?>