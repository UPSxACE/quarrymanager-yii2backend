<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $modelUser app\controllers\PerfilController */
/* @var $modelDefinicoes app\controllers\PerfilController */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="definicoes-form row">
    <div class="col-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <?php /*
                        $modelDefinicoes=(array)$modelDefinicoes;
                        $modelDefinicoes["confirmarPassword"] = '';
                        $modelDefinicoes=(object)$modelDefinicoes;
                       */
                ?>
                <div class="col-12"><?= $form->field($modelDefinicoes, 'username',['inputOptions' => ['value'=>Yii::$app->user->identity->username, 'class'=>'form-control']])->textInput(['maxlength' => true]) ?></div>
                <div class="col-12"><?= $form->field($modelDefinicoes, 'email',['inputOptions' => ['value'=>Yii::$app->user->identity->email, 'class'=>'form-control',]])->textInput(['maxlength' => true]) ?></div>
                <div class="col-12"><?= $form->field($modelDefinicoes, 'currentPassword',['inputOptions' => ['class'=>'form-control', 'type' => 'password',]])->textInput(['maxlength' => true]) ?></div>
                <div class="col-12"><?= $form->field($modelDefinicoes, 'newPassword',['inputOptions' => ['class'=>'form-control', 'type' => 'password',]])->textInput(['maxlength' => true, 'compare', 'compareAttribute' => 'newPasswordConfirm', 'message' => Yii::t('user', 'Passwords do not match')]) ?></div>
                <div class="col-12"><?= $form->field($modelDefinicoes, 'newPasswordConfirm',['inputOptions' => ['class'=>'form-control', 'type' => 'password',]])->textInput(['maxlength' => true]) ?></div>


                <!--
                <div class="col-12">
                    <div class="form-group">
                        <label class="control-label">Nova Password</label>
                        <input id="nova-password" class="form-control" type="password">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="control-label">Confirmar Nova Password</label>
                        <input id="confirmar-nova-password" class="form-control" type="password">
                    </div>
                </div>
            </div>-->


                <div class="form-group col-12">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end(); ?>
                </div>


        </div>

    </div>


</div>
