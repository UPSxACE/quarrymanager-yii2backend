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

    <?= $this->render('_formDefinicoes', [
        'modelDefinicoes' => $modelDefinicoes,
    ]) ?>

</div>