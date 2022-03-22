<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LocalArmazem */

$this->title = 'Create Local Armazem';
$this->params['breadcrumbs'][] = ['label' => 'Local Armazems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="local-armazem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
