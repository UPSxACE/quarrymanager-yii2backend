<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $modelDefinicoes app\controllers\DefinicoesController
/* @var $this yii\web\View */

$this->title = 'Definições';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="definicoes">
    <h1>Definições da Conta</h1>

    <?php if(Yii::$app->session->hasFlash('Account-success')): ?>

        <div class="flash-success">
            <?php echo Yii::$app->session->getFlash('Account-success'); ?>
        </div>

    <?php endif; ?>

    <?= $this->render('_formDefinicoes', [
        'modelDefinicoes' => $modelDefinicoes,
    ]) ?>

</div>