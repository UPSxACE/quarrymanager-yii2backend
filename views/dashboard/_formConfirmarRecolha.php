<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="novolocalarmazem-form row">

    <div class="col-12">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($modelPedidoLote, 'matricula_Veiculo_recolha')->textInput() ?>
    </div>

    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/encomendas/<?= $modelEncomenda->id ?>">Cancel</a>
            <?php ActiveForm::end(); ?>
        </div>

    </div>


</div>
