<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">

    <div class="col-12">
        <?php $form = ActiveForm::begin(); ?>
        <p>Para pedidos de orçamento deixe a sua mensagem.<br>Entraremos em contacto consigo o mais brevemente possível.</p>
    </div>
    <div class="col-6">
        <?= $form->field($modelPedido, 'quantidade')->textInput() ?>
    </div>
    <div class="col-6">
        <?= $form->field($modelPedido, 'codigo_desconto')->textInput() ?>
    </div>
    <div class="col-12">
        <?= $form->field($modelPerfil, 'nome',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->full_name, 'class'=>'form-control', 'readonly'=>'']])->textInput() ?>
    </div>
    <div class="col-6">
        <?= $form->field($modelPerfil, 'email',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->email, 'class'=>'form-control', 'readonly'=>'']])->textInput() ?>
    </div>
    <div class="col-6">
        <?= $form->field($modelPerfil, 'telefone',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->telefone, 'class'=>'form-control', 'readonly'=>'']])->textInput() ?>
    </div>
    <div class="col-12">
        <?= $form->field($modelPerfil, 'morada',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->morada, 'class'=>'form-control', 'readonly'=>'']])->textInput() ?>
    </div>
    <div class="col-6">
        <?= $form->field($modelPerfil, 'codPostal',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->codPostal, 'class'=>'form-control', 'readonly'=>'']])->textInput() ?>
    </div>
    <div class="col-6">
        <?= $form->field($modelPerfil, 'localidade',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->localidade, 'class'=>'form-control', 'readonly'=>'']])->textInput() ?>
    </div>
    <div class="col-12">
        <?= $form->field($modelPedido, 'mensagem',['inputOptions' => ['style'=>'height:250px', 'class'=>'form-control']])->textarea() ?>
    </div>

    <div class="col-12">
        <div class="form-group">
            <?= Html::submitButton('Enviar', ['class' => 'btn btn-success col-12']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>
