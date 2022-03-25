<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoUtilizador */

$this->title = 'Create Tipo Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Utilizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-utilizador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
