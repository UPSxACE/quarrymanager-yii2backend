<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Novo Local de Armazém';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-novolocalarmazem">
    <h1><?= $this->title ?></h1>
    <?= $this->render('_formNovoLocalArmazem', [
        'modelLocalArmazem' => $modelLocalArmazem,
    ]) ?>
</div>