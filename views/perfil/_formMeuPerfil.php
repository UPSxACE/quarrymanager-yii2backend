<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $modelPerfil app\controllers\PerfilController */
/* @var $modelUpload app\controllers\PerfilController */
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meu-perfil-form row">
                <div class="col-9">
                    <?php $form = ActiveForm::begin(['options' => ['data.formShareValues'=>'[\'fieldtest1\'=>\'abc\', \'fieldtest2\'=>\'def\']']]); ?>
                    <div class="row">
                        <div class="col-12"><?= $form->field($modelPerfil, 'full_name',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->full_name, 'class'=>'form-control']])->textInput(['maxlength' => true]) ?></div>
                        <div class="col-6"><?= $form->field($modelPerfil, 'dataNascimento',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->dataNascimento , 'class'=>'form-control', 'type'=>'date']])->textInput(['maxlength' => true]) ?></div>
                        <div class="col-6"><?= $form->field($modelPerfil, 'genero',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->genero, 'class'=>'form-control']])->dropDownList(["Masculino", "Feminino", "Outro(s)"]) ?></div>
                        <div class="col-12"><?= $form->field($modelPerfil, 'morada',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->morada, 'class'=>'form-control']])->textInput(['maxlength' => true]) ?></div>
                        <div class="col-6"><?= $form->field($modelPerfil, 'codPostal',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->codPostal, 'class'=>'form-control']])->textInput(['maxlength' => true]) ?></div>
                        <div class="col-6"><?= $form->field($modelPerfil, 'localidade',['inputOptions' => ['value'=>Yii::$app->user->identity->profile->localidade, 'class'=>'form-control']])->textInput(['maxlength' => true]) ?></div>


                        <div class="col-12">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                            <?php //ActiveForm::end(); ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-3">
                    <div>Fotografia_perfil_atual</div>
                    <?php

                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                    <?= $form->field($modelUpload, 'imageFile')->fileInput() ?>

                    <button>Submit</button>

                    <?php ActiveForm::end() ?>
                </div>

</div>
