<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="novolocalarmazem-form row">

    <div class="col-6">

        <?php
        echo $form->field($modelPedidoLote, 'codigoLote')->dropdownList($arrayLotes,
            ['text' => 'teste', 'prompt'=>'Selecione um material'],
        );
        ?>
    </div>
    <div class="col-6">
        <?= $form->field($modelPedidoLote, 'quantidade')->textInput() ?>
    </div>
    <div class="col-12">
        <?php
        echo $form->field($modelPedidoLote, 'idTransportadora')->dropdownList($arrayTransportadoras,
            ['text' => 'teste', 'prompt'=>'Selecione uma transportadora'],
        );
        ?>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <a class="btn btn-danger" href="/dashboard/encomendas/<?= $modelEncomenda->id ?>">Cancel</a>

        </div>

    </div>


</div>
<?php ActiveForm::end(); ?>