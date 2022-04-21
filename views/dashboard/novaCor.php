<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Nova Cor';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-novacor">
    <h1><?= $this->title ?></h1>
    <?= $this->render('_formNovaCor', [
        'modelCor' => $modelCor,
    ]) ?>
</div>