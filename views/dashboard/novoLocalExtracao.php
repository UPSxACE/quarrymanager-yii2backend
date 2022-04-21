<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Novo Local de Extração';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-novolocalextracao">
    <h1><?= $this->title ?></h1>
    <?= $this->render('_formNovoLocalExtracao', [
        'modelLocalExtracao' => $modelLocalExtracao,
    ]) ?>
</div>