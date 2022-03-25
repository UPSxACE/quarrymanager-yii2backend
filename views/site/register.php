<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Utilizador */
/* @var $form ActiveForm */

//use yii\bootstrap4\ActiveForm; necessário substituir?

$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'nome')->textInput() ?>
        <?= $form->field($model, 'morada')->textInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

    <?php
    /*
    <?= $form->field($model, 'nif')
    <?= $form->field($model, 'dataCriacao')
    <?= $form->field($model, 'localidade')
    <?= $form->field($model, 'nib') ?>
    <?= $form->field($model, 'telefone')
    <?= $form->field($model, 'codPostal')
    */
    ?>

</div><!-- site-register -->
