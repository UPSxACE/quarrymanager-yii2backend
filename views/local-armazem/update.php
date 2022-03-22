<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LocalArmazem */

$this->title = 'Update Local Armazem: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Local Armazems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="local-armazem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
