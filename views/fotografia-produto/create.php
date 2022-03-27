<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FotografiaProduto */

$this->title = 'Create Fotografia Produto';
$this->params['breadcrumbs'][] = ['label' => 'Fotografia Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotografia-produto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
