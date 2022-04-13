<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Novo Produto';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-novoproduto">
    <h1>Novo Produto</h1>
    <?= $this->render('_formNovoProduto', [
        'modelProduto' => $modelProduto,
        'arrayMateriais' => $arrayMateriais,
        'arrayCores' => $arrayCores
    ]) ?>
</div>