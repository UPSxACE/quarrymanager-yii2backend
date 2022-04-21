<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Novo Material';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-novomaterial">
    <h1><?= $this->title ?></h1>
    <?= $this->render('_formNovoMaterial', [
        'modelMaterial' => $modelMaterial,
    ]) ?>
</div>