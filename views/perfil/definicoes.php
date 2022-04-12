<?php

use yii\bootstrap4\Nav;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $modelDefinicoes app\controllers\DefinicoesController
/* @var $this yii\web\View */

$this->title = 'Definições';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="definicoes">
    <div class="row">
        <div class="col-2" style="">
            <?=
            $this->render('_sidebar', []);
            ?>
        </div>
        <div class="col-10">
            <h1>Definições da Conta</h1>

            <?php if(Yii::$app->session->hasFlash('Account-success')): ?>

                <div class="alert alert-success">
                    <?php echo Yii::$app->session->getFlash('Account-success'); ?>
                </div>

            <?php endif; ?>

            <?php if(Yii::$app->session->hasFlash('Account-fail')): ?>

                <div class="alert alert-danger">
                    <?php echo Yii::$app->session->getFlash('Account-fail'); ?>
                </div>

            <?php endif; ?>

            <?= $this->render('_formDefinicoes', [
                'modelDefinicoes' => $modelDefinicoes,
            ]) ?>
        </div>
    </div>
</div>