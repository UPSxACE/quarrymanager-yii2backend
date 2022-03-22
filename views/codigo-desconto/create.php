<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CodigoDesconto */

$this->title = 'Create Codigo Desconto';
$this->params['breadcrumbs'][] = ['label' => 'Codigo Descontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codigo-desconto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
