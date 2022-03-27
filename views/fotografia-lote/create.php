<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FotografiaLote */

$this->title = 'Create Fotografia Lote';
$this->params['breadcrumbs'][] = ['label' => 'Fotografia Lotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotografia-lote-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
