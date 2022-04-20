<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Adicionar Produto à Loja';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-novoprodutoloja">
    <h1>Novo Produto</h1>
    <?= $this->render('_formNovoProdutoLoja', [
        'modelProduto' => $modelProduto,
        'arrayMateriais' => $arrayMateriais,
        'arrayCores' => $arrayCores
    ]) ?>
</div>