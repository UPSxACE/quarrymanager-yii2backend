<?php

use app\models\Produto;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $listaProdutos \yii\data\ActiveDataProvider*/

$this->title = 'Produto ' . $produto->id;
?>

<img height="500px" width="100%" style="object-fit: cover" src="/uploads/<?= $produto->idFotografia0->link ?>">

