<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cor */

$this->title = 'Create Cor';
$this->params['breadcrumbs'][] = ['label' => 'Cors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
