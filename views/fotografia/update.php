<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fotografia */

$this->title = 'Update Fotografia: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fotografias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fotografia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
