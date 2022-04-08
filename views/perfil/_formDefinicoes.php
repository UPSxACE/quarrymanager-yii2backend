<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $modelUser app\controllers\PerfilController */
/* @var $modelDefinicoes app\controllers\PerfilController */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="definicoes-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-12"><?= $form->field($modelDefinicoes, 'username',['inputOptions' => ['value'=>Yii::$app->user->identity->username, 'class'=>'form-control']])->textInput(['maxlength' => true]) ?></div>
        <div class="col-12"><?= $form->field($modelDefinicoes, 'email',['inputOptions' => ['value'=>Yii::$app->user->identity->email, 'class'=>'form-control',]])->textInput(['maxlength' => true]) ?></div>
        <div class="col-12"><?= $form->field($modelDefinicoes, 'password',['inputOptions' => ['class'=>'form-control', 'type' => 'password',]])->textInput(['maxlength' => true]) ?></div>
        <div class="col-12"><?= $form->field($modelDefinicoes, 'password',['inputOptions' => ['class'=>'form-control', 'type' => 'password',]])->textInput(['maxlength' => true]) ?></div>
        <div class="col-12"><?= $form->field($modelDefinicoes, 'password',['inputOptions' => ['class'=>'form-control', 'type' => 'password',]])->textInput(['maxlength' => true]) ?></div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
