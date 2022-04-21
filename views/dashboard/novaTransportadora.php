<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Nova Transportadora';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-novatransportadora">
    <h1><?= $this->title ?></h1>
    <?= $this->render('_formNovaTransportadora', [
        'modelTransportadora' => $modelTransportadora,
    ]) ?>
</div>